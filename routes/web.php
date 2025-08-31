<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TallaController;
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

    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/tallas/data', [TallaController::class, 'obtenerTallas'])->name('tallas.data');
    Route::resource('/tallas', TallaController::class);
    
});