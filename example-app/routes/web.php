<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;

//RUTAS PÚBLICAS
Route::get('/', function () { return view('welcome'); });
Route::get('/contacto', function () { return view('contacto'); });

Route::get('/producto', [ProductoController::class, 'index'])->name('productos.index');

Route::get('/carrito', [CartController::class, 'cart'])->name('cart.list');
Route::post('/carrito-agregar', [CartController::class, 'add'])->name('cart.store');
Route::post('/carrito-actualizar', [CartController::class, 'update'])->name('cart.update');
Route::post('/carrito-eliminar', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/carrito-vaciar', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/finalizar-pedido', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/procesar-pedido', [CartController::class, 'processOrder'])->name('cart.process');

//RUTAS DE AUTENTICACIÓN
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

//RUTAS DE ADMIN
Route::group(['middleware' => 'auth'], function () {
Route::get('/admin', function () { return view('panelAdmin'); });
Route::get('/crearProducto', [ProductoController::class, 'create']);
Route::get('/verProductos', [ProductoController::class, 'listar']);
Route::post('/registrarProductos', [ProductoController::class, 'store'])->name("producto.create");
Route::post('/modificarProductos', [ProductoController::class, 'update_admin'])->name("producto.update");
Route::get('/eliminarProductos-{id}', [ProductoController::class, 'delete'])->name("producto.delete");

Route::resource('home_productos', ProductoController::class);
Route::get('/persona', [PersonaController::class, 'index']);
Route::get('/Pedido', [PedidoController::class, 'index']);
Route::get('/crearPedidos', [PedidoController::class, 'create']);
Route::get('/verPedidos', [PedidoController::class, 'listar']);
Route::resource('Pedido', PedidoController::class)->names('pedido');
/* Route::resource('producto', ProductoController::class); */

Route::get('/crearUsuarios', [UserController::class, 'create']);
Route::get('/verUsuarios', [UserController::class, 'listar']);

Route::get('/pedido-eliminar/{id}', [PedidoController::class, 'delete'])->name('pedido.delete');
Route::post('/pedido-actualizar', [PedidoController::class, 'update'])->name('pedido.update');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
