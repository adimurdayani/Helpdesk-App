<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // User
    // fungsi untuk menampilkan halaman user
    Route::get('user', [\App\Http\Controllers\UserController::class, 'index'])->name('user');

    // fungsi untuk menampilkan halaman tambah user
    Route::get('user/create', [\App\Http\Controllers\UserController::class, 'create'])->name('user.create');

    // fungsi untuk menyimpan data user baru
    Route::post('user/store', [\App\Http\Controllers\UserController::class, 'store'])->name('user.store');

    // fungsi untuk menampilkan halaman edit user
    Route::get('user/edit/{user}', [\App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');

    // fungsi untuk memperbarui data user
    Route::put('user/update/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');

    // fungsi untuk menghapus data user
    Route::delete('user/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

    // OPD
    Route::get('/opd', [\App\Http\Controllers\OpdController::class, 'index'])->name('opd');
    Route::get('/opd/create', [\App\Http\Controllers\OpdController::class, 'create'])->name('opd.create');
    Route::post('/opd/store', [\App\Http\Controllers\OpdController::class, 'store'])->name('opd.store');
    Route::get('/opd/edit/{instansi}', [\App\Http\Controllers\OpdController::class, 'edit'])->name('opd.edit');
    Route::put('/opd/update/{instansi}', [\App\Http\Controllers\OpdController::class, 'update'])->name('opd.update');
    Route::delete('/opd/{instansi}', [\App\Http\Controllers\OpdController::class, 'destroy'])->name('opd.destroy');

    Route::get('/permission', [\App\Http\Controllers\PermissionController::class, 'index'])->name('permission');
    Route::get('/role', [\App\Http\Controllers\RoleController::class, 'index'])->name('role');
    Route::get('/role/create', [\App\Http\Controllers\RoleController::class, 'create'])->name('role.create');
    Route::post('/role/store', [\App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
    Route::get('/role/edit/{role}', [\App\Http\Controllers\RoleController::class, 'edit'])->name('role.edit');
    Route::delete('/role/delete/{role}', [\App\Http\Controllers\RoleController::class, 'destroy'])->name('role.destroy');
});

require __DIR__ . '/auth.php';
