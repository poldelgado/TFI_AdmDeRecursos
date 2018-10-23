<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use App\PurchaseQualification;
use App\Product;
use App\Provider;
use App\ProviderQualification;
use Illuminate\Http\Request;
use Session;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = PurchaseOrder::all();
        return view('purchase_orders.index')->withOrders($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['products'] = Product::all();
        $data['providers'] = Provider::all();

        return view('purchase_orders.newOrder', $data);
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
            'warranty_void' =>  'required:integercontro',
            'total' => 'required'
        ));

        $buy_order = new PurchaseOrder();
        $buy_order->date_order = $request->date_order;
        $buy_order->provider_id = $request->providers;
        $buy_order->product_id = $request->products;
        $buy_order->warranty_void = $request->warranty_void;
        $buy_order->total = $request->total;
        $qualification = new PurchaseQualification();
        $qualification->save();
        $buy_order->purchase_qualification()->associate($qualification);
        $buy_order->save();
        Session::flash('success','Orden de Compra registrada exitosamente');
        return redirect()->route('purchase_orders.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = PurchaseOrder::find($id);

        return view('purchase_orders.show')->withOrder($order);
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

    public function qualifyPurchaseOrder($id)
    {
        $order = PurchaseOrder::find($id);
        return view('purchase_orders.qualify_purchase_order')->withOrder($order);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateQualification(Request $request, $id)
    {

        $qualification = PurchaseQualification::find($id);
        $qualification->delivery = $request->delivery;
        $qualification->status = $request->status;
        $qualification->warranty = $request->warranty;
        $qualification->average = (double)(($request->delivery+$request->status+$request->warranty)/3);
        $qualification->save();

        $prov_qual_id = $qualification->buy_order->provider->provider_qualification_id;

        //Actualizar Calificación del proveedor
        $prov_qual = ProviderQualification::find($prov_qual_id);



            $purchase_orders = PurchaseOrder::all()->where('provider', $qualification->buy_order->provider);
            $count = PurchaseOrder::all()->where('provider', $qualification->buy_order->provider)->count();
            $delivery = 0;
            $status = 0;
            $warranty = 0;
            foreach($purchase_orders as $order)
            {
                echo($order->buy_qualification->delivery);
                $delivery = $delivery + $order->buy_qualification->delivery;
                $status = $status + $order->buy_qualification->status;
                $warranty = $warranty + $order->buy_qualification->warranty;
            }
            $prov_qual->delivery = floatval($delivery/$count);
            $prov_qual->status = floatval($status/$count);
            $prov_qual->warranty = floatval($warranty/$count);
            $prov_qual->average = ($prov_qual->delivery + $prov_qual->status + $prov_qual->warranty)/3;



        $prov_qual->save();
        return redirect()->route('purchase_orders.index');
    }
}
