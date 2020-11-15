<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Image;

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
}
