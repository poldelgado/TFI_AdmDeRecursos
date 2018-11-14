<?php

namespace App\Http\Controllers;

use App\Product;
use App\Provider;
use Illuminate\Http\Request;

class ProductController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = Product::all();
        return $this->renderJson(true, $products, 'Listado de Productos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:35',
            'description' => 'required'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;

        if ($product->save()) {
            return $this->renderJson(true,null, 'Producto registrado exitosamente');
        }

        return $this->renderJson(false,null, 'Ocurrió un error al registrar el producto');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $product = Product::find($id);
        if (isset($product)) {
            return $this->renderJson(true, $product, 'Producto');
        }
        return $this->renderJson(false,null, 'No existe el producto buscado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|max:35',
            'description' => 'required'
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;

        if ($product->save()) {
            return $this->renderJson(true,null, 'El Producto fue actualizado exitosamente');
        }

        return $this->renderJson(false,null, 'Ocurrió un error al actualizar el producto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $product = Product::find($id);

        if ($product->delete()) {
            return $this->renderJson(true,null, 'Producto borrado exitosamente');
        }

        return $this->renderJson(false,null, 'Ocurrió un error al borrar el producto');
    }

    public function findProductName(Request $request) {

        $provider = Provider::find($request->id);

        return $this->renderJson(true,$provider->products ?? [], 'Listado de productos de ' . $provider->name);
    }
}
