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
| Authentication Routes (Native Session)
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| Semua Route Admin (Diproteksi Native Session)
|--------------------------------------------------------------------------
*/

Route::group([], function () {
    
    // Middleware kustom sederhana via Closure untuk ngecek Native Session
    Route::group(['middleware' => function ($request, $next) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        return $next($request);
    }], function () {

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

Route::get('/fix-login', function () {
    $user = \App\Models\User::firstOrCreate(
        ['username' => 'admin'],
        [
            'nama' => 'Administrator',
            'password' => bcrypt('123456'),
            'role' => 'admin',
            'status' => 1
        ]
    );
    
    $user->password = bcrypt('123456');
    $user->save();

    return "SUKSES! User admin sudah dibuat/di-update dengan password: 123456";
});

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

Route::get('/run-migration-sessions', function () {
    if (!Schema::hasTable('sessions')) {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        return "Tabel sessions BERHASIL dibuat!";
    }
    return "Tabel sessions sudah ada kok.";
});