<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\User;



class UserController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }
    public function index($search = null)
    {
        if (!empty($search)) {
            $users = User::where('nick', 'LIKE', '%' . $search . '%')
                ->orWhere ('name', 'LIKE', '%' . $search . '%')
                ->orWhere ('surname', 'LIKE', '%' . $search . '%')
                ->orderBy('id', 'desc')
                ->paginate(5);
        } else {
            $users = User::orderBy('id', 'desc')->paginate(5);
        }

        return view('users.index', [
            'users' => $users
        ]);
    }

    public function config()
    {

        return view('users.config');
    }

    public function update(UserRequest $request)
    {
        //Validacion de espacios
        \Validator::extend('alpha_spaces', function ($attribute, $value) {
            return preg_match('/^([-a-z0-9_-\s])+$/i', $value);
        });

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

        //Subir la imagen
        $image_path = $request->file('image_path');
        if ($image_path) {

            //Poner un nombre unico
            $image_path_name = time() . $image_path->getClientOriginalName();

            //Guardarla en la carpeta seleccionada
            Storage::disk('users')->put($image_path_name, File::get($image_path));


            $user->image = $image_path_name;
        }

        //Ejecurtar consultas y cambios en la Base de datos
        $user->update();

        return redirect()->route('user.config')->with(['message' => 'Usuario atualizado correctamente']);
    }

    public function getImage($filename)
    {

        $file = Storage::disk('users')->get($filename);

        return new Response($file, 200);
    }
    public function  profile($id)
    {
        $user = User::find($id);
        return view('users.perfile', [
            'user' => $user
        ]);
    }
}
