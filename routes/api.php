<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\CasesController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SubmenuController;
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
    //Auth
    Route::post('/logout', [AuthController::class, 'logout']);

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

    // MENU
    Route::get('/menulocale', [MenuController::class, 'show']);
    Route::get('/menu', [MenuController::class, 'getAllMenu']);
    Route::post('/menu', [MenuController::class, 'store']);
    Route::put('/menu/{id}', [MenuController::class, 'update']);
    Route::delete('/menu/{id}', [MenuController::class, 'destroy']);

    //SUBMENU
    Route::get('/submenu', [SubmenuController::class, 'show']);
    Route::post('/submenu', [SubmenuController::class, 'store']);
    Route::put('/submenu/{id}', [SubmenuController::class, 'update']);
    Route::delete('/submenu/{id}', [SubmenuController::class, 'destroy']);

});

Route::prefix('astro/menun')->group(function () {
    Route::get('/locale', [MenuController::class, 'show']);
    Route::get('/getAllMenun', [MenuController::class, 'getAllMenu']);
});
