<aside class="sidebar sidebarg">
    <div class="heading">
        <div class="icon">🎓</div>
        <h3>Guru / Admin</h3>
    </div>

    <nav>
        <a href="{{ route('dashboard.guru') }}" 
           class="{{ request()->routeIs('dashboard.guru') ? 'active' : '' }}">
           Dashboard
        </a>

        <a href="{{ route('siswa.index') }}" 
           class="{{ request()->is('siswa*') ? 'active' : '' }}">
           Data Siswa
        </a>

        <a href="{{ route('guru.dapim') }}" 
           class="{{ request()->routeIs('guru.dapim') ? 'active' : '' }}">
           Data Pembina
        </a>

        <a href="{{ route('eskul.index') }}" 
           class="{{ request()->is('eskul*') ? 'active' : '' }}">
           Data Ekskul
        </a>

        <a href="{{ route('guru.absensi') }}" 
           class="{{ request()->routeIs('guru.absensi') ? 'active' : '' }}">
            Absensi Siswa
        </a>

        <a href="{{ route('guru.prestasi.verifikasi') }}" 
           class="{{ request()->routeIs('guru.prestasi.verifikasi') ? 'active' : '' }}">
            Verifikasi Prestasi
        </a>
    </nav>

    <div class="logout">
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" style="background:none;border:none;padding:0;cursor:pointer;">
                Logout
            </button>
        </form>
    </div>
</aside>
