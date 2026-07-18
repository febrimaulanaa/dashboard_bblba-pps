<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPKBJJ extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nim',
        'nama',
        'nama_kegiatan',
        'tanggal',
        'waktu',
        'skema',
        'nomor_meja',
        'no_urut',
        'link_lok',
    ];
    protected $table = 'jadwalpkbjj';
    protected $primaryKey = 'id';
}
