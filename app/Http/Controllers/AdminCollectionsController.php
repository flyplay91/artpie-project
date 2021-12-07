<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminCollections;

class AdminCollectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = AdminCollections::all();
        return view('admin.gallerys.index',compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'coll_name' => 'required',
        ]);
        
        $collection = new AdminCollections($request->input()) ;
        $collection->save();
        $coll_name = $collection->coll_name;
        
        return redirect()->route('admin-gallery.index')
                        ->with('success', $coll_name);
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
        $collection = AdminCollections::find($id);
        return view('admin.gallerys.index', compact('collection'));
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
        $request->validate([
            'coll_name' => 'required',
        ]);

        $data = $request->all();
        $collection = AdminCollections::find($id);
        $collection->update($data);
  
        return redirect()->route('admin-gallery.index')
                        ->with('success','Collection is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = AdminCollections::find($id);
        $collection->delete();
  
        return redirect()->route('admin-gallery.index')
                        ->with('success','Product deleted successfully');
    }
}
