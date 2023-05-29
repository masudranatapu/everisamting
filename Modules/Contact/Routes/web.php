<?php

use Illuminate\Support\Facades\Route;
use Modules\Contact\Http\Controllers\ContactController;

// Contact Routes
Route::middleware(['auth:admin', 'set_lang'])->group(function () {
    Route::prefix('admin/contact')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('module.contact.index');
        Route::delete('/destroy/{contact}', [ContactController::class, 'destroy'])->name('module.contact.destroy');
        Route::delete('/multiple/destroy', [ContactController::class, 'multipleDestroy'])->name('module.contact.multiple.destroy');
    });
});
Route::post('contact/add', [ContactController::class, 'store'])->name('module.contact.store');
