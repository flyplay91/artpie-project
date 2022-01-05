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

        if (!empty($selectedCollIds)) {
            if (!in_array('any', $selectedCollIds)) {
                $galleryObjs = $galleryObjs->whereIn('coll_id',$selectedCollIds);
            }
        }

        // $galleryObjs = $galleryObjs->get();
        $galleryObjs = $galleryObjs->orderBy('updated_at', 'desc')->paginate(5);
        
    
        if ($request->ajax()) {
            $html = '';

            
            if (session('success') || ($selectedCollIds[0] != 'any' && count($selectedCollIds) == 1)) {
                $html.='<div class="hdrItems-list active hdrItems-list--addmore">';
                    $html.='<div class="hdrItems-list__inner flex aic jcc" style="height: 200px">';
                        $html.='<a class="btn-gallery-create" href="/admin-gallery/create?'.$selectedCollIds[0].'">그림추가</a>';
                    $html.='</div>';
                $html.='</div>';
            } else {
                $html.='<div class="hdrItems-list hdrItems-list--addmore">';
                    $html.='<div class="hdrItems-list__inner flex aic jcc" style="height: 200px">';
                        $html.='<a class="btn-gallery-create" href="/admin-gallery/create?'.$selectedCollIds[0].'">그림추가</a>';
                    $html.='</div>';
                $html.='</div>';
            }
            
            if (isset($galleryObjs)) {
                if (session('success')) {
                    foreach ($galleryObjs as $galleryObj) {
                        if (session('success') == $galleryObj->coll_id) {
                            $html.='<div class="hdrItems-list">';
                                if ($galleryObj->all_checked == 'false') {
                                    $html.='<div class="hdrItems-list__inner required">';    
                                } else {
                                    $html.='<div class="hdrItems-list__inner">';
                                }
                                    $html.='<a href="'.route('admin-gallery.edit',$galleryObj->id).'">';
                                    if ($galleryObj->all_checked == 'false') {
                                        $html.='<div class="hdrItems-list__inner-overlay"><label>편집요청</label></div>';
                                    }
                                    $html.='<img src="/images/'.$galleryObj->resized_image.'">';
                                    $html.='</a>';
                                $html.='</div>';
                            $html.='</div>';
                        }
                    }
                    
                } else {
                    foreach ($galleryObjs as $galleryObj) {
                        $html.='<div class="hdrItems-list">';
                            if ($galleryObj->all_checked == 'false') {
                                $html.='<div class="hdrItems-list__inner required">';    
                            } else {
                                $html.='<div class="hdrItems-list__inner">';
                            }
                                $html.='<a href="'.route('admin-gallery.edit',$galleryObj->id).'">';
                                if ($galleryObj->all_checked == 'false') {
                                    $html.='<div class="hdrItems-list__inner-overlay"><label>편집요청</label></div>';
                                }
                                    $html.='<img src="/images/'.$galleryObj->resized_image.'">';
                                $html.='</a>';
                            $html.='</div>';
                        $html.='</div>';
                    }
                }
            }
                 
            return $html;
        }

        return view('admin.gallerys.index');
        

        // $galleryIdImageArr = [];
        
        // foreach($galleryObjs as $galleryObj) {
        //     $galleryIdImageArr[$galleryObj->id] = array(
        //         'g_image' => $galleryObj->resized_image,
        //         'g_all_checked' => $galleryObj->all_checked,
        //     );
        // }
        
        // try {
		// 	return response()->json([
		// 	    'collection_ids' => $selectedCollIds,
        //         'gallery_ids_images' => $galleryIdImageArr
		// 	]);
		// } catch (Exception $e) {
		//     echo 'Caught exception: '. $e->getMessage() ."\n";

		//     return response()->json([
		// 	    'failed' => '1',
		// 	    'error_message' => $e->getMessage(),
		// 	]);
		// }
        
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
