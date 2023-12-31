<?php
/* 
use App\Http\Controllers\ClienteController; */
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;


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

/* Route::get('/cliente', [ClienteController::class, 'index']);
Route::get('/cliente/{cliente}', [ClienteController::class, 'show']); */
Route::get('/persona', [PersonaController::class, 'index']);
Route::get('/persona/{personas}', [PersonaController::class, 'show']);
Route::get('/pedido', [PedidoController::class, 'index']);
Route::get('/pedido/{pedidos}', [PedidoController::class, 'show']);
Route::get('/producto', [ProductoController::class, 'index']);
Route::get('/producto/{productos}', [ProductoController::class, 'show']);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/* Route::resource('home', ClienteController::class); */
Route::resource('home', ProductoController::class);

/* Route::group(['middleware' => 'admin'], function () { */
   
    Route::get( '/admin', function () {
        return view('panelAdmin');
    }); 
Route::get('/crearProducto', [ProductoController::class, 'create']);
Route::get('/verProductos', [ProductoController::class, 'listar']);
//ruta para añadir un nuevo producto
Route::post('/registrarProductos', [ProductoController::class, 'create'])->name("producto.create");
//ruta para modificar un producto 
Route::post('/modificarProductos', [ProductoController::class, 'update'])->name("producto.update");
//ruta para eliminar un producto 
Route::get('/eliminarProductos-{id}', [ProductoController::class, 'delete'])->name("producto.delete");
/* }); */