<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Menu Utama</li>
        <li class="nav-item active">
            <a class="nav-link {{ request()->is('home') ? '' : 'collapsed'}}" href="{{ route('home')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        @if (auth()->user()->role_id == 1)

        <li class="nav-item">
            <a class="nav-link {{ request()->is('emergency*') ? '' : 'collapsed'}}"
                href="{{ route('emergency.index')}}">
                <i class="bi bi-exclamation-diamond"></i>
                <span>UGD</span>
            </a>
        </li><!-- End Emergency Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('room*') ? '' : 'collapsed'}}" href="{{ route('room.index')}}">
                <i class="bi bi-shield-plus"></i>
                <span>Perawatan</span>
            </a>
        </li><!-- End Room Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('laboratory*') ? '' : 'collapsed'}}"
                href="{{ route('laboratory.index')}}">
                <i class="bi bi-building-add"></i>
                <span>Laboratorium</span>
            </a>
        </li><!-- End laboratory Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('action*') ? '' : 'collapsed'}}" href="{{ route('action.index')}}">
                <i class="bi bi-universal-access"></i>
                <span>Tindakan</span>
            </a>
        </li><!-- End action Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('tool*') ? '' : 'collapsed'}}" href="{{ route('tool.index')}}">
                <i class="bi bi-tools"></i>
                <span>Peralatan</span>
            </a>
        </li><!-- End tool Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('medicine*') ? '' : 'collapsed'}}" href="{{ route('medicine.index')}}">
                <i class="bi bi-capsule"></i>
                <span>Obta- Obatan</span>
            </a>
        </li><!-- End medicine Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('suport*') ? '' : 'collapsed'}}" href="{{ route('suport.index')}}">
                <i class="bi bi-heart-pulse"></i>
                <span>Pemeriksaan Penunjang</span>
            </a>
        </li><!-- End suport Nav -->

        <li class="nav-heading">Laporan</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('pasien')  ? '' : 'collapsed' }}" href="{{ route('pasien.index')}}">
                <i class="bi bi-journal-text"></i>
                <span>Data Pasien</span>
            </a>
        </li><!-- End Data Pasien Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('report') && request()->query('unit') === 'a' ? '' : 'collapsed' }}"
                href="{{ route('report.index')}}?unit=a">
                <i class="bi bi-journal-text"></i>
                <span>Nota Rawat Jalan</span>
            </a>
        </li><!-- End Data Nota Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('report') && request()->query('unit') === 'b' ? '' : 'collapsed' }}"
                href="{{ route('report.index')}}?unit=b">
                <i class="bi bi-journal-text"></i>
                <span>Nota Rawat Inap</span>
            </a>
        </li><!-- End Data Nota Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('report') && request()->query('unit') === 'c' ? '' : 'collapsed' }}"
                href="{{ route('report.index')}}?unit=c">
                <i class="bi bi-journal-text"></i>
                <span>Nota PONED</span>
            </a>
        </li><!-- End Data Nota Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('report') && request()->query('unit') === 'd' ? '' : 'collapsed' }}"
                href="{{ route('report.index')}}?unit=d">
                <i class="bi bi-journal-text"></i>
                <span>Nota UGD</span>
            </a>
        </li><!-- End Data Nota Nav -->

        @endif

        <li class="nav-heading">Buat Nota</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('note') && request()->query('unit') === 'a' ? '' : 'collapsed' }}"
                href="{{ route('note.index')}}?unit=a">
                <i class="bi bi-clipboard2-pulse"></i>
                <span>Rawat Jalan</span>
            </a>
        </li><!-- End suport Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('note') && request()->query('unit') === 'b' ? '' : 'collapsed' }}"
                href="{{ route('note.index')}}?unit=b">
                <i class="bi bi-building"></i>
                <span>Rawat Inap</span>
            </a>
        </li><!-- End suport Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('note') && request()->query('unit') === 'c' ? '' : 'collapsed' }}"
                href="{{ route('note.index')}}?unit=c">
                <i class="bi bi-person-gear"></i>
                <span>PONED</span>
            </a>
        </li><!-- End suport Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('note') && request()->query('unit') === 'd' ? '' : 'collapsed' }}"
                href="{{ route('note.index')}}?unit=d">
                <i class="bi bi-person-gear"></i>
                <span>UGD</span>
            </a>
        </li><!-- End suport Nav -->

    </ul>

</aside><!-- End Sidebar-->