<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSertifOSMB extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'datasertif_osmb';
    protected $primaryKey = 'id';
}
