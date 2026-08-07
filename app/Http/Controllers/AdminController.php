<?php

namespace App\Http\Controllers;

use DataTables;
use App\Exports\OSMBExport;
use App\Exports\WTKUExport;
use App\Imports\OSMBImport;
use App\Imports\WTKUImport;
use App\Exports\PKBJJExport;
use App\Imports\PKBJJImport;
use App\Exports\WisudaExport;
use App\Imports\WisudaImport;
use App\Exports\JadwalPKBJJExport;
use Illuminate\Http\Request;
use App\Models\DataSertifMhs;
use App\Exports\SeminarExport;
use App\Exports\TuwebExport;
use App\Imports\SeminarImport;
use App\Models\DataSertifOSMB;
use App\Models\DataSertifWTKU;
use App\Models\DataSertifSeminar;
use App\Http\Controllers\Controller;
use App\Imports\JadwalPKBJJImport;
use App\Imports\TuwebImport;
use App\Models\JadwalPKBJJ;
use App\Models\JadwalTuweb;
use App\Models\Wisuda;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{

    //PKBJJ

    public function index()
    {
        return view('backend.mainview.index');
    }

    //PKBJJ
    public function admin_pkbjj(Request $request)
    {
        $pkbjj = DataSertifMhs::get();
        return view('backend.pkbjj.data_pkbjj')->with(compact('pkbjj'));
    }

    public function getdatapkbjj(Request $request)
    {
        $data = $request->all();
        $orderByColumn = $data["order"][0]["column"];
        $orderBy = $data["order"][0]["dir"];

        if ($orderByColumn == 1) {
            $orderByColumn = "masa";
        }
        $limit = $data['length'];
        $offset = $data['start'];
        return datatables()->of(DataSertifMhs::all(["id", "masa", "nama", "nim", "prodi"]))->toJson();
    }

    public function storepkbjj(Request $request)
    {
        $pkbjj = DataSertifMhs::create([
            'masa' => $request->masa,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'prodi' => $request->prodi
        ]);
        return response()->json($pkbjj);
    }

    public function export_excel()
    {
        return Excel::download(new PKBJJExport, 'MhsPKBJJ.xlsx');
    }


    public function import_excel(Request $request)
    {
        $pkbjj = DataSertifMhs::all();

        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_pkbjj', $nama_file);

        // import data
        Excel::import(new PKBJJImport, public_path('/file_pkbjj/' . $nama_file));

        // notifikasi dengan session
        toast('Data Berhasil Diimport!', 'success');

        // alihkan halaman kembali
        return redirect()->back()->with(compact('pkbjj'));
    }

    //Jadwal LKPBJJ

    public function admin_jadwalpkbjj()
    {
        $jdpkbjj = JadwalPKBJJ::get();
        return view('backend.pkbjj.jadwal_pkbjj')->with(compact('jdpkbjj'));
    }

    public function export_jadwalexcel()
    {
        return Excel::download(new JadwalPKBJJExport, 'Data_Jadwal_LKPBJJ.xlsx');
    }

    public function import_jadwalexcel(Request $request)
    {
        $jdpkbjj = JadwalPKBJJ::all();

        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_jdpkbjj', $nama_file);

        // import data
        Excel::import(new JadwalPKBJJImport, public_path('/file_jdpkbjj/' . $nama_file));

        // notifikasi dengan session
        toast('Data Berhasil Diimport!', 'success');

        // alihkan halaman kembali
        return redirect()->back()->with(compact('jdpkbjj'));
    }

    public function storejadwalpkbjj(Request $request)
    {
        $jadwal = JadwalPKBJJ::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'skema' => $request->skema,
            'nomor_meja' => $request->nomor_meja,
            'no_urut' => $request->no_urut,
            'lokasi' => $request->lokasi,
            'link_lok' => $request->link_lok
        ]);
        return response()->json($jadwal);
    }

    public function bulkstorejadwalpkbjj(Request $request)
    {
        $data = $request->validate([
            'jadwals' => 'required|array',
            'jadwals.*.nim' => 'required',
            'jadwals.*.nama' => 'required',
        ]);
        
        foreach($data['jadwals'] as $row) {
            JadwalPKBJJ::create([
                'nim' => $row['nim'] ?? null,
                'nama' => $row['nama'] ?? null,
                'nama_kegiatan' => $row['nama_kegiatan'] ?? null,
                'tanggal' => $row['tanggal'] ?? null,
                'waktu' => $row['waktu'] ?? null,
                'skema' => $row['skema'] ?? null,
                'nomor_meja' => $row['nomor_meja'] ?? null,
                'no_urut' => $row['no_urut'] ?? null,
                'lokasi' => $row['lokasi'] ?? null,
                'link_lok' => $row['link_lok'] ?? null
            ]);
        }
        
        return response()->json(['status' => 'success']);
    }

    public function setBulkNamaKegiatan(Request $request)
    {
        $data = $request->validate([
            'nama_kegiatan_default' => 'required|string',
        ]);
        
        $count = JadwalPKBJJ::whereNull('nama_kegiatan')
                            ->orWhere('nama_kegiatan', '')
                            ->update(['nama_kegiatan' => $data['nama_kegiatan_default']]);
        
        return response()->json([
            'status' => 'success',
            'updated_count' => $count
        ]);
    }

    public function bulkReplaceJadwalPKBJJ(Request $request)
    {
        $data = $request->validate([
            'kolom' => 'required|string|in:nama_kegiatan,tanggal,waktu,skema,nomor_meja,no_urut,lokasi,link_lok',
            'nilai_lama' => 'required|string',
            'nilai_baru' => 'required|string',
        ]);

        $count = JadwalPKBJJ::where($data['kolom'], $data['nilai_lama'])
                            ->update([$data['kolom'] => $data['nilai_baru']]);

        return response()->json([
            'status' => 'success',
            'updated_count' => $count
        ]);
    }

    public function updatejadwalpkbjj(Request $request, $id)
    {
        $jadwal = JadwalPKBJJ::findOrFail($id);
        $jadwal->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'skema' => $request->skema,
            'nomor_meja' => $request->nomor_meja,
            'no_urut' => $request->no_urut,
            'lokasi' => $request->lokasi,
            'link_lok' => $request->link_lok
        ]);
        return response()->json($jadwal);
    }

    public function deletejadwalpkbjj($id)
    {
        $jadwal = JadwalPKBJJ::findOrFail($id);
        $jadwal->delete();
        return response()->json(['success' => 'Data berhasil dihapus']);
    }

    public function bulkdeletejadwalpkbjj()
    {
        JadwalPKBJJ::truncate();
        return redirect()->back()->with('success', 'Semua data Jadwal PKBJJ berhasil dihapus!');
    }

    public function getdatajadwalpkbjj(Request $request)
    {
        $data = $request->all();
        $orderByColumn = $data["order"][0]["column"];
        $orderBy = $data["order"][0]["dir"];

        if ($orderByColumn == 1) {
            $orderByColumn = "nim";
        }
        $limit = $data['length'];
        $offset = $data['start'];
        return datatables()->of(JadwalPKBJJ::all(["id", "nim", "nama", "tanggal", "skema", "link_lok"]))->toJson();
    }


    //OSMB

    public function admin_osmb(Request $request)
    {
        $osmb = DataSertifOSMB::all();
        return view('backend.osmb.data_osmb', compact('osmb'));
    }

    public function getdataosmb(Request $request)
    {
        $data = $request->all();
        $orderByColumn = $data["order"][0]["column"];
        $orderBy = $data["order"][0]["dir"];

        if ($orderByColumn == 1) {
            $orderByColumn = "masa";
        }
        $limit = $data['length'];
        $offset = $data['start'];
        return datatables()->of(DataSertifOSMB::all(["id", "masa", "nama", "nim", "prodi"]))->toJson();
    }

    public function storeosmb(Request $request)
    {

        $osmb = DataSertifOSMB::create([
            'masa' => $request->masa,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'prodi' => $request->prodi
        ]);
        return response()->json($osmb);
    }

    public function export_excelosmb()
    {
        return Excel::download(new OSMBExport, 'MhsOSMB.xlsx');
    }

    public function import_excelosmb(Request $request)
    {


        $osmb = DataSertifOSMB::all();

        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_osmb', $nama_file);

        // import data
        Excel::import(new OSMBImport, public_path('/file_osmb/' . $nama_file));

        // notifikasi dengan session
        toast('Data Berhasil Diimport!', 'success');

        // alihkan halaman kembali
        return redirect()->back()->with(compact('osmb'));
    }

    //Seminar

    public function admin_seminar()
    {
        $seminar = DataSertifSeminar::all();
        return view('backend.seminar.data_seminar', compact('seminar'));
    }

    public function storeseminar(Request $request)
    {
        $seminar = DataSertifSeminar::create([
            'masa' => $request->masa,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'prodi' => $request->prodi
        ]);
        return response()->json($seminar);
    }

    public function export_excelseminar()
    {
        return Excel::download(new SeminarExport, 'MhsSeminar.xlsx');
    }

    public function import_excelseminar(Request $request)
    {
        $seminar = DataSertifSeminar::all();

        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_seminar', $nama_file);

        // import data
        Excel::import(new SeminarImport, public_path('/file_seminar/' . $nama_file));

        // notifikasi dengan session
        toast('Data Berhasil Diimport!', 'success');

        // alihkan halaman kembali
        return redirect()->back()->with(compact('seminar'));
    }

    //WTKU

    public function admin_wtku()
    {
        $wtku = DataSertifWTKU::all();
        return view('backend.wtku.data_wtku', compact('wtku'));
    }

    public function storewtku(Request $request)
    {
        $wtku = DataSertifWTKU::create([
            'masa' => $request->masa,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'prodi' => $request->prodi
        ]);
        return response()->json($wtku);
    }

    public function export_excelwtku()
    {
        return Excel::download(new WTKUExport, 'MhsWTKU.xlsx');
    }

    public function import_excelwtku(Request $request)
    {
        $wtku = DataSertifWTKU::all();

        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_wtku', $nama_file);

        // import data
        Excel::import(new WTKUImport, public_path('/file_wtku/' . $nama_file));

        // notifikasi dengan session
        toast('Data Berhasil Diimport!', 'success');

        // alihkan halaman kembali
        return redirect()->back()->with(compact('wtku'));
    }

    //Wisuda

    public function admin_wisuda()
    {
        $wisuda = Wisuda::all();
        return view('backend.wisuda.data_wisuda', compact('wisuda'));
    }

    public function storewisuda(Request $request)
    {
        $wisuda = Wisuda::create([
            'kelompok' => $request->kelompok,
            'no_urut_ijazah' => $request->no_urut_ijazah,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'no_meja_ambil_ijazah' => $request->no_meja_ambil_ijazah,
            'prodi' => $request->prodi
        ]);
        return response()->json($wisuda);
    }

    public function export_excelwisuda()
    {
        return Excel::download(new WisudaExport, 'MahasiswaWisuda.xlsx');
    }

    public function import_excelwisuda(Request $request)
    {
        $wisuda = Wisuda::all();

        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_seminar', $nama_file);

        // import data
        Excel::import(new WisudaImport, public_path('/file_seminar/' . $nama_file));

        // notifikasi dengan session
        toast('Data Berhasil Diimport!', 'success');

        // alihkan halaman kembali
        return redirect()->back()->with(compact('wisuda'));
    }


    //Tuweb

    public function admin_tuweb(Request $request)
    {
        $tuweb = JadwalTuweb::get();
        return view('backend.tuweb.data_tuweb_mhs')->with(compact('tuweb'));
    }

    public function show($id)
    {
        // Penentuan masa aktif (Format: Tahun.Semester, misal 2024.1 / 2024.2)
        $now = \Carbon\Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $day = $now->day;

        $isMaretQ2 = ($month == 3 && $day >= 16);
        $isAgustusQ1 = ($month == 8 && $day <= 15);

        // Tahun akademik: Jan-Agustus Q1 = tahun sebelumnya, Agustus Q2-Des = tahun ini
        $tahunAktif = $year;
        if ($month < 8 || $isAgustusQ1) {
            $tahunAktif = $year - 1;
        }

        // Semester 2 (Genap): Maret Q2 (16 Mar) s.d Agustus Q1 (15 Ags)
        // Semester 1 (Gasal): Agustus Q2 (16 Ags) s.d Maret Q1 (15 Mar)
        $semester = 1; // Default Gasal
        if ($isMaretQ2 || ($month >= 4 && $month <= 7) || $isAgustusQ1) {
            $semester = 2; // Genap
        }

        $masa = $tahunAktif . $semester;
        $apiData = null;

        try {
            // Cek apakah token masih ada di cache (berlaku 30 menit)
            $token = \Illuminate\Support\Facades\Cache::get('api_login_token');

            if (!$token) {
                // Request dengan timeout 5 detik untuk mencegah ERR_EMPTY_RESPONSE
                $loginResponse = \Illuminate\Support\Facades\Http::timeout(5)
                    ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                    ->post(config('srs.base_url') . config('srs.endpoints.login'), [
                    'email' => config('srs.email'),
                    'password' => config('srs.password'),
                ]);

                if ($loginResponse->successful() && $loginResponse->json('status')) {
                    Log::info("Success login");
                    $token = $loginResponse->json('token');
                    \Illuminate\Support\Facades\Cache::put('api_login_token', $token, now()->addMinutes(30));
                }
            }

            if ($token) {
                Log::info("Token is valid");

                $dataResponse = \Illuminate\Support\Facades\Http::withToken($token)
                    ->timeout(5)
                    ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                    ->get(config('srs.base_url') . config('srs.endpoints.tutorial'), [
                    'nim' => $id,
                    'masa' => $masa
                ]);

                if ($dataResponse->successful()) {
                    Log::info("Data is successfully fetched");
                    $jsonPayload = $dataResponse->json();
                    $apiData = isset($jsonPayload['data']) ? $jsonPayload['data'] : $jsonPayload;
                }

                if ($dataResponse->status() === 401) {
                    \Illuminate\Support\Facades\Cache::forget('api_login_token');
                }
            }
        }
        catch (\Exception $e) {
            // Tangkap timeout (RequestException) agar tidak menyebabkan ERR_EMPTY_RESPONSE
            Log::warning('API UT Timeout/Error: ' . $e->getMessage());
        }

        // Jika API gagal, timeout, atau datanya kosong, gunakan Database Lokal sebagai Fallback
        if (empty($apiData)) {
            Log::info("Fallback to database cause empty data");
            $localData = JadwalTuweb::where('nim', $id)->get();
            return response()->json($localData);
        }

        // Mapping API response ke format database lokal
        $mappedData = array_map(function ($item) {
            return [
            'masa' => $item['masa'] ?? null,
            'nim' => $item['nim'] ?? null,
            'nama_mhs' => $item['nama_mahasiswa'] ?? null,
            'nama_tutor' => $item['nama_tutor'] ?? null,
            'kode_matkul' => $item['kode_matakuliah'] ?? null,
            'nama_matkul' => $item['nama_matakuliah'] ?? null,
            'link_tuweb' => $item['link'] ?? null,
            'lokasi' => $item['lokasi'] ?? null,
            'jam' => $item['jam'] ?? null,
            'hari' => $item['nama_hari'] ?? null,
            'tanggal_mulai' => $item['tanggal_mulai'] ?? null,
            'tanggal_selesai' => $item['tanggal_selesai'] ?? null,
            'keterangan' => $item['status_tutorial'] ?? null,
            'kelas' => $item['id_kelas'] ?? null,
            ];
        }, $apiData);

        return response()->json($mappedData);
    }

    public function showTutor($id)
    {
        // Penentuan masa aktif (sama dengan show mahasiswa)
        $now = \Carbon\Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $day = $now->day;

        $isMaretQ2 = ($month == 3 && $day >= 16);
        $isAgustusQ1 = ($month == 8 && $day <= 15);

        $tahunAktif = $year;
        if ($month < 8 || $isAgustusQ1) {
            $tahunAktif = $year - 1;
        }

        $semester = 1;
        if ($isMaretQ2 || ($month >= 4 && $month <= 7) || $isAgustusQ1) {
            $semester = 2;
        }

        $masa = $tahunAktif . $semester;
        $apiData = null;

        try {
            $token = \Illuminate\Support\Facades\Cache::get('api_login_token');

            if (!$token) {
                $loginResponse = \Illuminate\Support\Facades\Http::timeout(5)
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->post(config('srs.base_url') . config('srs.endpoints.login'), [
                        'email' => config('srs.email'),
                        'password' => config('srs.password'),
                    ]);

                if ($loginResponse->successful() && $loginResponse->json('status')) {
                    Log::info("Success login (tutor)");
                    $token = $loginResponse->json('token');
                    \Illuminate\Support\Facades\Cache::put('api_login_token', $token, now()->addMinutes(30));
                }
            }

            if ($token) {
                Log::info("Token is valid, fetching tutor data...");

                $dataResponse = \Illuminate\Support\Facades\Http::withToken($token)
                    ->timeout(5)
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->get(config('srs.base_url') . config('srs.endpoints.tutorial_tutor'), [
                        'id_tutor' => $id,
                        'masa' => $masa,
                    ]);

                if ($dataResponse->successful()) {
                    Log::info("Tutor data is successfully fetched");
                    $jsonPayload = $dataResponse->json();
                    $apiData = isset($jsonPayload['data']) ? $jsonPayload['data'] : $jsonPayload;
                }

                if ($dataResponse->status() === 401) {
                    \Illuminate\Support\Facades\Cache::forget('api_login_token');
                }
            }
        } catch (\Exception $e) {
            Log::warning('API UT Timeout/Error (tutor): ' . $e->getMessage());
        }

        if (empty($apiData)) {
            return response()->json([]);
        }

        // Mapping API response ke format lokal
        $mappedData = array_map(function ($item) {
            return [
                'masa' => $item['masa'] ?? null,
                'nim' => $item['nim'] ?? null,
                'nama_mhs' => $item['nama_mahasiswa'] ?? null,
                'nama_tutor' => $item['nama_tutor'] ?? null,
                'kode_matkul' => $item['kode_matakuliah'] ?? null,
                'nama_matkul' => $item['nama_matakuliah'] ?? null,
                'link_tuweb' => $item['link'] ?? null,
                'lokasi' => $item['lokasi'] ?? null,
                'jam' => $item['jam'] ?? null,
                'hari' => $item['nama_hari'] ?? null,
                'tanggal_mulai' => $item['tanggal_mulai'] ?? null,
                'tanggal_selesai' => $item['tanggal_selesai'] ?? null,
                'keterangan' => $item['status_tutorial'] ?? null,
                'kelas' => $item['id_kelas'] ?? null,
            ];
        }, $apiData);

        return response()->json($mappedData);
    }

    public function storetuweb(\Illuminate\Http\Request $request)
    {
        $tuweb = JadwalTuweb::create($request->all());
        return response()->json($tuweb);
    }

    public function export_exceltuweb()
    {
        return Excel::download(new TuwebExport, 'MahasiswaTuweb.xlsx');
    }

    public function import_exceltuweb(Request $request)
    {
        $tuweb = JadwalTuweb::all();

        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_tuweb', $nama_file);

        // import data
        Excel::import(new TuwebImport, public_path('/file_tuweb/' . $nama_file));

        // notifikasi dengan session
        toast('Data Berhasil Diimport!', 'success');

        // alihkan halaman kembali
        return redirect()->back()->with(compact('tuweb'));
    }

    // Manajemen User Pegawai
    public function admin_users()
    {
        $users = \App\Models\User::orderBy('id', 'desc')->get();
        return view('backend.users.index', compact('users'));
    }

    public function storeuser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }

    public function deleteuser($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }

    public function ajaxContent(Request $request, $page)
    {
        $views = [
            'dashboard' => 'backend.ajax.dashboard',
            'pkbjj' => 'backend.ajax.pkbjj',
            'osmb' => 'backend.ajax.osmb',
            'seminar' => 'backend.ajax.seminar',
            'wtku' => 'backend.ajax.wtku',
            'wisuda' => 'backend.ajax.wisuda',
            'tuweb' => 'backend.ajax.tuweb',
            'users' => 'backend.ajax.users',
            'absensi' => 'backend.ajax.absensi',
            'jadwalpkbjj' => 'backend.ajax.jadwalpkbjj',
            'sistem-sertifikat' => 'backend.ajax.sistem-sertifikat',
            'sistem-sertifikat-events' => 'backend.ajax.sistem-sertifikat-events',
            'sistem-sertifikat-templates' => 'backend.ajax.sistem-sertifikat-templates',
            'sistem-sertifikat-participants' => 'backend.ajax.sistem-sertifikat-participants',
        ];
        
        $viewName = $views[$page] ?? 'backend.ajax.dashboard';
        
        try {
            return view($viewName);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('AJAX Error: ' . $e->getMessage());
            return 'Error loading ' . $page . ': ' . $e->getMessage();
        }
    }
}