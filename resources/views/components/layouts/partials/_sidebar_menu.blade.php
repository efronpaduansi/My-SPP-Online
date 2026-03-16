<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="sidebar-link">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @if (Auth::user()->role_id == 1)
            <li
                class="sidebar-item has-sub {{ request()->is('kelas') || request()->is('tahun-ajaran') || request()->is('semester') ? 'active' : '' }}">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Akademik</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item {{ request()->is('kelas') ? 'active' : '' }}">
                        <a href="{{ route('kelas.index') }}" class="submenu-link">Kelas</a>
                    </li>

                    <li class="submenu-item {{ request()->is('tahun-ajaran') ? 'active' : '' }}">
                        <a href="{{ route('ta.index') }}" class="submenu-link">Tahun Ajaran</a>
                    </li>

                    <li class="submenu-item {{ request()->is('semester') ? 'active' : '' }}">
                        <a href="{{ route('semester.index') }}" class="submenu-link">Semester</a>
                    </li>
                </ul>
            </li>

            <li
                class="sidebar-item has-sub  {{ request()->is('siswa') || request()->is('siswa/create') || request()->is('siswa/edit/{any}') || request()->is('level') ? 'active' : '' }}">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-user-graduate"></i>
                    <span>Siswa</span>
                </a>
                <ul class="submenu">
                    <li
                        class="submenu-item {{ request()->is('siswa') || request()->is('siswa/create') ? 'active' : '' }}">
                        <a href="{{ route('siswa.index') }}" class="submenu-link">Data Siswa</a>
                    </li>

                    <li class="submenu-item {{ request()->is('level') ? 'active' : '' }}">
                        <a href="{{ route('level.index') }}" class="submenu-link">Level</a>
                    </li>

                </ul>
            </li>
        @endif

        <li
            class="sidebar-item has-sub {{ request()->is('invoice') || request()->is('invoice/create') || request()->is('payment') ? 'active' : '' }}">
            <a href="#" class="sidebar-link">
                <i class="fas fa-university"></i>
                <span>Keuangan</span>
            </a>
            <ul class="submenu">
                <li
                    class="submenu-item {{ request()->is('invoice') || request()->is('invoice/create') ? 'active' : '' }}">
                    <a href="{{ route('invoice.index') }}" class="submenu-link">Tagihan</a>
                </li>

                <li class="submenu-item {{ request()->is('payment') ? 'active' : '' }}">
                    <a href="{{ route('payment.index') }}" class="submenu-link">Pembayaran</a>
                </li>

            </ul>
        </li>
        <li class="sidebar-item {{ request()->is('pendapatan') ? 'active' : '' }}">
            <a href="{{ route('pendapatan.index') }}" class="sidebar-link">
                <i class="fas fa-wallet"></i>
                <span>Pendapatan</span>
            </a>
        </li>
        @if (Auth::user()->role_id == 1)
            <li class="sidebar-item {{ request()->is('staff') ? 'active' : '' }}">
                <a href="{{ route('staff.index') }}" class="sidebar-link">
                    <i class="fas fa-users"></i>
                    <span>Data User</span>
                </a>
            </li>

            {{-- <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="fas fa-sliders-h"></i>
                            <span>Preferensi</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="{{ route('profile.index') }}" class="submenu-link">Profil</a>
                            </li>

                            <li class="submenu-item">
                                <a href="{{ route('staff.index') }}" class="submenu-link">Staf</a>
                            </li>

                        </ul>
                    </li> --}}
        @endif
        <li class="sidebar-item">
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger ms-3 px-5 mt-2"
                    onclick="return confirm('Anda yakin keluar dari aplikasi?')"><i class="fas fa-power-off"></i>
                    Logout</button>
            </form>
        </li>

    </ul>
</div>
