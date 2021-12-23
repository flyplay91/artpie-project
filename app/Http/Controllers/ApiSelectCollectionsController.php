<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminGallerys;
use DB;

class ApiSelectCollectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $selectedCollIds = $request->selected_collection_ids;
        if (!$selectedCollIds) {
            return;
        }
        $galleryObjs = DB::table('admin_gallerys');
        // $galleryObjs = DB::table('admin_gallerys')
        //             ->whereIn('coll_id',$selectedCollIds)
        //             ->get();

        if (!empty($selectedCollIds)) {
            if (!in_array('any', $selectedCollIds)) {
                $galleryObjs = $galleryObjs->whereIn('coll_id',$selectedCollIds);
            }
        }

        $galleryObjs = $galleryObjs->get();

        $galleryIdImageArr = [];
        
        foreach($galleryObjs as $galleryObj) {
            $galleryIdImageArr[$galleryObj->id] = array(
                'g_image' => $galleryObj->image,
                'g_all_checked' => $galleryObj->all_checked,
            );
        }
        
        try {
			return response()->json([
			    'collection_ids' => $selectedCollIds,
                'gallery_ids_images' => $galleryIdImageArr
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
