<?php

namespace App\Services;

use App\Models\CertificateParticipant;
use App\Models\CertificateEvent;

class CertificateService
{
    /**
     * Generate unique certificate number
     * Format: CERT/EVENT_SLUG/YEAR/SEQ
     */
    public function generateNumber(CertificateEvent $event): string
    {
        $year = date('Y');
        
        // Count participants for this event
        $count = CertificateParticipant::where('event_id', $event->id)->count();
        $seq = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        
        return strtoupper("CERT/{$event->slug}/{$year}/{$seq}");
    }
}
