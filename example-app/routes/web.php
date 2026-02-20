<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendedorController;

/* --- RUTAS PÚBLICAS --- */

Route::view('/', 'welcome')->name('welcome');
Route::view('/contacto', 'contacto')->name('contacto');
Route::get('/productos', [ProductoController::class, 'tienda'])->name('productos.public');

/* --- CARRITO DE COMPRAS --- */

Route::get('/carrito', [CartController::class, 'cart'])->name('cart.list');
Route::post('/carrito', [CartController::class, 'add'])->name('cart.store');
Route::put('/carrito', [CartController::class, 'update'])->name('cart.update');
Route::delete('/carrito', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/carrito/vaciar', [CartController::class, 'clear'])->name('cart.clear');
Route::middleware(['auth'])->group(function () {
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/procesar-pedido', [CartController::class, 'processOrder'])->name('cart.process');
Route::get('/gracias/{id}', [CartController::class, 'gracias'])->name('pedido.gracias');
});
/* --- AUTENTICACIÓN --- */

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

/* --- PANEL ADMINISTRATIVO (Protegido por Auth y Rol Admin) --- */

// Agregamos 'admin' al middleware para validar el rol antes de entrar
Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard principal del Admin
    Route::view('/admin', 'panelAdmin')->name('admin.dashboard');

    // --- SECCIÓN FACTURACIÓN ---
    Route::get('/verFacturas', [PedidoController::class, 'verFacturas'])->name('facturas.index');
    
    // Proceso para generar la factura desde el listado de pedidos
    Route::post('/pedidos/{id}/finalizar', [PedidoController::class, 'finalizarCompraProfesional'])
         ->name('pedidos.finalizar');

    // --- GESTIÓN DE RECURSOS ---
    Route::resource('clientes', ClienteController::class);
    Route::resource('vendedores', VendedorController::class);
    Route::resource('personas', PersonaController::class);
    Route::resource('usuarios', UserController::class);
    Route::resource('productos-admin', ProductoController::class);
    
    // Vista de productos para el administrador
    Route::get('verProductos', [ProductoController::class, 'index'])->name('productos.index');

    // --- GESTIÓN DE PEDIDOS ---
    Route::resource('pedidos', PedidoController::class);

});
