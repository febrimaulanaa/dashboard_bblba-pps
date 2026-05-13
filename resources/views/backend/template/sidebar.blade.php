<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{ Request::segment(2) == '' ? 'active' : '' }}">
                    <a href="/admin301097">
                        <i class="fas fa-home"></i>
                        <p>Menu Utama</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sertifikat">
                        <i class="fas fa-layer-group"></i>
                        <p>Sertifikat</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sertifikat">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::segment(2) == 'osmb' ? 'active' : '' }}">
                                <a href="/admin301097/osmb">
                                    <span class="sub-item">OSMB</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) == 'pkbjj' ? 'active' : '' }}">
                                <a href="/admin301097/pkbjj">
                                    <span class="sub-item">PKBJJ</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) == 'wtku' ? 'active' : '' }}">
                                <a href="/admin301097/wtku">
                                    <span class="sub-item">Workshop Tugas & KU</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) == 'seminar' ? 'active' : '' }}">
                                <a href="/admin301097/seminar">
                                    <span class="sub-item">Seminar Akademik</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#lpkbjj">
                        <i class="fas fa-calendar"></i>
                        <p>LPKBJJ</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="lpkbjj">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::segment(2) == 'jadwalpkbjj' ? 'active' : '' }}">
                                <a href="/admin301097/jadwalpkbjj">
                                    <span class="sub-item">Jadwal PKBJJ</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#wisuda">
                        <i class="fas fa-graduation-cap"></i>
                        <p>Wisuda Daerah</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="wisuda">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::segment(2) == 'wisuda' ? 'active' : '' }}">
                                <a href="/admin301097/wisuda">
                                    <span class="sub-item">Nomor Urut Wisuda</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#tuweb">
                        <i class="fas fa-clock"></i>
                        <p>TTM & Tuweb</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tuweb">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::segment(2) == 'tuweb' ? 'active' : '' }}">
                                <a href="/admin301097/tuweb">
                                    <span class="sub-item">Jadwal TTM & Tuweb</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sertifikat-sistem">
                        <i class="fas fa-certificate"></i>
                        <p>Sistem Sertifikat</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sertifikat-sistem">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::segment(2) == 'sistem-sertifikat' && Request::segment(3) == '' ? 'active' : '' }}">
                                <a href="/admin301097/sistem-sertifikat">
                                    <span class="sub-item">Dashboard</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) == 'sistem-sertifikat' && Request::segment(3) == 'events' ? 'active' : '' }}">
                                <a href="/admin301097/sistem-sertifikat/events">
                                    <span class="sub-item"> Kegiatan</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) == 'sistem-sertifikat' && Request::segment(3) == 'templates' ? 'active' : '' }}">
                                <a href="/admin301097/sistem-sertifikat/templates">
                                    <span class="sub-item">Template Sertifikat</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) == 'sistem-sertifikat' && Request::segment(3) == 'participants' ? 'active' : '' }}">
                                <a href="/admin301097/sistem-sertifikat/participants">
                                    <span class="sub-item">Data Peserta</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#pegawai">
                        <i class="fas fa-users"></i>
                        <p>Pegawai & Absensi</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="pegawai">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::segment(2) == 'users' ? 'active' : '' }}">
                                <a href="/admin301097/users">
                                    <span class="sub-item">Manajemen Pegawai</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) == 'absensi' ? 'active' : '' }}">
                                <a href="/admin301097/absensi">
                                    <span class="sub-item">Data Absensi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->