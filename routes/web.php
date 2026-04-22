<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Admin\PendaftaranAdminController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\TicController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\PpdbBrosurController;
use App\Http\Controllers\PpdbJalurController;
use App\Http\Controllers\PpdbLinkController;

use App\Http\Controllers\PendaftaranLoginController;


// auth route ppdb siswa
Route::get('/pendaftaran/login', [PendaftaranLoginController::class, 'showLoginForm'])->name('pendaftaran.siswa.login');
Route::post('/pendaftaran/login', [PendaftaranLoginController::class, 'login'])->name('pendaftaran.siswa.login.submit');
Route::get('/pendaftaran/register', [PendaftaranLoginController::class, 'showRegisterForm'])->name('pendaftaran.siswa.register');
Route::post('/pendaftaran/register', [PendaftaranLoginController::class, 'register'])->name('pendaftaran.siswa.register.submit');

// dashboard siswa ppdb (protected)
Route::middleware('casisbas.auth')->group(function () {
    Route::get('/pmb/dashboard', [PendaftaranLoginController::class, 'index'])->name('pmb.dashboard');
    Route::get('/pmb/dashboard/data-diri', [PendaftaranLoginController::class, 'dataDiri'])->name('pmb.dashboard.data-diri');
    Route::get('/pmb/dashboard/data-diri/edit', [PendaftaranLoginController::class, 'editDataDiri'])->name('pmb.dashboard.edit-data-diri');
    Route::post('/pmb/dashboard/data-diri', [PendaftaranLoginController::class, 'updateDataDiri'])->name('pmb.dashboard.data-diri.update');
    Route::get('/pmb/dashboard/provinces/{province}/regencies', [PendaftaranLoginController::class, 'getRegenciesByProvince'])->name('pmb.dashboard.regencies.by-province');
    Route::get('/pmb/dashboard/status-pendaftaran', [PendaftaranLoginController::class, 'statusPendaftaran'])->name('pmb.dashboard.status-pendaftaran');
    Route::get('/pmb/cetak-bukti', [PendaftaranLoginController::class, 'cetakBukti'])->name('pmb.cetak.bukti');
    Route::match(['get', 'post'], '/pmb/logout', [PendaftaranLoginController::class, 'logout'])->name('pmb.logout');
});


// Authentication Routes Admin
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Register (simple username/password)
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [LoginController::class, 'register'])->name('register');

Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');
Route::get('/hero', [LandingPageController::class, 'hero'])->name('hero');
Route::get('/infosekolah', [LandingPageController::class, 'infosekolah'])->name('landingpage-infosekolah');
Route::get('/infojurusan', [LandingPageController::class, 'infojurusan'])->name('landingpage-infojurusan');
Route::get('/berita', [BeritaController::class, 'webIndex'])->name('berita.index');
// Gunakan slug untuk berita publik
Route::get('/berita/{berita:slug}', [BeritaController::class, 'webShow'])->name('berita.show');
Route::get('/event', [EventController::class, 'webIndex'])->name('event.index');
Route::get('/event/{event:slug}', [EventController::class, 'webShow'])->name('event.show');
Route::get('/pengumuman', [PengumumanController::class, 'webIndex'])->name('pengumuman.index');
Route::get('/pengumuman/{pengumuman:slug}', [PengumumanController::class, 'webShow'])->name('pengumuman.show');
Route::get('/galeri', [GaleriController::class, 'webIndex'])->name('galeri.index');
// Jurusan publik
Route::get('/jurusan', [JurusanController::class, 'webIndex'])->name('jurusan.index');
Route::get('/jurusan/{jurusan:slug}', [JurusanController::class, 'webShow'])->name('jurusan.show');

// Profil sekolah
Route::get('/profile', [ProfilSekolahController::class, 'profile'])->name('profilsekolah.profile');
// Route::get('/visi-misi', [ProfilSekolahController::class, 'visiMisi'])->name('profilsekolah.visi_misi');
// Route::get('/sejarah', [ProfilSekolahController::class, 'sejarah'])->name('profilsekolah.sejarah');
// Route::get('/struktur-organisasi', [ProfilSekolahController::class, 'strukturOrganisasi'])->name('profilsekolah.struktur_organisasi');
// Route::get('/fasilitas', [ProfilSekolahController::class, 'fasilitas'])->name('profilsekolah.fasilitas');
Route::get('/ekstrakulikuler', [EkstrakurikulerController::class, 'publicIndex'])->name('profilsekolah.ekstrakulikuler');
Route::get('/ekstrakulikuler/detail', function () {
    return view('utama.content.ekskul-detail');
})->name('ekskul.detail');
Route::get('/prestasi', [PrestasiController::class, 'publicIndex'])->name('profilsekolah.prestasi');
// Route::get('/ppdb', [ProfilSekolahController::class, 'ppdb'])->name('profilsekolah.ppdb');

//TIC
Route::get('/tic', [TicController::class, 'index'])->name('tic.index');
Route::get('/desa-wisata/{slug}', [TicController::class, 'desaWisataDetail'])->name('desa-wisata-detail');
Route::get('/hotel/{slug}', [TicController::class, 'hotelDetail'])->name('hotel-detail');
Route::get('/objek-wisata/{slug}', [TicController::class, 'objekWisataDetail'])->name('objek-wisata-detail');
Route::get('/paket-wisata/{slug}', [TicController::class, 'paketWisataDetail'])->name('paket-wisata-detail');
Route::get('/transportasi/{slug}', [TicController::class, 'transportasiDetail'])->name('transportasi-detail');
Route::get('/restoran/{slug}', [TicController::class, 'restoranDetail'])->name('restoran-detail');

