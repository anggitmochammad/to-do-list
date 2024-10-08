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

    Route::apiResource('checklist', ChecklistController::class);

    Route::post('checklist/{checklist}/item', [ChecklistItemController::class, 'store']);
    Route::delete('checklist/{checklist}/item', [ChecklistItemController::class, 'destroy']);
    Route::get('checklist/{checklist}/item/{checklistItem}', [ChecklistItemController::class, 'show']);
    Route::put('checklist/{checklist}/item/{checklistItem}', [ChecklistItemController::class, 'updateStatus'])->name('updateStatus');
    Route::put('checklist/{checklist}/item/rename/{checklistItem}', [ChecklistItemController::class, 'updateName']);
    

});

