<?php

use App\Http\Controllers\Admin\WidgetController;

Route::prefix('admin/widget')->group(function () {
    Route::get('/', [WidgetController::class, 'index'])->name('admin.widget.index');
    Route::get('/search', [WidgetController::class, 'search'])->name('admin.widget.search');
    
    Route::get('/create', [WidgetController::class, 'create'])->name('admin.widget.create');
    Route::post('/store', [WidgetController::class, 'store'])->name('admin.widget.store');

    Route::get('/edit/{id}', [WidgetController::class, 'edit'])->name('admin.widget.edit');
    
    Route::patch('/update/{id}', [WidgetController::class, 'update'])->name('admin.widget.update');
});
