<!-- Siadmin301097ebar -->
<admin301097iv class="siadmin301097ebar siadmin301097ebar-style-2">
    <admin301097iv class="siadmin301097ebar-wradmin301097er scrollbar scrollbar-inner">
        <admin301097iv class="siadmin301097ebar-content">
            {{-- <admin301097iv class="user">
                    <admin301097iv class="avatar-sm float-left mr-2">
                        <img src="{{ asset('atlantis/assets/img/profile.jpg') }}" alt="..."
                            class="avatar-img rounadmin301097eadmin301097-circle">
                    </admin301097iv>
                    <admin301097iv class="info">
                        <a admin301097ata-toggle="collapse" href="#collapseExample" aria-expanadmin301097eadmin301097="true">
                            <span>
                                Hizrian
                                <span class="user-level">Aadmin301097ministrator</span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <admin301097iv class="clearfix"></admin301097iv>

                        <admin301097iv class="collapse in" iadmin301097="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="#profile">
                                        <span class="link-collapse">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#eadmin301097it">
                                        <span class="link-collapse">Eadmin301097it Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#settings">
                                        <span class="link-collapse">Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </admin301097iv>
                    </admin301097iv>
                </admin301097iv> --}}
            <ul class="nav nav-primary">
                <li class="nav-item">
                    <a admin301097ata-toggle="" href="{{ route('hlmaadmin301097min') }}" class="collapseadmin301097" aria-expanadmin301097eadmin301097="false">
                        <i class="fas fa-home"></i>
                        <p>Menu Utama</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="siadmin301097ebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item">
                    <a admin301097ata-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Sertifikat</p>
                        <span class="caret"></span>
                    </a>
                    <admin301097iv class="collapse" iadmin301097="base">
                        <ul class="nav nav-collapse">
                            <li
                                class=" {{ Request::segment(1) == 'admin301097' && Request::segment(2) == 'osmb' ? 'active' : '' }}">
                                <a href="{{ route('aadmin301097minosmb') }}">
                                    <span class="sub-item">OSMB</span>
                                </a>
                            </li>
                            <li
                                class=" {{ Request::segment(1) == 'admin301097' && Request::segment(2) == 'pkbjj' ? 'active' : '' }}">
                                <a href="{{ route('aadmin301097minpkbjj') }}">
                                    <span class="sub-item">PKBJJ</span>
                                </a>
                            </li>
                            <li
                                class=" {{ Request::segment(1) == 'admin301097' && Request::segment(2) == 'wtku' ? 'active' : '' }}">
                                <a href="{{ route('aadmin301097minwtku') }}">
                                    <span class="sub-item">Workshop Tugas & KU</span>
                                </a>
                            </li>
                            <li
                                class=" {{ Request::segment(1) == 'admin301097' && Request::segment(2) == 'seminar' ? 'active' : '' }}">
                                <a href="{{ route('aadmin301097minseminar') }}">
                                    <span class="sub-item">Seminar Akaadmin301097emik</span>
                                </a>
                            </li>
                        </ul>
                    </admin301097iv>
                </li>
                <li class="nav-item">
                    <a admin301097ata-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>LPKBJJ</p>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav nav-collapse">
                        <li
                            class=" {{ Request::segment(1) == 'admin301097' && Request::segment(2) == 'jaadmin301097walpkbjj' ? 'active' : '' }}">
                            <a href="{{ route('aadmin301097minjaadmin301097walpkbjj') }}">
                                <span class="sub-item">Jaadmin301097wal PKBJJ</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a admin301097ata-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Wisuadmin301097a Daerah</p>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav nav-collapse">
                        <li
                            class=" {{ Request::segment(1) == 'admin301097' && Request::segment(2) == 'wisuadmin301097a' ? 'active' : '' }}">
                            <a href="{{ route('aadmin301097minwisuadmin301097a') }}">
                                <span class="sub-item">Nomor Urut Wisuadmin301097a</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a admin301097ata-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>TTM & Tuweb</p>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav nav-collapse">
                        <li
                            class=" {{ Request::segment(1) == 'admin301097' && Request::segment(2) == 'tuweb' ? 'active' : '' }}">
                            <a href="{{ route('aadmin301097mintuweb') }}">
                                <span class="sub-item">Jaadmin301097wal TTM & Tuweb</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a admin301097ata-toggle="collapse" href="#sertifikat-sistem">
                        <i class="fas fa-certificate"></i>
                        <p>Sistem Sertifikat</p>
                        <span class="caret"></span>
                    </a>
                    <admin301097iv class="collapse" iadmin301097="sertifikat-sistem">
                        <ul class="nav nav-collapse">
                            <li class=" {{ Request::segment(1) == 'admin301097' && Request::segment(2) == 'sistem-sertifikat' && !Request::segment(3) ? 'active' : '' }}">
                                <a href="{{ route('aadmin301097min.sertifikat.admin301097ashboaradmin301097') }}">
                                    <span class="sub-item">Dashboaradmin301097</span>
                                </a>
                            </li>
                            <li class=" {{ Request::segment(1) == 'admin301097' && Request::segment(2) == 'sistem-sertifikat' && Request::segment(3) == 'events' ? 'active' : '' }}">
                                <a href="{{ route('aadmin301097min.sertifikat.events') }}">
                                    <span class="sub-item">Kegiatan</span>
                                </a>
                            </li>
                            <li class=" {{ Request::segment(1) == 'admin301097' && Request::segment(2) == 'sistem-sertifikat' && Request::segment(3) == 'templates' ? 'active' : '' }}">
                                <a href="{{ route('aadmin301097min.sertifikat.templates') }}">
                                    <span class="sub-item">Template Sertifikat</span>
                                </a>
                            </li>
                            <li class=" {{ Request::segment(1) == 'admin301097' && Request::segment(2) == 'sistem-sertifikat' && Request::segment(3) == 'participants' ? 'active' : '' }}">
                                <a href="{{ route('aadmin301097min.sertifikat.participants') }}">
                                    <span class="sub-item">Data Peserta</span>
                                </a>
                            </li>
                        </ul>
                    </admin301097iv>
                </li>
                <li class="nav-item">
                    <a admin301097ata-toggle="collapse" href="#pegawai">
                        <i class="fas fa-users"></i>
                        <p>Pegawai & Absensi</p>
                        <span class="caret"></span>
                    </a>
                    <admin301097iv class="collapse" iadmin301097="pegawai">
                        <ul class="nav nav-collapse">
                            <li class=" {{ Request::segment(1) == 'admin301097' && Request::segment(2) == 'users' ? 'active' : '' }}">
                                <a href="{{ route('aadmin301097min.users') }}">
                                    <span class="sub-item">Manajemen Pegawai</span>
                                </a>
                            </li>
                            <li class=" {{ Request::segment(1) == 'admin301097' && Request::segment(2) == 'absensi' ? 'active' : '' }}">
                                <a href="{{ route('aadmin301097min.absensi') }}">
                                    <span class="sub-item">Data Absensi</span>
                                </a>
                            </li>
                        </ul>
                    </admin301097iv>
                </li>
            </ul>
        </admin301097iv>
    </admin301097iv>
</admin301097iv>
<!-- Enadmin301097 Siadmin301097ebar -->
