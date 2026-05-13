<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrder scrollbar scrollbar-inner">
        <div class="sidebar-content">
            {{-- <div class="user">
                    <div class="avatar-sm float-left mr-2">
                        <img src="{{ asset('atlantis/assets/img/profile.jpg') }}" alt="..."
                            class="avatar-img rounded-circle">
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                Hizrian
                                <span class="user-level">Administrator</span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse in" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="#profile">
                                        <span class="link-collapse">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#edit">
                                        <span class="link-collapse">Edit Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#settings">
                                        <span class="link-collapse">Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
            <ul class="nav nav-primary">
                <li class="nav-item">
                    <a data-toggle="" href="{{ route('hlmadmin') }}" class="collapsed" aria-expanded="false">
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
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Sertifikat</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li
                                class=" {{ Request::segment(1) == 'd' && Request::segment(2) == 'osmb' ? 'active' : '' }}">
                                <a href="{{ route('adminosmb') }}">
                                    <span class="sub-item">OSMB</span>
                                </a>
                            </li>
                            <li
                                class=" {{ Request::segment(1) == 'd' && Request::segment(2) == 'pkbjj' ? 'active' : '' }}">
                                <a href="{{ route('adminpkbjj') }}">
                                    <span class="sub-item">PKBJJ</span>
                                </a>
                            </li>
                            <li
                                class=" {{ Request::segment(1) == 'd' && Request::segment(2) == 'wtku' ? 'active' : '' }}">
                                <a href="{{ route('adminwtku') }}">
                                    <span class="sub-item">Workshop Tugas & KU</span>
                                </a>
                            </li>
                            <li
                                class=" {{ Request::segment(1) == 'd' && Request::segment(2) == 'seminar' ? 'active' : '' }}">
                                <a href="{{ route('adminseminar') }}">
                                    <span class="sub-item">Seminar Akademik</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>LPKBJJ</p>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav nav-collapse">
                        <li
                            class=" {{ Request::segment(1) == 'd' && Request::segment(2) == 'jadwalpkbjj' ? 'active' : '' }}">
                            <a href="{{ route('adminjadwalpkbjj') }}">
                                <span class="sub-item">Jadwal PKBJJ</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Wisuda Daerah</p>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav nav-collapse">
                        <li
                            class=" {{ Request::segment(1) == 'd' && Request::segment(2) == 'wisuda' ? 'active' : '' }}">
                            <a href="{{ route('adminwisuda') }}">
                                <span class="sub-item">Nomor Urut Wisuda</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>TTM & Tuweb</p>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav nav-collapse">
                        <li
                            class=" {{ Request::segment(1) == 'd' && Request::segment(2) == 'tuweb' ? 'active' : '' }}">
                            <a href="{{ route('admintuweb') }}">
                                <span class="sub-item">Jadwal TTM & Tuweb</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sertifikat-sistem">
                        <i class="fas fa-certificate"></i>
                        <p>Sistem Sertifikat</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sertifikat-sistem">
                        <ul class="nav nav-collapse">
                            <li class=" {{ Request::segment(1) == 'd' && Request::segment(2) == 'sistem-sertifikat' && !Request::segment(3) ? 'active' : '' }}">
                                <a href="{{ route('admin.sertifikat.dashboard') }}">
                                    <span class="sub-item">Dashboard</span>
                                </a>
                            </li>
                            <li class=" {{ Request::segment(1) == 'd' && Request::segment(2) == 'sistem-sertifikat' && Request::segment(3) == 'events' ? 'active' : '' }}">
                                <a href="{{ route('admin.sertifikat.events') }}">
                                    <span class="sub-item">Kegiatan</span>
                                </a>
                            </li>
                            <li class=" {{ Request::segment(1) == 'd' && Request::segment(2) == 'sistem-sertifikat' && Request::segment(3) == 'templates' ? 'active' : '' }}">
                                <a href="{{ route('admin.sertifikat.templates') }}">
                                    <span class="sub-item">Template Sertifikat</span>
                                </a>
                            </li>
                            <li class=" {{ Request::segment(1) == 'd' && Request::segment(2) == 'sistem-sertifikat' && Request::segment(3) == 'participants' ? 'active' : '' }}">
                                <a href="{{ route('admin.sertifikat.participants') }}">
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
                            <li class=" {{ Request::segment(1) == 'd' && Request::segment(2) == 'users' ? 'active' : '' }}">
                                <a href="{{ route('admin.users') }}">
                                    <span class="sub-item">Manajemen Pegawai</span>
                                </a>
                            </li>
                            <li class=" {{ Request::segment(1) == 'd' && Request::segment(2) == 'absensi' ? 'active' : '' }}">
                                <a href="{{ route('admin.absensi') }}">
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
