<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Orders;
use App\OrderLineItems;
use Session;

class OrderInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $request->validate([
            'billing_email' => 'required',
            'billing_phone' => 'required',
            'billing_address' => 'required',
            'billing_name' => 'required',
        ]);
        
        $requestOrderData = $request->input();
        
        $orderData = [
            'user_id'   => $requestOrderData['user_id'],
            'billing_email' => $requestOrderData['billing_email'],
            'billing_phone' => $requestOrderData['billing_phone'],
            'billing_address' => $requestOrderData['billing_address'],
            'billing_name' => $requestOrderData['billing_name'],
            'total_price' => $requestOrderData['total_price'],
            'status' => 'pending',
        ];

        if (!empty($requestOrderData['user_id'])) {
            $orderData['user_id'] = $requestOrderData['user_id'];
        }
        
        $order = new Orders($orderData);
        $order->save();
        
        // Line Item
        foreach($requestOrderData['gallery_id'] as $index => $galleryId) {
            $gallery = [
                'order_id'   => $order->id,
                'gallery_id' => $galleryId,
                'image' => $requestOrderData['image'][$index],
                'title' => $requestOrderData['title'][$index],
                'qty'   => $requestOrderData['qty'][$index],
                'price' => $requestOrderData['price'][$index],
            ];
            

            $lineItem = new OrderLineItems($gallery);
            $lineItem->save();
        }

        Session::forget('cart');
        Session::save();
        
        return redirect()->action('front\GallerysController@index')
                        ->with('success', 'Order is made successfully');
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
