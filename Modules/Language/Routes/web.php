<?php

use Illuminate\Support\Facades\Route;
use Modules\Language\Http\Controllers\LanguageController;
use Modules\Language\Http\Controllers\TranslationController;


Route::middleware(['auth:admin', 'set_lang'])->prefix('admin/settings')->group(function () {
    Route::prefix('language')->group(function () {
        // translation form show
        Route::get('/{code}', [TranslationController::class, 'langView'])->name('language.view');

        // translation form submit
        Route::post('translation/update', [TranslationController::class, 'transUpdate'])->name('translation.update');
        Route::post('auto/translation/single', [TranslationController::class, 'autoTransSingle'])->name('translation.update.auto');
        Route::post('auto/translation/update/all', [TranslationController::class, 'transUpdateAutoAll'])->name('translation.update.auto.all');
    });

    // language crud
    Route::get('languages', [LanguageController::class, 'index'])->name('language.index');
    Route::get('languages/create', [LanguageController::class, 'create'])->name('language.create');
    Route::post('languages/store', [LanguageController::class, 'store'])->name('language.store');

    Route::get('languages/edit/{language}', [LanguageController::class, 'edit'])->name('language.edit');
    Route::put('languages/update/{language}', [LanguageController::class, 'update'])->name('language.update');
    Route::delete('languages/delete/{language}', [LanguageController::class, 'destroy'])->name('language.delete');
    Route::put('setdefaultlanguage', [TranslationController::class, 'setDefaultLanguage'])->name('setDefaultLanguage');
});

// set language
Route::get('changelanguage/{lang}', [TranslationController::class, 'changeLanguage'])->name('changeLanguage');
