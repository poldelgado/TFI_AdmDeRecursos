<?php

namespace App\Http\Controllers;

use App\ProviderQualification;
use Illuminate\Http\Request;

use App\Provider;


class ProviderController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $providers = Provider::with('provider_qualification')->all();
        $providersWithQualifications = [];
        foreach ($providers as $provider) {
            $providersWithQualifications[] = [
                "id" => $provider->id,
                "name" => $provider->name,
                "email" => $provider->email,
                "phone" => $provider->phone,
                "cuit" => $provider->cuit,
                "address" => $provider->address,
                "qualification" => $provider->provider_qualification()->average,
            ];
        }

        return $this->renderJson(true, $providersWithQualifications, 'Listado de Proveedores');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:5',
            'cuit' => 'required|numeric',
            'email' => 'required|email',
            'phone' => 'required|min:5|max:20',
            'address' => 'required'
        ]);

        $provider = new Provider();

        $provider->name = $request->name;
        $provider->cuit = $request->cuit;
        $provider->email = $request->email;
        $provider->phone = $request->phone;
        $provider->address = $request->address;

        //Creamos un nuevo objeto Calificación de Proveedor
        $provider_qualification = new ProviderQualification();
        if ($provider_qualification->save()) {
            $provider->provider_qualification()->associate($provider_qualification); //Asociamos el objeto calificación.
            if ($provider->save()) {
                $provider->technicians()->sync($request->technicians, false);
                return $this->renderJson(true, null, 'Proveedor registrado exitosamente');
            }
        }

        return $this->renderJson(false, null, 'Ocurrió un error al registrar el proveedor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $provider = Provider::find($id);
        if (isset($provider)) {
            $provicerWithQualification = [
                "id" => $provider->id,
                "name" => $provider->name,
                "email" => $provider->email,
                "phone" => $provider->phone,
                "cuit" => $provider->cuit,
                "address" => $provider->address,
                "qualification" => $provider->provider_qualification()->average,
            ];
            return $this->renderJson(true, $provicerWithQualification, 'Proveedor');
        }
        return $this->renderJson(false, null, 'No existe el proveedor buscado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //validar los datos
        $this->validate($request, [
            'name' => 'required|max:30',
            'cuit' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email'
        ]);


        // guardar los datos en la bbdd

        $provider = Provider::find($id);

        $provider->name = $request->input('name');
        $provider->cuit = $request->input('cuit');
        $provider->phone = $request->input('phone');
        $provider->email = $request->input('email');
        $provider->address = $request->input('address');

        if ($provider->save()) {
            $provider->technicians()->sync($request->technicians);
            return $this->renderJson(true, null, 'El Proveedor fue actualizado exitosamente');
        }

        return $this->renderJson(false, null, 'Ocurrió un error al actualizar el Proveedor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $provider = Provider::find($id);
        if ($provider->delete()) {
            return $this->renderJson(true, null, 'El Proveedor fue borrado exitosamente');
        }

        return $this->renderJson(false, null, 'Ocurrió un error al borrar el Proveedor');
    }
}
