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
use App\Http\Controllers\FAQController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\GalleryController;
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

    // LOGS
    Route::resource('/logs', LogController::class);

   //SECTIONS
    // Route::get('/sections', [SectionsController::class, 'show']);
    Route::resource('sections', SectionsController::class);

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
    Route::resource('menu', MenuController::class);

    //SUBMENU
    Route::resource('submenu', SubmenuController::class);

    //FAQ
    Route::resource('faq', FAQController::class);

    //GALERY
    Route::post('/gallery/upload', [GalleryController::class, 'upload']);
    Route::get('/gallery', [GalleryController::class, 'list']);
});

Route::prefix('astro/menun')->group(function () {
    Route::get('/locale', [MenuController::class, 'show']);
    Route::get('/getAllMenun', [MenuController::class, 'getAllMenu']);
});
