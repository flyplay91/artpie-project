<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminGallerys;
use App\AdminHeaderData;
use App\Orders;
use App\AdminArtists;
use App\AdminCategories;
use App\GalleryFragments;
use Auth;
use App\User;
use DB;

class MyGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $gallerys = [];
        $headerdata = AdminHeaderData::latest('id')->first();
        $fragments = GalleryFragments::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $artists = AdminArtists::all();
        $categories = AdminCategories::all();

        $userId = Auth::user()->id;
        $user = User::find($userId);
        
        return view('front.pages.myGallery.index',compact('headerdata', 'artists', 'categories', 'fragments', 'user'));
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
