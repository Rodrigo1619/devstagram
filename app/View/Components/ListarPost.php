<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListarPost extends Component
{
    /**
     * Create a new component instance.
     */
    //el __construct es la informacion que se le pasa al componente b
    public $posts;
    public function __construct($posts)
    {
        //le hacemos saber de la varible post y poder pasarla
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.listar-post');
    }
}
