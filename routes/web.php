<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SantriController;
use App\Http\Controllers\Admin\PengasuhController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Pengurus\DataHafalanSantri;
use App\Http\Controllers\Admin\DataKegiatanController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\DataPelanggaranController;
use App\Http\Controllers\Pengurus\HafalanSantriController;
use App\Http\Controllers\Santri\DashboardSantriController;
use App\Http\Controllers\Santri\LihatHafalanSayaController;
use App\Http\Controllers\Admin\LaporanAdminHafalanController;
use App\Http\Controllers\Admin\LaporanAdminPelanggaranController;
use App\Http\Controllers\Admin\LaporanAdminPerizinanPulangController;
use App\Http\Controllers\Pengasuh\DashboardPengasuhController;
use App\Http\Controllers\Pengasuh\PelanggaranSantriController;
use App\Http\Controllers\Pengurus\DashboardPengurusController;
use App\Http\Controllers\Santri\LihatPelanggaranSayaController;
use App\Http\Controllers\Admin\LihatDataHafalanSantriController;
use App\Http\Controllers\Pengasuh\DataPerizinanPulangController;
use App\Http\Controllers\Santri\AjukanPerizinanPulangController;
use App\Http\Controllers\Admin\LihatDataPelanggaranSantriController;
use App\Http\Controllers\Admin\LihatDataPerizinanPulangSantriController;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Admin
    Route::prefix('dashboard/admin')->middleware('role:admin')->group(function () {
        Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboard.admin');
        //Kelas
        Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
        Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
        Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
        //santri
        Route::resource('/santri', SantriController::class);
        //pengurus
        Route::resource('/pengurus', PengurusController::class);
        //pengasuh
        Route::resource('/pengasuh', PengasuhController::class);
        Route::resource('/data-kegiatan', DataKegiatanController::class);
        Route::resource('/data-pelanggaran', DataPelanggaranController::class);

        // Menampilkan semua kegiatan hafalan yang ada
        Route::get('/hafalan-santri', [LihatDataHafalanSantriController::class, 'index'])->name('admin.hafalan-santri.index');
        // Menampilkan detail hafalan per kegiatan
        Route::get('/hafalan-santri/{dataKegiatan}', [LihatDataHafalanSantriController::class, 'show'])->name('admin.hafalan-santri.show');
        // Menampilkan semua kegiatan hafalan yang ada
        Route::get('/pelanggaran-santri', [LihatDataPelanggaranSantriController::class, 'index'])->name('admin.pelanggaran-santri.index');
        // Menampilkan detail hafalan per kegiatan
        Route::get('/pelanggaran-santri/{dataPelanggaran}', [LihatDataPelanggaranSantriController::class, 'show'])->name('admin.pelanggaran-santri.show');

        Route::get('perizinan-pulang', [LihatDataPerizinanPulangSantriController::class, 'index'])->name('admin.perizinan-pulang.index');
        Route::get('perizinan-pulang/{id}', [LihatDataPerizinanPulangSantriController::class, 'show'])->name('admin.perizinan-pulang.show');

        Route::get('/laporan-hafalan', [LaporanAdminHafalanController::class, 'index'])->name('admin.laporan-hafalan.index');
        Route::post('/laporan-hafalan', [LaporanAdminHafalanController::class, 'laporanHafalan'])->name('admin.laporan-hafalan');
        Route::get('/laporan-hafalan/pdf', [LaporanAdminHafalanController::class, 'cetakHafalanPDF'])->name('admin.laporan-hafalan.pdf');

        Route::get('/laporan-pelanggaran', [LaporanAdminPelanggaranController::class, 'index'])->name('admin.laporan-pelanggaran.index');
        Route::post('/laporan-pelanggaran', [LaporanAdminPelanggaranController::class, 'laporanPelanggaran'])->name('admin.laporan-pelanggaran');
        Route::get('/laporan-pelanggaran/pdf', [LaporanAdminPelanggaranController::class, 'cetakPelanggaranPDF'])->name('admin.laporan-pelanggaran.pdf');

        Route::get('/laporan-perizinan-pulang', [LaporanAdminPerizinanPulangController::class, 'index'])->name('admin.laporan-perizinan-pulang.index');
        Route::post('/laporan-perizinan-pulang', [LaporanAdminPerizinanPulangController::class, 'laporanPerizinanPulang'])->name('admin.laporan-perizinan-pulang');
        Route::get('/laporan-perizinan-pulang/pdf', [LaporanAdminPerizinanPulangController::class, 'cetakPerizinanPulangPDF'])->name('admin.laporan-perizinan-pulang.pdf');
    });

    // Dashboard Pengasuh
    Route::prefix('dashboard/pengasuh')->middleware('role:pengasuh')->group(function () {
        Route::get('/', [DashboardPengasuhController::class, 'index'])->name('dashboard.pengasuh');

        Route::get('/pelanggaran', [PelanggaranSantriController::class, 'index'])->name('pengasuh.pelanggaran.index');
        Route::get('/pelanggaran/create/{dataPelanggaran}', [PelanggaranSantriController::class, 'create'])->name('pengasuh.pelanggaran.create');
        Route::post('/pelanggaran', [PelanggaranSantriController::class, 'store'])->name('pengasuh.pelanggaran.store');
        Route::get('/pelanggaran/show/{dataPelanggaran}', [PelanggaranSantriController::class, 'show'])->name('pengasuh.pelanggaran.show');
        Route::get('/pelanggaran/edit/{pelanggaran}', [PelanggaranSantriController::class, 'edit'])->name('pengasuh.pelanggaran.edit');
        Route::put('/pelanggaran/{pelanggaran}', [PelanggaranSantriController::class, 'update'])->name('pengasuh.pelanggaran.update');
        Route::delete('/pelanggaran/{pelanggaran}', [PelanggaranSantriController::class, 'destroy'])->name('pengasuh.pelanggaran.destroy');

        Route::get('/perizinan-pulang', [DataPerizinanPulangController::class, 'index'])->name('pengasuh.perizinan-pulang.index');
        Route::get('/perizinan-pulang/{id}', [DataPerizinanPulangController::class, 'show'])->name('pengasuh.perizinan-pulang.show');
        Route::post('/perizinan-pulang/{id}/status', [DataPerizinanPulangController::class, 'updateStatus'])->name('pengasuh.perizinan-pulang.updateStatus');
    });

    // Dashboard Pengurus
    Route::prefix('dashboard/pengurus')->middleware('role:pengurus')->group(function () {
        Route::get('/', [DashboardPengurusController::class, 'index'])->name('dashboard.pengurus');

        Route::get('/hafalan', [HafalanSantriController::class, 'index'])->name('pengurus.hafalan.index');
        Route::get('/hafalan/create/{dataKegiatan}', [HafalanSantriController::class, 'create'])->name('pengurus.hafalan.create');
        Route::post('/hafalan', [HafalanSantriController::class, 'store'])->name('pengurus.hafalan.store');
        Route::get('/hafalan/show/{dataKegiatan}', [HafalanSantriController::class, 'show'])->name('pengurus.hafalan.show');
        Route::get('/hafalan/edit/{hafalan}', [HafalanSantriController::class, 'edit'])->name('pengurus.hafalan.edit');
        Route::put('/hafalan/{hafalan}', [HafalanSantriController::class, 'update'])->name('pengurus.hafalan.update');
        Route::delete('/hafalan/{hafalan}', [HafalanSantriController::class, 'destroy'])->name('pengurus.hafalan.destroy');
    });

    // Dashboard Santri
    Route::prefix('dashboard/santri')->middleware('role:santri')->group(function () {
        Route::get('/', [DashboardSantriController::class, 'index'])->name('dashboard.santri');

        Route::resource('/perizinan-pulang', AjukanPerizinanPulangController::class);

        Route::get('/hafalan-saya', [LihatHafalanSayaController::class, 'index'])->name('santri.hafalan-saya.index');
        Route::get('/hafalan-saya/{dataKegiatan}', [LihatHafalanSayaController::class, 'show'])->name('santri.hafalan-saya.show');

        Route::get('/pelanggaran-saya', [LihatPelanggaranSayaController::class, 'index'])->name('santri.pelanggaran-saya.index');
        Route::get('/pelanggaran-saya/{dataPelanggaran}', [LihatPelanggaranSayaController::class, 'show'])->name('santri.pelanggaran-saya.show');
    });
});
