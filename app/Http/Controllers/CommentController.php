<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Comment;

class CommentController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function save(CommentRequest $request)
    {
        // Recogiendo los datos 
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        //Asigno valores nuevos a mi nuevo objeto 
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        //Guardarr en la BD
        $comment->save();

        //Redireccion
        return redirect()->route('image.detail', ['id' => $image_id])->with(['message' => 'Has publicado uncomentario correctamente']);
    }
}
