<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect()->route('login'); 
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/admin', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/tallas/data', [TallaController::class, 'obtenerTallas'])->name('tallas.data');
    Route::resource('/tallas', TallaController::class);
    Route::patch('tallas/{talla}/restaurar', [TallaController::class, 'restaurar'])->name('tallas.restaurar');

    Route::get('/colores/data', [ColorController::class, 'obtenerColores'])->name('colores.data');
    Route::resource('/colores', ColorController::class);
    Route::patch('colores/{colore}/restaurar', [ColorController::class, 'restaurar'])->name('colores.restaurar');

    Route::get('/marcas/data', [MarcaController::class, 'obtenerMarcas'])->name('marcas.data');
    Route::resource('/marcas', MarcaController::class);
    Route::patch('marcas/{marca}/restaurar', [MarcaController::class, 'restaurar'])->name('marcas.restaurar');

    Route::get('/categorias/data', [CategoriaController::class, 'obtenerCategorias'])->name('categorias.data');
    Route::resource('/categorias', CategoriaController::class);
    Route::patch('categorias/{categoria}/restaurar', [CategoriaController::class, 'restaurar'])->name('categorias.restaurar');
});