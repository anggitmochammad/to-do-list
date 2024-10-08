<?php

use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Events\Login;
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

Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('checklist', ChecklistController::class)->only(['index', 'store', 'destroy']);

    Route::prefix('checklist/{checklist}/item')->group(function () {
        Route::get('/', [ChecklistItemController::class, 'index']);

        Route::get('/{checklistItem}', [ChecklistItemController::class, 'show']);
        Route::post('/', [ChecklistItemController::class, 'store']);
        Route::delete('/', [ChecklistItemController::class, 'destroy']);
        Route::put('/{checklistItem}', [ChecklistItemController::class, 'updateStatus'])->name('updateStatus');
        Route::put('/rename/{checklistItem}', [ChecklistItemController::class, 'updateName']);
    });
});
