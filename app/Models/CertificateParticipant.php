<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'nim',
        'email',
        'phone',
        'study_program',
        'faculty',
        'certificate_number',
        'certificate_path',
        'email_sent',
        'submitted_at',
    ];

    protected $casts = [
        'email_sent' => 'boolean',
        'submitted_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(CertificateEvent::class, 'event_id');
    }

    public function logs()
    {
        return $this->hasMany(CertificateLog::class, 'participant_id');
    }
}
