<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'background',
        'settings_json',
        'status',
    ];

    protected $casts = [
        'settings_json' => 'array',
        'status' => 'boolean',
    ];

    public function events()
    {
        return $this->hasMany(CertificateEvent::class, 'template_id');
    }
}
