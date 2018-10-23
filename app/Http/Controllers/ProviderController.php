<?php

namespace App\Http\Controllers;

use App\ProviderQualification;
use App\Technician;
use Illuminate\Http\Request;

use App\Provider;
use Session;


class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::all();

        return view('providers.index')->withProviders($providers);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tecnicos = Technician::all();
        return view('providers.create')->withTechnicians($tecnicos);
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
           'name' => 'required|min:5',
            'cuit' => 'required|numeric',
            'email' => 'required|email',
            'phone' => 'required|min:5|max:20',
            'address' => 'required'
        ));

        $provider = new Provider();

        $provider->name = $request->name;
        $provider->cuit = $request->cuit;
        $provider->email = $request->email;
        $provider->phone = $request->phone;
        $provider->address = $request->address;

        //Creamos un nuevo objeto Calificación de Proveedor
        $provider_qualification = new ProviderQualification();
        $provider_qualification->save();
        $provider->provider_qualification()->associate($provider_qualification); //Asociamos el objeto calificación.

        $provider->save();

        $provider->technicians()->sync($request->tecnicos, false);

        Session::flash('success', 'El proveedor fue registrado exitosamente');

        return redirect()->route('providers.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provider = Provider::find($id);
        return view('providers.show')->withProvider($provider);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //buscar el proveedor en la base de datos
        $provider = Provider::find($id);
        $tecnicos = Technician::all();


        // retornar a la vista con los datos a editar
        return view('providers.edit')->withProvider($provider)->withTechnicians($tecnicos);
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
        //validar los datos
        $this->validate($request, array(
            'name' => 'required|max:30',
            'cuit' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email'
        ));


        // guardar los datos en la bbdd

        $provider = Provider::find($id);

        $provider->name = $request->input('name');
        $provider->cuit = $request->input('cuit');
        $provider->phone = $request->input('phone');
        $provider->email = $request->input('email');
        $provider->address = $request->input('address');

        $provider->save();

        $provider->tecnicos()->sync($request->tecnicos);

        // redireccion con un mensaje flash a providers.show

        Session::flash('success', 'Proveedor actualizado correctamente');

        return redirect()->route('providers.show', $provider->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = Provider::find($id);
        $provider->delete();

        Session::flash('success', 'Proveedor eliminado correctamente');
        return redirect()->route('providers.index');
    }
}
