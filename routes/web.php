<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DiscordAuthController;
use App\Http\Controllers\HomeController;

// Home page route
Route::get('/', [HomeController::class, 'index']);

// Gallery page route
Route::get('/gallery', function () {
    return view('gallery');
});

// Support page route
Route::get('/support', function () {
    return view('support');
});

// route untuk submit form
Route::get('/submit', [SubmissionController::class, 'create']);
Route::post('/submit', [SubmissionController::class, 'store']);

// route untuk BUTUN submit form
Route::get('/submit/butun', [SubmissionController::class, 'createButun']);
Route::post('/submit/butun', [SubmissionController::class, 'store']);

// Discord OAuth routes
Route::get('/auth/discord', [DiscordAuthController::class, 'redirectToDiscord'])->name('discord.login');
Route::get('/auth/discord/callback', [DiscordAuthController::class, 'handleDiscordCallback'])->name('discord.callback');
Route::post('/auth/discord/clear', [DiscordAuthController::class, 'clearDiscordAuth'])->name('discord.clear');

// Admin authentication routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Protected admin routes
Route::middleware(['admin.auth'])->group(function () {
    // Dashboard & Submissions
    Route::get('/admin/submissions', [SubmissionController::class, 'index'])->name('admin.submissions');
    Route::post('/admin/submissions/{id}/approve', [SubmissionController::class, 'approve'])->name('admin.submissions.approve');
    Route::post('/admin/submissions/{id}/reject', [SubmissionController::class, 'reject'])->name('admin.submissions.reject');
    
    // Approval History
    Route::get('/admin/approval-history', [SubmissionController::class, 'approvalHistory'])->name('admin.approval-history');
    
    // Admin Management
    Route::get('/admin/create-admin', [AdminManagementController::class, 'create'])->name('admin.create-admin');
    Route::post('/admin/create-admin', [AdminManagementController::class, 'store'])->name('admin.store-admin');
    Route::get('/admin/manage-admins', [AdminManagementController::class, 'index'])->name('admin.manage-admins');
    Route::patch('/admin/manage-admins/{admin}/toggle', [AdminManagementController::class, 'toggleStatus'])->name('admin.toggle-admin');
    Route::delete('/admin/manage-admins/{admin}', [AdminManagementController::class, 'destroy'])->name('admin.delete-admin');
    
    // Role Management
    Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles');
    Route::post('/admin/roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::put('/admin/roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/admin/roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
    Route::patch('/admin/roles/{role}/toggle', [RoleController::class, 'toggleStatus'])->name('admin.roles.toggle-status');
});
