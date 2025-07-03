<?php

use App\Http\Controllers\Admin\IssueController;

Route::prefix('admin/issue')->controller(IssueController::class)->group(function () {
    Route::get('/', 'index')->name('admin.issue.index');
    Route::get('/search', 'search')->name('admin.issue.search');
    Route::get('/create', 'create')->name('admin.issue.create');
    Route::post('/store', 'store')->name('admin.issue.store');
    Route::get('/edit/{id}', 'edit')->name('admin.issue.edit');
    Route::put('/update/{id}', 'update')->name('admin.issue.update');
    Route::get('/change-status/{id}/{type}', 'changeStatus')->name('admin.issue.changeStatus');
});
