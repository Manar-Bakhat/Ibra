<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OutfitsController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//====================Auth==============================
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me', 'me');
});

//====================Categories==============================
Route::controller(CategoriesController::class)->group(function () {
    Route::get('/categories/{id}', 'show');
    Route::get('/categories', 'index');
    Route::post('/categories', 'store');
    //Route::post('/Produits', 'store');
});

//===================Colors=========================
Route::controller(ColorsController::class)->group(function () {
    Route::get('/colors/{id}', 'show');
    Route::get('/colors', 'index');
    Route::post('/colors', 'store');
    //Route::post('/Produits', 'store');
});

//=====================Products============================
Route::controller(ProductsController::class)->group(function () {
    Route::get('/produits/{id}', 'show');
    Route::get('/produits', 'index');
    Route::post('/produits', 'store');
    //Route::post('/Produits', 'store');
});
//=====================Outfit============================
Route::controller(OutfitsController::class)->group(function () {
    Route::get('/outfit/{id}', 'show');
    Route::get('/outfit', 'index');
    Route::get('/outfit2', 'index2');
    Route::post('/outfit', 'store');
});

//=====================Comment============================
Route::controller(CommentsController::class)->group(function () {
    Route::get('/comments/{id}', 'show');
    Route::post('/comments/{id}', 'store');
});

//=====================Like============================
Route::controller(\App\Http\Controllers\LikesController::class)->group(function () {
    Route::get('/like/{id}', 'show');
    Route::post('/like', 'store');
    Route::delete('/like', 'destroy');
});
