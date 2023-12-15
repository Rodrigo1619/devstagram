<!-- los que tienen un @ son una directiva y apuntan directamente hacia views-->
<!-- Lo que se pone dentro de la directiva es la direccion del archivo a mostrar -->
<!-- Por ejemplo en react es con ubicacion/ubicacion, en laravel es con punto -->
@extends('layouts.app')

<!--  con lo siguiente decimos que el codigo siguiente se inyecte en el @yield('') del app.blade -->
@section('titulo')
    Pagina Principal
@endsection

@section('contenido')
    Contenido de la Pagina
@endsection