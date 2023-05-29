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

use Modules\Designation\Http\Controllers\DesignationController;

Route::prefix('designation')->group(function() {
    Route::get('/', 'DesignationController@index');
});

Route::prefix('admin')->middleware(['auth:admin', 'set_lang'])->group(function () {
    // ServiceType Routes
    Route::prefix('designation')->group(function () {
        Route::get('/', [DesignationController::class, 'index'])->name('module.designation.index');
        Route::get('/add', [DesignationController::class, 'create'])->name('module.designation.create');
        Route::post('/add', [DesignationController::class, 'store'])->name('module.designation.store');
        Route::get('/edit/{id}', [DesignationController::class, 'edit'])->name('module.designation.edit');
        Route::put('/update/{id}', [DesignationController::class, 'update'])->name('module.designation.update');
        Route::get('/show/{id}', [DesignationController::class, 'show'])->name('module.designation.show');
        Route::delete('/destroy/{id}', [DesignationController::class, 'destroy'])->name('module.designation.destroy');
    });
});
