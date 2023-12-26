<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post){
        
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);
        return back();
    }
    public function destroy(Request $request, Post $post){
        //de la request viene el usuario y en el usuario hicimos un metodo en su modelo de likes que contiene la relacion
        //filtramos segun el post al que le estamos quitando el like ya que en el post_id tambien tenemos la referencia 
        //de un usuario
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
