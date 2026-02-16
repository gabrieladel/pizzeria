<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;

/*RUTAS PÚBLICAS*/

Route::view('/', 'welcome')->name('welcome');
Route::view('/contacto', 'contacto')->name('contacto');
Route::get('/productos', [ProductoController::class, 'tienda'])
    ->name('productos.public');

/* Carrito */
Route::get('/carrito', [CartController::class, 'cart'])->name('cart.list');
Route::post('/carrito', [CartController::class, 'add'])->name('cart.store');
Route::put('/carrito', [CartController::class, 'update'])->name('cart.update');
Route::delete('/carrito', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/carrito/vaciar', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/procesar-pedido', [CartController::class, 'processOrder'])->name('cart.process');


/*AUTENTICACIÓN*/


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


/*PANEL ADMIN*/


Route::middleware(['auth'])->group(function () {

    Route::view('/admin', 'panelAdmin')->name('admin.dashboard');
    Route::get('verProductos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('verPedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::resource('productos-admin', ProductoController::class);
    Route::resource('pedidos', PedidoController::class);
    Route::resource('personas', PersonaController::class);
    Route::resource('usuarios', UserController::class);

});
