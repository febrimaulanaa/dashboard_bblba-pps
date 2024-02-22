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
        'tanggal',
        'skema',
        'link_lok',
    ];
    protected $table = 'jadwalpkbjj';
    protected $primaryKey = 'id';
}
