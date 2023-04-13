<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengajuanMagangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(AuthController::class)->group(function () {
	Route::get('register', 'register')->name('register');
	Route::post('register', 'registerSimpan')->name('register.simpan');

	Route::get('login', 'login')->name('login');
	Route::post('login', 'loginAksi')->name('login.aksi');

	Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::get('/', function () {
	return view('auth/login');
});

Route::get('/index', function () {
	return view('beranda');
});

Route::middleware('auth')->group(function () {
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::controller(BarangController::class)->prefix('barang')->group(function () {
		Route::get('', 'index')->name('barang');
		Route::get('tambah', 'tambah')->name('barang.tambah');
		Route::post('tambah', 'simpan')->name('barang.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('barang.edit');
		Route::post('edit/{id}', 'update')->name('barang.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('barang.hapus');
	});

	Route::controller(KategoriController::class)->prefix('kategori')->group(function () {
		Route::get('', 'index')->name('kategori');
		Route::get('tambah', 'tambah')->name('kategori.tambah');
		Route::post('tambah', 'simpan')->name('kategori.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('kategori.edit');
		Route::post('edit/{id}', 'update')->name('kategori.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('kategori.hapus');
	});

	Route::controller(UnitController::class)->prefix('unit')->group(function () {
		Route::get('', 'index')->name('unit');
		Route::get('tambah', 'tambah')->name('unit.tambah');
		Route::post('tambah', 'simpan')->name('unit.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('unit.edit');
		Route::post('edit/{id}', 'update')->name('unit.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('unit.hapus');
	});

	Route::controller(PengajuanMagangController::class)->prefix('pengajuan_magang')->group(function () {
		Route::get('', 'index')->name('pengajuan_magang');
		Route::get('tambah', 'tambah')->name('pengajuan_magang.tambah');
		Route::post('tambah', 'simpan')->name('pengajuan_magang.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('pengajuan_magang.edit');
		Route::post('edit/{id}', 'update')->name('pengajuan_magang.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('pengajuan_magang.hapus');
	});

	Route::controller(MagangController::class)->prefix('riwayat_magang')->group(function () {
		Route::get('', 'index')->name('magang');
		Route::get('tambah', 'tambah')->name('magang.tambah');
		Route::post('tambah', 'simpan')->name('magang.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('magang.edit');
		Route::post('edit/{id}', 'update')->name('magang.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('magang.hapus');
	});


});
