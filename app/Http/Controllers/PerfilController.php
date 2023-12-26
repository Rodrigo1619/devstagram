<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    //protegiendo la ruta de que el usuario debe estar autenticado
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('perfil.index');
    }
}
