<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use DB;

class ApiBillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $galleryId = $request->gallery_id;
        $userId = $request->user_id;
        $totalPrice = $request->total_price;
        $billingEmail = $request->billing_email;
        $billingPhone = $request->billing_phone;
        $billingAddress = $request->billing_address;
        $billingName = $request->billing_name;
        $billingComment = $request->billing_comment;

        $billingObjs = array('user_id' => $userId, 'gallery_id' => $galleryId, 'billing_email' => $billingEmail, 'billing_phone' => $billingPhone, 'billing_address' => $billingAddress, 'billing_name' => $billingName, 'total_price' => $totalPrice, 'total_price' => $totalPrice, 'status' => 'pending', 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now());
        
        DB::table('orders')->insert($billingObjs);

        try {
			return response()->json([
			    'success' => 'ok',
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
