<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminHeaderData;

class AdminHeaderDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'sub_title' => 'required',
        ]);
        
        $headerData = new AdminHeaderData($request->input());

        if($file = $request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/';
            $file->move($destinationPath,$fileName);
            
            $headerData->image = $fileName ;
        }
        $headerData->save();

        return redirect()->route('admin-gallery.index')
                        ->with('success', 'Header data is created.');
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
            
            'title'  => 'required',
            'sub_title'  => 'required',
        ]);
        $data = $request->all();

        if($file = $request->hasFile('image')) {
            
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/';
            $file->move($destinationPath,$fileName);

            $data['image'] = $fileName;
        }
        
        $headerData = AdminHeaderData::find($id);
        $headerData->update($data);

        return redirect()->route('admin-gallery.index')
                        ->with('success','Header is updated successfully');
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
