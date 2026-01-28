<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSertifWTKU extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'masa',
        'nama',
        'nim',
        'prodi',
    ];
    protected $table = 'datasertif_wtku';
    protected $primaryKey = 'id';
}
