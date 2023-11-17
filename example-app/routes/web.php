<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

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
Route::get('carrito', function () {
    return view('Carrito/index');
});
Route::get('contacto', function () {
    return view('contacto');
});


Route::get('/cliente', [ClienteController::class, 'index']);
Route::get('/cliente/{cliente}', [ClienteController::class, 'show']);
Route::get('/persona', [PersonaController::class, 'index']);
Route::get('/persona/{personas}', [PersonaController::class, 'show']);
Route::get('/pedido', [PedidoController::class, 'index']);
Route::get('/pedido/{pedidos}', [PedidoController::class, 'show']);
Route::get('/producto', [ProductoController::class, 'index']);
Route::get('/producto/{productos}', [ProductoController::class, 'show']);

Route::get('/crearProducto', [ProductoController::class, 'create']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('home', ClienteController::class);
Route::resource('home', ProductoController::class);
//Route::post('/cart-add',    'CartController@add')->name('cart.add');

//Route::get('/cart-checkout','CartController@cart')->name('cart.checkout');

//Route::post('/cart-clear',  'CartController@clear')->name('cart.clear');

//Route::post('/cart-removeitem',  'CartController@removeitem')->name('cart.removeitem');

 Route::get( '/admin', function () {
    return view('panelAdmin');
}); 
Route::get('/verProductos', [ProductoController::class, 'listar']);
//ruta para añadir un nuevo producto
Route::post('/registrarProductos', [ProductoController::class, 'create'])->name("producto.create");
//ruta para modificar un producto 
Route::post('/modificarProductos', [ProductoController::class, 'update'])->name("producto.update");
//ruta para eliminar un producto 
Route::get('/eliminarProductos-{id}', [ProductoController::class, 'delete'])->name("producto.delete");


Route::get('/', [CartController::class, 'shop'])->name('shop');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::post('/add', [CartController::class, 'add'])->name('cart.store');
Route::post('/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');