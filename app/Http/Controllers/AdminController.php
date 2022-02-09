<?php

namespace App\Http\Controllers;

use App\Exports\OSMBExport;
use App\Imports\OSMBImport;
use App\Exports\PKBJJExport;
use App\Imports\PKBJJImport;
use Illuminate\Http\Request;
use App\Models\DataSertifMhs;
use App\Models\DataSertifOSMB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index()
    {
        return view('backend.mainview.index');
    }

    //PKBJJ
    public function admin_pkbjj()
    {
        $pkbjj = DataSertifMhs::all();
        return view('backend.pkbjj.data_pkbjj', compact('pkbjj'));
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

    //OSMB

    public function admin_osmb()
    {
        $osmb = DataSertifOSMB::all();
        return view('backend.osmb.data_osmb', compact('osmb'));
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
}
