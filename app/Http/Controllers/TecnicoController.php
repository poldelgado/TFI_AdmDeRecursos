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

        return redirect()->route('tecnicos.show', $tecnico->id);
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
