<div>
    @if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        {{-- Mostrar los posts, como es un arreglo debemos iterarlo --}}
        @foreach ($posts as $post )
            <div>
                <a href="{{route('posts.show', ['post'=> $post, 'user'=> $post->user])}}">
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
@else
    <p class="text-center">No te salen posts? - Sigue a alguien para poder ver sus posts</p>
@endif
</div>