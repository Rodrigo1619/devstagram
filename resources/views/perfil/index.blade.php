@extends('layouts.app')

@section('titulo')
    Editar perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="" class="mt-10 md:mt-0">
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold"> Username</label>
                    {{-- con @error dentro de la clase podemos validar que si hay un error ponga ciertas clases --}}
                    <input id="username" name="username" type="text" placeholder="Username"
                            class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                            value="{{auth()->user()->username}}"
                    />

                    {{-- Con lo siguiente podemos hacer la validacion de que un campo es obligatorio --}}
                    @error('username')
                    {{-- la variable $messagge es para poder tener mensajes de error dinamicos --}}
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold"> Imagen perfil</label>
                    {{-- con @error dentro de la clase podemos validar que si hay un error ponga ciertas clases --}}
                    <input id="imagen" name="imagen" type="file"
                            class="border p-3 w-full rounded-lg"
                            value=""
                            accept=".jpg, .jpeg, .png"
                    />
                </div>
                <input 
                    type="submit"
                    value="Guardar cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold
                            w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>  

    </div>
@endsection