<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('pedido', function () {
    return view('index');
});


Route::get('/cliente', [ClienteController::class, 'index']);
Route::get('/cliente/{cliente}', [ClienteController::class, 'show']);
Route::get('/persona', [PersonaController::class, 'index']);
Route::get('/persona/{personas}', [PersonaController::class, 'show']);
Route::get('/pedido', [PedidoController::class, 'index']);
Route::get('/pedido/{pedidos}', [PedidoController::class, 'show']);
Route::get('/producto', [ProductoController::class, 'index']);
Route::get('/producto/{productos}', [ProductoController::class, 'show']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('home', ClienteController::class);
