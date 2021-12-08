<?php
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\AdminGallerys;
use App\AdminCollections;

class AdminGallerysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallerys = AdminGallerys::all();
        $collections = AdminCollections::all();
        return view('admin.gallerys.index',compact('gallerys', 'collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallerys.create');
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
            'coll_id'  => 'required',
        ]);

        $gallerys = new AdminGallerys($request->input()) ;

        if($file = $request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/';
            $file->move($destinationPath,$fileName);
            
            $gallerys->image = $fileName ;
        }

        if ($gallerys->save()) {
            $id = $gallerys->id;
        }
   
        // Product::create($request->all());
   
        return redirect()->route('admin-gallery.edit', $id)
                        ->with('success','Product created successfully.');
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
        $gallery = AdminGallerys::find($id);
        return view('admin.gallerys.edit', compact('gallery'));
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
            'title' => 'required',
            'size'  => 'required',
            'price' => 'required',
            'category'  => 'required',
            'artist_id' => 'required',
            'pieces_number' => 'required',
            'paint_date' => 'required',
            'registered_date'   =>  'required',
            'updated_date'  =>  'required',
            'frame' => 'required',
            'description'   =>  'required',
            'keywords'  => 'required',
            'original'  => 'required',
            'signed'    =>  'required'
        ]);

        $data = $request->all();

        if($file = $request->hasFile('image')) {
            
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/';
            $file->move($destinationPath,$fileName);

            $data['image'] = $fileName;
        }
        $gallery = AdminGallerys::find($id);
        $gallery->update($data);
  
        return redirect()->route('admin-gallery.index')
                        ->with('success','Product updated successfully');
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
