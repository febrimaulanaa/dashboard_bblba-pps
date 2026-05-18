<?php

namespace App\Jobs;

use App\Mail\CertificateMail;
use App\Models\CertificateParticipant;
use App\Services\CertificateService;
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

    public $participant;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CertificateParticipant $participant)
    {
        $this->participant = $participant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $service = app(CertificateService::class);

        // Generate PDF
        $pdfPath = $service->generatePdf($this->participant);

        // Update Participant Status FIRST so the Mail class can read certificate_path
        $this->participant->update([
            'email_sent' => true,
            'email_sent_at' => now(),
            'certificate_path' => $pdfPath,
        ]);

        // Send Email
        Mail::to($this->participant->email)
            ->send(new CertificateMail($this->participant));

    }
}
