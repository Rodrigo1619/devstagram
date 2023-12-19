@extends('layouts.app')

@section('titulo')
{{-- Como el $post viene desde el ROUTE debo pasarlo al controlador, eso me da acceso a la variable desde esta vista --}}
    {{$post->titulo}}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{asset('uploads') . '/' . $post->imagen}}" alt="Imagen del post {{$post->imagen}}">

            <div class="p-3">
                <p>0 likes</p>
            </div>
                <p class="font-bold"> {{$post->user->username}}</p>
                <p class="text-sm text-gray-500"> {{$post->created_at->diffForHumans()}}</p>
                <p class="mt-5">{{$post->descripcion}}</p>
            <div>

            </div>
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    
                <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>
                @if (session('mensaje'))
                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                        {{session('mensaje')}}
                    </div>
                @endif

                <form action="{{ route('comentarios.store', ['post'=>$post, 'user'=>$user])}}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold"> Comentario</label>
                        {{-- con @error dentro de la clase podemos validar que si hay un error ponga ciertas clases --}}
                        <textarea id="comentario" name="comentario" placeholder="Agrega un comentario"
                                class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"
                        ></textarea>
                                {{-- Con lo siguiente podemos hacer la validacion de que un campo es obligatorio --}}
                                @error('comentario')
                                {{-- la variable $messagge es para poder tener mensajes de error dinamicos --}}
                                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}</p>
                                @enderror
                    </div>
                    <input 
                    type="submit"
                    value="Comentar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold
                            w-full p-3 text-white rounded-lg"
                >
                </form>
                @endauth
            </div>
        </div>
    </div>
@endsection