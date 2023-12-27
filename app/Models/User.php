<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //relaciones con posts
    public function posts(){
        return $this->hasMany(Post::class);
    }
    //si nos salimos de algunas convenciones de laravel debemos hacer referencia al campo que deseamos
    /* public function posts(){
        return $this->hasMany(Post::class, 'id_algo');
    } */

    //se usara en likeController
    public function likes(){
        return $this->hasMany(Like::class);
    }

    //almacena los seguidores de un usuario
    public function followers(){
        //el metodo followers() en la tabla 'followers' pertenece a muchos usuarios
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }
    //almacenar a los que seguimos, solo es darle la vuelta a user_id con follower_id porque ahora se quiere ver a quien sigo
    public function followings(){
        //el metodo followers() en la tabla 'followers' pertenece a muchos usuarios
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }


    //comprobar si un usuario ya sigue a otro
    public function siguiendo(User $user){
        return $this->followers->contains($user->id);
    }

    
}
