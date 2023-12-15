<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function store(Request $request){
        
        $this->validate($request, [
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        //si el usuario no se logra autenticar mandar un mensaje de error
        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            //con with() llenamos los valores en la sesion que esta en mi login.blade.php
            //con back() practicamente es que no nos movemos del login, al hacer un post nos redirije pero si las
            //credenciales son incorrectas nos regresa al formulario

            return back()->with('mensaje','Credenciales incorrectas'); //esto debemos guardarlo en una sesion en el login.blade
        }

        //si se logra autenticar lo rederijimos pero necesitamos el username debido que la ruta lo necesita
        //se lo pasamos con auth ya que a estas alturas ek usuario ya esta autenticado
        return redirect()->route('posts.index', auth()->user()->username);
    }
}