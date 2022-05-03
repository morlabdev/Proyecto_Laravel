<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){

        // Validación
        $validate = $this->validate($request, [
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ]);

        // Recoger datos
        $user = Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        // Asigno los valores a mi nuevo objeto guardar
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        // Guardar en la bd
        $comment->save();

        // Redirección
        return redirect()->route('home')->with(['message' => 'Comentario publicado correctamente']);

    }

    public function delete($id){
        // Conseguir datos del usuario logueado
        $user = Auth::user();

        // Conseguir objeto del comentario
        $comment = Comment::find($id);

        // Comprobar si soy el dueño del comentario o de la publiación
        if ($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();

            return redirect()->route('home')->with(['message' => 'Comentario eliminado correctamente']);
        }else {
            return redirect()->route('home')->with(['message' => 'Comentario NO eliminado correctamente']);
        }
    }
}
