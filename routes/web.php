<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Lacak Tiket
    Route::get('email-request/lacak', [App\Http\Controllers\LacakController::class, 'index'])->name('lacak');

    // Email Request
    Route::get('email-request', [\App\Http\Controllers\EmailRequestController::class, 'index'])
        ->name('email-request');
    Route::get('email-request/create', [\App\Http\Controllers\EmailRequestController::class, 'create'])
        ->name('email-request.create');
    Route::post('email-request/store', [\App\Http\Controllers\EmailRequestController::class, 'store'])
        ->name('email-request.store');
    Route::get('email-request/edit/{emailRequest}', [\App\Http\Controllers\EmailRequestController::class, 'edit'])
        ->name('email-request.edit');
    Route::put('email-request/update/{emailRequest}', [\App\Http\Controllers\EmailRequestController::class, 'update'])
        ->name('email-request.update');
    Route::get('email-request/show/{emailRequest}', [\App\Http\Controllers\EmailRequestController::class, 'show'])
        ->name('email-request.show');
    Route::get('email-request/verifikasi/{emailRequest}', [\App\Http\Controllers\EmailRequestController::class, 'verifikasi'])
        ->name('email-request.verifikasi');
    Route::put('email-request/{emailRequest}/update-status', [\App\Http\Controllers\EmailRequestController::class, 'updateStatus'])
        ->name('email-request.updateStatus');
    Route::delete('email-request/{emailRequest}', [\App\Http\Controllers\EmailRequestController::class, 'destroy'])
        ->name('email-request.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //tambahkan kode middleware ini berfungsi untuk memberi akses kepada pengguna jika rolenya admin maka dia bisa akses route/url ini jika tidak maka tidak bisa di akses
    Route::middleware('role:admin')->group(function () {
        // OPD
        Route::get('/opd', [\App\Http\Controllers\OpdController::class, 'index'])->name('opd'); // melihat data opd
        Route::get('/opd/create', [\App\Http\Controllers\OpdController::class, 'create'])->name('opd.create'); // halaman tambah data opd
        Route::post('/opd/store', [\App\Http\Controllers\OpdController::class, 'store'])->name('opd.store'); // proses tambah data opd
        Route::get('/opd/edit/{instansi}', [\App\Http\Controllers\OpdController::class, 'edit'])->name('opd.edit'); // halaman edit data opd
        Route::put('/opd/update/{instansi}', [\App\Http\Controllers\OpdController::class, 'update'])->name('opd.update'); //proses edit data opd
        Route::delete('/opd/{instansi}', [\App\Http\Controllers\OpdController::class, 'destroy'])->name('opd.destroy'); // proses hapus data opd

        Route::get('/permission', [\App\Http\Controllers\PermissionController::class, 'index'])->name('permission'); // melihat data permission
        Route::get('/permission/create', [\App\Http\Controllers\PermissionController::class, 'create'])->name('permission.create'); // halaman tambah data permission
        Route::post('/permission/store', [\App\Http\Controllers\PermissionController::class, 'store'])->name('permission.store'); // proses tambah data permission
        Route::get('/permission/edit/{permission}', [\App\Http\Controllers\PermissionController::class, 'edit'])->name('permission.edit'); // halaman tambah data permission
        Route::put('/permission/edit/{permission}', [\App\Http\Controllers\PermissionController::class, 'update'])->name('permission.update'); // proses edit data permission
        Route::delete('/permission/{permission}', [\App\Http\Controllers\PermissionController::class, 'destroy'])->name('permission.destroy'); // proses hapus data permission

        Route::get('/role', [\App\Http\Controllers\RoleController::class, 'index'])->name('role'); //melihat data role
        Route::get('/role/create', [\App\Http\Controllers\RoleController::class, 'create'])->name('role.create'); //halaman tambah data role
        Route::post('/role/store', [\App\Http\Controllers\RoleController::class, 'store'])->name('role.store'); //proses tambah data role
        Route::get('/role/edit/{role}', [\App\Http\Controllers\RoleController::class, 'edit'])->name('role.edit'); //halaman edit data role
        Route::put('/role/update/{role}', [\App\Http\Controllers\RoleController::class, 'update'])->name('role.update'); // proses edit data role
        Route::delete('/role/delete/{role}', [\App\Http\Controllers\RoleController::class, 'destroy'])->name('role.destroy'); // proses hapus data role

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
    });
});

require __DIR__ . '/auth.php';
