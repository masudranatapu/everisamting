<?php

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


use Modules\ProductModel\Http\Controllers\ProductModelController;

Route::prefix('admin')->middleware(['auth:admin', 'set_lang'])->group(function () {
    // ServiceType Routes
    Route::prefix('model')->group(function () {
        Route::get('/', [ProductModelController::class, 'index'])->name('module.model.index');
        Route::get('/add', [ProductModelController::class, 'create'])->name('module.model.create');
        Route::post('/add', [ProductModelController::class, 'store'])->name('module.model.store');
        Route::get('/edit/{id}', [ProductModelController::class, 'edit'])->name('module.model.edit');
        Route::put('/update/{id}', [ProductModelController::class, 'update'])->name('module.model.update');
        Route::get('/show/{id}', [ProductModelController::class, 'show'])->name('module.model.show');
        Route::delete('/destroy/{id}', [ProductModelController::class, 'destroy'])->name('module.model.destroy');
    });
});
