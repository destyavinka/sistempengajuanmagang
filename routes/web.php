<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\PekertianController;
use App\Http\Controllers\PekertiController;
use App\Http\Controllers\PengajuanMagangController;
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengajuanSerkomController;
use App\Http\Controllers\SerkomController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PenyelenggaraController;
use App\Http\Controllers\JenisSertifikasiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ReportDataController;


use App\Models\Pengajuan_magang;


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
	Route::get('verif-email/{tokenVerif}', 'verifEmail')->name('auth.verify');
	Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::get('/', function () {
	return view('auth/login');
});

Route::get('/index', function () {
	return view('beranda');
});

Route::middleware('auth', 'is_verify_email')->group(function () {
	Route::get('dashboard', function () {
		$dataCountPengajuanMagangBelumDiSetujui = Pengajuan_magang::where('status_pengajuanmagang', 'Belum Disetujui')->count();
		$dataCountPengajuanMagangBelumDiValidasi = Pengajuan_magang::where('status_pengajuanmagang', 'Menunggu Validasi')->count();
		$dataCountPengajuanMagangSudahDiSetujui = Pengajuan_magang::where('status_pengajuanmagang', 'Sudah Disetujui')->count();
		$dataOfCount = array(
			'dataCountPengajuanMagangBelumDiSetujui' => $dataCountPengajuanMagangBelumDiSetujui,
			'dataCountPengajuanMagangBelumDiValidasi' => $dataCountPengajuanMagangBelumDiValidasi,
			'dataCountPengajuanMagangSudahDiSetujui' => $dataCountPengajuanMagangSudahDiSetujui,
		);
		return view('dashboard', compact('dataOfCount'));
	})->name('dashboard');

	Route::controller(UnitController::class)->prefix('unit')->group(function () {
		Route::get('', 'index')->name('unit');
		Route::get('tambah', 'tambah')->name('unit.tambah');
		Route::post('tambah', 'simpan')->name('unit.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('unit.edit');
		Route::post('edit/{id}', 'update')->name('unit.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('unit.hapus');
	});

	Route::controller(PengajuanMagangController::class)->prefix('pengajuan_magang', 'skema')->group(function () {
		Route::get('', 'index')->name('pengajuan_magang');
		Route::get('tambah', 'tambah')->name('pengajuan_magang.tambah', 'skema');
		Route::post('tambah', 'simpan')->name('pengajuan_magang.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('pengajuan_magang.edit');
		Route::post('edit/{id}', 'update')->name('pengajuan_magang.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('pengajuan_magang.hapus');
		// Route::get('download/{id}', 'download')->name('pengajuan_magang.download');
		Route::get('detail/{id}', 'detail')->name('pengajuan_magang.detail');
		Route::post('updateverif', 'updateverif')->name('pengajuan_magang.updateverif');
		Route::get('export_excel',  'export_excel')->name('pengajuan_magang.export');
	});

	Route::controller(MagangController::class)->prefix('riwayat_magang')->group(function () {
		Route::get('', 'index')->name('magang');
		Route::get('tambah', 'tambah')->name('magang.tambah');
		Route::post('tambah', 'simpan')->name('magang.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('magang.edit');
		Route::post('edit/{id}', 'update')->name('magang.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('magang.hapus');
		Route::get('detail/{id}', 'detail')->name('magang.detail');
		Route::post('updateverif', 'updateverif')->name('magang.updateverif');
		Route::get('export_excel',  'export_excel')->name('magang.export');
	});
	Route::controller(SkemaController::class)->prefix('skema')->group(function () {
		Route::get('', 'index')->name('skema');
		Route::get('tambah', 'tambah')->name('skema.tambah');
		Route::post('tambah', 'simpan')->name('skema.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('skema.edit');
		Route::post('edit/{id}', 'update')->name('skema.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('skema.hapus');
	});
	Route::controller(InstansiController::class)->prefix('instansi')->group(function () {
		Route::get('', 'index')->name('instansi');
		Route::get('tambah', 'tambah')->name('instansi.tambah');
		Route::post('tambah', 'simpan')->name('instansi.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('instansi.edit');
		Route::post('edit/{id}', 'update')->name('instansi.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('instansi.hapus');
	});

	Route::controller(UserController::class)->prefix('user')->group(function () {
		Route::get('', 'index')->name('user');
		Route::get('tambah', 'tambah')->name('user.tambah');
		Route::post('tambah', 'simpan')->name('user.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('user.edit');
		Route::post('edit/{id}', 'update')->name('user.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('user.hapus');
		Route::post('import-user', 'importUser')->name('user.importUser');
	});

	Route::controller(PengajuanSerkomController::class)->prefix('pengajuan_serkom', 'skema')->group(function () {
		Route::get('', 'index')->name('pengajuan_serkom');
		Route::get('tambah', 'tambah')->name('pengajuan_serkom.tambah', 'skema');
		Route::post('tambah', 'simpan')->name('pengajuan_serkom.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('pengajuan_serkom.edit');
		Route::post('edit/{id}', 'update')->name('pengajuan_serkom.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('pengajuan_serkom.hapus');
		Route::get('detail/{id}', 'detail')->name('pengajuan_serkom.detail');
		Route::post('updateverif', 'updateverif')->name('pengajuan_serkom.updateverif');
		Route::get('export_excel',  'export_excel')->name('pengajuan_serkom.export');
	});

	Route::controller(SerkomController::class)->prefix('riwayat_serkom')->group(function () {
		Route::get('', 'index')->name('serkom');
		Route::get('tambah', 'tambah')->name('serkom.tambah');
		Route::post('tambah', 'simpan')->name('serkom.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('serkom.edit');
		Route::post('edit/{id}', 'update')->name('serkom.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('serkom.hapus');
		Route::post('updateverif', 'updateverif')->name('serkom.updateverif');
	});



	Route::controller(PeriodeController::class)->prefix('periode')->group(function () {
		Route::get('', 'index')->name('periode');
		Route::get('tambah', 'tambah')->name('periode.tambah');
		Route::post('tambah', 'simpan')->name('periode.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('periode.edit');
		Route::post('edit/{id}', 'update')->name('periode.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('periode.hapus');
	});

	Route::controller(PenyelenggaraController::class)->prefix('penyelenggara')->group(function () {
		Route::get('', 'index')->name('penyelenggara');
		Route::get('tambah', 'tambah')->name('penyelenggara.tambah');
		Route::post('tambah', 'simpan')->name('penyelenggara.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('penyelenggara.edit');
		Route::post('edit/{id}', 'update')->name('penyelenggara.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('penyelenggara.hapus');
	});

	Route::controller(RoleController::class)->prefix('role')->group(function () {
		Route::get('', 'index')->name('role');
		Route::get('tambah', 'tambah')->name('role.tambah');
		Route::post('tambah', 'simpan')->name('role.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('role.edit');
		Route::post('edit/{id}', 'update')->name('role.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('role.hapus');
	});

	// Route::controller(PekertiController::class)->prefix('pekerti')->group(function () {
	// 	Route::get('', 'index')->name('pekerti.index');
	// 	Route::get('tambah', 'tambah')->name('pekerti.tambah');
	// 	Route::post('tambah', 'simpan')->name('pekerti.tambah.simpan');
	// 	Route::get('edit/{id}', 'edit')->name('pekerti.edit');
	// 	Route::post('edit/{id}', 'update')->name('pekerti.tambah.update');
	// 	Route::get('hapus/{id}', 'hapus')->name('pekerti.hapus');
	// });

	Route::controller(PekertianController::class)->prefix('pekertian')->group(function () {
		Route::get('', 'index')->name('pekertian');
		Route::get('', 'index')->name('pekertian.index');
		Route::get('tambah', 'tambah')->name('pekertian.tambah');
		Route::post('tambah', 'simpan')->name('pekertian.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('pekertian.edit');
		Route::post('edit/{id}', 'update')->name('pekertian.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('pekertian.hapus');
		Route::get('detail/{id}', 'detail')->name('pekertian.detail');
		Route::post('updateverif', 'updateverif')->name('pekertian.updateverif');
	});

	Route::controller(ReportDataController::class)->prefix('reportdata')->group(function () {
		Route::get('', 'index')->name('reportdata.index');
		Route::get('export-reportdata', 'exportReportData')->name('reportdata.exportReportData');
		Route::post('import-reportdata', 'importReportData')->name('reportdata.importReportData');
	});

	Route::controller(JenisSertifikasiController::class)->prefix('jenis_sertifikasi')->group(function () {
		Route::get('', 'index')->name('jenis_sertifikasi');
		Route::get('tambah', 'tambah')->name('jenis_sertifikasi.tambah');
		Route::post('tambah', 'simpan')->name('jenis_sertifikasi.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('jenis_sertifikasi.edit');
		Route::post('edit/{id}', 'update')->name('jenis_sertifikasi.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('jenis_sertifikasi.hapus');
	});

	Route::controller(ProfilController::class)->prefix('profil')->group(function () {
		Route::get('', 'index')->name('profil');
		Route::post('edit', 'update')->name('profil.update');
	});

	Route::controller(PasswordController::class)->prefix('password')->group(function () {
		Route::get('', 'index')->name('password');
		Route::post('edit', 'update')->name('password.update');
	});
});
