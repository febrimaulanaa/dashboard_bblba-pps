<?php

namespace App\Services;

use App\Models\CertificateParticipant;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PdfService
{
    public function generate(CertificateParticipant $participant): string
    {
        $event = $participant->event;
        $template = $event->template;
        
        // Generate QR Code as base64 string
        $verifyUrl = url('/verify/' . $participant->certificate_number);
        // Using SVG format to avoid Imagick dependency
        $qrCode = base64_encode(QrCode::format('svg')->size(150)->margin(0)->generate($verifyUrl));
        
        // Load background as base64 to avoid SSL/Network issues in DomPDF
        $backgroundData = '';
        if ($template && $template->background) {
            $backgroundPath = storage_path('app/public/' . $template->background);
            if (file_exists($backgroundPath)) {
                $ext = pathinfo($backgroundPath, PATHINFO_EXTENSION);
                $backgroundData = 'data:image/' . $ext . ';base64,' . base64_encode(file_get_contents($backgroundPath));
            }
        }
        
        $data = [
            'participant' => $participant,
            'event' => $event,
            'template' => $template,
            'settings' => $template->settings_json ?? [],
            'qrCodeBase64' => $qrCode,
            'backgroundData' => $backgroundData,
        ];
        
        // Render PDF
        $pdf = Pdf::loadView('certificates.templates.default', $data);
        
        // Paper size: A4 Landscape
        $pdf->setPaper('A4', 'landscape');
        
        // Remove trailing spaces or non-alphanumeric chars from NIM
        $cleanNim = preg_replace('/[^A-Za-z0-9\-]/', '', $participant->nim);
        $filename = 'certificates/' . $event->slug . '/' . $cleanNim . '.pdf';
        
        // Save to public storage
        Storage::disk('public')->put($filename, $pdf->output());
        
        $participant->update(['certificate_path' => $filename]);
        
        return $filename;
    }
}
