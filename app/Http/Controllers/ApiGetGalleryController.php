<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminGallerys;
use App\AdminArtists;
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
        
        $galleryObj = AdminGallerys::find($galleryId);

        $artistName = DB::table('admin_artists')->where('id', $galleryObj->artist_id)->pluck('art_name')->first();
        if (isset($galleryObj->piece_count)) {
            $galleryPieces = $galleryObj->piece_count;
        } else {
            $galleryPieces = 0;
        }
        $galleryObjArr = [];

        $galleryObjArr[$galleryObj->id] = array(
            'g_id'  => $galleryObj->id,
            'g_image' => $galleryObj->image,
            'g_title' => $galleryObj->title,
            'g_description' => $galleryObj->description,
            'g_artistname' => $artistName,
            'g_price' => $galleryObj->retail_price,
            'g_pieces' => $galleryPieces,
            
        );
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
