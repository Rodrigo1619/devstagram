@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5 ">
                <img src="{{ asset('img/usuario.svg') }}" alt="usuarioIMG"> {{-- asset() apunto diracto a public --}}
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                {{--  <p class="text-gray-700 text-2xl">{{auth()->user()->username}}</p>  --}}{{-- imprimimos el nombre del usuario --}}
                {{-- Le paso mi $user que viene de mi postController como parametro  --}}
                <p class="text-gray-700 text-2xl">{{$user->username}}</p>

                <p class=" text-gray-800 text-sm mb-3 mt-5 font-bold">
                    0
                    <span class="font-normal"> Seguidores</span>
                </p>
                <p class=" text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal"> Siguiendo</span>
                </p>
                <p class=" text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal"> Posts</span>
                </p>
            </div>

        </div>

    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        {{-- Condicional para mostrar mensaje en dado caso no hayan publicaciones --}}
        {{-- Si se cuenta mas de 0 posts --}}
        @if($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                {{-- Mostrar los posts, como es un arreglo debemos iterarlo --}}
                @foreach ($posts as $post )
                    <div>
                        <a href="{{route('posts.show', ['post'=> $post, 'user'=> $user])}}">
                            {{-- Usamos asset para mostrar la imagen y le concatenamos el $post->imagen porque es el nombre
                                guardado en la base de datos--}}
                            <img src="{{ asset('uploads') . '/' . $post->imagen}}" alt="Imagen del post {{$post->titulo}}" >
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Paginarlos --}}
            <div class="my-10">
                {{$posts->links('pagination::tailwind')}}
            </div>

        {{-- Sino mostrar menaje que no hay publicaciones --}}    
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay publicaciones, nimodo</p>
        @endif

    </section>
@endsection 