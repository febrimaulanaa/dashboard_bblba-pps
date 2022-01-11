<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSertifMhs extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'datasertif_mhs';
    protected $primaryKey = 'id';
}
