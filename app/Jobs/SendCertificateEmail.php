<?php

namespace App\Jobs;

use App\Models\CertificateParticipant;
use App\Models\CertificateLog;
use App\Mail\CertificateMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCertificateEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $participant;

    public function __construct(CertificateParticipant $participant)
    {
        $this->participant = $participant;
    }

    public function handle()
    {
        try {
            // Generate PDF first
            if (!$this->participant->certificate_path || !file_exists(storage_path('app/public/' . $this->participant->certificate_path))) {
                $pdfService = app(\App\Services\PdfService::class);
                $pdfService->generate($this->participant);
            }

            Mail::to($this->participant->email)->send(new CertificateMail($this->participant));
            
            $this->participant->update(['email_sent' => true]);
            
            CertificateLog::create([
                'participant_id' => $this->participant->id,
                'status' => 'success',
                'message' => 'Email sertifikat berhasil dikirim',
            ]);
            
        } catch (\Exception $e) {
            CertificateLog::create([
                'participant_id' => $this->participant->id,
                'status' => 'failed',
                'message' => 'Gagal mengirim email: ' . $e->getMessage(),
            ]);
            
            throw $e; // To allow the queue worker to retry
        }
    }
}
