<?php

namespace App\Http\Controllers;

use App\Technician;
use Session;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //seleccionar todos los tecnicos
        $tecnicos = Technician::all();
        return view('tecnicos.index')->withTechnicians($tecnicos);
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

        $tecnico = new Technician();
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
        $tecnico = Technician::find($id);

        //envio a la vista el técnico para ser mostrado
        return view('tecnicos.show')->withTechnician($tecnico);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tecnico = Technician::find($id);

        return view('tecnicos.edit')->withTechnician($tecnico);
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
        $tecnico = Technician::find($id);
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
        $tecnico = Technician::find($id);
        $tecnico->delete();

        Session::flash('success', 'Técnico eliminado correctamente');
        return redirect()->route('tecnicos.index');
    }
}
