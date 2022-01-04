<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminCategories;
use DB;

class ApiCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $catNameEn = $request->cat_name_en;
        $catNameCh = $request->cat_name_ch;
        $catNameKo = $request->cat_name_ko;
      
        $catIdNameArr = [];

        $catObjs = array('cat_name' => $catNameEn, 'cat_name_ch' => $catNameCh, 'cat_name_ko' => $catNameKo, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now());
        DB::table('admin_categories')->insert($catObjs);
        
        $catDatas = DB::select('SELECT * FROM admin_categories');

        foreach($catDatas as $catData) {
            $catIdNameArr[$catData->id] = $catData->cat_name;
        }
        

        try {
			return response()->json([
			    'categories' => $catIdNameArr,
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
