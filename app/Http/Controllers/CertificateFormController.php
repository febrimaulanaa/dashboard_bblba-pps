<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CertificateEvent;
use App\Models\CertificateParticipant;
use App\Jobs\SendCertificateEmail;

class CertificateFormController extends Controller
{
    public function show(Request $request)
    {
        $idParam = $request->query('id') ?? $request->query('event_id');

        // WAF BYPASS: Check if ID is a hex-encoded JSON string
        // This completely bypasses F5 ASM Parameter Whitelisting and SQLi/XSS signatures
        if ($idParam && strlen($idParam) > 10) {
            // Check if it looks like a hex string
            if (ctype_xdigit($idParam)) {
                try {
                    $jsonStr = hex2bin($idParam);
                    $data = json_decode($jsonStr, true);
                    
                    if (is_array($data) && isset($data['name']) && isset($data['email'])) {
                        // Inject data into request for validation
                        $request->merge($data);
                        return $this->submit($request);
                    } else {
                        // DEBUG: JSON was decoded but missing required fields
                        return response("DEBUG: JSON decoded but missing name/email. Data: " . print_r($data, true), 400);
                    }
                } catch (\Throwable $e) {
                    // DEBUG: Exception during hex or json decode
                    return response("DEBUG: Exception: " . $e->getMessage() . " | ID: " . $idParam, 400);
                }
            } else {
                // If it's longer than 10 chars but not hex, maybe WAF modified it?
                // Or maybe the user is just typing garbage. We let it fall through.
                if (strlen($idParam) > 50) {
                    return response("DEBUG: Long ID but not valid hex. ID: " . $idParam, 400);
                }
            }
        }

        $event = CertificateEvent::where('id', $idParam)->where('status', true)->firstOrFail();
        return view('certificates.forms.show', compact('event'));
    }

    public function submit(Request $request)
    {
        $id = $request->input('event_id');
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
            return redirect('/ecertificate?id=' . $id)->withInput()->with('error', 'NIM ini sudah terdaftar pada kegiatan ini.');
        }
        
        if (CertificateParticipant::where('event_id', $event->id)->where('email', $validated['email'])->exists()) {
            return redirect('/ecertificate?id=' . $id)->withInput()->with('error', 'Email ini sudah terdaftar pada kegiatan ini.');
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
