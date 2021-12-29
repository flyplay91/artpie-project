<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminGallerys;
use DB;

class ApiSelectGallerysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $selectedCatIds = $request->selected_cat_ids;
        $selectedPrices = $request->selected_price;

        $galleryObjs = DB::table('admin_gallerys');
        
        if (!empty($selectedCatIds)) {
            if (!in_array('any', $selectedCatIds)) {
                $galleryObjs = $galleryObjs->whereIn('category_id',$selectedCatIds);
            }
        }

        $minPrice = '';
        $maxPrice = '';
        
        if (!empty($selectedPrices)) {
            if (!in_array('any', $selectedPrices)) {
                $galleryObjs = $galleryObjs->where(function($query) use ($galleryObjs, $selectedPrices) {
                    foreach($selectedPrices as $selectedPrice) {
                        $splitedPrice = explode('_', $selectedPrice);
                        $minPrice = $splitedPrice[0];
                        $maxPrice = $splitedPrice[1];

                        if ($maxPrice == 'max') {
                            $galleryObjs = $galleryObjs->orWhere('retail_price', '>=', $minPrice);        
                        } else {
                            $galleryObjs = $galleryObjs->orWhereBetween('retail_price',[$minPrice, $maxPrice]);        
                        }
                    }
                });
            }
        }
        
        $galleryObjs = $galleryObjs->where('all_checked', 'true')->get();

        $galleryIdImageArr = [];
        
        foreach($galleryObjs as $galleryObj) {
            $galleryIdImageArr[$galleryObj->id] = array(
                'g_image' => $galleryObj->image,
                'g_title' => $galleryObj->title,
                'g_artist_name' => $galleryObj->artist_name
            );
        }
        
        try {
            return response()->json([
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
