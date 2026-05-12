<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'status',
        'message',
    ];

    public function participant()
    {
        return $this->belongsTo(CertificateParticipant::class, 'participant_id');
    }
}
