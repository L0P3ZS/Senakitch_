<?php

use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RecipeController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//permite acceder a la información del usuario autenticado 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//rustas de users
Route::apiResource('users',UserController::class);

//rustas de comment 
Route::apiResource('comment',CommentController::class);

//rustas de product
Route::apiResource('product',ProductController::class);

//rustas de menu
Route::apiResource('menu',MenuController::class);
//ruta de recipe
Route::apiResource('recipe',RecipeController::class);





