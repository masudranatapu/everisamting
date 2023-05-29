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

use Modules\ServiceType\Http\Controllers\ServiceTypeController;


Route::prefix('admin')->middleware(['auth:admin', 'set_lang'])->group(function () {
    // ServiceType Routes
    Route::prefix('serviceType')->group(function () {
        Route::get('/', [ServiceTypeController::class, 'index'])->name('module.serviceType.index');
        Route::get('/add', [ServiceTypeController::class, 'create'])->name('module.serviceType.create');
        Route::post('/add', [ServiceTypeController::class, 'store'])->name('module.serviceType.store');
        Route::get('/edit/{id}', [ServiceTypeController::class, 'edit'])->name('module.serviceType.edit');
        Route::put('/update/{id}', [ServiceTypeController::class, 'update'])->name('module.serviceType.update');
        Route::get('/show/{id}', [ServiceTypeController::class, 'show'])->name('module.serviceType.show');
        Route::delete('/destroy/{id}', [ServiceTypeController::class, 'destroy'])->name('module.serviceType.destroy');
    });
});
