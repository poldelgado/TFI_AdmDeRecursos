<?php

namespace App\Http\Controllers;

use App\Technician;
use Illuminate\Http\Request;

class TechnicianController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $technicians = Technician::all();
		 foreach ($technicians as $technician) {
			$technician->name =  $technician->last_name.', '.$technician->first_name;
		 }
        return $this->renderJson(true, $technicians, 'Listado de Técnicos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'last_name' => 'required|max:30',
            'first_name' => 'required|max:30',
            'cuit' => 'required',
            'phone' => 'required|max:25',
            'email' => 'required|email'
        ]);

        $technician = new Technician();
        $technician->last_name = $request->last_name;
        $technician->first_name = $request->first_name;
        $technician->cuit = $request->cuit;
        $technician->phone = $request->phone;
        $technician->email = $request->email;
        $technician->address = $request->address;

        if ($technician->save()) {
            return $this->renderJson(true, $technician, 'El Técnico fue creado exitosamente');
        }

        return $this->renderJson(false, $technician, 'Ocurrió un error al guardar el técnico');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //solicito al modelo el tecnico para el id solicitada
        $technician = Technician::find($id);
        if (isset($technician)) {
            return $this->renderJson(true, $technician, 'Técnico');
        }
        return $this->renderJson(false,null, 'No existe el técnico buscado');
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
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'cuit' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email'
        ]);

        //buscar el tecnico a modificar
        $technician = Technician::find($id);
        $technician->first_name = $request->first_name;
        $technician->last_name = $request->last_name;
        $technician->cuit = $request->cuit;
        $technician->phone = $request->phone;
        $technician->address = $request->address;
        $technician->email = $request->email;

        if ($technician->save()) {
            return $this->renderJson(true,null, 'El Técnico fue actualizado exitosamente');
        }

        return $this->renderJson(false,null, 'Ocurrió un error al actualizar el técnico');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $technician = Technician::find($id);
        if ($technician->delete()) {
            return $this->renderJson(true,null, 'El Técnico fue borrado exitosamente');
        }

        return $this->renderJson(false,null, 'Ocurrió un error al borrar el técnico');
    }
}
