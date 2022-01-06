<?php
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\AdminGallerys;
use App\AdminCollections;
use App\AdminCategories;
use App\AdminArtists;
use App\AdminHeaderData;


class AdminGallerysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $gallerys = AdminGallerys::latest()->first();
        $gallerys = AdminGallerys::orderBy('updated_at', 'desc')->get();
        $collections = AdminCollections::all();
        $headerData = AdminHeaderData::latest('id')->first();
        return view('admin.gallerys.index',compact('gallerys', 'collections', 'headerData'));
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'coll_id'  => 'required',
        ]);
        $collId = $request->coll_id;

        $gallerys = new AdminGallerys($request->input()) ;

        if($file = $request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/';
            $file->move($destinationPath,$fileName);
            
            $gallerys->image = $fileName;

            $resizedImage = \Image::make($destinationPath . $fileName);
            $resizedImage->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $withoutExtFileName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $fileName);
            $renamedImage = $withoutExtFileName . '_resized';
            $info = getimagesize($destinationPath . $fileName);
            $extension = image_type_to_extension($info[2]);
            $renamedImage = $renamedImage . $extension ;
            
            $resizedImage->save($destinationPath . $renamedImage);
        }

        $gallerys->all_checked = 'false';

        if ($gallerys->save()) {
            $id = $gallerys->id;
        }
   
        return redirect()->route('admin-gallery.index')
                        ->with('success',$collId);
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
        $categories = AdminCategories::all();
        $artists = AdminArtists::all();
        
        return view('admin.gallerys.edit', compact('gallery', 'categories', 'artists'));
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
        ]);
        
        $width = intval($request->width);
        $height = intval($request->height);
        $size = intval(sqrt(pow($width, 2) + pow($height, 2)));
        
        $data = $request->all();
        
        $allChecked = "true";

        foreach($data as $key => $value) {
            if ($key != 'description_ch' && $key != 'description' && $key != 'description_ko' && $key != 'keywords' && $key != 'materials' 
                && $key != 'paint_date' && $key != 'piece_count') {
                    
                if (empty($value)) {
                    $allChecked = "false";
                }
            }
        }

        if($file = $request->hasFile('image')) {
            
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/';
            $file->move($destinationPath,$fileName);

            $data['image'] = $fileName;

            $resizedImage = \Image::make($destinationPath . $fileName);
            $resizedImage->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $withoutExtFileName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $fileName);
            $renamedImage = $withoutExtFileName . '_resized';
            $info = getimagesize($destinationPath . $fileName);
            $extension = image_type_to_extension($info[2]);
            $renamedImage = $renamedImage . $extension ;
            
            $resizedImage->save($destinationPath . $renamedImage);
        }

        $data['size'] = $size;
        $data['all_checked'] = $allChecked;

        $gallery = AdminGallerys::find($id);

        if (isset($request->check_enable_pieces)) {
            $data['check_enable_pieces'] = 'yes';
        } else {
            $data['check_enable_pieces'] = 'no';
        }

        $gallery->update($data);
        
        return redirect()->route('admin-gallery.index')
                        ->with('success',$gallery->coll_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $gallery = AdminGallerys::find($id);
        
        $gallery->delete();
  
        return redirect()->route('admin-gallery.index')
                        ->with('success',$gallery->coll_id);
    }
}
