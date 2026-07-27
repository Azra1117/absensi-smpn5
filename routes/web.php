<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'index'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

use App\Models\Guru;
use App\Models\Staff;
use App\Models\Siswa;
use App\Models\Absensi;

Route::get('/admin', function () {

    return view('admin.dashboard',[
        'guru' => Guru::count(),
        'staff' => Staff::count(),
        'siswa' => Siswa::count(),
        'absensi' => Absensi::count(),
    ]);

})->middleware('auth');

Route::get('/guru', function () {
    return view('guru.dashboard');
});

Route::get('/staff', function () {
    return view('staff.dashboard');
});

Route::get('/siswa', function () {
    return view('siswa.dashboard');
});
use App\Http\Controllers\GuruController;

Route::resource('guru', GuruController::class);