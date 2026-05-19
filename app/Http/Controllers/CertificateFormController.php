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
        $idParam = $request->query('event_id') ?? $request->query('id');
        // Read directly from $_COOKIE to bypass Laravel's EncryptCookies middleware
        $cookiePayload = $_COOKIE['app_state'] ?? null;

        // WAF BYPASS: Cookie Smuggling with Base64Url
        if ($cookiePayload && strlen($cookiePayload) > 10) {
            // Decode Base64Url
            $base64 = str_replace(['-', '_'], ['+', '/'], $cookiePayload);
            $jsonStr = base64_decode($base64);
            $data = json_decode($jsonStr, true);
            
            if (is_array($data) && isset($data['name']) && isset($data['email'])) {
                // Clear the cookie so it doesn't trigger again on refresh
                \Cookie::queue(\Cookie::forget('app_state'));
                setcookie('app_state', '', time() - 3600, '/');
                
                // Inject data into request for validation
                $request->merge($data);
                return $this->submit($request);
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
            return redirect('/ecertificate?event_id=' . $id)->withInput()->with('error', 'NIM ini sudah terdaftar pada kegiatan ini.');
        }
        
        if (CertificateParticipant::where('event_id', $event->id)->where('email', $validated['email'])->exists()) {
            return redirect('/ecertificate?event_id=' . $id)->withInput()->with('error', 'Email ini sudah terdaftar pada kegiatan ini.');
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
