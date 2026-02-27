<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\InvitationController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', 'banned'])->group(function () {

    // --- Dashboard & Navigation ---
    Route::get('/dashboard', [ColocationController::class, 'dashboard'])->name('dashboard');

    Route::get('/admindashboard', [AdminController::class, 'index'])
        ->middleware('can:admin-access')
        ->name('admin.index');

    // --- Profile ---
    Route::prefix('profile')->as('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('colocations')->as('colocations.')->group(function () {
        Route::get('/', [ColocationController::class, 'index'])->name('index');
        Route::get('/create', [ColocationController::class, 'create'])->name('create');
        Route::post('/store', [ColocationController::class, 'store'])->name('store');
        
        Route::post('/join', [ColocationController::class, 'join'])->name('join');

     Route::get('/{colocation}/invite', [ColocationController::class, 'showInviteForm'])->name('invite');
     Route::post('/colocations/join', [ColocationController::class, 'join'])->name('colocations.join');
     Route::post('/{colocation}/invite', [ColocationController::class, 'sendInvitation'])->name('invite.send');

     Route::delete('/{colocation}/members/{user}', [ColocationController::class, 'removeMember'])->name('members.remove');
        
    });

      Route::middleware(['auth'])->group(function () {
    Route::get('/invitations/received', [InvitationController::class, 'receivedInvitations'])
        ->name('colocations.received');

    Route::patch('/invitations/{invitation}/accept', [InvitationController::class, 'accept'])->name('invitations.accept');
        
    Route::patch('/invitations/{invitation}/reject', [InvitationController::class, 'reject'])
        ->name('invitations.reject');
});

Route::middleware(['can:admin-access'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
Route::patch('/users/{user}/toggle-ban', [AdminController::class, 'toggleBan'])->name('users.toggle-ban');});

});

require __DIR__.'/auth.php';