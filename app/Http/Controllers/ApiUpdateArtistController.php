<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminArtists;
use DB;


class ApiUpdateArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $artistId = $request->artist_id;
        
        $artistNameEn = $request->artist_name_en;
        if (empty($request->artist_description_en)) {
            $artistDescriptionEn = '';
        } else {
            $artistDescriptionEn = $request->artist_description_en;
        }
        
        $artistNameCh = $request->artist_name_ch;
        if (empty($request->artist_description_ch)) {
            $artistDescriptionCh = '';
        } else {
            $artistDescriptionCh = $request->artist_description_ch;
        }

        $artistNameKo = $request->artist_name_ko;
        if (empty($request->artist_description_ko)) {
            $artistDescriptionKo = '';
        } else {
            $artistDescriptionKo = $request->artist_description_ko;
        }
        
        AdminArtists::where('id', $artistId)
                ->update([
                    'art_name' => $artistNameEn,
                    'art_name_ch' => $artistNameCh,
                    'art_name_ko' => $artistNameKo,
                    'art_description' => $artistDescriptionEn,
                    'art_description_ch' => $artistDescriptionCh,
                    'art_description_ko' => $artistDescriptionKo,
                ]);

        
        try {
            return response()->json([
                'success' => '1',
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
