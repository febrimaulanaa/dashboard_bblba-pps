<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSertifMhs extends Model
{
    public function datasertifosmb()
    {
        return $this->belongsTo('App\DataSertifOSMB', 'id');
    }

    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'masa',
        'nama',
        'nim',
        'prodi',
    ];
    protected $table = 'datasertif_mhs';
    protected $primaryKey = 'id';
}
