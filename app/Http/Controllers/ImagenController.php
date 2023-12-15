<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request){
        /* $input = $request->all(); //para ver todos los requests

        //construimos una respuesta y mandamos el arreglo de input y convertimos eso a json
        return response()->json($input); */

        $imagen = $request->file('file');
        //generar un uuid unico para cada imagen , concatenamos el .Extension
        $nombreImagen = Str::uuid() . '.' . $imagen->extension();

        //usamos intervention/image para hacer una imagen 
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000,1000); //1000x1000 px

        //mover imagen en algun lugar en el servidor
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen ]);
    }
}