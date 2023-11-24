<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\PinjamPengembalianController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\LabItemsController;
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

Route::controller(UserAdminController::class)->group(function () {
    Route::get('/admin-list', 'index');
});

// Route::controller(VisitorController::class)->group(function () {
//     Route::get('/visitors', 'index');
// });

// Route::controller(ItemController::class)->group(function () {
//     Route::get('/items', 'index');
// });

Route::controller(PinjamPengembalianController::class)->group(function () {
    Route::get('/pinjam-pengembalian', 'index');
});

Route::resource('items', LabItemsController::class);

Route::resource('visitors', VisitorController::class);
