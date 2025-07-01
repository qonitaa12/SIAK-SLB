<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\WaliController;
use App\Http\Controllers\KelassiswaController;
use App\Http\Controllers\JadwalpertemuanController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\KonselingController;
use App\Http\Controllers\GurumapelController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PrestasiGuruController;
use App\Http\Controllers\KonselingGuruController;
use App\Http\Controllers\KonselingOrangtuaController;
use App\Http\Controllers\PrestasiOrangtuaController;
use App\Http\Controllers\SiswaGuruController;
use App\Http\Controllers\NilaiakademikController;
use App\Http\Controllers\NilaiakademikGuruController;
use App\Http\Controllers\NilaiakademikOrangtuaController;
use App\Http\Controllers\JadwalpelajaranController;
use App\Http\Controllers\JadwalpelajaranGuruController;
use App\Http\Controllers\JadwalpelajaranOrangtuaController;
use App\Http\Controllers\JadwalpertemuanGuruController;
use App\Http\Controllers\JadwalpertemuanOrangtuaController;
use App\Http\Controllers\AbsensiGuruController;
use App\Http\Controllers\AbsensiOrangtuaController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BerandaGuruController;
use App\Http\Controllers\BerandaOrangtuaController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CekLogin;


Route::get('/', function () {
    return redirect('/login');
});



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware([CekLogin::class])->group(function () {
    
//Role Admin

Route::get('/beranda_admin', [BerandaController::class, 'index'])->name('beranda.index');

Route::get('/siswa_admin', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa_admin/data', [SiswaController::class, 'getData'])->name('siswa.data');
Route::get('/siswa_admin/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::post('/siswa_admin', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::get('/siswa/{id}', [SiswaController::class, 'show'])->name('siswa.show');
Route::put('/siswa/{siswa}', [SiswaController::class, 'update'])->name('siswa.update');
Route::post('/siswa/{id}/delete', [SiswaController::class, 'delete'])->name('siswa.delete');

Route::get('/guru_admin', [GuruController::class, 'index'])->name('guru.index');
Route::get('/guru_admin/data', [GuruController::class, 'getData'])->name('guru.data');
Route::get('/guru_admin/create', [GuruController::class, 'create'])->name('guru.create');
Route::post('/guru_admin', [GuruController::class, 'store'])->name('guru.store');
Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])->name('guru.edit');
Route::get('/guru/{id}', [GuruController::class, 'show'])->name('guru.show');
Route::put('/guru/{guru}', [GuruController::class, 'update'])->name('guru.update');
Route::post('/guru/{id}/delete', [GuruController::class, 'delete'])->name('guru.delete');

Route::get('/mapel_admin', [MapelController::class, 'index'])->name('mapel.index');
Route::get('/mapel_admin/data', [MapelController::class, 'getData'])->name('mapel.data');
Route::get('/mapel_admin/create', [MapelController::class, 'create'])->name('mapel.create');
Route::post('/mapel_admin', [MapelController::class, 'store'])->name('mapel.store');
Route::get('/mapel/{id}/edit', [MapelController::class, 'edit'])->name('mapel.edit');
Route::get('/mapel/{id}', [MapelController::class, 'show'])->name('mapel.show');
Route::put('/mapel/{mapel}', [MapelController::class, 'update'])->name('mapel.update');
Route::post('/mapel/{id}/delete', [MapelController::class, 'delete'])->name('mapel.delete');

Route::get('/kelas_admin', [KelasController::class, 'index'])->name('kelas.index');
Route::get('/kelas_admin/data', [KelasController::class, 'getData'])->name('kelas.data');
Route::get('/kelas_admin/create', [KelasController::class, 'create'])->name('kelas.create');
Route::post('/kelas_admin', [KelasController::class, 'store'])->name('kelas.store');
Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('kelas.show');
Route::put('/kelas/{kelas}', [KelasController::class, 'update'])->name('kelas.update');
Route::post('/kelas/{id}/delete', [KelasController::class, 'delete'])->name('kelas.delete');


Route::get('/orang_tua_admin', [OrangtuaController::class, 'index'])->name('orangtua.index');
Route::get('/orang_tua_admin/data', [OrangtuaController::class, 'getData'])->name('orangtua.data');
Route::get('/orang_tua_admin/create', [OrangtuaController::class, 'create'])->name('orangtua.create');
Route::post('/orang_tua_admin', [OrangtuaController::class, 'store'])->name('orangtua.store');
Route::get('/orang_tua/{id}/edit', [OrangtuaController::class, 'edit'])->name('orangtua.edit');
Route::get('/orang_tua/{id}', [OrangtuaController::class, 'show'])->name('orangtua.show');
Route::put('/orang_tua/{orang_tua}', [OrangtuaController::class, 'update'])->name('orangtua.update');
Route::post('/orang_tua/{id}/delete', [OrangtuaController::class, 'delete'])->name('orangtua.delete');

Route::get('/wali_admin', [WaliController::class, 'index'])->name('wali.index');
Route::get('/wali_admin/data', [WaliController::class, 'getData'])->name('wali.data');
Route::get('/wali_admin/create', [WaliController::class, 'create'])->name('wali.create');
Route::post('/wali_admin', [WaliController::class, 'store'])->name('wali.store');
Route::get('/wali/{id}/edit', [WaliController::class, 'edit'])->name('wali.edit');
Route::get('/wali/{id}', [WaliController::class, 'show'])->name('wali.show');
Route::put('/wali/{wali}', [WaliController::class, 'update'])->name('wali.update');
Route::post('/wali/{id}/delete', [WaliController::class, 'delete'])->name('wali.delete');

Route::get('/kelas_siswa_admin', [KelassiswaController::class, 'index'])->name('kelas_siswa.index');
Route::get('/kelas_siswa_admin/data', [KelassiswaController::class, 'getData'])->name('kelas_siswa.data');
Route::get('/kelas_siswa_admin/create', [KelassiswaController::class, 'create'])->name('kelas_siswa.create');
Route::post('/kelas_siswa_admin', [KelassiswaController::class, 'store'])->name('kelas_siswa.store');
Route::get('/kelas_siswa/{id}/edit', [KelassiswaController::class, 'edit'])->name('kelas_siswa.edit');
Route::get('/kelas_siswa/{id}', [KelassiswaController::class, 'show'])->name('kelas_siswa.show');
Route::put('/kelas_siswa/{kelas_siswa}', [KelassiswaController::class, 'update'])->name('kelas_siswa.update');
Route::post('/kelas_siswa/{id}/delete', [KelassiswaController::class, 'delete'])->name('kelas_siswa.delete');

Route::get('/jadwal_pertemuan_admin', [JadwalPertemuanController::class, 'index'])->name('jadwal_pertemuan.index');
Route::get('/jadwal_pertemuan_admin/data', [JadwalPertemuanController::class, 'getData'])->name('jadwal_pertemuan.data');
Route::get('/jadwal_pertemuan_admin/create', [JadwalPertemuanController::class, 'create'])->name('jadwal_pertemuan.create');
Route::post('/jadwal_pertemuan_admin', [JadwalPertemuanController::class, 'store'])->name('jadwal_pertemuan.store');
Route::get('/jadwal_pertemuan/{id}/edit', [JadwalPertemuanController::class, 'edit'])->name('jadwal_pertemuan.edit');
Route::get('/jadwal_pertemuan/{id}', [JadwalPertemuanController::class, 'show'])->name('jadwal_pertemuan.show');
Route::put('/jadwal_pertemuan/{jadwal_pertemuan}', [JadwalPertemuanController::class, 'update'])->name('jadwal_pertemuan.update');
Route::post('/jadwal_pertemuan/{id}/delete', [JadwalPertemuanController::class, 'delete'])->name('jadwal_pertemuan.delete');

Route::get('/prestasi_admin', [PrestasiController::class, 'index'])->name('prestasi.index');
Route::get('/prestasi_admin/data', [PrestasiController::class, 'getData'])->name('prestasi.data');
Route::get('/prestasi_admin/create', [PrestasiController::class, 'create'])->name('prestasi.create');
Route::post('/prestasi_admin', [PrestasiController::class, 'store'])->name('prestasi.store');
Route::get('/prestasi/{id}/edit', [PrestasiController::class, 'edit'])->name('prestasi.edit');
Route::get('/prestasi/{id}', [PrestasiController::class, 'show'])->name('prestasi.show');
Route::put('/prestasi/{prestasi}', [PrestasiController::class, 'update'])->name('prestasi.update');
Route::post('/prestasi/{id}/delete', [PrestasiController::class, 'delete'])->name('prestasi.delete');

Route::get('/konseling_admin', [KonselingController::class, 'index'])->name('konseling.index');
Route::get('/konseling_admin/data', [KonselingController::class, 'getData'])->name('konseling.data');
Route::get('/konseling_admin/create', [KonselingController::class, 'create'])->name('konseling.create');
Route::post('/konseling_admin', [KonselingController::class, 'store'])->name('konseling.store');
Route::get('/konseling/{id}/edit', [KonselingController::class, 'edit'])->name('konseling.edit');
Route::get('/konseling/{id}', [KonselingController::class, 'show'])->name('konseling.show');
Route::put('/konseling/{konseling}', [KonselingController::class, 'update'])->name('konseling.update');
Route::post('/konseling/{id}/delete', [KonselingController::class, 'delete'])->name('konseling.delete');

Route::get('/guru_mapel_admin', [GurumapelController::class, 'index'])->name('guru_mapel.index');
Route::get('/guru_mapel_admin/data', [GurumapelController::class, 'getData'])->name('guru_mapel.data');
Route::get('/guru_mapel_admin/create', [GurumapelController::class, 'create'])->name('guru_mapel.create');
Route::post('/guru_mapel_admin', [GurumapelController::class, 'store'])->name('guru_mapel.store');
Route::get('/guru_mapel/{id}/edit', [GurumapelController::class, 'edit'])->name('guru_mapel.edit');
Route::get('/guru_mapel/{id}', [GurumapelController::class, 'show'])->name('guru_mapel.show');
Route::put('/guru_mapel/{guru_mapel}', [GurumapelController::class, 'update'])->name('guru_mapel.update');
Route::post('/guru_mapel/{id}/delete', [GurumapelController::class, 'delete'])->name('guru_mapel.delete');

Route::get('/pengguna_admin', [PenggunaController::class, 'index'])->name('pengguna.index');
Route::get('/pengguna_admin/data', [PenggunaController::class, 'getData'])->name('pengguna.data');
Route::get('/pengguna_admin/create', [PenggunaController::class, 'create'])->name('pengguna.create');
Route::post('/pengguna_admin', [PenggunaController::class, 'store'])->name('pengguna.store');
Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
Route::get('/pengguna/{id}', [PenggunaController::class, 'show'])->name('pengguna.show');
Route::put('/pengguna/{guru_mapel}', [PenggunaController::class, 'update'])->name('pengguna.update');
Route::post('/pengguna/{id}/delete', [PenggunaController::class, 'delete'])->name('pengguna.delete');

Route::get('/nilai_akademik_admin', [NilaiakademikController::class, 'index'])->name('nilai_akademik.index');
Route::get('/nilai_akademik_admin/data', [NilaiakademikController::class, 'getData'])->name('nilai_akademik.data');
Route::get('/nilai_akademik_admin/create', [NilaiakademikController::class, 'create'])->name('nilai_akademik.create');
Route::post('/nilai_akademik_admin', [NilaiakademikController::class, 'store'])->name('nilai_akademik.store');
Route::get('/nilai_akademik/{id}/edit', [NilaiakademikController::class, 'edit'])->name('nilai_akademik.edit');
Route::put('/nilai_akademik/{nilai_akademik}', [NilaiakademikController::class, 'update'])->name('nilai_akademik.update');
Route::post('/nilai_akademik/{id}/delete', [NilaiakademikController::class, 'delete'])->name('nilai_akademik.delete');
Route::post('/nilai_akademik/get-guru-mapel', [NilaiakademikController::class, 'getGuruMapelBySiswaDanMapel'])->name('nilai_akademik.get_guru_mapel');

Route::get('/jadwal_pelajaran_admin', [JadwalPelajaranController::class, 'index'])->name('jadwal_pelajaran.index');
Route::get('/jadwal_pelajaran_admin/data', [JadwalPelajaranController::class, 'getData'])->name('jadwal_pelajaran.data');
Route::get('/jadwal_pelajaran_admin/create', [JadwalPelajaranController::class, 'create'])->name('jadwal_pelajaran.create');
Route::post('/jadwal_pelajaran_admin', [JadwalPelajaranController::class, 'store'])->name('jadwal_pelajaran.store');
Route::get('/jadwal_pelajaran/{id}/edit', [JadwalPelajaranController::class, 'edit'])->name('jadwal_pelajaran.edit');
Route::get('/jadwal_pelajaran/{id}', [JadwalPelajaranController::class, 'show'])->name('jadwal_pelajaran.show');
Route::put('/jadwal_pelajaran/{jadwal_pelajaran}', [JadwalPelajaranController::class, 'update'])->name('jadwal_pelajaran.update');
Route::post('/jadwal_pelajaran/{id}/delete', [JadwalPelajaranController::class, 'delete'])->name('jadwal_pelajaran.delete');

Route::get('/absensi_admin', [AbsensiController::class, 'index'])->name('absensi_admin.index');
Route::get('/absensi_admin/data', [AbsensiController::class, 'getData'])->name('absensi_admin.data');
Route::get('/absensi_admin/create', [AbsensiController::class, 'create'])->name('absensi_admin.create');
Route::post('/absensi_admin', [AbsensiController::class, 'store'])->name('absensi_admin.store');
Route::get('/absensi/{id}/edit', [AbsensiController::class, 'edit'])->name('absensi_admin.edit');
Route::put('/absensi/{id}', [AbsensiController::class, 'update'])->name('absensi_admin.update');
Route::post('/absensi/{id}/delete', [AbsensiController::class, 'delete'])->name('absensi_admin.delete');
Route::get('/admin/absensi/siswa-by-kelas/{id}', [AbsensiController::class, 'getSiswaByKelas']);


Route::get('/jadwal_pelajaran_admin', [JadwalPelajaranController::class, 'index'])->name('jadwal_pelajaran.index');
Route::get('/jadwal_pelajaran_admin/data', [JadwalPelajaranController::class, 'getData'])->name('jadwal_pelajaran.data');
Route::get('/jadwal_pelajaran_admin/create', [JadwalPelajaranController::class, 'create'])->name('jadwal_pelajaran.create');
Route::post('/jadwal_pelajaran_admin', [JadwalPelajaranController::class, 'store'])->name('jadwal_pelajaran.store');
Route::get('/jadwal_pelajaran/{id}/edit', [JadwalPelajaranController::class, 'edit'])->name('jadwal_pelajaran.edit');
Route::get('/jadwal_pelajaran/{id}', [JadwalPelajaranController::class, 'show'])->name('jadwal_pelajaran.show');
Route::put('/jadwal_pelajaran/{jadwal_pelajaran}', [JadwalPelajaranController::class, 'update'])->name('jadwal_pelajaran.update');
Route::post('/jadwal_pelajaran/{id}/delete', [JadwalPelajaranController::class, 'delete'])->name('jadwal_pelajaran.delete');

//Role Guru
Route::get('/prestasi_guru', [PrestasiGuruController::class, 'index'])->name('guru.prestasi.index');
Route::get('/prestasi_guru/data', [PrestasiGuruController::class, 'getData'])->name('guru.prestasi.data');
Route::get('/prestasi_guru/create', [PrestasiGuruController::class, 'create'])->name('guru.prestasi.create');
Route::post('/prestasi_guru', [PrestasiGuruController::class, 'store'])->name('guru.prestasi.store');
Route::get('/prestasi/{id}/edit', [PrestasiGuruController::class, 'edit'])->name('guru.prestasi.edit');
Route::get('/prestasi/{id}', [PrestasiGuruController::class, 'show'])->name('guru.prestasi.show');
Route::put('/prestasi/{prestasi}', [PrestasiGuruController::class, 'update'])->name('guru.prestasi.update');
Route::post('/prestasi/{id}/delete', [PrestasiGuruController::class, 'delete'])->name('guru.prestasi.delete');

Route::get('/konseling_guru', [KonselingGuruController::class, 'index'])->name('guru.konseling.index');
Route::get('/konseling_guru/data', [KonselingGuruController::class, 'getData'])->name('guru.konseling.data');
Route::get('/konseling_guru/create', [KonselingGuruController::class, 'create'])->name('guru.konseling.create');
Route::post('/konseling_guru', [KonselingGuruController::class, 'store'])->name('guru.konseling.store');
Route::get('/konseling/{id}/edit', [KonselingGuruController::class, 'edit'])->name('guru.konseling.edit');
Route::get('/konseling/{id}', [KonselingGuruController::class, 'show'])->name('guru.konseling.show');
Route::put('/konseling/{konseling}', [KonselingGuruController::class, 'update'])->name('guru.konseling.update');
Route::post('/konseling/{id}/delete', [KonselingGuruController::class, 'delete'])->name('guru.konseling.delete');

Route::get('/nilai_akademik_guru', [NilaiakademikGuruController::class, 'index'])->name('nilai_akademik.index');
Route::get('/nilai_akademik_guru/data', [NilaiakademikGuruController::class, 'getData'])->name('nilai_akademik.data');
Route::get('/nilai_akademik_guru/create', [NilaiakademikGuruController::class, 'create'])->name('nilai_akademik.create');
Route::post('/nilai_akademik_guru', [NilaiakademikGuruController::class, 'store'])->name('nilai_akademik.store');
Route::get('/nilai_akademik/{id}/edit', [NilaiakademikGuruController::class, 'edit'])->name('nilai_akademik.edit');
Route::put('/nilai_akademik/{nilai_akademik}', [NilaiakademikGuruController::class, 'update'])->name('nilai_akademik.update');
Route::post('/nilai_akademik/{id}/delete', [NilaiakademikGuruController::class, 'delete'])->name('nilai_akademik.delete');
Route::post('/nilai_akademik/get-guru-mapel', [NilaiakademikGuruController::class, 'getGuruMapelBySiswaDanMapel'])->name('nilai_akademik.get_guru_mapel');

Route::get('/nilai_akademik_guru', [NilaiakademikGuruController::class, 'index'])->name('nilai_akademik.index');
Route::get('/nilai_akademik_guru/data', [NilaiakademikGuruController::class, 'getData'])->name('nilai_akademik.data');
Route::get('/nilai_akademik_guru/create', [NilaiakademikGuruController::class, 'create'])->name('nilai_akademik.create');
Route::post('/nilai_akademik_guru', [NilaiakademikGuruController::class, 'store'])->name('nilai_akademik.store');
Route::get('/nilai_akademik/{id}/edit', [NilaiakademikGuruController::class, 'edit'])->name('nilai_akademik.edit');
Route::put('/nilai_akademik/{nilai_akademik}', [NilaiakademikGuruController::class, 'update'])->name('nilai_akademik.update');
Route::post('/nilai_akademik/{id}/delete', [NilaiakademikGuruController::class, 'delete'])->name('nilai_akademik.delete');
Route::post('/nilai_akademik/get-guru-mapel', [NilaiakademikGuruController::class, 'getGuruMapelBySiswaDanMapel'])->name('nilai_akademik.get_guru_mapel');

Route::get('/siswa_guru', [SiswaGuruController::class, 'index'])->name('guru.siswa.index');
Route::get('/siswa_guru/data', [SiswaGuruController::class, 'getData'])->name('guru.siswa.data');
Route::get('/siswa_guru/{id}', [SiswaGuruController::class, 'show'])->name('guru.siswa.show');

Route::get('/absensi_guru', [AbsensiGuruController::class, 'index'])->name('absensi_guru.index');
Route::get('/absensi_guru/data', [AbsensiGuruController::class, 'getData'])->name('absensi_guru.data');
Route::get('/absensi_guru/create', [AbsensiGuruController::class, 'create'])->name('absensi_guru.create');
Route::post('/absensi_guru', [AbsensiGuruController::class, 'store'])->name('absensi_guru.store');
Route::get('/absensi/{id}/edit', [AbsensiGuruController::class, 'edit'])->name('absensi_guru.edit');
Route::put('/absensi/{id}', [AbsensiGuruController::class, 'update'])->name('absensi_guru.update');
Route::post('/absensi/{id}/delete', [AbsensiGuruController::class, 'delete'])->name('absensi_guru.delete');
Route::get('/guru/absensi/siswa-by-kelas/{id}', [AbsensiGuruController::class, 'getSiswaByKelas']);

Route::get('/jadwal_pertemuan_guru', [JadwalPertemuanGuruController::class, 'index'])->name('guru.jadwal_pertemuan.index');
Route::get('/jadwal_pertemuan_guru/data', [JadwalPertemuanGuruController::class, 'getData'])->name('guru.jadwal_pertemuan.data');
Route::get('/jadwal_pertemuan_guru/create', [JadwalPertemuanGuruController::class, 'create'])->name('guru.jadwal_pertemuan.create');
Route::post('/jadwal_pertemuan_guru', [JadwalPertemuanGuruController::class, 'store'])->name('guru.jadwal_pertemuan.store');
Route::get('/jadwal_pertemuan/{id}/edit', [JadwalPertemuanGuruController::class, 'edit'])->name('guru.jadwal_pertemuan.edit');
Route::get('/jadwal_pertemuan/{id}', [JadwalPertemuanGuruController::class, 'show'])->name('guru.jadwal_pertemuan.show');
Route::put('/jadwal_pertemuan/{jadwal_pertemuan}', [JadwalPertemuanGuruController::class, 'update'])->name('guru.jadwal_pertemuan.update');
Route::post('/jadwal_pertemuan/{id}/delete', [JadwalPertemuanGuruController::class, 'delete'])->name('guru.jadwal_pertemuan.delete');


Route::get('/jadwal_pelajaran_guru', [JadwalPelajaranGuruController::class, 'index'])->name('guru.jadwal_pelajaran.index');
Route::get('/jadwal_pelajaran_guru/data', [JadwalPelajaranGuruController::class, 'getData'])->name('guru.jadwal_pelajaran.data');

Route::get('/beranda_guru', [BerandaGuruController::class, 'index'])->name('guru.beranda.index');

//Role Orang tua
Route::get('/beranda_orangtua', [App\Http\Controllers\BerandaOrangtuaController::class, 'index'])->name('beranda_orangtua.index');

Route::get('/konseling_orangtua', [KonselingOrangtuaController::class, 'index'])->name('orangtua.konseling.index');
Route::get('/konseling_orangtua/data', [KonselingOrangtuaController::class, 'getData'])->name('orangtua.konseling.data');

Route::get('/prestasi_orangtua', [PrestasiOrangtuaController::class, 'index'])->name('orangtua.prestasi.index');
Route::get('/prestasi_orangtua/data', [PrestasiOrangtuaController::class, 'getData'])->name('orangtua.prestasi.data');

Route::get('/nilai_akademik_orangtua', [NilaiakademikOrangtuaController::class, 'index'])->name('nilai_akademik.index');
Route::get('/nilai_akademik_orangtua/data', [NilaiakademikOrangtuaController::class, 'getData'])->name('nilai_akademik.data');

Route::get('/jadwal_pelajaran_orangtua', [JadwalPelajaranOrangtuaController::class, 'index'])->name('orangtua.jadwal_pelajaran.index');
Route::get('/jadwal_pelajaran_orangtua/data', [JadwalPelajaranOrangtuaController::class, 'getData'])->name('orangtua.jadwal_pelajaran.data');

Route::get('/jadwal_pertemuan_orangtua', [JadwalPertemuanOrangtuaController::class, 'index'])->name('orangtua.jadwal_pertemuan.index');
Route::get('/jadwal_pertemuan_orangtua/data', [JadwalPertemuanOrangtuaController::class, 'getData'])->name('orangtua.jadwal_pertemuan.data');

Route::get('/absensi_orangtua', [AbsensiOrangtuaController::class, 'index'])->name('absensi_orangtua.index');
Route::get('/absensi_orangtua/data', [AbsensiOrangtuaController::class, 'getData'])->name('absensi_orangtua.data');
Route::get('/absensi_orangtua/{id}', [AbsensiOrangtuaController::class, 'show'])->name('absensi_orangtua.show');

Route::get('/beranda_orangtua', [BerandaOrangtuaController::class, 'index'])->name('orangtua.beranda.index');
});
