@extends('layouts.app')

@section('titulo')
    Crea un post nuevo
@endsection

{{-- Con este push que declaramos en el app.blade, decimos que ocuparemos ese stack en este push --}}
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">                                    {{-- enctype="multipart/form-data" es propio de html para poder subir imagenes --}}
            <form action="{{ route('imagenes.store')}}" method="POST" enctype="multipart/form-data" id="dropzone" 
            class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center" >
                @csrf {{-- evitar problemas de cors al subir una imagen --}}
            </form>
        </div>
        <div class="md:w-1/2 p-10 bg-white rounded-xl shadow-xl mt-10 md:mt-0">
            <form action="{{route('posts.store')}}" method="POST" novalidate> {{-- Action es la url a la que queremos mandar la informacion y hay que especificar el METHOD --}}
                @csrf {{-- con esto evitamos ataques y nos crea un campo oculto --}}


                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold"> Titulo</label>
                    {{-- con @error dentro de la clase podemos validar que si hay un error ponga ciertas clases --}}
                    <input id="titulo" name="titulo" type="text" placeholder="Titulo del post"
                            class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                                value="{{old('titulo')}}">
                            {{-- Con lo siguiente podemos hacer la validacion de que un campo es obligatorio --}}
                            @error('titulo')
                            {{-- la variable $messagge es para poder tener mensajes de error dinamicos --}}
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}</p>
                            @enderror
                </div>

                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold"> Descripción</label>
                    {{-- con @error dentro de la clase podemos validar que si hay un error ponga ciertas clases --}}
                    <textarea id="descripcion" name="descripcion" placeholder="Descripción del post"
                            class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                    >{{old('descripcion')}}</textarea>
                            {{-- Con lo siguiente podemos hacer la validacion de que un campo es obligatorio --}}
                            @error('descripcion')
                            {{-- la variable $messagge es para poder tener mensajes de error dinamicos --}}
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}</p>
                            @enderror
                </div>
                <div class="mb-5">
                    {{-- se llena la informacion desde nuestro app.js para subir la imagen --}}
                    <input type="hidden" name="imagen" value="{{old('imagen')}}"/> 
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}</p>
                    @enderror
                    
                </div>


                <input 
                    type="submit"
                    value="Crear publicación"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold
                            w-full p-3 text-white rounded-lg"
                >
            </form>
        </div>
    </div>
@endsection