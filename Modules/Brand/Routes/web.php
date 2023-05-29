<?php

use Illuminate\Support\Facades\Route;
use Modules\Brand\Http\Controllers\BrandController;

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

Route::prefix('admin')->middleware(['auth:admin', 'set_lang'])->group(function () {
    // Brand Routes
    Route::prefix('brand')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('module.brand.index');
        Route::get('/add', [BrandController::class, 'create'])->name('module.brand.create');
        Route::post('/add', [BrandController::class, 'store'])->name('module.brand.store');
        Route::get('/edit/{brand}', [BrandController::class, 'edit'])->name('module.brand.edit');
        Route::put('/update/{brand}', [BrandController::class, 'update'])->name('module.brand.update');
        Route::get('/{brand:slug}/ads', [BrandController::class, 'show'])->name('module.brand.show');
        Route::delete('/destroy/{brand}', [BrandController::class, 'destroy'])->name('module.brand.destroy');
    });
});
