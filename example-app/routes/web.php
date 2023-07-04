<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PersonaController;
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

Route::get('personas', function () {
    return view('/persona.index');
});


Route::get('/cliente', [ClienteController::class, 'index']);
Route::get('/cliente/{cliente}', [ClienteController::class, 'show']);
Route::get('/persona', [PersonaController::class, 'index']);
Route::get('/persona/{personas}', [PersonaController::class, 'show']);