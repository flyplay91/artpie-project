<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminGallerys;
use App\AdminArtists;
use DB;

class ApiSearchGallerysController extends Controller
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
        $selectedValue = $request->selected_search_val;
        $selectedLang = $request->selected_lang;
        

        $galleryObjs = DB::table('admin_gallerys');
        $artists = AdminArtists::all();
        
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

        if ($selectedLang == 'en') {

        } else if ($selectedLang == 'ch') {

        } else if ($selectedLang == 'ko') {
            
        }
        $galleryObjs = $galleryObjs->where('all_checked', 'true')
                                    ->where('title', 'like', '%' . $selectedValue . '%')
                                    ->orwhere('title_ch', 'like', '%' . $selectedValue . '%')
                                    ->orwhere('title_ko', 'like', '%' . $selectedValue . '%')
                                    ->orWhere('artist_name', 'like', '%' . $selectedValue . '%')
                                    ->orWhere('artist_name_ch', 'like', '%' . $selectedValue . '%')
                                    ->orWhere('artist_name_ko', 'like', '%' . $selectedValue . '%')
                                    ->orWhere('keywords', 'like', '%' . $selectedValue . '%')->orderBy('updated_at', 'desc')->get();

        $galleryIdImageArr = [];
        
        foreach($galleryObjs as $galleryObj) {
            $srcPath = public_path().'/images/'.$galleryObj->image;
            $filename = pathinfo($srcPath, PATHINFO_FILENAME);
            $ext = pathinfo($srcPath, PATHINFO_EXTENSION);
            $targetWidth = 400;
            $filenameResized = $filename . '_resized_'.$targetWidth.'x.'.$ext;

            $galleryIdImageArr[] = array(
                'g_id' => $galleryObj->id,
                'g_image' => $filenameResized,
                'g_title_en' => $galleryObj->title,
                'g_title_ch' => $galleryObj->title_ch,
                'g_title_ko' => $galleryObj->title_ko,
                'g_artist_name_en' => $galleryObj->artist_name,
                'g_artist_name_ch' => $galleryObj->artist_name_ch,
                'g_artist_name_ko' => $galleryObj->artist_name_ko
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
