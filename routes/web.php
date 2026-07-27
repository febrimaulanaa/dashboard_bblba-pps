<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PKBJJController;
use App\Http\Controllers\TuwebController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\DaftarTutorController;
use App\Http\Controllers\SertifikatOSMBController;
use App\Http\Controllers\SertifikatWTKUController;
use App\Http\Controllers\SertifikatSeminarController;
use App\Http\Controllers\WisudaController;
use App\Http\Controllers\AbsensiPegawaiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateFormController;

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

// Auth Routes (Login Pegawai)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Test route - coba akses ini via browser
Route::get('/test-route', function () {
    return 'Route OK - ' . date('Y-m-d H:i:s');
});

Route::get('/abc', function () {
    return 'ABC OK';
});

// Test POST route
Route::post('/test-post-route', function (Request $request) {
    return 'POST OK - ' . $request->input('test', 'no input');
});

// Absensi Pegawai Monitoring (Tanpa Login)
Route::get('/absensi-monitoring', [AbsensiPegawaiController::class, 'create'])->name('absensi.create');
Route::post('/absensi-monitoring', [AbsensiPegawaiController::class, 'store'])->name('absensi.store');
Route::get('/admin/absensi-pegawai', [AbsensiPegawaiController::class, 'index'])
    ->name('admin.absensi');

// Sistem Sertifikat Publik
Route::prefix('ecertificate')->group(function () {
    Route::get('/{id}', [CertificateFormController::class, 'show'])->name('sertifikat.form');
    Route::post('/{id}', [CertificateFormController::class, 'submit'])->name('sertifikat.submit');
});
Route::get('/verify', [CertificateFormController::class, 'verify'])->name('sertifikat.verify');

//Tampilan Utama

Route::get('/', function () {
    return view('mainview.index');
})->name('home');

Route::get('/daftartutor', [DaftarTutorController::class, 'index'])->name('daftartutor');

//Jadwal PKBJJ
Route::get('/jadwalpkbjj', [PKBJJController::class, 'index'])->name('jadwalpkbjj');
Route::post('/cekjadwalpkbjj', [PKBJJController::class, 'cekjadwalpkbjj'])->name('cekjadwalpkbjj');

//Jadwal Tuweb
Route::get('/jadwaltuwebmahasiswa', [TuwebController::class, 'index'])->name('jadwaltuwebmhs');
Route::get('/jadwaltuwebtutor', [TuwebController::class, 'indexTutor'])->name('jadwaltuwebtutor');

//Sertif PKBJJ
Route::get('/sertifikat', [SertifikatController::class, 'index'])->name('sertif');
Route::post('/cetaksertifikat', [SertifikatController::class, 'process'])->name('buat');
Route::get('/sertifikat/file/{token}', [SertifikatController::class, 'download'])->name('buat.download');

//Sertif OSMB
Route::get('/sertifikatosmb', [SertifikatOSMBController::class, 'index'])->name('sertifosmb');
Route::post('/cetaksertifikatosmb', [SertifikatOSMBController::class, 'process'])->name('cetak');
Route::get('/sertifikatosmb/file/{token}', [SertifikatOSMBController::class, 'download'])->name('cetak.download');

//Sertif Seminar Akademik
Route::get('/sertifikatseminar', [SertifikatSeminarController::class, 'index'])->name('sertifseminar');
Route::post('/generate-seminar', [SertifikatSeminarController::class, 'process'])->name('cetakseminar');

//Sertif WTKU
Route::get('/sertifikatwtku', [SertifikatWTKUController::class, 'index'])->name('sertifwtku');
Route::post('/cetaksertifikatwtku', [SertifikatWTKUController::class, 'process'])->name('cetakwtku');
Route::get('/sertifikatwtku/file/{token}', [SertifikatWTKUController::class, 'download'])->name('cetakwtku.download');

//Cek Meja Wisuda

// 1. Form input NIM
Route::get('/mejaijazah', [WisudaController::class, 'index'])
    ->name('mejaijazah');

