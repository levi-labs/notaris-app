<ul class="nav pcoded-inner-navbar ">
    <li class="nav-item pcoded-menu-caption">
        <label>Navigation</label>
    </li>
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link "><span class="pcoded-micon"><i
                    class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
    </li>
    @if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master')
        <li class="nav-item">
            <a href="{{ route('permohonan.index') }}" class="nav-link "><span class="pcoded-micon text-white"><i
                        class="feather icon-align-justify"></i></span><span class="pcoded-mtext">Jenis
                    Permohonan</span></a>
        </li>
        <li class="nav-item">
            <a href="{{ route('layanan.index') }}" class="nav-link "><span class="pcoded-micon"><i
                        class="feather icon-file-text"></i></span><span class="pcoded-mtext">Nama Layanan
                </span></a>
        </li>
    @endif

    @if (auth()->user()->type_user == 'master')
        <li class="nav-item">
            <a href="{{ route('biaya.index') }}" class="nav-link "><span class="pcoded-micon"><i
                        class="feather icon-pie-chart   "></i></span><span class="pcoded-mtext">Biaya
                    Layanan</span></a>
        </li>
    @endif

    <li class="nav-item pcoded-hasmenu">
        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span
                class="pcoded-mtext">Layanan PPAT
            </span></a>
        <ul class="pcoded-submenu">
            <li><a href="{{ route('ppat.index') }}"> Pengajuan Layanan</a></li>
            <li><a href="{{ route('ppat.index2') }}">Pengajuan Terkonfirmasi</a></li>
            <li><a href="{{ route('ppat.index3') }}">Pengajuan Terverifikasi</a></li>
            <li><a href="{{ route('ppat.index4') }}">Selesai</a></li>
        </ul>
    </li>
    <li class="nav-item pcoded-hasmenu">
        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span
                class="pcoded-mtext">Layanan Notaris
            </span></a>
        <ul class="pcoded-submenu">
            <li><a href="{{ route('notaris.index') }}">Pengajuan Layanan</a></li>
            <li><a href="{{ route('notaris.index2') }}">Pengajuan Terkonfirmasi</a></li>
            <li><a href="{{ route('notaris.index3') }}">Pengajuan Terverifikasi</a></li>
            <li><a href="{{ route('notaris.index4') }}">Selesai</a></li>
        </ul>
    </li>
    @if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-map"></i></span><span
                    class="pcoded-mtext">Arsip
                </span></a>
            <ul class="pcoded-submenu">
                <li><a href="{{ route('arsip-ppat.index') }}">Arsip PPAT</a></li>
                <li><a href="{{ route('arsip-notaris.index') }}">Arsip Notaris</a></li>

            </ul>
        </li>
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-flag"></i></span><span
                    class="pcoded-mtext">Report
                </span></a>
            <ul class="pcoded-submenu">
                <li><a href="{{ route('report-ppat.index') }}">Report PPAT</a></li>
                <li><a href="{{ route('report-notaris.index') }}">Report Notaris</a></li>

            </ul>
        </li>
    @endif

    @if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master')
        <li class="nav-item"><a href="{{ route('user.index') }}" class="nav-link "><span class="pcoded-micon"><i
                        class="feather icon-lock"></i></span><span class="pcoded-mtext">User Management</span></a></li>
    @endif
</ul>
