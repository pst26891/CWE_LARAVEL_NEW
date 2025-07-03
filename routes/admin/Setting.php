<?php
use App\Http\Controllers\Admin\SettingController;
Route::prefix('admin/setting')->group(function () {

    Route::get('/edit/{id}', [SettingController::class, 'edit'])->name('admin.setting.edit');
    Route::patch('/update/{id}', [SettingController::class, 'update'])->name('admin.setting.update');
});
