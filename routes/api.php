<?php

use App\Models\Orders;
use App\Http\Controllers\controllerorders;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/Orders', [controllerorders::class, 'index']);
Route::get('/Details/{id}', [controllerorders::class, 'show']);
Route::post('/Create', [controllerorders::class, 'store']);
Route::put('/Update/{id}', [controllerorders::class, 'update']);
Route::delete('/Delete/{id}', [controllerorders::class, 'destroy']);


