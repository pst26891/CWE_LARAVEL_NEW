
    <?php

    use App\Http\Controllers\Admin\ArticlesController;

    Route::prefix('admin/articles')->controller(ArticlesController::class)->group(function () {
        Route::get('/', 'index')->name('admin.article.index');
        Route::get('/search', 'search')->name('admin.article.search');
        Route::get('/create', 'create')->name('admin.article.create');
        Route::post('/store', 'store')->name('admin.article.store');
        Route::get('/edit/{id}', 'edit')->name('admin.article.edit');
        Route::patch('/update/{id}', 'update')->name('admin.article.update');

        Route::get('/update-items', 'updateItems')->name('admin.article.update-items'); // Changed route name
        Route::POST('/issue-by-volume', 'issueByVolume')->name('admin.article.issue-by-volume'); // Changed route name
    });
