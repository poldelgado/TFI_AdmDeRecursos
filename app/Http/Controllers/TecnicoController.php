<?php

namespace App\Http\Controllers;

use App\Tecnico;
use Session;
use Illuminate\Http\Request;

class TecnicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //seleccionar todos los tecnicos
        $tecnicos = Tecnico::all();
        return view('tecnicos.index')->withTecnicos($tecnicos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tecnicos.create');
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
            'last_name' => 'required|max:30',
            'first_name' => 'required|max:30',
            'cuit' => 'required',
            'phone' => 'required|max:25',
            'email' => 'required|email'
        ));

        $tecnico = new Tecnico();
        $tecnico->last_name = $request->last_name;
        $tecnico->first_name = $request->first_name;
        $tecnico->cuit = $request->cuit;
        $tecnico->phone = $request->phone;
        $tecnico->email = $request->email;
        $tecnico->address = $request->address;

        $tecnico->save();

        Session::flash('success', 'El técnico fue registrado exitosamente');

        return redirect()->route('tecnicos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //solicito al modelo el tecnico para el id solicitada
        $tecnico = Tecnico::find($id);

        //envio a la vista el técnico para ser mostrado
        return view('tecnicos.show')->withTecnico($tecnico);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tecnico = Tecnico::find($id);

        return view('tecnicos.edit')->withTecnico($tecnico);
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
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'cuit' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email'
        ));

        //buscar el tecnico a modificar
        $tecnico = Tecnico::find($id);
        $tecnico->first_name = $request->first_name;
        $tecnico->last_name = $request->last_name;
        $tecnico->cuit = $request->cuit;
        $tecnico->phone = $request->phone;
        $tecnico->address = $request->address;
        $tecnico->email = $request->email;
        $tecnico->save();

        //redireccionar

        Session::flash('success', 'Técnico actualizado correctamente');

        return redirect()->route('tecnicos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tecnico = Tecnico::find($id);
        $tecnico->delete();

        Session::flash('success', 'Técnico eliminado correctamente');
        return redirect()->route('tecnicos.index');
    }
}
