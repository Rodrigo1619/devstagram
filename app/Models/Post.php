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
}
