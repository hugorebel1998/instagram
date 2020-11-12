<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{
    public function config()
    {

        return view('users.config');
    }

    public function update(UserRequest $request)
    {
        //Conseguir usuario identificado
        $user =  \Auth::user();
        $id = $user->id;

        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //Asignar nuevos valores al usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //Ejecurtar consultas y cambios en la Base de datos
        $user->update();

        return redirect()->route('user.config')->with(['message' => 'Usuario atualizado correctamente']);
    }
}
