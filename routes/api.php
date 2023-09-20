<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskNoteController;
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

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class,'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('projects')->as('project.')->group(function () {
        Route::get('', [ProjectController::class, 'index'])->name('index');
        Route::post('new', [ProjectController::class, 'store'])->name('store');
        Route::get('{projectId}', [ProjectController::class, 'show'])->name('show');
    });

    Route::prefix('tasks')->as('task.')->group(function () {
        Route::get('', [TaskController::class, 'index'])->name('index');
        Route::post('new', [TaskController::class, 'store'])->name('store');
        Route::get('{taskId}', [TaskController::class, 'show'])->name('show');
    });

    Route::prefix('notes')->as('note.')->group(function () {
        Route::post('new', [TaskNoteController::class, 'store'])->name('store');
    });
});
