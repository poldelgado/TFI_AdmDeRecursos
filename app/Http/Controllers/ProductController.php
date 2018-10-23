<?php

namespace App\Http\Controllers;

use App\Product;
use App\Provider;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index')->withProducts($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'name' => 'required|max:35',
            'description' => 'required'
        ));

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();


        if ($request->uri == "/products/create"){
            Session::flash('success','Producto registrado exitosamente');
            return redirect()->route('products.index');
        }
        else{
            Session::flash('success','Producto registrado exitosamente');
            return redirect()->route('products_providers.create');
        }
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
        $product = Product::find($id);

        return view('products.show')->withProduct($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('products.edit')->withProduct($product);
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
        $this->validate($request, array(
            'name' => 'required|max:35',
            'description' => 'required'
        ));

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();

        Session::flash('success', 'Producto actualizado exitosamente');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        Session::flash('success', 'Producto eliminado correctamente');
        return redirect()->route('products.index');
    }

    public function findProductName(Request $request){

        $provider = Provider::find($request->id);
        $data = $provider->products;

        //request->id this is the id of your chosen option id
        return response()->json($data);
    }
}
