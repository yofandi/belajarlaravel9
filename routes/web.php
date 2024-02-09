<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/coba', function () {
    // beda return dengan echo ialah
    // return berfungsi membalikan nilai kepada root
    // echo berfungsi sekedar menampilkan data
    $ping = ['haloo' => "hai"];
    return view('coba');
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login/authenticate', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::get('login/logput', [AuthController::class, 'logout'])->name('login.logout');
Route::get('register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('register', [AuthController::class, 'registerProses'])->name('register.proses');


// route menunjuk ke controller hellocontroller
// Route::get('hello', 'App\Http\Controllers\HelloController@index');
Route::get('hello', [HelloController::class, 'index']);
Route::get('world', [HelloController::class, 'world']);

// Route::resource('posts', PostController::class);
Route::get('posts', [PostController::class, 'index'])->name('post.index');
Route::get('posts/create', [PostController::class, 'create'])->name('post.create');
Route::post('posts', [PostController::class, 'store'])->name('post.store');
Route::get('posts/{id}', [PostController::class, 'show'])->name('post.show');
Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::patch('posts/{id}', [PostController::class, 'update'])->name('post.patch');
Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('post.delete');