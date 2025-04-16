<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KdumController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenyemakController;
use App\Http\Controllers\KdumDetailController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\RaporLokalController;
use App\Http\Controllers\TahunPelajaranController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\RaporLokalDetailController;
use App\Http\Controllers\RiwayatKelasSiswaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/coba', function () {
//     return view('coba');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/profil-guru', [ProfilController::class, 'showProfile'])->name('profil.guru');
Route::post('/profil/update-password', [ProfilController::class, 'updatePassword'])->name('profil.updatePassword');
Route::post('/profil/upload-foto', [ProfilController::class, 'uploadFoto'])->name('profil.uploadFoto');

Route::get('/kelas', [App\Http\Controllers\KelasController::class, 'index'])->name('kelas.index');
Route::post('/kelas', [App\Http\Controllers\KelasController::class, 'store'])->name('kelas.store');
Route::post('/kelas/update/{id}', [App\Http\Controllers\KelasController::class, 'update'])->name('kelas.update');
Route::delete('/kelas/{id}', [App\Http\Controllers\KelasController::class, 'destroy'])->name('kelas.destroy');
Route::resource('tahun', TahunPelajaranController::class);
Route::resource('mapel', MapelController::class);
Route::resource('jabatan', JabatanController::class);
Route::resource('ekstrakurikuler', EkstrakurikulerController::class);
Route::get('/siswas/{id}/riwayat-kelas', [SiswaController::class, 'showRiwayatKelas'])->name('siswa.riwayat.kelas');
Route::resource('siswas', SiswaController::class);
Route::get('/siswa/edit-siswa/{id}', [SiswaController::class, 'editSiswa'])->name('siswas.edit-siswa');
Route::put('/siswa/update-siswa/{id}', [SiswaController::class, 'updateSiswa'])->name('siswas.update-siswa');

Route::resource('gurus', GuruController::class);
Route::resource('penyemak', PenyemakController::class);
Route::resource('users', UserController::class);
Route::get('/kdum', [KdumController::class, 'index'])->name('kdum.index');
Route::get('/kdum/{id}/detail', [KdumController::class, 'showDetail'])->name('kdum.detail');
Route::get('/kdum/{id}/preview', [KdumController::class, 'preview'])->name('kdum.preview');
Route::put('/kdumdetail/{id}', [KdumDetailController::class, 'updateNilai'])->name('kdumdetail.update');
Route::get('/kdum/export/{id}', [App\Http\Controllers\KdumController::class, 'exportPdf'])->name('kdum.export');
Route::get('/kdum/saya', [App\Http\Controllers\KdumController::class, 'showBySiswa'])->name('kdum.saya');
Route::get('/rapor-lokal', [RaporLokalController::class, 'index'])->name('rapor-lokal.index');
Route::get('/rapor-lokal/{id}/detail', [RaporLokalController::class, 'showDetail'])->name('rapor-lokal.detail');
Route::get('/rapor-lokal/{id}/export', [RaporLokalController::class, 'exportPdf'])->name('rapor-lokal.export');
Route::get('/rapor-lokal/siswa', [RaporLokalController::class, 'showBySiswa'])->name('rapor-lokal.siswa');
Route::put('/rapor-lokal/{id}/detail', [RaporLokalDetailController::class, 'update'])->name('rapor-lokal.detail.update');
Route::put('/rapor-lokal/{id}', [RaporLokalController::class, 'update'])->name('rapor-lokal.update');
Route::get('/riwayat-kelas-siswa/create', [RiwayatKelasSiswaController::class, 'create'])->name('riwayat_kelas_siswa.create');
Route::post('/riwayat-kelas-siswa/store', [RiwayatKelasSiswaController::class, 'store'])->name('riwayat_kelas_siswa.store');
Route::get('riwayat-kelas/mass-update', [RiwayatKelasSiswaController::class, 'massUpdate'])->name('riwayatkelas.mass');
Route::post('riwayat-kelas/mass-update', [RiwayatKelasSiswaController::class, 'massStore'])->name('riwayatkelas.mass.store');

Route::resource('kompetensi', KompetensiController::class);


require __DIR__.'/auth.php';
