<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {

    return view('welcome');
});

Route::resource('users','UserController');

Route::post('/login', function(){
    $name = request()->get('name');
    $user = User::where('name',$name)->get();
    if($user){
        if($user[0]->password == request()->get('password')){
            if($user[0]->user_type == 'cliente'){
                return view('usuarios.cliente');
            }elseif($user[0]->user_type == 'admin'){
                return view('usuarios.admin');
            }else{
                return view('usuarios.encargado');
            }
        }else{
            return view('usuarios.login');
        }
    }else{
        return view('usuarios.login');
    }
});

/*Route::get('/admin', function () {
    return view('admin');
});*/

