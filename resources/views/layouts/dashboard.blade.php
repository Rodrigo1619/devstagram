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
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl">{{$user->username}}</p>
                    {{-- si el user del perfil es el mismo que esta autenticado mostramos el boton de eitar --}}
                    @auth
                        @if($user->id === auth()->user()->id)
                            <a href="" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>

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