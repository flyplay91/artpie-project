<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminGallerys;
use App\AdminArtists;
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
        $artists = AdminArtists::all();
        $selectedCatIds = $request->selected_cat_ids;
        $selectedPrices = $request->selected_price;
        $selectedLang = $request->selected_lang;
        
        $galleryObjs = DB::table('admin_gallerys');
        
        if (!empty($selectedCatIds)) {
            if (!in_array('any', $selectedCatIds)) {
                $galleryObjs->whereIn('category_id',$selectedCatIds);
            }
        }

        $minPrice = '';
        $maxPrice = '';
        
        if (!empty($selectedPrices)) {
            if (!in_array('any', $selectedPrices)) {
                $galleryObjs->where(function($galleryObjs) use ($selectedPrices) {
                    foreach($selectedPrices as $k => $selectedPrice) {
                        $splitedPrice = explode('_', $selectedPrice);
                        $minPrice = $splitedPrice[0];
                        $maxPrice = $splitedPrice[1];

                        if ($maxPrice == 'max') {
                            $galleryObjs->orWhere('retail_price', '>=', $minPrice);        
                        } else {
                            $galleryObjs->orWhereBetween('retail_price',[$minPrice, $maxPrice]);        
                        }
                    }
                });
            }
        }
        
        // $galleryObjs = $galleryObjs->where('all_checked', 'true')->get();
        $galleryObjs = $galleryObjs->where('all_checked', 'true')->orderBy('updated_at', 'desc')->paginate(6);

        if ($request->ajax()) {
            $html = '';

            if (isset($galleryObjs)) {
                foreach ($galleryObjs as $galleryObj) {
                    $srcPath = public_path().'/images/'.$galleryObj->image;

                    $filename = pathinfo($srcPath, PATHINFO_FILENAME);
                    $ext = pathinfo($srcPath, PATHINFO_EXTENSION);
                    $targetWidth = 400;
                    $filenameResized = $filename . '_resized_'.$targetWidth.'x.'.$ext;

                    
                    if ($galleryObj->all_checked == 'true') {
                        if ($galleryObj->check_enable_pieces == 'yes') {
                            $html .= '<div class="hdrItems-list piece-gallery">';
                        } else {
                            $html .= '<div class="hdrItems-list">';
                        }
                            $html .= '<div class="hdrItems-list__inner position-relative">';
                                $html .= '<div class="hdrItems-list__tooltip position-absolute">';
                                    $html .= '<label>';
                                    if ($selectedLang == 'en') {
                                        $html .= $galleryObj->title;
                                    } else if ($selectedLang == 'ch') {
                                        $html .= $galleryObj->title_ch;
                                    } else if ($selectedLang == 'ko') {
                                        $html .= $galleryObj->title_ko;
                                    } else {
                                        $html .= $galleryObj->title;
                                    }
                                    $html .= '</label>';
                                    if (isset($artists)) {
                                        foreach ($artists as $artist) {
                                            if ($artist->id == $galleryObj->artist_id) {
                                            $html .= '<span>';
                                                if ($selectedLang == 'en') {
                                                    $html .= $artist->art_name;
                                                } else if ($selectedLang == 'ch') {
                                                    $html .= $artist->art_name_ch;
                                                } else if ($selectedLang == 'ko') {
                                                    $html .= $artist->art_name_ko;
                                                } else {
                                                    $html .= $artist->art_name;
                                                }
                                                $html .= '</span>';
                                            }
                                        }
                                    }
                                $html .= '</div>';
                                $html .= '<a class="image-gallery" href="javascript:void(0)" data-id="'.$galleryObj->id.'" data-artist-id="'.$galleryObj->artist_id.'">';
                                    $html .= '<div class="hdrItems-list__inner-overlay"></div>';
                                    $html .= '<img src="/images/'.$filenameResized.'">';
                                $html .= '</a>';
                            $html .= '</div>';
                        $html .= '</div>';
                    }
                }
            }

            return $html;

        }

        return view('front.pages.home');

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
