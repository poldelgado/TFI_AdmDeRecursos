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
        $providersInfo = [];
        if (isset($providers)) {
            foreach ($providers as $provider) {
                $providerInfo['cuit'] = $provider->cuit;
                $providerInfo['name'] = $provider->name;
                $providerInfo['products'] = $provider->products;
                $providersInfo[] = $providerInfo;
            }
            return $this->renderJson(true, $providersInfo, 'Productos de Proveedor');
        }

        return $this->renderJson(false, null, 'Ocurrió un error al intentar obtener la lista de productos asociados a proveedor');
    }

    public function find($id) {
        $provider = Provider::find((int) $id);

        if (isset($provider)) {
            $providerInfo['cuit'] 		= $provider->cuit;
            $providerInfo['name'] 		= $provider->name;
            $providerInfo['products']	= $provider->products;
            return $this->renderJson(true, $providerInfo, 'Products de Proveedor');
        }

        return $this->renderJson(false, null, 'Ocurrió un error al intentar obtener la lista de productos asociados a proveedor');
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
