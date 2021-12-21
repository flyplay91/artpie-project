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
            'user_id'   => 'required',
            'address_1' => 'required',
        ]);
        
        $requestOrderData = $request->input();
        
        $orderData = [
            'user_id'   => $requestOrderData['user_id'],
            'user_name'   => $requestOrderData['user_name'],
            'user_email'   => $requestOrderData['user_email'],
            'address_1'   => $requestOrderData['address_1'],
            'total_price' => $requestOrderData['total_price'],
            'status' => 'pending',
        ];

        if (!empty($requestOrderData['address_2'])) {
            $orderData['address_2'] = $requestOrderData['address_2'];
        }
        if (!empty($requestOrderData['address_3'])) {
            $orderData['address_3'] = $requestOrderData['address_3'];
        }
        if (!empty($requestOrderData['address_4'])) {
            $orderData['address_4'] = $requestOrderData['address_4'];
        }
        if (!empty($requestOrderData['address_5'])) {
            $orderData['address_5'] = $requestOrderData['address_5'];
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
        return redirect()->route('gallery.index')
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
