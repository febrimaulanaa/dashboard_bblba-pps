<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Helvetica', 'Arial', sans-serif;
        }
        @page {
            margin: 0px;
        }
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .content {
            position: relative;
            width: 100%;
            height: 100%;
        }
        .name {
            position: absolute;
            top: {{ $settings['name_y'] ?? '350' }}px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: {{ $settings['name_size'] ?? '40' }}px;
            font-weight: bold;
            color: {{ $settings['name_color'] ?? '#000000' }};
        }
        .event {
            position: absolute;
            top: {{ $settings['event_y'] ?? '450' }}px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: {{ $settings['event_size'] ?? '24' }}px;
            color: {{ $settings['event_color'] ?? '#333333' }};
        }
        .qrcode {
            position: absolute;
            bottom: {{ $settings['qr_bottom'] ?? '50' }}px;
            left: {{ $settings['qr_left'] ?? '50' }}px;
        }
        .number {
            position: absolute;
            top: {{ $settings['number_y'] ?? '50' }}px;
            right: {{ $settings['number_x'] ?? '50' }}px;
            font-size: {{ $settings['number_size'] ?? '14' }}px;
            color: {{ $settings['number_color'] ?? '#555555' }};
        }
    </style>
</head>
<body>
    @if(!empty($backgroundData))
        <img src="{{ $backgroundData }}" class="background">
    @else
        <!-- Placeholder background if none provided -->
        <div class="background" style="background-color: #f0f0f0; border: 10px solid #006191; box-sizing: border-box;"></div>
    @endif

    <div class="content">
        <div class="number">No: {{ $participant->certificate_number }}</div>
        
        <div class="name">{{ $participant->name }}</div>
        
        <div class="event">{{ $event->name }}</div>
        
        @if(!empty($qrCodeBase64))
        <div class="qrcode">
            <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}" width="100" height="100">
        </div>
        @endif
    </div>
</body>
</html>
