<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //decimos que el usuario debe de estar autenticado para poder acceder a cualquiera de los metodos de abajo
    public function __construct(){
        //una vez protegidas damos el acceso a algunos metodos pero si por ejemplo quiero comentar y no esta 
        //autenticado no podra
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user){
        //traerme todos los posts de un usuario y paginarlos
        $posts = Post::where('user_id', $user->id)->paginate(20);
        
        
        return view('layouts.dashboard', [
            'user'=> $user,
            'posts' => $posts
        ]); //el arreglo es para pasarle la informacion del modelo al view
    }
    public function create(){
        return view('posts.create');
    }
    public function store(Request $request){
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        /* Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            //como el que hace la publicacion es el que esta autenticado, se debe guardar su id
            'user_id' => auth()->user()->id
        ]); */

        //otra forma de hacer registro (no me gusta xd)
        /* $post = new Post();
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save() */

        //otra forma de validar pero ya con las relaciones
        //posts viene del modelo de User, que es una relacion
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post){
        return view('posts.show', ['user'=>$user ,'post' => $post]);
    }
    public function destroy(Post $post){
        dd('eliminando', $post->id);
    }
}