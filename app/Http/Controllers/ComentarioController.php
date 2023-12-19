<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //el $post del route si me sirve, pero el user del route no porque se puede comentar publicaciones de otros usuarios
    //entonces ese user no nos sirve pero de igual manera se importa el User
    public function store(Request $request, User $user, Post $post){
        
        //validar
        $this->validate($request, [
            'comentario' => 'required|max:255',
        ]); 
        //almacenar
        Comentario::create([
            'user_id' =>  auth()->user()->id, //tomando id de usuario autenticado que comento, no sobre donde estamos comentando
            'post_id'=> $post->id ,
            'comentario' => $request->comentario
        ]);
        //imprimir un mensaje
        return back()->with('mensaje', 'Comentario realizado correctamente');
    }
}
