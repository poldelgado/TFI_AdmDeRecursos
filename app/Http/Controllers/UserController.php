<?php

namespace App\Http\Controllers;

use \App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::all();
        return $this->renderJson(true, $users, 'Listado de Usuarios');
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
            'email' => 'required|email',
            'password' => 'required|max:20',
            'admin' => 'required|boolean'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->description = $request->description;

        if ($user->save()) {
            return $this->renderJson(true, null, 'Usuario registrado exitosamente');
        }

        return $this->renderJson(false, null, 'Ocurrió un error al registrar el Usuario');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = User::find($id);
        if (isset($user)) {
            return $this->renderJson(true, $user, 'Usuario');
        }
        return $this->renderJson(false, null, 'No existe el Usuario buscado');
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

        $user = User::find($id);
        $user->name = $request->name;
        $user->description = $request->description;

        if ($user->save()) {
            return $this->renderJson(true, null, 'El Usuario fue actualizado exitosamente');
        }

        return $this->renderJson(false, null, 'Ocurrió un error al actualizar el Usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = User::find($id);

        if ($user->delete()) {
            return $this->renderJson(true, null, 'Usuario borrado exitosamente');
        }

        return $this->renderJson(false, null, 'Ocurrió un error al borrar el Usuario');
    }

    public function is_admin() {
        return $this->renderJson(true, ['user' => Auth::user()->name, 'admin' => Auth::user()->isAdmin()], 'Usuario');
    }

    public function is_logged_in() {
        return $this->renderJson(Auth::user(), null, null);
    }
}
