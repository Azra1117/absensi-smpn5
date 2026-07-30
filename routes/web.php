<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ImportSiswaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\KalenderAkademikController;

use App\Models\Guru;
use App\Models\Staff;
use App\Models\Siswa;
use App\Models\Absensi;

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| Semua Route Admin (Harus Login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/absensi/siswa/{kelas}', [AbsensiController::class, 'getSiswa'])
    ->name('absensi.siswa');
Route::get('/laporan', [LaporanController::class, 'index'])
    ->name('laporan.index');

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/admin', function () {
        return view('admin.dashboard', [
            'guru'     => Guru::count(),
            'staff'    => Staff::count(),
            'siswa'    => Siswa::count(),
            'kelas'    => \App\Models\Kelas::count(),
            'absensi'  => Absensi::whereDate('tanggal', now())->count(),
        ]);
    })->name('admin.dashboard');

    Route::get('/laporan/export/excel', [LaporanController::class, 'exportExcel'])
    ->name('laporan.excel');
    Route::get('/laporan/export/pdf', [LaporanController::class, 'exportPdf'])
    ->name('laporan.pdf');

    /*
    |--------------------------------------------------------------------------
    | Guru
    |--------------------------------------------------------------------------
    */

    Route::resource('guru', GuruController::class);

    /*
    |--------------------------------------------------------------------------
    | Kelas
    |--------------------------------------------------------------------------
    */

    Route::resource('kelas', KelasController::class);

    /*
    |--------------------------------------------------------------------------
    | Import Data Siswa
    |--------------------------------------------------------------------------
    */

    Route::get('/import-siswa', [ImportSiswaController::class, 'index'])
        ->name('import.siswa');

    Route::post('/import-siswa', [ImportSiswaController::class, 'store'])
        ->name('import.siswa.store');

    /*
    |--------------------------------------------------------------------------
    | Absensi
    |--------------------------------------------------------------------------
    */

    Route::resource('absensi', AbsensiController::class);

    /*
    |--------------------------------------------------------------------------
    | Rekap Absensi
    |--------------------------------------------------------------------------
    */

    Route::get('/rekap-absensi', [RekapController::class, 'index'])
        ->name('rekap.index');
    
    Route::get('/rekap-absensi/export/excel', [RekapController::class, 'exportExcel'])
    ->name('rekap.export.excel');

    Route::get('/rekap-absensi/export/pdf', [RekapController::class, 'exportPdf'])
    ->name('rekap.export.pdf');
    
    Route::get('/kalender-akademik', [KalenderAkademikController::class, 'index'])
    ->name('kalender.index');

    Route::post('/kalender-akademik/generate', [KalenderAkademikController::class, 'generate'])
    ->name('kalender.generate');

    Route::get('/kalender-akademik/{kalender}/edit', [KalenderAkademikController::class, 'edit'])
    ->name('kalender.edit');

    Route::put('/kalender-akademik/{kalender}', [KalenderAkademikController::class, 'update'])
    ->name('kalender.update');

});
    Route::get('/absensi/data/{tanggal}/{shift}/{kelas}', [AbsensiController::class, 'getAbsensi'])
    ->name('absensi.data');

/*
|--------------------------------------------------------------------------
| Dashboard Siswa
|--------------------------------------------------------------------------
*/

Route::get('/siswa', function () {
    return view('siswa.dashboard');
});