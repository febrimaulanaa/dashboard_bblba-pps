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

//Admin Routes (Original /admin301097 - disabled due to firewall)
Route::get('/admin301097', function() { return view('backend.min-dashboard'); });
Route::get('/admin301097/pkbjj', function() { return view('backend.min-list', ['title' => 'Data PKBJJ', 'data' => \App\Models\DataSertifMhs::limit(100)->get(), 'fields' => ['masa','nama','nim','prodi']]); });
Route::get('/admin301097/osmb', function() { return view('backend.min-list', ['title' => 'Data OSMB', 'data' => \App\Models\DataSertifOSMB::limit(100)->get(), 'fields' => ['masa','nama','nim','prodi']]); });
Route::get('/admin301097/seminar', function() { return view('backend.min-list', ['title' => 'Data Seminar', 'data' => \App\Models\DataSertifSeminar::limit(100)->get(), 'fields' => ['masa','nama','nim','prodi']]); });
Route::get('/admin301097/wtku', function() { return view('backend.min-list', ['title' => 'Data WTKU', 'data' => \App\Models\DataSertifWTKU::limit(100)->get(), 'fields' => ['masa','nama','nim','prodi']]); });
Route::get('/admin301097/wisuda', function() { return view('backend.min-list', ['title' => 'Data Wisuda', 'data' => \App\Models\Wisuda::limit(100)->get(), 'fields' => ['nim','nama','no_meja_ambil_ijazah','prodi']]); });
Route::get('/admin301097/tuweb', function() { return view('backend.min-list', ['title' => 'Jadwal Tuweb', 'data' => \App\Models\JadwalTuweb::limit(100)->get(), 'fields' => ['kode_mk','nama_mk','tutor','hari']]); });
Route::get('/admin301097/users', function() { return view('backend.min-list', ['title' => 'Users', 'data' => \App\Models\User::limit(100)->get(), 'fields' => ['name','email']]); });
Route::post('/admin301097/users/store', [AdminController::class, 'storeuser'])->name('admin.users.store');
Route::delete('/admin301097/users/delete/{id}', [AdminController::class, 'deleteuser'])->name('admin.users.delete');

// CRUD Routes PKBJJ
Route::post('/pkbjj/storepkbjj', [AdminController::class, 'storepkbjj'])->name('storepkbjj');
Route::get('/pkbjj/export_excel', [AdminController::class, 'export_excel'])->name('export');
Route::post('/pkbjj/import_excel', [AdminController::class, 'import_excel'])->name('import');
Route::post('/pkbjj/import_jadwalexcel', [AdminController::class, 'import_jadwalexcel'])->name('importjadwalpkbjj');

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
Route::get('/admin301097/absensi', function() { return view('backend.min-list', ['title' => 'Absensi', 'data' => \App\Models\AbsensiPegawai::limit(100)->get(), 'fields' => ['nama','tanggal','jam_masuk','jam_keluar']]); });
Route::get('/admin301097/absensi/export', [AbsensiPegawaiController::class, 'export'])->name('admin.absensi.export');

// Sistem Sertifikat
Route::get('/admin301097/sistem-sertifikat', function() { return view('backend.min-list', ['title' => 'Sistem Sertifikat', 'data' => \App\Models\CertificateEvent::limit(100)->get(), 'fields' => ['name','slug','start_date','end_date','status']]); });
Route::get('/admin301097/sistem-sertifikat/events', function() { return view('backend.min-list', ['title' => 'Events', 'data' => \App\Models\CertificateEvent::limit(100)->get(), 'fields' => ['name','slug','status']]); });
Route::get('/admin301097/sistem-sertifikat/participants', function() { return view('backend.min-list', ['title' => 'Peserta', 'data' => \App\Models\CertificateParticipant::limit(100)->get(), 'fields' => ['name','email','verification_code','email_sent']]); });

// Admin Sertifikat 
Route::get('/admin301097/sistem-sertifikat', function() { return view('backend.simple-sertifikat'); });
Route::get('/admin301097/sistem-sertifikat/events', function() { return view('backend.simple-sertifikat-events'); });
Route::get('/admin301097/sistem-sertifikat/templates', function() { return view('backend.simple-sertifikat-templates'); });
Route::get('/admin301097/sistem-sertifikat/participants', function() { return view('backend.simple-sertifikat-participants'); });
    // Route::get('/portal/sistem-sertifikat/templates/create', [CertificateAdminController::class, 'createTemplate'])->name('admin.sertifikat.templates.create');
    // Route::post('/portal/sistem-sertifikat/templates', [CertificateAdminController::class, 'storeTemplate'])->name('admin.sertifikat.templates.store');
    // Route::get('/portal/sistem-sertifikat/templates/{id}/edit', [CertificateAdminController::class, 'editTemplate'])->name('admin.sertifikat.templates.edit');
    // Route::put('/portal/sistem-sertifikat/templates/{id}', [CertificateAdminController::class, 'updateTemplate'])->name('admin.sertifikat.templates.update');
    // Route::delete('/portal/sistem-sertifikat/templates/{id}', [CertificateAdminController::class, 'destroyTemplate'])->name('admin.sertifikat.templates.destroy');
    // Route::get('/portal/sistem-sertifikat/participants', [CertificateAdminController::class, 'participants'])->name('admin.sertifikat.participants');
    // Route::post('/portal/sistem-sertifikat/participants', [CertificateAdminController::class, 'storeParticipant'])->name('admin.sertifikat.participants.store');
    // Route::post('/portal/sistem-sertifikat/participants/{id}/resend', [CertificateAdminController::class, 'resendEmail'])->name('admin.sertifikat.participants.resend');

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
