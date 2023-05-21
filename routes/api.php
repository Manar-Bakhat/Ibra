<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OutfitController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\ProductController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// outfits routes
Route::get('/outfits', [OutfitController::class, 'index']);
Route::post('/outfits', [OutfitController::class, 'store']);
Route::get('/outfits/{id}', [OutfitController::class, 'show']);
Route::put('/outfits/{id}', [OutfitController::class, 'update']);
Route::delete('/outfits/{id}', [OutfitController::class, 'destroy']);

// tags routes
Route::get('/tags', [TagController::class, 'index']);
Route::post('/tags', [TagController::class, 'store']);
Route::get('/tags/{id}', [TagController::class, 'show']);
Route::put('/tags/{id}', [TagController::class, 'update']);
Route::delete('/tags/{id}', [TagController::class, 'destroy']);

// categories routes
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

//attachments routes
Route::get('/attachments', [AttachmentController::class, 'index']);
Route::post('/attachments', [AttachmentController::class, 'store']);
Route::get('/attachments/{id}', [AttachmentController::class, 'show']);
Route::put('/attachments/{id}', [AttachmentController::class, 'update']);
Route::delete('/attachments/{id}', [AttachmentController::class, 'destroy']);

// products routes
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);