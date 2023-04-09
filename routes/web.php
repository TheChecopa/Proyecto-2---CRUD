<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

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
    return view('auth.login');
});

/*
Route::get('/productos', function () {
    return view('productos.index');
});

Route::get('productos/create', [ProductoController::class,'create']);
*/

Route::resource('productos', ProductoController::class)->middleware('auth');

Auth::routes(['reset'=>false]);

Route::get('/home', [ProductoController::class, 'index'])->name('home');



Route::group(['middleware'=>'auth'], function () {
    Route::get('/', [ProductoController::class, 'index'])->name('home');
});

