<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DiscordAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CriticsAdviceController;
use App\Http\Controllers\DiscordController;
use App\Http\Controllers\DiscordChatController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\AdminTopupController;

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

// Topup routes
Route::get('/topup', [TopupController::class, 'index'])->name('topup.index');
Route::post('/topup', [TopupController::class, 'store'])->name('topup.store');
Route::get('/topup/packages/{gameId}', [TopupController::class, 'getPackages'])->name('topup.packages');
Route::get('/topup/payment/{id}', [TopupController::class, 'payment'])->name('topup.payment');
Route::post('/topup/confirm-payment/{id}', [TopupController::class, 'confirmPayment'])->name('topup.confirm-payment');
Route::get('/topup/success/{id}', [TopupController::class, 'success'])->name('topup.success');

// route untuk BUTUN submit form
Route::get('/submit/butun', [SubmissionController::class, 'createButun']);
Route::post('/submit/butun', [SubmissionController::class, 'store']);

// Critics & Advice routes
Route::get('/critics-advice', [CriticsAdviceController::class, 'showForm'])->name('critics.advice.form');
Route::post('/critics-advice', [CriticsAdviceController::class, 'store'])->name('critics.advice.store');

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
    
    // Critics & Advice Management
    Route::get('/admin/critics-advice', [CriticsAdviceController::class, 'index'])->name('admin.critics.advice');
    Route::post('/admin/critics-advice/{id}/respond', [CriticsAdviceController::class, 'respond'])->name('admin.critics.advice.respond');
    Route::delete('/admin/critics-advice/{id}', [CriticsAdviceController::class, 'destroy'])->name('admin.critics.advice.destroy');

    // Discord Chat Management
    Route::get('/admin/discord-chat', [DiscordChatController::class, 'index'])->name('admin.discord.chat');
    Route::post('/admin/discord-chat/send', [DiscordChatController::class, 'sendMessage'])->name('admin.discord.chat.send');
    Route::get('/admin/discord-chat/channels', [DiscordChatController::class, 'getChannels'])->name('admin.discord.chat.channels');

    // Topup Management
    Route::get('/admin/topup', [AdminTopupController::class, 'index'])->name('admin.topup.index');
    
    // Specific routes MUST come BEFORE parameterized routes
    Route::get('/admin/topup/games', [AdminTopupController::class, 'games'])->name('admin.topup.games');
    Route::get('/admin/topup/packages', [AdminTopupController::class, 'packages'])->name('admin.topup.packages');
    Route::get('/admin/topup/packages/create', [AdminTopupController::class, 'createPackage'])->name('admin.topup.packages.create');
    Route::post('/admin/topup/packages', [AdminTopupController::class, 'storePackage'])->name('admin.topup.packages.store');
    Route::get('/admin/topup/packages/{id}/edit', [AdminTopupController::class, 'editPackage'])->name('admin.topup.packages.edit');
    Route::put('/admin/topup/packages/{id}', [AdminTopupController::class, 'updatePackage'])->name('admin.topup.packages.update');
    Route::delete('/admin/topup/packages/{id}', [AdminTopupController::class, 'destroyPackage'])->name('admin.topup.packages.destroy');
    Route::post('/admin/topup/packages/{id}/toggle-status', [AdminTopupController::class, 'togglePackageStatus'])->name('admin.topup.packages.toggle-status');
    Route::get('/admin/topup/payment-methods', [AdminTopupController::class, 'paymentMethods'])->name('admin.topup.payment-methods');
    
    // Parameterized routes come LAST
    Route::get('/admin/topup/{id}', [AdminTopupController::class, 'show'])->name('admin.topup.show');
    Route::get('/admin/topup/{id}/details', [AdminTopupController::class, 'getDetails'])->name('admin.topup.details');
    Route::post('/admin/topup/{id}/process', [AdminTopupController::class, 'process'])->name('admin.topup.process');
    Route::post('/admin/topup/{id}/reject', [AdminTopupController::class, 'reject'])->name('admin.topup.reject');
    
    // Games Management Routes
    Route::post('/admin/topup/games', [AdminTopupController::class, 'storeGame'])->name('admin.topup.games.store');
    Route::put('/admin/topup/games/{id}', [AdminTopupController::class, 'updateGame'])->name('admin.topup.games.update');
    Route::delete('/admin/topup/games/{id}', [AdminTopupController::class, 'destroyGame'])->name('admin.topup.games.destroy');
    
    // Payment Methods Management Routes
    Route::post('/admin/topup/payment-methods', [AdminTopupController::class, 'storePaymentMethod'])->name('admin.topup.payment-methods.store');
    Route::put('/admin/topup/payment-methods/{id}', [AdminTopupController::class, 'updatePaymentMethod'])->name('admin.topup.payment-methods.update');
    Route::delete('/admin/topup/payment-methods/{id}', [AdminTopupController::class, 'destroyPaymentMethod'])->name('admin.topup.payment-methods.destroy');
});

// Discord API routes
Route::prefix('api/discord')->group(function () {
    Route::get('/selected-members', [DiscordController::class, 'getSelectedMembers'])->name('discord.selected-members');
    Route::get('/member-count', [DiscordController::class, 'getMemberCount'])->name('discord.member-count');
    Route::get('/user/{userId}', [DiscordController::class, 'getUser'])->name('discord.user');
    Route::get('/roles', [DiscordController::class, 'getRoles'])->name('discord.roles');
    Route::get('/test', function() {
        return response()->json([
            'status' => 'Discord API is working',
            'bot_token_set' => !empty(config('services.discord.bot_token')),
            'guild_id_set' => !empty(config('services.discord.guild_id')),
            'timestamp' => now()
        ]);
    })->name('discord.test');
    
    Route::get('/debug-members', function() {
        try {
            $discordService = app(\App\Services\DiscordService::class);
            $members = $discordService->getSelectedMembers(['904600598849159198', '750989836206342185']);
            
            return response()->json([
                'success' => true,
                'members_found' => count($members),
                'members' => $members,
                'debug_info' => [
                    'guild_id' => config('services.discord.guild_id'),
                    'bot_token_length' => strlen(config('services.discord.bot_token')),
                    'timestamp' => now()
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    })->name('discord.debug-members');
    
    Route::get('/clear-cache', function() {
        try {
            $discordService = app(\App\Services\DiscordService::class);
            $discordService->clearCache();
            
            return response()->json([
                'success' => true,
                'message' => 'Discord cache cleared successfully',
                'timestamp' => now()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    })->name('discord.clear-cache');
});
