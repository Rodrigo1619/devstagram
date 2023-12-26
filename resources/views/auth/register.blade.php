@extends('layouts.app')

@section('titulo')
    Registrate en Devstagram
@endsection

{{-- Formulario --}}
@section('contenido')
    <div class="md:flex justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }} " alt="Imagen de registro">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-xl shadow-xl">
            <form action="{{route('register')}}" method="POST" novalidate> {{-- Action es la url a la que queremos mandar la informacion y hay que especificar el METHOD --}}
                @csrf {{-- con esto evitamos ataques y nos crea un campo oculto --}}

                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold"> Nombre</label>
                    {{-- con @error dentro de la clase podemos validar que si hay un error ponga ciertas clases --}}
                    <input id="name" name="name" type="text" placeholder="Nombre"
                            class="border p-3 w-full rounded-lg @error('name')border-red-500 @enderror"
                            value="{{old('name')}}"
                    />
                    {{-- Con lo siguiente podemos hacer la validacion de que un campo es obligatorio --}}
                    @error('name')
                    {{-- la variable $messagge es para poder tener mensajes de error dinamicos --}}
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold"> Username</label>
                    <input id="username" name="username" type="text" placeholder="Nombre de usuario"
                            class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                            value="{{old('username')}}"
                    />

                    @error('username')
                    {{-- la variable $messagge es para poder tener mensajes de error dinamicos --}}
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold"> Correo</label>
                    <input id="email" name="email" type="text" placeholder="Correo electronico"
                            class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                            value="{{old('email')}}"
                    />
                    @error('email')
                    {{-- la variable $messagge es para poder tener mensajes de error dinamicos --}}
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold"> Contraseña</label>
                    <input id="password" name="password" type="password" placeholder="Contraseña"
                            class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                    />
                    @error('password')
                    {{-- la variable $messagge es para poder tener mensajes de error dinamicos --}}
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold"> Repite Contraseña</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Repetir Contraseña"
                            class="border p-3 w-full rounded-lg" >
                </div>
                {{-- Boton --}}
                <input 
                    type="submit"
                    value="Crear Cuenta"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold
                            w-full p-3 text-white rounded-lg"
                >
            </form>

        </div>
    </div>
@endsection