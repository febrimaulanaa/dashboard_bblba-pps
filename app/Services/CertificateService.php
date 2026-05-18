<?php

namespace App\Services;

use App\Models\CertificateParticipant;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CertificateService
{
    public function generatePdf(CertificateParticipant $participant)
    {
        $url = url('/verify?code=' . $participant->certificate_number);
        
        // 2. Generate QR Code image (base64)
        $qrCode = base64_encode(QrCode::format('svg')->size(150)->generate($url));
        
        $event = $participant->event;
        $template = $event->template;
        $settings = $template ? $template->settings_json : [];
        
        $backgroundData = '';
        if ($template && $template->background) {
            $path = storage_path('app/public/' . $template->background);
            if (file_exists($path)) {
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $backgroundData = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
        }

        // 3. Prepare data for the PDF
        $data = [
            'participant' => $participant,
            'event' => $event,
            'qrCodeBase64' => $qrCode,
            'settings' => is_string($settings) ? json_decode($settings, true) : $settings,
            'backgroundData' => $backgroundData
        ];

        // 4. Generate the PDF using a view
        $pdf = Pdf::loadView('certificates.templates.default', $data)
                  ->setPaper('a4', 'landscape');

        // 5. Define filename and path
        $filename = 'certificate-' . $participant->id . '-' . time() . '.pdf';
        
        // 6. Save PDF to storage
        Storage::disk('public')->put(
            'certificates/' . $filename,
            $pdf->output()
        );

        // 7. Update participant with PDF path
        $pdfPath = 'certificates/' . $filename;
        $participant->update([
            'certificate_path' => $pdfPath
        ]);

        return $pdfPath;
    }

    public function generateNumber($event)
    {
        // Example: UT-EVENTSLUG-001
        $count = CertificateParticipant::where('event_id', $event->id)->count();
        $number = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        
        return strtoupper('UT-' . substr($event->slug, 0, 8) . '-' . date('Y') . '-' . $number);
    }
}
