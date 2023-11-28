<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PinjamPengembalianController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ItemsController;
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

Route::get('/', [HomeController::class, 'index']);

// Route::get('/login', function () {
//     return view('pages.login');
// });

// Route::controller(VisitorController::class)->group(function () {
//     Route::get('/visitors', 'index');
// });

// Route::controller(ItemController::class)->group(function () {
//     Route::get('/items', 'index');
// });

Route::get('login', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'identifikasi']);
Route::get('/logout', [LoginController::class, 'logout']);


Route::resource('admin-list', AdminController::class)->middleware('auth.admin');
Route::resource('/pinjam-pengembalian', PinjamPengembalianController::class)->middleware('auth.admin');
Route::resource('items',ItemsController::class)->middleware('auth.admin');

Route::resource('visitors', VisitorController::class)->middleware('auth.admin');


