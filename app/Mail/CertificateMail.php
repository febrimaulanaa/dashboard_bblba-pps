<?php

namespace App\Mail;

use App\Models\CertificateParticipant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CertificateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $participant;

    public function __construct(CertificateParticipant $participant)
    {
        $this->participant = $participant;
    }

    public function build()
    {
        $event = $this->participant->event;
        $pdfPath = storage_path('app/public/' . $this->participant->certificate_path);

        $mail = $this->subject('Sertifikat Kegiatan: ' . $event->name)
                    ->view('emails.certificate')
                    ->with([
                        'participantName' => $this->participant->name,
                        'eventName' => $event->name,
                    ]);
                    
        if (file_exists($pdfPath)) {
            $mail->attach($pdfPath, [
                'as' => 'Sertifikat_' . $event->slug . '_' . preg_replace('/[^A-Za-z0-9\-]/', '', $this->participant->nim) . '.pdf',
                'mime' => 'application/pdf',
            ]);
        }
        
        return $mail;
    }
}
