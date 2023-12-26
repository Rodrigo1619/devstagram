<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable =[
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user(){
        //traer solamente el nombre y username de un usuario
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }
    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }

    //ver si un usuario ya dio me gusta y que no hayan duplicados
    public function checkLikes(User $user){
        //ya tenemos una relacion con likes, lo usamos para checkear si ya hay un id de usuario en nuestra tabla de Likes
        //en la columna de 'user_id'
        return $this->likes->contains('user_id', $user->id);
    }
}
