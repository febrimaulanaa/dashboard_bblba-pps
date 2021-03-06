<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\DaftarTutorController;
use App\Http\Controllers\SertifikatOSMBController;
use App\Http\Controllers\SertifikatSeminarController;
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

//Sertif PKBJJ
Route::get('/sertifikat', [SertifikatController::class, 'index'])->name('sertif');
Route::post('/cetaksertifikat', [SertifikatController::class, 'process'])->name('buat');

//Sertif OSMB
Route::get('/sertifikatosmb', [SertifikatOSMBController::class, 'index'])->name('sertifosmb');
Route::post('/cetaksertifikatosmb', [SertifikatOSMBController::class, 'process'])->name('cetak');

//Sertif Seminar Akademik
Route::get('/sertifikatseminar', [SertifikatSeminarController::class, 'index'])->name('sertifseminar');
Route::post('/cetaksertifikatseminar', [SertifikatSeminarController::class, 'process'])->name('cetakseminar');

// ---------------------------------------------------------------------------------------------------------------

//Admin

Route::get('/admin301097', [AdminController::class, 'index'])->name('hlmadmin');
Route::get('/admin301097/pkbjj', [AdminController::class, 'admin_pkbjj'])->name('adminpkbjj');
Route::get('/admin301097/osmb', [AdminController::class, 'admin_osmb'])->name('adminosmb');
Route::get('/admin301097/seminar', [AdminController::class, 'admin_seminar'])->name('adminseminar');

// Export & Import Excel PKBJJ
Route::get('/pkbjj/export_excel', [AdminController::class, 'export_excel'])->name('export');
Route::post('/pkbjj/import_excel', [AdminController::class, 'import_excel'])->name('import');

// Export & Import Excel OSMB
Route::get('/osmb/export_excelosmb', [AdminController::class, 'export_excelosmb'])->name('exportosmb');
Route::post('/osmb/import_excelosmb', [AdminController::class, 'import_excelosmb'])->name('importosmb');

// Export & Import Excel Seminar
Route::get('/seminar/export_excelseminar', [AdminController::class, 'export_excelseminar'])->name('exportseminar');
Route::post('/seminar/import_excelseminar', [AdminController::class, 'import_excelseminar'])->name('importseminar');
