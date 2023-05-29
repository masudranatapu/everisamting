<?php

use Illuminate\Support\Facades\Route;
use Modules\Review\Http\Controllers\ReviewController;

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
    Route::prefix('review')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('review.index');
        Route::post('/store', [ReviewController::class, 'store'])->name('review.store');
        Route::delete('/delete/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');
        Route::post('/status/change', [ReviewController::class, 'statusChange'])->name('review.status.change');
    });
});
