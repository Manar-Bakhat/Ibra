<?php

use App\Http\Controllers\ColorsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController; 
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



Route::post('/Colors',[ColorsController::class,'store']);
Route::post('/categories',[CategoriesController::class,'store']);
Route::post('/Produits',[ProductsController::class,'store']);