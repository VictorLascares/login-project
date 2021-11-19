<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\ProductController;
use App\Models\User;

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


Route::get('/', function(){
    return view('iniciar');
});
Route::get('iniciar',['App\Http\Controllers\SessionController','iniciar']);
Route::get('salir',['App\Http\Controllers\SessionController','salir']);
Route::post('validar',['App\Http\Controllers\SessionController','validar']);

Route::get('login', function(){
    return view('usuarios.login');
});
Route::get('register', function(){
    return view('usuarios.sigup');
});

Route::resource('users','UserController');


Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

