<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\CasesController;
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

Route::get('/sections', [SectionsController::class, 'show']);

//CASES
Route::get('/cases', [CasesController::class, 'get']);
Route::post('/create-case', [CasesController::class, 'createCase']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
