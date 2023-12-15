<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //c¿por convencion, a los metodos que devuelven una vista se les pone index
    public function index() 
    {
        return view('auth.register');
    }
    public function store(Request $request) //$request es como nosotros quisimos llamarlo
    {
        /* Pa poder debuggear */
        //dd($request);
        //dd($request ->get('username'));

        //casi no se hace, pero modifico el request para que entre en la validacion con el slug
        $request->request->add(['username'=>Str::slug( $request->username)]); //guardar strings en minuscula y que no haya espacios 

        //Validacion
        $this->validate($request, [
            //pasar los parametros que tenemos como name en el formulario
            //con | podemos decir que es como un y
            /* 'name' => 'required|min:5', */ //sino te gusta asi se puede mandar como arreglo
            //'name' => ['required', 'max:30'] //se puede hacer de esta manera tambien
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:30', //unique:users quiere decir la tabla users donde se verifica que sea unico
            'email' => 'required|unique:users|email|max:60', //ya se tiene una expresion regular con la validacion email
            'password' => 'required|confirmed|min:6' //hace que el password y passwordConfirmation sean iguales
        ]);
        //insertamos el usuario en el modelo de Users, el id no es necesario ponerlo si tenemos el autoincrement
        User::create([
            'name' => $request->name,
            'username'=> $request->username ,  //mando a llamar a la modificacion de la request
            'email'=> $request->email,
            'password' => Hash::make( $request->password)
        ]);

        //autenticacion del usuario
        /* auth()->attempt([ //attempt es para intentar autenticar al usuario 
            'email' => $request->email,
            'password' => $request->password
        ]); */

        //otra forma de autenticar es
        auth()->attempt($request->only('email', 'password'));

        //redericcionamos
        return redirect()->route('posts.index', ['user' => auth()->user()->username]); //como ya tengo una ruta con name, es mejor ponerle el name que la ruta pura, esto por si la ruta cambia
    }
}