<?php

use App\Http\Controllers\Admin\VolumeController;

Route::prefix('admin/volume')->group(function () {
    Route::get('/', [VolumeController::class, 'index'])->name('admin.volume.index');
    Route::get('/search', [VolumeController::class, 'search'])->name('admin.volume.search');
    
    Route::get('/create', [VolumeController::class, 'create'])->name('admin.volume.create');
    Route::post('/store', [VolumeController::class, 'store'])->name('admin.volume.store');

    Route::get('/edit/{id}', [VolumeController::class, 'edit'])->name('admin.volume.edit');
    
    Route::patch('/update/{id}', [VolumeController::class, 'update'])->name('admin.volume.update');
});
