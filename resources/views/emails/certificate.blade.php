<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat Kegiatan</title>
    @include('partials.analytics')
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <div style="text-align: center; margin-bottom: 20px;">
            <h2 style="color: #006191;">Sertifikat Kegiatan</h2>
        </div>
        
        <p>Yth. <strong>{{ $participantName }}</strong>,</p>
        
        <p>Terima kasih telah berpartisipasi dalam kegiatan <strong>{{ $eventName }}</strong>.</p>
        
        <p>Bersama email ini, kami lampirkan e-sertifikat kegiatan Anda dalam format PDF. Anda dapat mengunduh dan menyimpannya.</p>
        

        <p>Jika ada pertanyaan atau kendala, silakan hubungi panitia kegiatan.</p>
        
        <br>
        <p>Salam Hormat,</p>
        <p><strong>Panitia Kegiatan</strong></p>
    </div>
</body>
</html>