//PPDB
Route::get('/ppdb-detail/', [PendaftaranController::class, 'ppdbUser'])->name('profilsekolah.ppdb-detail');

// Pendaftaran Routes (Public - Tanpa Login)
Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
    Route::get('/daftar', [PendaftaranController::class, 'create'])->name('create');
    Route::post('/daftar', [PendaftaranController::class, 'store'])->name('store');
    Route::get('/cek-status', [PendaftaranController::class, 'checkStatus'])->name('check-status');
    Route::post('/cek-status', [PendaftaranController::class, 'getStatus'])->name('get-status');
    Route::get('/status/{nisn}', [PendaftaranController::class, 'getStatus'])->name('status.show');
    Route::get('/bayar-nanti', [PendaftaranController::class, 'payLater'])->name('pay-later');
    Route::post('/bayar-nanti', [PendaftaranController::class, 'processPayLater'])->name('process-pay-later');
    Route::get('/pembayaran/{kodePendaftaran}', [PendaftaranController::class, 'showPayment'])->name('payment');
    Route::post('/pembayaran/{kodePendaftaran}/upload', [PendaftaranController::class, 'uploadPaymentProof'])->name('payment.upload');
});

// Midtrans Routes
Route::prefix('payment')->name('payment.')->group(function () {
    Route::post('/create-snap-token/{kodePendaftaran}', [App\Http\Controllers\MidtransController::class, 'createSnapToken'])->name('create-snap-token');
    Route::get('/finish/{kodePendaftaran}', [App\Http\Controllers\MidtransController::class, 'paymentFinish'])->name('finish');
    Route::get('/check-status/{kodePendaftaran}', [App\Http\Controllers\MidtransController::class, 'checkStatus'])->name('check-status');
});

// Midtrans Webhook (without CSRF)
Route::post('/payment/midtrans/notification', [App\Http\Controllers\MidtransController::class, 'notificationHandler'])->name('payment.midtrans-notification')->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// Admin Routes - CMS Panel
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard')->middleware('role:admin,adminPPDB');

    // Super Admin Resources
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('profiles', ProfileController::class)->except(['destroy']);
        Route::resource('jurusans', JurusanController::class);
        Route::post('beritas/{berita:slug}/publish', [BeritaController::class, 'publish'])->name('beritas.publish');
        Route::resource('beritas', BeritaController::class);
        Route::post('events/{event:slug}/toggle-status', [EventController::class, 'toggleStatus'])->name('events.toggle-status');
        Route::resource('events', EventController::class);
        Route::resource('pengumumans', PengumumanController::class);
        Route::resource('galeris', GaleriController::class);
        Route::resource('mitras', MitraController::class);
        Route::resource('ekstrakurikulers', EkstrakurikulerController::class);
        Route::resource('prestasis', PrestasiController::class);
        Route::resource('hotels', App\Http\Controllers\HotelController::class);
        Route::resource('objek-wisata', App\Http\Controllers\ObjekWisataController::class);
        Route::resource('desa-wisata', App\Http\Controllers\DesaWisataController::class);
        Route::resource('paket-wisata', App\Http\Controllers\PaketWisataController::class);
        Route::resource('transportasi', App\Http\Controllers\TransportasiController::class);
        Route::resource('restorans', App\Http\Controllers\RestoranController::class);
    });

    // PPDB Admin Resources (Shared with Admin)
    Route::middleware(['role:admin,adminPPDB'])->group(function () {
        // Admin Pendaftaran Routes
        Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
            Route::get('/', [PendaftaranAdminController::class, 'index'])->name('index');

            // Calon Siswa Route harus di atas route parameter agar tidak tertangkap {id}
            Route::get('/calon-siswa', [PendaftaranAdminController::class, 'calonSiswa'])->name('calon-siswa');
            Route::get('/calon-siswa/{id}/edit', [PendaftaranAdminController::class, 'editDataCalonSiswaForm'])->name('calon-siswa.edit');
            Route::get('/calon-siswa/{id}/status', [PendaftaranAdminController::class, 'statusCalonSiswaForm'])->name('calon-siswa.status');
            Route::put('/calon-siswa/{id}/status', [PendaftaranAdminController::class, 'updateStatusCalonSiswa'])->name('calon-siswa.status.update');
            Route::get('/calon-siswa/{id}', [PendaftaranAdminController::class, 'showCalonSiswa'])->name('calon-siswa.show');
            Route::put('/calon-siswa/{id}', [PendaftaranAdminController::class, 'editDataCalonSiswa'])->name('calon-siswa.update');
            Route::delete('/calon-siswa/{id}', [PendaftaranAdminController::class, 'hapusDataCalonSiswa'])->name('calon-siswa.destroy');
            Route::get('/provinces/{provinceId}/regencies', [PendaftaranAdminController::class, 'getRegenciesByProvince'])->name('regencies.by-province');

            Route::get('/{id}', [PendaftaranAdminController::class, 'show'])->name('show');
            Route::put('/{id}/status', [PendaftaranAdminController::class, 'updateStatus'])->name('update-status');
            Route::get('/{id}/download/{type}', [PendaftaranAdminController::class, 'downloadDocument'])->name('download-document');
            Route::delete('/{id}', [PendaftaranAdminController::class, 'destroy'])->name('destroy');
            Route::get('/export/csv', [PendaftaranAdminController::class, 'export'])->name('export');
        });

        Route::resource('ppdb_brosurs', PpdbBrosurController::class);
        Route::resource('ppdb_jalurs', PpdbJalurController::class);
        Route::resource('ppdb_links', PpdbLinkController::class);
    });
});
