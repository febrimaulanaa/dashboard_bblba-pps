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

        // Mengambil data berdasarkan NIM
        $data = JadwalTuweb::where('nim', $id)->get();

        // Mengembalikan data dalam format JSON
        return response()->json($data);
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
}
