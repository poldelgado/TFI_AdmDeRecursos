<?php

namespace App\Http\Controllers;

use App\BuyOrder;
use App\Product;
use App\Provider;
use Illuminate\Http\Request;
use Session;

class BuyOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('buy_orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $providers = Provider::all();

        return view('buy_orders.newOrder')->withProducts($products)->withProviders($providers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'date_order' => 'required:date',
            'providers' => 'required',
            'products' => 'required',
            'warranty_void' =>  'required:integer',
            'total' => 'required'
        ));

        $buy_order = new BuyOrder();
        $buy_order->date_order = $request->date_order;
        $buy_order->provider_id = $request->providers;
        $buy_order->product_id = $request->products;
        $buy_order->warranty_void = $request->warranty_void;
        $buy_order->total = $request->total;

        $buy_order->save();
        Session::flash('success','Orden de Compra registrada exitosamente');
        return redirect()->route('buy_orders.index');

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
