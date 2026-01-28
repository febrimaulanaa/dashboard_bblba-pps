<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisuda extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'kelompok',
        'no_urut_ijazah',
        'nim',
        'nama',
        'no_meja_ambil_ijazah',
        'prodi',
    ];
    protected $table = 'wisuda';
    protected $primaryKey = 'id';
}
