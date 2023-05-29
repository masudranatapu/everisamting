<?php

use Illuminate\Support\Facades\Route;
use Modules\CustomField\Http\Controllers\CategoryCustomFieldController;
use Modules\CustomField\Http\Controllers\CustomFieldController;
use Modules\CustomField\Http\Controllers\CustomFieldGroupController;

Route::prefix('admin/custom-field')->middleware(['auth:admin', 'set_lang'])->group(function () {
    Route::get('/', [CustomFieldController::class, 'index'])->name('module.custom.field.index');
    Route::get('/create', [CustomFieldController::class, 'create'])->name('module.custom.field.create');
    Route::post('/store', [CustomFieldController::class, 'store'])->name('module.custom.field.store');
    Route::get('/edit/{custom_field}', [CustomFieldController::class, 'edit'])->name('module.custom.field.edit');
    Route::put('/update/{custom_field}', [CustomFieldController::class, 'update'])->name('module.custom.field.update');
    Route::delete('/destroy/{custom_field}', [CustomFieldController::class, 'destroy'])->name('module.custom.field.destroy');
    Route::post('/custom/field/sorting', [CustomFieldController::class, 'sorting'])->name('module.custom.field.sorting');

    // Category wise custom fields
    Route::get('/custom/field/add/{category}', [CategoryCustomFieldController::class, 'categoryCustomFieldCreate'])->name('module.category.custom.field.add');
    Route::post('/custom/field/attach/{category}', [CategoryCustomFieldController::class, 'categoryCustomFieldAttach'])->name('module.category.custom.field.attach');
    Route::post('/custom/field/store/{category}', [CategoryCustomFieldController::class, 'categoryCustomFieldStore'])->name('module.category.custom.field.store');
    // Route::post('/store/categories/{field}', [CustomFieldController::class, 'StoreCategories'])->name('module.custom.field.store.category');


    // ================= For Field Value ===================
    Route::get('/add/value/{field}', [CustomFieldController::class, 'addValue'])->name('module.custom.field.add.value');
    Route::post('/add/value/store/{field}', [CustomFieldController::class, 'storeValue'])->name('module.custom.field.store.value');
    Route::get('/add/value/edit/{value}', [CustomFieldController::class, 'editValue'])->name('module.custom.field.edit.value');
    Route::put('/add/value/update/{value}', [CustomFieldController::class, 'updateValue'])->name('module.custom.field.update.value');
    Route::delete('/add/value/destroy/{value}', [CustomFieldController::class, 'destroyValue'])->name('module.custom.field.destroy.value');

    // ================= For Field Group ===================
    Route::get('/group/{slug?}', [CustomFieldGroupController::class, 'index'])->name('module.custom.field.group.index');
    Route::post('/group/sorting', [CustomFieldGroupController::class, 'sorting'])->name('module.custom.field.group.sorting');
    Route::post('/group/add', [CustomFieldGroupController::class, 'store'])->name('module.custom.field.group.store');
    Route::put('/group/update/{custom_field_group:slug}', [CustomFieldGroupController::class, 'update'])->name('module.custom.field.group.update');
    Route::delete('/group/destroy/{custom_field_group}', [CustomFieldGroupController::class, 'destroy'])->name('module.custom.field.group.destroy');
});