// 2. Proses validasi & generate PDF (POST)
Route::post('/mejaijazah/verify', [WisudaController::class, 'verify'])
    ->name('mejaijazah.verify');

// 3. Download PDF (GET)
Route::get('/mejaijazah/file/{token}', [WisudaController::class, 'download'])
    ->name('mejaijazah.download');

// Admin Routes (Standard Routing)
Route::prefix('admin301097')->name('admin.')->group(function () {
    // Login Routes
    Route::get('/login', [\App\Http\Controllers\AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AdminAuthController::class, 'login'])->name('login.post');
    Route::get('/login-get', [\App\Http\Controllers\AdminAuthController::class, 'loginGet'])->name('login.get');
    Route::get('/redirect/{token}', [\App\Http\Controllers\AdminAuthController::class, 'handleRedirect'])->name('login.redirect');
    Route::get('/error/{token}', [\App\Http\Controllers\AdminAuthController::class, 'handleError'])->name('login.error');
    Route::post('/logout', [\App\Http\Controllers\AdminAuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware('admin.auth')->group(function () {
        // Redirect dashboard to Sertifikat Dashboard or a new dashboard view
        // For now, let's make it show the Sertifikat Dashboard as the main one, or create a generic one.
        // We will create a simple generic dashboard later if needed, but let's use the ajax-admin one converted to standard?
        Route::get('/', function () {
            return view('backend.dashboard');
        })->name('dashboard');

        // Legacy Routes
        Route::get('/pkbjj', [AdminController::class, 'admin_pkbjj'])->name('pkbjj');
        Route::get('/osmb', [AdminController::class, 'admin_osmb'])->name('osmb');
        Route::get('/seminar', [AdminController::class, 'admin_seminar'])->name('seminar');
        Route::get('/wtku', [AdminController::class, 'admin_wtku'])->name('wtku');
        Route::get('/wisuda', [AdminController::class, 'admin_wisuda'])->name('wisuda');
        Route::get('/tuweb', [AdminController::class, 'admin_tuweb'])->name('tuweb');
        Route::get('/users', [AdminController::class, 'admin_users'])->name('users');
        Route::get('/jadwalpkbjj', [AdminController::class, 'admin_jadwalpkbjj'])->name('jadwalpkbjj');

        // API Routes for DataTables
        Route::get('/pkbjj/getdata', [AdminController::class, 'getdatapkbjj'])->name('getpkbjj');
        Route::get('/osmb/getdata', [AdminController::class, 'getdataosmb'])->name('getosmb');
        Route::get('/jadwalpkbjj/getdata', [AdminController::class, 'getdatajadwalpkbjj'])->name('getjadwalpkbjj');

        // Users Store & Delete
        Route::post('/users/store', [AdminController::class, 'storeuser'])->name('users.store');
        Route::delete('/users/delete/{id}', [AdminController::class, 'deleteuser'])->name('users.delete');

        // Admin Accounts (Superadmin Only)
        Route::middleware('superadmin.auth')->group(function () {
            Route::get('/admins', [\App\Http\Controllers\AdminAccountController::class, 'index'])->name('admins.index');
            Route::post('/admins', [\App\Http\Controllers\AdminAccountController::class, 'store'])->name('admins.store');
            Route::put('/admins/{id}', [\App\Http\Controllers\AdminAccountController::class, 'update'])->name('admins.update');
            Route::delete('/admins/{id}', [\App\Http\Controllers\AdminAccountController::class, 'destroy'])->name('admins.destroy');
        });
    });
});

// CRUD Routes PKBJJ
Route::middleware('admin.auth')->group(function () {
    Route::post('/pkbjj/storepkbjj', [AdminController::class, 'storepkbjj'])->name('storepkbjj');
    Route::get('/pkbjj/export_excel', [AdminController::class, 'export_excel'])->name('export');
    Route::post('/pkbjj/import_excel', [AdminController::class, 'import_excel'])->name('import');
    Route::post('/pkbjj/import_jadwalexcel', [AdminController::class, 'import_jadwalexcel'])->name('importjadwalpkbjj');
    Route::post('/pkbjj/storejadwalpkbjj', [AdminController::class, 'storejadwalpkbjj'])->name('storejadwalpkbjj');
    Route::post('/pkbjj/bulkstorejadwalpkbjj', [AdminController::class, 'bulkstorejadwalpkbjj'])->name('bulkstorejadwalpkbjj');
    Route::post('/pkbjj/set_bulk_nama_kegiatan', [AdminController::class, 'setBulkNamaKegiatan'])->name('setBulkNamaKegiatan');
    Route::put('/pkbjj/updatejadwalpkbjj/{id}', [AdminController::class, 'updatejadwalpkbjj'])->name('updatejadwalpkbjj');
    Route::delete('/pkbjj/deletejadwalpkbjj/{id}', [AdminController::class, 'deletejadwalpkbjj'])->name('deletejadwalpkbjj');

    // CRUD Routes OSMB
    Route::post('/osmb/storeosmb', [AdminController::class, 'storeosmb'])->name('storeosmb');
    Route::get('/osmb/export_excelosmb', [AdminController::class, 'export_excelosmb'])->name('exportosmb');
    Route::post('/osmb/import_excelosmb', [AdminController::class, 'import_excelosmb'])->name('importosmb');

    // CRUD Routes Seminar
    Route::post('/seminar/storeseminar', [AdminController::class, 'storeseminar'])->name('storeseminar');
    Route::get('/seminar/export_excelseminar', [AdminController::class, 'export_excelseminar'])->name('exportseminar');
    Route::post('/seminar/import_excelseminar', [AdminController::class, 'import_excelseminar'])->name('importseminar');

    // CRUD Routes WTKU
    Route::post('/wtku/storewtku', [AdminController::class, 'storewtku'])->name('storewtku');
    Route::get('/wtku/export_excelwtku', [AdminController::class, 'export_excelwtku'])->name('exportwtku');
    Route::post('/wtku/import_excelwtku', [AdminController::class, 'import_excelwtku'])->name('importwtku');

    // CRUD Routes Wisuda
    Route::post('/wisuda/storewisuda', [AdminController::class, 'storewisuda'])->name('storewisuda');
    Route::get('/wisuda/export_excelwisuda', [AdminController::class, 'export_excelwisuda'])->name('exportwisuda');
    Route::post('/wisuda/import_excelwisuda', [AdminController::class, 'import_excelwisuda'])->name('importwisuda');

    // CRUD Routes Tuweb
    Route::post('/tuweb/storetuweb', [AdminController::class, 'storetuweb'])->name('storetuweb');
    Route::get('/tuweb/export_exceltuweb', [AdminController::class, 'export_exceltuweb'])->name('exporttuweb');
    Route::post('/tuweb/import_exceltuweb', [AdminController::class, 'import_exceltuweb'])->name('importtuweb');

    // Absensi
    // Route::get('/admin301097/absensi', function () {
    //     return view('backend.simple-absensi');
    // });
    // Route::get('/admin301097/jadwalpkbjj', function () {
    //     return view('backend.simple-jadwalpkbjj');
    // });
    Route::get('/admin301097/absensi/export', [AbsensiPegawaiController::class, 'export'])->name('admin.absensi.export');

    // Sistem Sertifikat (Modern UI)
    Route::prefix('admin301097/sertifikat')->name('admin.sertifikat.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\CertificateAdminController::class, 'dashboard'])->name('dashboard');

        // Events
        Route::get('/events', [\App\Http\Controllers\CertificateAdminController::class, 'events'])->name('events');
        Route::get('/events/create', [\App\Http\Controllers\CertificateAdminController::class, 'createEvent'])->name('events.create');
        Route::post('/events', [\App\Http\Controllers\CertificateAdminController::class, 'storeEvent'])->name('events.store');
        Route::get('/events/{id}/edit', [\App\Http\Controllers\CertificateAdminController::class, 'editEvent'])->name('events.edit');
        Route::put('/events/{id}', [\App\Http\Controllers\CertificateAdminController::class, 'updateEvent'])->name('events.update');
        Route::delete('/events/{id}', [\App\Http\Controllers\CertificateAdminController::class, 'destroyEvent'])->name('events.destroy');

        // Templates
        Route::get('/templates', [\App\Http\Controllers\CertificateAdminController::class, 'templates'])->name('templates');
        Route::get('/templates/create', [\App\Http\Controllers\CertificateAdminController::class, 'createTemplate'])->name('templates.create');
        Route::post('/templates', [\App\Http\Controllers\CertificateAdminController::class, 'storeTemplate'])->name('templates.store');
        Route::get('/templates/{id}/edit', [\App\Http\Controllers\CertificateAdminController::class, 'editTemplate'])->name('templates.edit');
        Route::put('/templates/{id}', [\App\Http\Controllers\CertificateAdminController::class, 'updateTemplate'])->name('templates.update');
        Route::delete('/templates/{id}', [\App\Http\Controllers\CertificateAdminController::class, 'destroyTemplate'])->name('templates.destroy');

        // Participants
        Route::get('/participants', [\App\Http\Controllers\CertificateAdminController::class, 'participants'])->name('participants');
        Route::post('/participants', [\App\Http\Controllers\CertificateAdminController::class, 'storeParticipant'])->name('participants.store');
        Route::post('/participants/{id}/resend', [\App\Http\Controllers\CertificateAdminController::class, 'resendEmail'])->name('participants.resend');
        Route::delete('/participants/{id}', [\App\Http\Controllers\CertificateAdminController::class, 'destroyParticipant'])->name('participants.destroy');
    });

    // Export & Import Excel PKBJJ
    Route::post('/pkbjj/storepkbjj', [AdminController::class, 'storepkbjj'])->name('storepkbjj');
    Route::get('/pkbjj/export_excel', [AdminController::class, 'export_excel'])->name('export');
    Route::post('/pkbjj/import_excel', [AdminController::class, 'import_excel'])->name('import');
    Route::post('/pkbjj/import_jadwalexcel', [AdminController::class, 'import_jadwalexcel'])->name('importjadwalpkbjj');

    // Export & Import Excel OSMB
    Route::post('/osmb/storeosmb', [AdminController::class, 'storeosmb'])->name('storeosmb');
    Route::get('/osmb/export_excelosmb', [AdminController::class, 'export_excelosmb'])->name('exportosmb');
    Route::post('/osmb/import_excelosmb', [AdminController::class, 'import_excelosmb'])->name('importosmb');

    // Export & Import Excel Seminar
    Route::post('/seminar/storeseminar', [AdminController::class, 'storeseminar'])->name('storeseminar');
    Route::get('/seminar/export_excelseminar', [AdminController::class, 'export_excelseminar'])->name('exportseminar');
    Route::post('/seminar/import_excelseminar', [AdminController::class, 'import_excelseminar'])->name('importseminar');

    // Export & Import Excel WTKU
    Route::post('/wtku/storewtku', [AdminController::class, 'storewtku'])->name('storewtku');
    Route::get('/wtku/export_excelwtku', [AdminController::class, 'export_excelwtku'])->name('exportwtku');
    Route::post('/wtku/import_excelwtku', [AdminController::class, 'import_excelwtku'])->name('importwtku');

    // Export & Import Excel Wisuda
    Route::post('/wisuda/storewisuda', [AdminController::class, 'storewisuda'])->name('storewisuda');
    Route::get('/wisuda/export_excelwisuda', [AdminController::class, 'export_excelwisuda'])->name('exportwisuda');
    Route::post('/wisuda/import_excelwisuda', [AdminController::class, 'import_excelwisuda'])->name('importwisuda');

    // Export & Import Tuweb
    Route::post('/tuweb/storetuweb', [AdminController::class, 'storetuweb'])->name('storetuweb');
    Route::get('/tuweb/export_exceltuweb', [AdminController::class, 'export_exceltuweb'])->name('exporttuweb');
    Route::post('/tuweb/import_exceltuweb', [AdminController::class, 'import_exceltuweb'])->name('importtuweb');
});

