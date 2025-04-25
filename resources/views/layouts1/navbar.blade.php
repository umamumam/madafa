<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="#" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <img src="{{ asset('kopma.png') }}" alt="Logo" style="width: 210px; height: auto;">
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item">
                    <a href="{{ (Auth::check() && Auth::user()->role === 'siswa') ? url('/profil') : url('/dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-home"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>
                @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'super admin'))
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-list"></i></span>
                        <span class="pc-mtext">Manajemen Sistem</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="/kelas">Kelas</a></li>
                        <li class="pc-item"><a class="pc-link" href="/tahun">Tahun Pelajaran</a></li>
                        <li class="pc-item"><a class="pc-link" href="/mapel">Mata Pelajaran</a></li>
                        <li class="pc-item"><a class="pc-link" href="/jabatan">Jabatan</a></li>
                        <li class="pc-item"><a class="pc-link" href="/kompetensi">Kompetensi KDUM</a></li>
                        <li class="pc-item"><a class="pc-link" href="/ekstrakurikuler">Ekstrakurikuler</a></li>
                    </ul>
                </li>
                @endif
                @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'super admin'))
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-list"></i></span>
                        <span class="pc-mtext">Manajemen PPDB</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="/ujian">Tanggal Ujian</a></li>
                    </ul>
                </li>
                @endif

                <li class="pc-item pc-caption">
                    <label>Dafatar Menu</label>
                    <i class="ti ti-dashboard"></i>
                </li>
                @if(Auth::check() && in_array(Auth::user()->role, ['admin', 'super admin', 'guru']))
                <li class="pc-item">
                    <a href="/siswas" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-users"></i></span>
                        <span class="pc-mtext">Siswa</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="/gurus" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-school"></i></span>
                        <span class="pc-mtext">Guru</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="/kdum" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                        <span class="pc-mtext">KDUM</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="/rapor-lokal" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                        <span class="pc-mtext">Rapor</span>
                    </a>
                </li>
                @endif
                @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'super admin'))
                <li class="pc-item">
                    <a href="/penyemak" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-clipboard-list"></i></i></span>
                        <span class="pc-mtext">Penyemak</span>
                    </a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role === 'super admin')
                <li class="pc-item">
                    <a href="/users" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-shield-lock"></i></i></span>
                        <span class="pc-mtext">Manajemen User</span>
                    </a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role === 'siswa')
                <li class="pc-item">
                    <a href="{{ route('kdum.saya') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-file-certificate"></i></span>
                        <span class="pc-mtext">KDUM Saya</span>
                    </a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role === 'siswa')
                <li class="pc-item">
                    <a href="{{ route('rapor-lokal.siswa') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-file-certificate"></i></span>
                        <span class="pc-mtext">Rapor Saya</span>
                    </a>
                </li>
                @endif

                {{-- <li class="pc-item pc-caption">
                    <label>Pages</label>
                    <i class="ti ti-news"></i>
                </li>
                <li class="pc-item">
                    <a href="../pages/login.html" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-lock"></i></span>
                        <span class="pc-mtext">Login</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="../pages/register.html" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user-plus"></i></span>
                        <span class="pc-mtext">Register</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Other</label>
                    <i class="ti ti-brand-chrome"></i>
                </li>
                <li class="pc-item">
                    <a href="../other/sample-page.html" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-brand-chrome"></i></span>
                        <span class="pc-mtext">Sample page</span>
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
