<?php
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\AdminGallerys;
use App\AdminCollections;
use App\AdminCategories;
use App\AdminArtists;
use App\AdminHeaderData;
use App\Orders;
use Auth;

use Illuminate\Support\Facades\Log;


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
        $processingOrders = Orders::where('status', 'processing')->get();
        $processingOrderCount = count($processingOrders);
        return view('admin.gallerys.index',compact('gallerys', 'collections', 'headerData', 'processingOrderCount'));
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

    protected function resizeImage($srcPath, $targetWidth)
    {
        if (!file_exists($srcPath) || is_dir($srcPath)) {
            Log::error(__FUNCTION__.': Invalid path: '.$srcPath);
            return false;
        }

        if (!$targetWidth) {
            return false;
        }

        // Read source file
        $image = \Image::make($srcPath);

        // Generate new filename
        $filename = pathinfo($srcPath, PATHINFO_FILENAME);
        $ext = pathinfo($srcPath, PATHINFO_EXTENSION);
        $filenameResized = $filename . '_resized_'.$targetWidth.'x.'.$ext;
        $pathResized = pathinfo($srcPath, PATHINFO_DIRNAME).DIRECTORY_SEPARATOR.$filenameResized;

        // Resize to 400x
        $image->resize($targetWidth, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        return $image->save($pathResized);
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
            $dir = public_path().'/images/';

            // Full path to saved file
            $src = $dir . $fileName;
            while (file_exists($src)) {
                $fn = pathinfo($src, PATHINFO_FILENAME);
                $ext = pathinfo($src, PATHINFO_EXTENSION);
                $src = $dir.$fn.'_1.'.$ext;
            }

            $fileName = pathinfo($src, PATHINFO_BASENAME);

            $file->move($dir, $fileName);
            $gallerys->image = $fileName;

            // Resize to 400x
            $this->resizeImage($src, 400);

            // Resize to 800x
            $this->resizeImage($src, 800);
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

        $data['size'] = $size;
        $data['all_checked'] = $allChecked;

        $gallery = AdminGallerys::find($id);

        if (isset($request->check_enable_pieces)) {
            $data['check_enable_pieces'] = 'yes';
        } else {
            $data['check_enable_pieces'] = 'no';
        }

        $gallery->touch();
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
