<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin/customer')->as('module.customer.')->middleware(['auth:admin', 'set_lang'])->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('/create', [CustomerController::class, 'create'])->name('create');
    Route::post('/', [CustomerController::class, 'store'])->name('store');
    Route::get('/{customer:username}/ads', [CustomerController::class, 'ads'])->name('ads');
    Route::get('/{customer:username}/edit', [CustomerController::class, 'edit'])->name('edit');
    Route::get('/{customer:username}', [CustomerController::class, 'show'])->name('show');
    Route::put('/{customer:username}', [CustomerController::class, 'update'])->name('update');
    Route::post('/email/verify', [CustomerController::class, 'emailVerify'])->name('emailverified');
    Route::delete('/{customer:username}', [CustomerController::class, 'destroy'])->name('destroy');
});
