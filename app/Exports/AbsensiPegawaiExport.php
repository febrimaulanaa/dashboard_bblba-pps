<?php

namespace App\Exports;

use App\Models\AbsensiPegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbsensiPegawaiExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return AbsensiPegawai::with('user')->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Pemantau',
            'Jenis Tutorial',
            'Tanggal',
            'Jam Tutorial',
            'Pertemuan Ke',
            'Kode / Mata Kuliah / Kelas',
            'ID Kelas Tutorial',
            'ID Tutor',
            'Nama Tutor',
            'Waktu Mulai Pemantauan',
            'Jml Mahasiswa Seharusnya',
            'Jml Mahasiswa Hadir',
            'Jenis Pemantauan',
            'KBM: Absensi',
            'KBM: Penyampaian Materi',
            'KBM: Penggunaan Media',
            'KBM: Diskusi Aktif',
            'KBM: Pengarahan Sesi Datang',
            'KBM: Bahas Tugas',
            'Waktu Akhir Pemantauan',
            'Praktik Baik',
            'Temuan Ketidaksesuaian',
            'Kesan Pembelajaran',
            'Kendala Tutorial',
            'Saran Perbaikan',
            'File Materi (Link)',
            'File Peserta (Link)',
            'Link Video Rekaman',
            'Google Maps (Lokasi)',
            'Waktu Submit',
        ];
    }

    public function map($absensi): array
    {
        static $rowNumber = 0;
        $rowNumber++;

        $googleMapsLink = "https://www.google.com/maps/search/?api=1&query={$absensi->latitude},{$absensi->longitude}";
        
        $linkMateri = $absensi->file_materi ? (\Illuminate\Support\Str::startsWith($absensi->file_materi, 'http') ? $absensi->file_materi : url($absensi->file_materi)) : '-';
        $linkPeserta = $absensi->file_peserta ? (\Illuminate\Support\Str::startsWith($absensi->file_peserta, 'http') ? $absensi->file_peserta : url($absensi->file_peserta)) : '-';

        return [
            $rowNumber,
            $absensi->nama_pemantau,
            $absensi->jenis_tutorial,
            $absensi->tanggal,
            $absensi->jam_tutorial,
            $absensi->pertemuan_ke,
            $absensi->kode_nama_matkul_kelas,
            $absensi->id_kelas_tutorial,
            $absensi->id_tutor,
            $absensi->nama_tutor,
            $absensi->tgl_jam_mulai_pantau,
            $absensi->jml_mhs_seharusnya,
            $absensi->jml_mhs_hadir,
            $absensi->jenis_pemantauan,
            $absensi->kbm_absensi,
            $absensi->kbm_materi,
            $absensi->kbm_media,
            $absensi->kbm_diskusi,
            $absensi->kbm_pengarahan,
            $absensi->bahas_tugas,
            $absensi->jam_akhir_pantau,
            $absensi->praktik_baik,
            $absensi->temuan_ketidaksesuaian,
            $absensi->kesan_pembelajaran,
            $absensi->kendala_tutorial,
            $absensi->saran_perbaikan,
            $linkMateri,
            $linkPeserta,
            $absensi->link_video,
            $googleMapsLink,
            $absensi->created_at->format('d/m/Y H:i'),
        ];
    }
}
