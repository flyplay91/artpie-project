<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ApiAdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $checkUser = $request->checked;
        
        $userId = $request->user_id;
        $userObj = User::find($userId);
        
        if ($checkUser == 'true') {
            User::where('id', $userId)
            ->update([
                'role' => 'admin',
            ]);
        } else {
            User::where('id', $userId)
            ->update([
                'role' => 'buyer',
            ]);
        }
        

        try {
            return response()->json([
                'success' => '0',
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
