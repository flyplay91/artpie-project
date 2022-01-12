<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use App\OrderLineItems;
use App\Deposits;
use Auth;
use DB;

class AdminOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orders::orderBy('created_at', 'desc')->get();
        $processingOrders = Orders::where('status', 'processing')->get();
        $processingOrderCount = count($processingOrders);

        $processingDeposits = Deposits::where('status', 'pending')->get();
        $processingDepositCount = count($processingDeposits);
        return view('admin.orders.index', compact('orders', 'processingOrderCount', 'processingDepositCount'));
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
        $request->validate([
            'status' => 'required',
        ]);

        $data = $request->all();
        
        $order = Orders::find($id);
        $order->update($data);
        
        if ($order->status == 'completed') {
            $galleryId = $order->gallery_id;
            $senderEmail = $order->billing_email;
            $price = $order->total_price;

            $transactionObj = array('description' => 'whole', 'piece_count' => 0, 'gallery_id' => $galleryId, 'gallery_title' => $order->gallery->title, 'sender' => $senderEmail, 'receiver' => 'KArtPie Admin', 'price' => $price, 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now());
            DB::table('transactions')->insert($transactionObj);
        }

        return redirect()->route('admin-order.index')
                        ->with('success','Order status is updated successfully');
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
