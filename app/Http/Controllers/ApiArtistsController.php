<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminArtists;
use DB;

class ApiArtistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $artistName = $request->artist_name;
        $artistDescription = $request->artist_description;
        
         
        if (!$artistName) {
            return;
        }

        $artistIdNameArr = [];

        $artistObjs = array('art_name' => $artistName, 'art_description' => $artistDescription , 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now());
        
        DB::table('admin_artists')->insert($artistObjs);
        
        $artistDatas = DB::select('SELECT * FROM admin_artists');

        foreach($artistDatas as $artistData) {
            $artistIdNameArr[$artistData->id] = $artistData->art_name;
        }
        

        try {
			return response()->json([
			    'artists' => $artistIdNameArr,
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
