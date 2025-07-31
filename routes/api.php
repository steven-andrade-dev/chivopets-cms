<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\CasesController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\Auth\AuthController;
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

//Authentication
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
   //SECTIONS
    Route::get('/sections', [SectionsController::class, 'show']);

    // CONTENT
    Route::get('/content/{id?}', [ContentController::class, 'show']);
    Route::get('/content-by-id/{id}', [ContentController::class, 'showById']);
    Route::put('/contenido/update', [ContentController::class, 'update']);
    //CASES
    Route::get('/cases', [CasesController::class, 'get']);
    Route::post('/create-case', [CasesController::class, 'createCase']);

    // LOCALES
    Route::get('/locales', [LocaleController::class, 'show']);
    Route::post('/locales', [LocaleController::class, 'add']);
    Route::put('/locales/{id}', [LocaleController::class, 'update']);
    Route::delete('/locales/{id}', [LocaleController::class, 'destroy']);

    // USERS
    Route::get('/users', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // ROL
    Route::get('/rol', [RolController::class, 'show']);
    Route::post('/rol', [RolController::class, 'add']);
    Route::put('/rol/{id}', [RolController::class, 'update']);
    Route::delete('/rol/{id}', [RolController::class, 'destroy']);

    // MAIN
    Route::get('/main', [MainController::class, 'getAllMain']);
    Route::post('/main', [MainController::class, 'store']);
    Route::put('/main/{id}', [MainController::class, 'update']);
    Route::delete('/main/{id}', [MainController::class, 'destroy']);
});

Route::prefix('astro/main')->group(function () {
    Route::get('/getAllMain', [MainController::class, 'getAllMain']);
});
