<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:view_role');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission:create_role');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:create_role');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show')->middleware('permission:view_role');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:edit_role');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:edit_role');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:delete_role');

    //users
    Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('permission:view_user');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('permission:create_user');
    Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('permission:create_user');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('permission:view_user');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:edit_user');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('permission:edit_user');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:delete_user');


    //permissions
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index')->middleware('permission:view_permission');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware('permission:create_permission');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store')->middleware('permission:create_permission');
    Route::get('/permissions/{permission}', [PermissionController::class, 'show'])->name('permissions.show')->middleware('permission:view_permission');
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('permission:edit_permission');
    Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update')->middleware('permission:edit_permission');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy')->middleware('permission:delete_permission');
});

require __DIR__.'/auth.php';
