<?php

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
use App\Http\Controllers\CertificateAdminController;
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

// Absensi Pegawai Monitoring (Harus Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/absensi-monitoring', [AbsensiPegawaiController::class, 'create'])->name('absensi.create');
    Route::post('/absensi-monitoring', [AbsensiPegawaiController::class, 'store'])->name('absensi.store');
});

// Sistem Sertifikat Publik (Baru)
Route::get('/sertifikat-form/{slug}', [CertificateFormController::class, 'show'])->name('sertifikat.form');
Route::post('/sertifikat-form/{slug}', [CertificateFormController::class, 'submit'])->name('sertifikat.submit');
Route::get('/verify/{code}', [CertificateFormController::class, 'verify'])->name('sertifikat.verify');

//Tampilan Utama

Route::get('/', function () {
    $activeEvents = \App\Models\CertificateEvent::where('status', true)->get();
    return view('mainview.index', compact('activeEvents'));
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
Route::get('/sertifikatseminar/file/{token}', [SertifikatSeminarController::class, 'download'])->name('cetakseminar.download');

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

//Admin Login Routes
Route::get('/admin301097/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin301097/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin301097/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

//Admin Protected Routes
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin301097', [AdminController::class, 'index'])->name('hlmadmin');
    Route::get('/admin301097/pkbjj', [AdminController::class, 'admin_pkbjj'])->name('adminpkbjj');
    Route::get('/admin301097/osmb', [AdminController::class, 'admin_osmb'])->name('adminosmb');
    Route::get('/admin301097/seminar', [AdminController::class, 'admin_seminar'])->name('adminseminar');
    Route::get('/admin301097/wtku', [AdminController::class, 'admin_wtku'])->name('adminwtku');
    
    // Admin Sertifikat Baru
    Route::get('/admin301097/sistem-sertifikat', [CertificateAdminController::class, 'dashboard'])->name('admin.sertifikat.dashboard');
    
    // CRUD Events
    Route::get('/admin301097/sistem-sertifikat/events', [CertificateAdminController::class, 'events'])->name('admin.sertifikat.events');
    Route::get('/admin301097/sistem-sertifikat/events/create', [CertificateAdminController::class, 'createEvent'])->name('admin.sertifikat.events.create');
    Route::post('/admin301097/sistem-sertifikat/events', [CertificateAdminController::class, 'storeEvent'])->name('admin.sertifikat.events.store');
    Route::get('/admin301097/sistem-sertifikat/events/{id}/edit', [CertificateAdminController::class, 'editEvent'])->name('admin.sertifikat.events.edit');
    Route::put('/admin301097/sistem-sertifikat/events/{id}', [CertificateAdminController::class, 'updateEvent'])->name('admin.sertifikat.events.update');
    Route::delete('/admin301097/sistem-sertifikat/events/{id}', [CertificateAdminController::class, 'destroyEvent'])->name('admin.sertifikat.events.destroy');

    // CRUD Templates
    Route::get('/admin301097/sistem-sertifikat/templates', [CertificateAdminController::class, 'templates'])->name('admin.sertifikat.templates');
    Route::get('/admin301097/sistem-sertifikat/templates/create', [CertificateAdminController::class, 'createTemplate'])->name('admin.sertifikat.templates.create');
    Route::post('/admin301097/sistem-sertifikat/templates', [CertificateAdminController::class, 'storeTemplate'])->name('admin.sertifikat.templates.store');
    Route::get('/admin301097/sistem-sertifikat/templates/{id}/edit', [CertificateAdminController::class, 'editTemplate'])->name('admin.sertifikat.templates.edit');
    Route::put('/admin301097/sistem-sertifikat/templates/{id}', [CertificateAdminController::class, 'updateTemplate'])->name('admin.sertifikat.templates.update');
    Route::delete('/admin301097/sistem-sertifikat/templates/{id}', [CertificateAdminController::class, 'destroyTemplate'])->name('admin.sertifikat.templates.destroy');
    
    Route::get('/admin301097/sistem-sertifikat/participants', [CertificateAdminController::class, 'participants'])->name('admin.sertifikat.participants');
    Route::post('/admin301097/sistem-sertifikat/participants', [CertificateAdminController::class, 'storeParticipant'])->name('admin.sertifikat.participants.store');
    Route::post('/admin301097/sistem-sertifikat/participants/{id}/resend', [CertificateAdminController::class, 'resendEmail'])->name('admin.sertifikat.participants.resend');
    Route::get('/admin301097/osmb/data', [AdminController::class, 'getdataosmb'])->name('getosmb');
    Route::get('/admin301097/pkbjj/data', [AdminController::class, 'getdatapkbjj'])->name('getpkbjj');
    Route::get('/admin301097/jadwalpkbjj', [AdminController::class, 'admin_jadwalpkbjj'])->name('adminjadwalpkbjj');
    Route::get('/admin301097/jadwalpkbjj/data', [AdminController::class, 'getdatajadwalpkbjj'])->name('getjadwalpkbjj');
    Route::get('/admin301097/tuweb', [AdminController::class, 'admin_tuweb'])->name('admintuweb');
    Route::get('/data/{id}', [AdminController::class, 'show'])->name('showdatatuweb');
    Route::get('/data-tutor/{id}', [AdminController::class, 'showTutor'])->name('showdatatutor');
    Route::get('/admin301097/wisuda', [AdminController::class, 'admin_wisuda'])->name('adminwisuda');
    Route::get('/admin301097/wisuda/data', [AdminController::class, 'getdatawisuda'])->name('getwisuda');

    // Admin Absensi Monitoring
    Route::get('/admin301097/absensi', [AbsensiPegawaiController::class, 'index'])->name('admin.absensi');
    Route::get('/admin301097/absensi/export', [AbsensiPegawaiController::class, 'export'])->name('admin.absensi.export');

    // Manajemen Pegawai
    Route::get('/admin301097/users', [AdminController::class, 'admin_users'])->name('admin.users');
    Route::post('/admin301097/users/store', [AdminController::class, 'storeuser'])->name('admin.users.store');
    Route::delete('/admin301097/users/delete/{id}', [AdminController::class, 'deleteuser'])->name('admin.users.delete');

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
