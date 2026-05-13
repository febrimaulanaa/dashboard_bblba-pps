<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-calendar-check"></i></div>
        <div class="stat-info">
            <h3>{{ \App\Models\CertificateEvent::count() }}</h3>
            <p>Total Events</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-users"></i></div>
        <div class="stat-info">
            <h3>{{ \App\Models\CertificateParticipant::count() }}</h3>
            <p>Total Peserta</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange"><i class="fas fa-check-circle"></i></div>
        <div class="stat-info">
            <h3>{{ \App\Models\CertificateParticipant::where('email_sent', 1)->count() }}</h3>
            <p>Terkirim</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red"><i class="fas fa-times-circle"></i></div>
        <div class="stat-info">
            <h3>{{ \App\Models\CertificateParticipant::where('email_sent', 0)->count() }}</h3>
            <p>Belum Terkirim</p>
        </div>
    </div>
</div>

<div class="data-card" style="margin-top: 20px;">
    <div class="data-card-header">
        <h3>Menu Cepat Sistem Sertifikat</h3>
    </div>
    <div class="data-card-body">
        <div style="display: flex; flex-wrap: wrap; gap: 10px; padding: 20px;">
            <a href="#" onclick="loadPage('sistem-sertifikat-events', event)" class="btn btn-primary">Kelola Events</a>
            <a href="#" onclick="loadPage('sistem-sertifikat-templates', event)" class="btn btn-success">Template Sertifikat</a>
            <a href="#" onclick="loadPage('sistem-sertifikat-participants', event)" class="btn btn-danger">Data Peserta</a>
        </div>
    </div>
</div>