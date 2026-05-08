<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiPegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_pemantau',
        'jenis_tutorial',
        'tanggal',
        'jam_tutorial',
        'pertemuan_ke',
        'kode_nama_matkul_kelas',
        'id_kelas_tutorial',
        'id_tutor',
        'nama_tutor',
        'tgl_jam_mulai_pantau',
        'jml_mhs_seharusnya',
        'jml_mhs_hadir',
        'jenis_pemantauan',
        'kbm_absensi',
        'kbm_materi',
        'kbm_media',
        'kbm_diskusi',
        'kbm_pengarahan',
        'bahas_tugas',
        'jam_akhir_pantau',
        'praktik_baik',
        'temuan_ketidaksesuaian',
        'kesan_pembelajaran',
        'kendala_tutorial',
        'saran_perbaikan',
        'file_materi',
        'file_peserta',
        'link_video',
        'latitude',
        'longitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
