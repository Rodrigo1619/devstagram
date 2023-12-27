<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user){
        //follower viene del metodo del modelo de User
        //usar attach cuando sea una relacion de muchos a muchos
        //con esto estamos haciendo que un usuario tenga seguidores, por ejemplo que el usuario con id 4 tenga como follower id a 1
        $user->followers()->attach(auth()->user()->id);

        return back();
    }

    public function destroy(User $user){
        $user->followers()->detach(auth()->user()->id);

        return back();
    }
}
