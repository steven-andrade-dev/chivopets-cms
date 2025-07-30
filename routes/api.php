<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\CasesController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\MainController;
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

//SECTIONS
Route::get('/sections', [SectionsController::class, 'show']);

// CONTENT
Route::get('/content/{id?}', [ContentController::class, 'show']);
Route::get('/content-by-id/{id}', [ContentController::class, 'showById']);
//CASES
Route::get('/cases', [CasesController::class, 'get']);
Route::post('/create-case', [CasesController::class, 'createCase']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('astro/main')->group(function () {
    Route::get('/getAllMain', [MainController::class, 'getAllMain']);
});
