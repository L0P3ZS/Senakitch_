<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RecipeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

$routesNotGenerate = ['create', 'edit','show'];
Route::get('',[HomeController::class,'index'])->middleware('can:admin.home')->name('admin.home');
Route::resource('users',UserController::class)->names('admin.users')->except($routesNotGenerate); 
Route::resource('products',ProductController::class)->names('admin.products')->except($routesNotGenerate);
Route::get('exportProduct',[ProductController::class,'export'])->name('exportProduct');
Route::resource('recipes',RecipeController::class)->names('admin.recipes')->except($routesNotGenerate);
Route::resource('comments',CommentController::class)->names('admin.comments')->except($routesNotGenerate);
Route::resource('categories',CategoryController::class)->names('admin.categories')->except($routesNotGenerate);
Route::resource('menus',MenuController::class)->names('admin.menus')->except($routesNotGenerate);
Route::resource('roles',RoleController::class)->names('admin.roles');
Route::get('calendario', function () {
    return view('admin.cruds.calendario');
})->name('admin.calendario.index');