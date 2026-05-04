<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\SettingController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'status'])->group(function () {

    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('permission:dashboard.view')->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware(['auth', 'role:super_admin'])->group(function () {
Route::middleware(['auth', 'status'])->group(function () {

    // Users
    Route::get('/users', [UserController::class, 'index'])->middleware('permission:users.view')->name('users.index');

    Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->middleware('permission:users.manage')->name('users.toggle.status');

    // Admin
    Route::get('/admins', [AdminController::class, 'index'])->middleware('permission:admins.view')->name('admins.index');
    Route::get('/admins/create', [AdminController::class, 'create'])->middleware('permission:admins.manage')->name('admins.create');
    Route::post('/admins/store', [AdminController::class, 'store'])->middleware('permission:admins.manage')->name('admins.store');
    Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->middleware('permission:admins.manage')->name('admins.edit');
    Route::put('/admins/{id}', [AdminController::class, 'update'])->middleware('permission:admins.manage')->name('admins.update');
    Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->middleware('permission:admins.manage')->name('admins.destroy');

    // Roles
    Route::get('/roles', [RolePermissionController::class, 'index'])->middleware('permission:roles.manage')->name('roles.index');
    Route::get('/roles/{id}/permissions', [RolePermissionController::class, 'edit'])->middleware('permission:roles.manage')->name('roles.permissions');
    Route::post('/roles/{id}/permissions', [RolePermissionController::class, 'update'])->middleware('permission:roles.manage')->name('roles.permissions.update');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->middleware('permission:settings.manage')->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->middleware('permission:settings.manage')->name('settings.update');

    Route::get('/permission-matrix', [RolePermissionController::class, 'matrix'])->middleware('permission:roles.manage')->name('permissions.matrix');
    Route::post('/permission-matrix', [RolePermissionController::class, 'matrixUpdate'])->middleware('permission:roles.manage');
});


require __DIR__ . '/auth.php';
