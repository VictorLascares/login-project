<?php

//use App\Http\Controllers\QuestionController;
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


//Route::get('/', function(){
//    return view('iniciar');
//});
Route::get('/',['App\Http\Controllers\SessionController','iniciar']);
Route::post('comprar/{linea}/{product_id}',['App\Http\Controllers\CompraController','comprar']);
Route::post('comprar/{banco}/{product_id}',['App\Http\Controllers\CompraController','comprar']);

Route::get('compras',['App\Http\Controllers\CompraController','compras']);

Route::get('iniciar',['App\Http\Controllers\SessionController','iniciar']);
Route::get('salir',['App\Http\Controllers\SessionController','salir']);
Route::post('validar',['App\Http\Controllers\SessionController','validar']);

Route::get('login', function(){
    return view('auth.login');
});
Route::get('register', function(){
    return view('auth.register');
});

Route::resource('users',UserController::class);

Route::get('/user/editpass/{user_id}',['App\Http\Controllers\UserController','editpass']);

Route::put('/product/{id}/consignar',['App\Http\Controllers\ProductController','consignar']);

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

Route::get('/product/{category_id}',['App\Http\Controllers\ProductController','indexCategory']);
Route::post('/product/{null}',['App\Http\Controllers\ProductController','indexCategory']);
Route::get('/estado/{id}/{estado}',['App\Http\Controllers\UserController','updateEstado']);
Route::get('/estado/{id}',['App\Http\Controllers\CompraController','updateEstado']);
Route::post('/calificado/{id}',['App\Http\Controllers\CompraController','updateCalificado']);
Route::get('/pago/{id}',['App\Http\Controllers\CompraController','updatePago']);
Route::get('/pagos/{id}',['App\Http\Controllers\CompraController','updatePagos']);

Route::resource('questions', QuestionController::class);

//Route::post('questions/addAnswer',['App\Http\Controllers\QuestionController','update']);

Route::post('/verificarcorreo',['App\Http\Controllers\RegisterController','verificarCorreo']);
