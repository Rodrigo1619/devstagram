<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//como tenemos el invoke en el controller, ya no hace falta el index
Route::get('/', HomeController::class)->name('home');

//pasamos el controlador creado, pero decimos que queremos la clase con el ::class y cual es el metodo que queremos usar
//cuando hacemos el -> name es como estamos nombrando a la ruta y eso ayuda para no ir a cambiar en todas las referencias hechas en las vistas
//si al metodo de abajo no le ponemos el -> name, simplemente toma el que tiene anterior, ya que registra la ruta, no el metodo
Route::get('/register', [RegisterController::class, 'index']) ->name('register');
Route::post('/register',[RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index']) ->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store']) ->name('logout');

//perfil
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');



Route::get('/posts/create',[PostController::class,'create']) ->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
//mostrar el nombre de usuario y de ahi el post

//rutas con varaibles
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/imagenes',[ImagenController::class, 'store'])->name('imagenes.store');

//likes
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');


Route::get('/{user:username}', [PostController::class,'index']) ->name('posts.index');

//siguiendo usuarios
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');


