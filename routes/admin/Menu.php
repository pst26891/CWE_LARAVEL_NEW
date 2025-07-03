<?php 
// routes/admin/Menu.php 
// This file is responsible for defining the routes related to the menu management in the admin panel of a web application.
use App\Http\Controllers\Admin\MenuController;

Route::get('admin/manage-menus/{id?}', [MenuController::class, 'index']);
Route::post('admin/createMenu', [MenuController::class, 'store']);

Route::get('admin/addCatToMenu', [MenuController::class, 'addCatToMenu']);
Route::get('admin/addPostToMenu', [MenuController::class, 'addPostToMenu']);
Route::get('admin/addCustomLink', [MenuController::class, 'addCustomLink']);
Route::get('admin/updateMenu', [MenuController::class, 'updateMenu']);

Route::get('admin/deleteMenuItem/{id}/{key}/{in?}', [MenuController::class, 'deleteMenuItem']);
Route::post('admin/updateMenuItem/{id}', [MenuController::class, 'updateMenuItem']);

Route::get('admin/deleteMenu/{id}', [MenuController::class, 'destroy']);