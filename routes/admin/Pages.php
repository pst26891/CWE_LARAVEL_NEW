<?php
use App\Http\Controllers\Admin\PagesController;
// Define routes using FQCN
Route::get('admin/pages', [PagesController::class, 'index']);
Route::get('admin/pages/search', [PagesController::class, 'search'])->name('admin.pages.search');
Route::get('admin/pages/create', [PagesController::class, 'create']);
// Route::post('admin/pages/store', [PagesController::class, 'store']);
Route::get('admin/pages/edit/{id}', [PagesController::class, 'edit']);
Route::POST('admin/pages/store', [PagesController::class, 'store'])->name('admin.pages.store');

// If using PATCH, define it properly
Route::patch('admin/pages/update/{id}', [PagesController::class, 'update'])->name('admin.pages.update');
