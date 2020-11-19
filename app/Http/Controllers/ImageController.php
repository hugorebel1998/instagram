<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Image;
use App\User;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function create()
    {
        return view('image.create');
    }

    public function save(ImageRequest $request)
    {
        \Validator::extend('alpha_spaces', function ($attribute, $value) {
            return preg_match('/^([-a-z0-9_-\s])+$/i', $value);
        });
        //Recogiendo los datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        // var_dump($imagen_path);
        // var_dump($description);
        // die();

        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;



        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->save();

        return redirect()->route('home')->with([
            'message' => 'La imagen subida con éxito'
        ]);

        // var_dump(json_decode($request));
        // die();
    }

    public function getImage($filname)
    {

        $file = Storage::disk('images')->get($filname);

        return new Response($file, 200);
    }

    public function detail($id)
    {

        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image
        ]);
    }

    public function delete($id)
    {
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        if ($user && $image && $image->user->id == $user->id) {

            //Eliminar comentario 
            if ($comments && count($comments) >= 1) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            //Eliminar likes 
            if ($likes && count($likes) >= 1) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }


            //Eliminar ficheros de imagen 
            Storage::disk('images')->delete($image, 'image_path');

            //Eliminar registro de imagen

            $image->delete();
            $message = array('message' => 'La imagen no se borro correctamente');
        } else {
            $message = array('message' => 'La imagen no se ha borrado');
        }
        return redirect()->route('home')->with($message);
    }

    public function edit($id)
    {
        $user = \Auth::user();
        $image = Image::find($id);

        if ($user && $image && $image->user->id == $user->id) {

            return view('image.edit', [
                'image' => $image
            ]);
        } else {
            return redirect()->route('home');
        }
    }
    public function update(ImageRequest $request)
    {
        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //Conseguir objeto de la imagen
        $image = Image::find($image_id);
        $image->description = $description;


        //Subir fichero
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        //Actualizar registro
        $image->update();
        return redirect()->route('image.detail', ['id' => $image_id])->with(['message' => 'Imagen actualizada con éxito']);
    }
}
