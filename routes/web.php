<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PKBJJController;
use App\Http\Controllers\TuwebController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\DaftarTutorController;
use App\Http\Controllers\SertifikatOSMBController;
use App\Http\Controllers\SertifikatWTKUController;
use App\Http\Controllers\SertifikatSeminarController;
use App\Http\Controllers\WisudaController;
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

//Sertif PKBJJ
Route::get('/sertifikat', [SertifikatController::class, 'index'])->name('sertif');
Route::post('/cetaksertifikat', [SertifikatController::class, 'process'])->name('buat');

//Sertif OSMB
Route::get('/sertifikatosmb', [SertifikatOSMBController::class, 'index'])->name('sertifosmb');
Route::post('/cetaksertifikatosmb', [SertifikatOSMBController::class, 'process'])->name('cetak');

//Sertif Seminar Akademik
Route::get('/sertifikatseminar', [SertifikatSeminarController::class, 'index'])->name('sertifseminar');
Route::post('/cetaksertifikatseminar', [SertifikatSeminarController::class, 'process'])->name('cetakseminar');

//Sertif Seminar WTKU
Route::get('/sertifikatwtku', [SertifikatWTKUController::class, 'index'])->name('sertifwtku');
Route::post('/cetaksertifikatwtku', [SertifikatWTKUController::class, 'process'])->name('cetakwtku');

//Cek Meja Wisuda
Route::get('/mejaijazah', [WisudaController::class, 'index'])->name('mejaijazah');
Route::post('/cetakmejaijazah', [WisudaController::class, 'process'])->name('cetakmejaijazah');

// ---------------------------------------------------------------------------------------------------------------

//Admin
Route::get('/admin301097', [AdminController::class, 'index'])->name('hlmadmin');
Route::get('/admin301097/pkbjj', [AdminController::class, 'admin_pkbjj'])->name('adminpkbjj');
Route::get('/admin301097/osmb', [AdminController::class, 'admin_osmb'])->name('adminosmb');
Route::get('/admin301097/seminar', [AdminController::class, 'admin_seminar'])->name('adminseminar');
Route::get('/admin301097/wtku', [AdminController::class, 'admin_wtku'])->name('adminwtku');
Route::get('/admin301097/osmb/data', [AdminController::class, 'getdataosmb'])->name('getosmb');
Route::get('/admin301097/pkbjj/data', [AdminController::class, 'getdatapkbjj'])->name('getpkbjj');
Route::get('/admin301097/jadwalpkbjj', [AdminController::class, 'admin_jadwalpkbjj'])->name('adminjadwalpkbjj');
Route::get('/admin301097/jadwalpkbjj/data', [AdminController::class, 'getdatajadwalpkbjj'])->name('getjadwalpkbjj');
Route::get('/admin301097/tuweb', [AdminController::class, 'admin_tuweb'])->name('admintuweb');
Route::get('/data/{id}', [AdminController::class, 'show'])->name('showdatatuweb');
Route::get('/admin301097/wisuda', [AdminController::class, 'admin_wisuda'])->name('adminwisuda');
Route::get('/admin301097/wisuda/data', [AdminController::class, 'getdatawisuda'])->name('getwisuda');

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
