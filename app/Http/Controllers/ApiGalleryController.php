<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminGallerys;
use App\GalleryFragments;
use App\AdminArtists;
use App\AdminCategories;
use DB;
use App\User;
use App\Setting;

class ApiGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $galleryId = $request->gallery_id;
        $artistId = $request->artist_id;
        
        $sameArtistObj = DB::table('admin_gallerys')->where('artist_id', $artistId)->get();
        $sameArtistCount = count($sameArtistObj);

        $sameArtistsImageObj = DB::select("SELECT GROUP_CONCAT(image) as images FROM `admin_gallerys` WHERE `artist_id` = '".$artistId."' AND `id` != $galleryId  GROUP BY `artist_id`");

        $galleryObj = AdminGallerys::find($galleryId);

        $artistName = DB::table('admin_artists')->where('id', $galleryObj->artist_id)->pluck('art_name')->first();
        if (isset($galleryObj->piece_count)) {
            $galleryPieces = $galleryObj->piece_count;
        } else {
            $galleryPieces = 0;
        }

        $catName = DB::table('admin_categories')->where('id', $galleryObj->category_id)->pluck('cat_name');

        $artDesc = '';
        $artId = $galleryObj->artist_id;
        $artistObj = AdminArtists::find($artId);
        if (isset($artistObj->art_description)) {
            $artDesc = $artistObj->art_description;
            $artDesc = nl2br($artDesc);
        }
        
        
        $galleryObjArr = [];

        $galleryObjArr[$galleryObj->id] = array(
            'g_id'  => $galleryObj->id,
            'g_artist_des'  => $artDesc,
            'g_image' => $galleryObj->image,
            'g_title' => $galleryObj->title,
            'g_description' => nl2br($galleryObj->description),
            'g_artistname' => $artistName,
            'g_price' => $galleryObj->retail_price,
            'g_pieces' => $galleryPieces,
            'g_width'   => $galleryObj->width,
            'g_height'  => $galleryObj->height,
            'g_unit'  => $galleryObj->unit,
            'same_artist_count' => $sameArtistCount,
            'g_category_name' => $catName,
            'g_check_pieces' => $galleryObj->check_enable_pieces,
        );

        if (count($sameArtistsImageObj) > 0) {
            $sameArtistsImage = $sameArtistsImageObj[0]->images;
            $galleryObjArr[$galleryObj->id]['same_artist_images'] = $sameArtistsImage;
        }
        try {
			return response()->json([
                'gallery_Obj' => $galleryObjArr,
			]);
		} catch (Exception $e) {
		    echo 'Caught exception: '. $e->getMessage() ."\n";

		    return response()->json([
			    'failed' => '1',
			    'error_message' => $e->getMessage(),
			]);
		}
        
    }

    /**
     * Purchase gallery fragments
     *
     * @return \Illuminate\Http\Response
     */
    public function purchaseFragments(Request $request)
    {
        $gallery = AdminGallerys::find($request->gallery_id);
        $requestedPieceCount = $request->piece_count;
        $userId = $request->user_id;
        
        if ($gallery->check_enable_pieces != 'yes') {
            return response()->json([
			    'success' => false,
			    'data' => "This gallery can't be purchased by pieces"
			]);
        }

        $fragmentPrice = 0;
        $fragment = GalleryFragments::where(
            ['user_id' => $userId, 'gallery_id' => $gallery->id]
        )->first();

        if (empty($fragment)) {
            $fragment = GalleryFragments::create(
                [
                    'user_id' => $userId,
                    'gallery_id' => $gallery->id,
                    'piece_count' => 0,
                    'buy_price' => 0.00,
                    'sell_price' => 0.00
                ]
            );
        }

        $availablePieceCount = $gallery->piece_count - $fragment->piece_count;
        $requestedPieceCount = $availablePieceCount > $requestedPieceCount ? $requestedPieceCount : $availablePieceCount;
        $fragmentPrice = $fragment->piece_count * $fragment->buy_price;
        $fragmentPieces = $fragment->piece_count;

        if ($requestedPieceCount < $gallery->remainingPieces()) {
            $fragmentPrice += $gallery->retail_price / $gallery->piece_count * $requestedPieceCount;
            $fragmentPieces += $requestedPieceCount;
        } else {
            $fragmentPrice += $gallery->retail_price / $gallery->piece_count * $gallery->remainingPieces();
            $fragmentPieces += $gallery->remainingPieces();
            $requestedPieceCount -= $gallery->remainingPieces();
            $fragments = $gallery->availableFragments($userId)->get();

            foreach($fragments as $frag) {
                if ($requestedPieceCount < $frag->piece_count) {
                    $fragmentPrice += $frag->sell_price * $requestedPieceCount;
                    $fragmentPieces += $requestedPieceCount;
                    $frag->piece_count -= $requestedPieceCount;
                    $frag->save();
                    break;
                } else {
                    $fragmentPrice += $frag->sell_price * $frag->piece_count;
                    $fragmentPieces += $frag->piece_count;
                    $requestedPieceCount -= $frag->piece_count;
                    $frag->delete();
                }

                if ($requestedPieceCount <= 0) {
                    break;
                }
            }
        }

        $fragment->buy_price = $fragmentPrice / $fragmentPieces;
        $fragment->piece_count = $fragmentPieces;

        if ($fragment->sell_price <= 0) {
            $fragment->sell_price = $fragment->buy_price * 1.2;
        }
        $fragment->save();

        return response()->json([
            'success' => true,
            'data' => "Pieces are successfully purchased"
        ]);
    }
}