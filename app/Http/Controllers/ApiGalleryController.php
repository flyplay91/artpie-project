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
use App\Orders;

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
        
        // $sameArtistObj = DB::table('admin_gallerys')->where('artist_id', $artistId)->get();
        // $sameArtistCount = count($sameArtistObj);

        $sameArtistsImageObj = DB::select("SELECT GROUP_CONCAT(image) as images FROM `admin_gallerys` WHERE `artist_id` = '".$artistId."' AND `id` != '".$galleryId."' AND `all_checked` = 'true'  GROUP BY `artist_id`");
        $sameArtistCount = count($sameArtistsImageObj);
        

        $galleryObj = AdminGallerys::find($galleryId);

        $artistNameEn = DB::table('admin_artists')->where('id', $galleryObj->artist_id)->pluck('art_name')->first();
        $artistNameCh = DB::table('admin_artists')->where('id', $galleryObj->artist_id)->pluck('art_name_ch')->first();
        $artistNameKo = DB::table('admin_artists')->where('id', $galleryObj->artist_id)->pluck('art_name_ko')->first();
        $artistDescriptionEn = DB::table('admin_artists')->where('id', $galleryObj->artist_id)->pluck('art_description')->first();
        $artistDescriptionCh = DB::table('admin_artists')->where('id', $galleryObj->artist_id)->pluck('art_description_ch')->first();
        $artistDescriptionKo = DB::table('admin_artists')->where('id', $galleryObj->artist_id)->pluck('art_description_ko')->first();

        $categoryNameEn = DB::table('admin_categories')->where('id', $galleryObj->category_id)->pluck('cat_name')->first();
        $categoryNameCh = DB::table('admin_categories')->where('id', $galleryObj->category_id)->pluck('cat_name_ch')->first();
        $categoryNameKo = DB::table('admin_categories')->where('id', $galleryObj->category_id)->pluck('cat_name_ko')->first();

        if (isset($galleryObj->piece_count)) {
            $galleryPieces = $galleryObj->piece_count;
        } else {
            $galleryPieces = 0;
        }

        $catName = DB::table('admin_categories')->where('id', $galleryObj->category_id)->pluck('cat_name');

        $artDesc = '';
        $artId = $galleryObj->artist_id;
        $artistObj = AdminArtists::find($artId);

        $orders = Orders::all();
        
        if (isset($artistObj->art_description)) {
            $artDesc = $artistObj->art_description;
            $artDesc = nl2br($artDesc);
        }
        
        $srcPath = public_path().'/images/'.$galleryObj->image;

        $filename = pathinfo($srcPath, PATHINFO_FILENAME);
        $ext = pathinfo($srcPath, PATHINFO_EXTENSION);
        $targetWidth = 800;
        $filenameResized = $filename . '_resized_'.$targetWidth.'x.'.$ext;
        
        $galleryObjArr = [];

        $galleryObjArr[$galleryObj->id] = array(
            'g_id'  => $galleryObj->id,
            'g_artist_des'  => $artDesc,
            'g_image' => $galleryObj->image,
            'g_resized_image' => $filenameResized,
            'g_title_en' => $galleryObj->title,
            'g_title_ch' => $galleryObj->title_ch,
            'g_title_ko' => $galleryObj->title_ko,
            'g_description_en' => nl2br($galleryObj->description),
            'g_description_ch' => nl2br($galleryObj->description_ch),
            'g_description_ko' => nl2br($galleryObj->description_ko),
            'g_artist_name_en' => $artistNameEn,
            'g_artist_name_ch' => $artistNameCh,
            'g_artist_name_ko' => $artistNameKo,
            'g_artist_description_en' => nl2br($artistDescriptionEn),
            'g_artist_description_ch' => nl2br($artistDescriptionCh),
            'g_artist_description_ko' => nl2br($artistDescriptionKo),
            'g_price' => $galleryObj->retail_price,
            'g_current_price' => $galleryObj->current_price(),
            'g_pieces' => $galleryPieces,
            'g_width'   => $galleryObj->width,
            'g_height'  => $galleryObj->height,
            'g_unit'  => $galleryObj->unit,
            'same_artist_count' => $sameArtistCount,
            'g_category_name_en' => $categoryNameEn,
            'g_category_name_ch' => $categoryNameCh,
            'g_category_name_ko' => $categoryNameKo,
            'g_check_pieces' => $galleryObj->check_enable_pieces,
        );

        if ($sameArtistCount > 0) {
            $sameArtistsImage = $sameArtistsImageObj[0]->images;
            $galleryObjArr[$galleryObj->id]['same_artist_images'] = $sameArtistsImage;
        }

        $isSoldout = false;
        foreach($orders as $order) {
            if ($order->gallery_id == $galleryId) {
                
                if ($order->status == 'cancel') {
                    $isSoldout = false;
                } else {
                    $isSoldout = true;
                    $orderedUserId = $order->user_id;
                    break;
                }
            }
        }

        if ($isSoldout == true) {
            $galleryObjArr[$galleryObj->id]['g_sold_out'] = 'sold_out';
            $galleryObjArr[$galleryObj->id]['g_sold_out_user_id'] = $orderedUserId;
        } else {
            $galleryObjArr[$galleryObj->id]['g_sold_out'] = 'sold_in';
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

        if ($availablePieceCount <= 0) {
            return response()->json([
                'success' => false,
                'data' => "No pieces are available!"
            ]);
        }
        
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
