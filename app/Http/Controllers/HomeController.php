<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //como solo tenemos index pondremos el __invoke ya que eso lo manda a llamar automaticamente
    public function __invoke(){

        //obtener a quienes seguimos
        //pluck nos trae el campo que nosotros requerimos
        $ids = auth()->user()->followings->pluck('id')-> toArray();

        //vamos a filtrar los posts de las personas que nosotros seguimos, como es un arreglo usamos whereIn
        $posts = Post::WhereIn('user_id', $ids)->latest()->paginate(20);
        
        //ahora pasamos toda la informacion de los posts a la vista
        return view('home', [
            'posts' => $posts
        ]);
    }
}
