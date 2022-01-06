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
        $galleryObjs = $galleryObjs->orderBy('updated_at', 'desc')->paginate(8);
        
    
        if ($request->ajax()) {
            $html = '';
            if (isset($galleryObjs)) {
                if (session('success')) {
                    foreach ($galleryObjs as $galleryObj) {
                        $fileName = $galleryObj->image;
                        $destinationPath = public_path().'/images/';
                        $withoutExtFileName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $fileName);
                        $renamedImage = $withoutExtFileName . '_resized';
                        
                        $info = getimagesize($destinationPath . $fileName);
                        $extension = image_type_to_extension($info[2]);
                        $renamedImage = $renamedImage . $extension ;
                        
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
                                        $html.='<img src="/images/'.$renamedImage.'" class="">';
                                    $html.='</a>';
                                $html.='</div>';
                            $html.='</div>';
                        }
                    }
                    
                } else {
                    foreach ($galleryObjs as $galleryObj) {
                        $fileName = $galleryObj->image;
                        $destinationPath = public_path().'/images/';
                        $withoutExtFileName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $fileName);
                        $renamedImage = $withoutExtFileName . '_resized';
                        
                        $info = getimagesize($destinationPath . $fileName);
                        $extension = image_type_to_extension($info[2]);
                        $renamedImage = $renamedImage . $extension ;
                        
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
                                    $html.='<img src="/images/'.$renamedImage.'" class="">';
                                $html.='</a>';
                            $html.='</div>';
                        $html.='</div>';
                    }
                }
            }
                 
            return $html;
        }

        return view('admin.gallerys.index');
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
