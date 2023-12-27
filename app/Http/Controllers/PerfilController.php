<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //protegiendo la ruta de que el usuario debe estar autenticado
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('perfil.index');
    }
    public function store(Request $request){
        //modificando el $request para que entre a la validacion con el slug, de que sea todo minuscula y sin espacios
        $request->request->add(['username'=>Str::slug( $request->username)]);

        $this->validate($request, [
            //1.con not in estamos poniendo como una lista negra para que el usuario no se pueda poner esos nombres de usuario
            //2.en unique estamos diciendo que el campo username de la tabla users debe ser unico, excepto para el id del usuario autenticado
            //con eso podemos dejar que el usuario mantenga su username.
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:30', 'not_in:twitter,editar-perfil'],
        ]);

        //si el usuario edita la foto
        if($request->imagen){
            $imagen = $request->file('imagen');
            //generar un uuid unico para cada imagen , concatenamos el .Extension
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();

            //usamos intervention/image para hacer una imagen 
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000,1000); //1000x1000 px

            //mover imagen en algun lugar en el servidor
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        //guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ??''; //es la imagen o se deja vacio
        $usuario->save();

        //redireccionando
        //para la redireccion no se utuliza auth()->user()->username porque puede que lo haya modificado, entonces
        //se utiliza la instancia creada con $usuario, que es la ultima copia
        return redirect()->route('posts.index', $usuario->username);
    }
}
