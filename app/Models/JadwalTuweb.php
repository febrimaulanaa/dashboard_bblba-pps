<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTuweb extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'masa',
        'nim',
        'nama_mhs',
        'nama_tutor',
        'kode_matkul',
        'nama_matkul',
        'link_tuweb',
        'lokasi',
        'jam',
        'hari',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',
    ];
    protected $table = 'jadwal_tuweb';
    protected $primaryKey = 'id';
}
