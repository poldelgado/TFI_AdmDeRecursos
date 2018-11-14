<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;
use App\Product;
use Illuminate\Support\Facades\DB;

class ProductProviderController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $providers = Provider::all();
        $products = Product::all();

        return $this->renderJson(true, ['products' => $products, 'providers' =>$providers], 'Listado de Productos de Proveedores');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'product_id' => 'required|integer',
            'provider_id' => 'required|integer',
        ]);

        DB::table('product_provider')->insert(
            ['product_id' => $request->product_id,
                'provider_id' => $request->provider_id,
            ]);

        return $this->renderJson(true, null, 'El Producto fue asociado al Proveedor correctamente');
    }
}
