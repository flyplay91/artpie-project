<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminGallerys;
use App\AdminArtists;
use App\AdminCategories;
use DB;

class ApiGetGalleryController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
