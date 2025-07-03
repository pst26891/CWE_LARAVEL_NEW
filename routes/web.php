<?php
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TocController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\XMLController;
use Illuminate\Support\Facades\Route;

if (!function_exists('include_route_files')) {
    function include_route_files($folder)
    {
        foreach (glob($folder . '/*.php') as $routeFile) {
            require $routeFile;
        }
    }
}

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.dashboard');

    include_route_files(__DIR__ . '/admin/');

});

Route::get('/', [HomeController::class, 'index']);
Route::get('/abstract/{articleId}', [ArticleController::class, 'viewAbstract']);

Route::get('/search/articles', [SearchController::class, 'index']);
Route::get('/xml/{voliss}/{articleSlug}', [XMLController::class, 'index']);

Route::get('/page/{parent}/{child}', [HomeController::class, 'showChiled']);
Route::get('/page/{slug}', [HomeController::class, 'showPage']);
Route::get('/{slug}', [HomeController::class, 'showPage']);
Route::post('/contact/saveContact', [HomeController::class, 'contactSave']);

Route::view('/contact', 'contact')->name('contact');
Route::post('/submission/saveSubmission', [HomeController::class, 'sendSubmission']);

Route::get('/toc/{volume}/{issue}', [TocController::class, 'show']);
Route::get('/ebook/{volume}/{issue}', [TocController::class, 'ebook']);
Route::get('/feed/{volume}/{issue}', [TocController::class, 'feed']);

Route::get('/{voliss}/{articleSlug}', [ArticleController::class, 'viewArticle']);


require __DIR__.'/auth.php';
