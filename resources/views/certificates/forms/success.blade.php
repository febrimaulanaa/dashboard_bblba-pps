@extends('layouts.certificate')
@section('title', 'Pendaftaran Berhasil')

@section('content')
<div class="card mb-4 text-center">
    <div class="top-accent"></div>
    <div class="card-body p-5">
        <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#198754" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
        </div>
        <h2 class="h3 mb-3">Pendaftaran Berhasil!</h2>
        <p class="text-muted mb-4">Terima kasih <strong>{{ $participant->name }}</strong> telah mengisi formulir kegiatan <strong>{{ $event->name }}</strong>.</p>
        
        <div class="alert alert-info d-inline-block text-start mb-4">
            <h5 class="alert-heading text-center mb-2">Nomor Sertifikat Anda:</h5>
            <p class="mb-0 text-center fw-bold fs-4">{{ $participant->certificate_number }}</p>
        </div>
        
        <p class="text-muted">Sistem kami sedang membuat sertifikat Anda dan akan mengirimkannya secara otomatis ke email <strong>{{ $participant->email }}</strong> dalam beberapa menit.</p>
        <p class="text-muted small">Jika Anda belum menerimanya dalam waktu 1 jam, mohon periksa folder SPAM atau hubungi admin.</p>
        
        <div class="mt-4">
            <a href="/" class="btn btn-outline-secondary">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
