<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        //no ponemos el post_id porque automaticamente lo detecta en el controller
    ];
}
