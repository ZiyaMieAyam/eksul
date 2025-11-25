<aside class="sidebar sidebarp">
    <div class="heading">
        <div class="icon">🏅</div>
        <h3>Pembina</h3>
    </div>

    <nav>
        <a href="{{ route('dashboard.pembina') }}"
           class="{{ request()->routeIs('dashboard.pembina') ? 'active' : '' }}">
           Dashboard
        </a>

        <a href="{{ route('pendaftaran.index') }}"
           class="{{ request()->is('pendaftaran*') ? 'active' : '' }}">
           Data Pendaftaran
        </a>

        <a href="{{ route('pembina.index') }}"
           class="{{ request()->is('pembina*') ? 'active' : '' }}">
           Data Pembina
        </a>

        <a href="{{ route('aktivitas.index') }}"
           class="{{ request()->is('aktivitas*') ? 'active' : '' }}">
           Data Aktivitas Eskul
        </a>

        <a href="{{ route('kehadiran.index') }}"
           class="{{ request()->is('kehadiran*') ? 'active' : '' }}">
           Absensi Siswa
        </a>

        <a href="{{ route('prestasi.index') }}"
           class="{{ request()->is('prestasi*') ? 'active' : '' }}">
           Data Prestasi
        </a>
    </nav>

    <div class="logout">
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" style="background:none;border:none;padding:0;cursor:pointer;">
                Keluar
            </button>
        </form>
    </div>
</aside>
