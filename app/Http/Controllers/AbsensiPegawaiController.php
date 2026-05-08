<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsensiPegawai;
use App\Exports\AbsensiPegawaiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class AbsensiPegawaiController extends Controller
{
    public function index()
    {
        $absensis = AbsensiPegawai::with('user')->orderBy('created_at', 'desc')->get();
        return view('backend.absensi.index', compact('absensis'));
    }

    public function create()
    {
        return view('absensi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_tutorial' => 'required',
            'tanggal' => 'required|date',
            'jam_tutorial' => 'required',
            'pertemuan_ke' => 'required',
            'kode_nama_matkul_kelas' => 'required',
            'id_kelas_tutorial' => 'required',
            'id_tutor' => 'required',
            'nama_tutor' => 'required',
            'tgl_jam_mulai_pantau' => 'required',
            'jml_mhs_seharusnya' => 'required|integer',
            'jml_mhs_hadir' => 'required|integer',
            'jenis_pemantauan' => 'required',
            'kbm_absensi' => 'required',
            'kbm_materi' => 'required',
            'kbm_media' => 'required',
            'kbm_diskusi' => 'required',
            'kbm_pengarahan' => 'required',
            'jam_akhir_pantau' => 'required',
            'praktik_baik' => 'required',
            'temuan_ketidaksesuaian' => 'required',
            'kesan_pembelajaran' => 'required',
            'kendala_tutorial' => 'required',
            'saran_perbaikan' => 'required',
            'file_materi' => 'required|image|mimes:jpeg,png,jpg,bmp|max:102400',
            'file_peserta' => 'required|image|mimes:jpeg,png,jpg,bmp|max:102400',
            'link_video' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $fileMateri = null;
        if ($request->hasFile('file_materi')) {
            $file = $request->file('file_materi');
            $filename = time() . '_materi.' . $file->getClientOriginalExtension();
            
            \Illuminate\Support\Facades\Storage::disk('google')->put($filename, file_get_contents($file));
            
            $adapter = \Illuminate\Support\Facades\Storage::disk('google')->getAdapter();
            $metadata = $adapter->getMetadata($filename);
            // $metadata['path'] is the file ID in Google Drive
            $fileMateri = 'https://drive.google.com/uc?id=' . $metadata['path'];
        }

        $filePeserta = null;
        if ($request->hasFile('file_peserta')) {
            $file = $request->file('file_peserta');
            $filename = time() . '_peserta.' . $file->getClientOriginalExtension();
            
            \Illuminate\Support\Facades\Storage::disk('google')->put($filename, file_get_contents($file));
            
            $adapter = \Illuminate\Support\Facades\Storage::disk('google')->getAdapter();
            $metadata = $adapter->getMetadata($filename);
            $filePeserta = 'https://drive.google.com/uc?id=' . $metadata['path'];
        }

        AbsensiPegawai::create([
            'user_id' => auth()->id(),
            'nama_pemantau' => auth()->user()->name,
            'jenis_tutorial' => $request->jenis_tutorial,
            'tanggal' => $request->tanggal,
            'jam_tutorial' => $request->jam_tutorial,
            'pertemuan_ke' => $request->pertemuan_ke,
            'kode_nama_matkul_kelas' => $request->kode_nama_matkul_kelas,
            'id_kelas_tutorial' => $request->id_kelas_tutorial,
            'id_tutor' => $request->id_tutor,
            'nama_tutor' => $request->nama_tutor,
            'tgl_jam_mulai_pantau' => $request->tgl_jam_mulai_pantau,
            'jml_mhs_seharusnya' => $request->jml_mhs_seharusnya,
            'jml_mhs_hadir' => $request->jml_mhs_hadir,
            'jenis_pemantauan' => $request->jenis_pemantauan,
            'kbm_absensi' => $request->kbm_absensi,
            'kbm_materi' => $request->kbm_materi,
            'kbm_media' => $request->kbm_media,
            'kbm_diskusi' => $request->kbm_diskusi,
            'kbm_pengarahan' => $request->kbm_pengarahan,
            'bahas_tugas' => $request->bahas_tugas,
            'jam_akhir_pantau' => $request->jam_akhir_pantau,
            'praktik_baik' => $request->praktik_baik,
            'temuan_ketidaksesuaian' => $request->temuan_ketidaksesuaian,
            'kesan_pembelajaran' => $request->kesan_pembelajaran,
            'kendala_tutorial' => $request->kendala_tutorial,
            'saran_perbaikan' => $request->saran_perbaikan,
            'file_materi' => $fileMateri,
            'file_peserta' => $filePeserta,
            'link_video' => $request->link_video,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->back()->with('success', 'Data pemantauan berhasil disimpan!');
    }

    public function export()
    {
        return Excel::download(new AbsensiPegawaiExport, 'Data_Pemantauan_Monitoring.xlsx');
    }
}
