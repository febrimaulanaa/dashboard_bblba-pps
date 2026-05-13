<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-user-graduate"></i></div>
        <div class="stat-info">
            <h3>{{ \App\Models\DataSertifMhs::count() }}</h3>
            <p>Mahasiswa PKBJJ</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-user-graduate"></i></div>
        <div class="stat-info">
            <h3>{{ \App\Models\DataSertifOSMB::count() }}</h3>
            <p>Mahasiswa OSMB</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange"><i class="fas fa-graduation-cap"></i></div>
        <div class="stat-info">
            <h3>{{ \App\Models\Wisuda::count() }}</h3>
            <p>Mahasiswa Wisuda</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-calendar"></i></div>
        <div class="stat-info">
            <h3>{{ \App\Models\JadwalTuweb::count() }}</h3>
            <p>Jadwal Tuweb</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red"><i class="fas fa-users"></i></div>
        <div class="stat-info">
            <h3>{{ \App\Models\User::count() }}</h3>
            <p>Pegawai</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon teal"><i class="fas fa-clock"></i></div>
        <div class="stat-info">
            <h3>{{ \App\Models\AbsensiPegawai::count() }}</h3>
            <p>Data Absensi</p>
        </div>
    </div>
</div>

<div class="data-card" style="margin-top: 20px;">
    <div class="data-card-header">
        <h3>Ringkasan Data</h3>
    </div>
    <div class="data-card-body">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>1</td><td>Mahasiswa PKBJJ</td><td>{{ \App\Models\DataSertifMhs::count() }}</td></tr>
                <tr><td>2</td><td>Mahasiswa OSMB</td><td>{{ \App\Models\DataSertifOSMB::count() }}</td></tr>
                <tr><td>3</td><td>Mahasiswa Seminar</td><td>{{ \App\Models\DataSertifSeminar::count() }}</td></tr>
                <tr><td>4</td><td>Mahasiswa WTKU</td><td>{{ \App\Models\DataSertifWTKU::count() }}</td></tr>
                <tr><td>5</td><td>Mahasiswa Wisuda</td><td>{{ \App\Models\Wisuda::count() }}</td></tr>
                <tr><td>6</td><td>Jadwal Tuweb</td><td>{{ \App\Models\JadwalTuweb::count() }}</td></tr>
                <tr><td>7</td><td>Jadwal PKBJJ</td><td>{{ \App\Models\JadwalPKBJJ::count() }}</td></tr>
                <tr><td>8</td><td>Pegawai</td><td>{{ \App\Models\User::count() }}</td></tr>
            </tbody>
        </table>
    </div>
</div>