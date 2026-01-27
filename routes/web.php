<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [TicketController::class, 'index'])
        ->name('dashboard');

    Route::resource('tickets', TicketController::class)
        ->except(['index', 'create']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/tickets', [AdminController::class, 'index'])
            ->name('tickets.index');

        Route::patch('/tickets/{ticket}/status', [AdminController::class, 'updateStatus'])
            ->name('tickets.update-status');

        Route::patch('/tickets/{ticket}/assign', [AdminController::class, 'assignTicket'])
            ->name('tickets.assign');
    });

require __DIR__.'/auth.php';
