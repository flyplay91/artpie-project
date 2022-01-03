<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminArtists;

class ApiGetArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $selectedArtistId = $request->selected_artist_id;
        $artist = AdminArtists::find($selectedArtistId);

        $artistIdNameArr = [];
        
        $artist_name_en = $artist->art_name;
        $artist_description_en = $artist->art_description;

        $artist_name_ch = $artist->art_name_ch;
        $artist_description_ch = $artist->art_description_ch;

        $artist_name_ko = $artist->art_name_ko;
        $artist_description_ko = $artist->art_description_ko;

        $artistIdNameArr[$selectedArtistId] = array(
            'artist_name_en' => $artist_name_en,
            'artist_name_ch' => $artist_name_ch,
            'artist_name_ko' => $artist_name_ko,
            'artist_description_en' => $artist_description_en,
            'artist_description_ch' => $artist_description_ch,
            'artist_description_ko' => $artist_description_ko
        );

        try {
			return response()->json([
			    'artist' => $artistIdNameArr,
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
