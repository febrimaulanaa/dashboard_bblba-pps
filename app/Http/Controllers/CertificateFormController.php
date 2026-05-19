<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CertificateEvent;
use App\Models\CertificateParticipant;
use App\Jobs\SendCertificateEmail;

class CertificateFormController extends Controller
{
    public function show($id)
    {
        $event = CertificateEvent::where('id', $id)->where('status', true)->firstOrFail();
        return view('certificates.forms.show', compact('event'));
    }

    public function submit(Request $request, $id)
    {
        $event = CertificateEvent::where('id', $id)->where('status', true)->firstOrFail();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'study_program' => 'nullable|string|max:100',
            'faculty' => 'nullable|string|max:100',
        ]);
        
        // Check uniqueness for this event
        if (CertificateParticipant::where('event_id', $event->id)->where('nim', $validated['nim'])->exists()) {
            return redirect('/ecertificate/' . $id)->withInput()->with('error', 'NIM ini sudah terdaftar pada kegiatan ini.');
        }
        
        if (CertificateParticipant::where('event_id', $event->id)->where('email', $validated['email'])->exists()) {
            return redirect('/ecertificate/' . $id)->withInput()->with('error', 'Email ini sudah terdaftar pada kegiatan ini.');
        }
        
        $participant = new CertificateParticipant($validated);
        $participant->event_id = $event->id;
        $participant->submitted_at = now();
        
        // Generate number
        $certService = app(\App\Services\CertificateService::class);
        $participant->certificate_number = $certService->generateNumber($event);
        
        // Generate PDF directly instead of using Job if we want immediate download (but user asked for queue)
        $participant->save();
        
        // Use PdfService to generate PDF and then Mail
        // Note: For now we can dispatch it to queue
        SendCertificateEmail::dispatch($participant);
        
        return view('certificates.forms.success', compact('event', 'participant'));
    }

    public function verify(Request $request)
    {
        $code = $request->query('code');
        $participant = CertificateParticipant::with('event')->where('certificate_number', $code)->firstOrFail();
        return view('certificates.forms.verify', compact('participant'));
    }
}
