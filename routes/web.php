<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// Halaman Publik
Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/projects/{project}', [PortfolioController::class, 'show'])->name('projects.show');
Route::post('/contact', [PortfolioController::class, 'storeMessage'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

// Autentikasi Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:login')
    ->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Admin Terproteksi
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::post('/categories', [ProjectController::class, 'storeCategory'])->name('categories.store');
    Route::delete('/categories/{category}', [ProjectController::class, 'destroyCategory'])->name('categories.destroy');

    Route::delete('/messages/{message}', [ProjectController::class, 'destroyMessage'])->name('messages.destroy');
});

// Endpoint JSON Publik
Route::get('/api/projects', [PortfolioController::class, 'api'])
    ->middleware('throttle:60,1')
    ->name('api.projects');
