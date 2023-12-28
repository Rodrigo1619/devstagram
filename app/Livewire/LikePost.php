<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    //aqui no tenemos acceso a Request de laravel, livewire tiene si propia forma de hacerlo

    public $post;
    public $isLiked;
    public $likes;

    //mount es del ciclo de vida de livewire y se ejecutara media vez ya se haya instanciado el like al post
    //practicamente es un constructor como en php
    public function mount($post){
        $this->isLiked = $post->checkLikes(auth()->user());
        //cuando se instancie si hay like o no, mandar la informacion de cuantos likes hay
        $this->likes = $post->likes->count();
    }

    public function like(){
        //verificar si el usuario actual que ve el post, ya le dio like si es asi se elimina el like
        if($this->post->checkLikes(auth()->user())){
            $this->post->likes()->where('post_id', $this->post->id)->delete();

            //cambiar los valores segun hay like o no para que livewire haga el re-render por nosotros
            $this->isLiked = false;
            $this->likes--;

        }else{
            //sino ha dado like creamos el like al post
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);

            //valores reescritos si da like
            $this->isLiked = true;
            $this->likes++;
        }
    }
    public function render()
    {
        return view('livewire.like-post');
    }
}
