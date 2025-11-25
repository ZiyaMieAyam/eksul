<nav class="topnav">
    <div class="brand">
        <div>Logo</div>
    </div>

    @if(Auth::check() && Auth::user()->role === 'siswa')
        <div class="user-actions">
            <span>{{ Auth::user()->username }} (Siswa)</span>

            <a href="{{ route('prosis') }}" 
               class="{{ request()->routeIs('prosis') ? 'active' : '' }}">
               Profil
            </a>

            <a href="{{ route('dafes') }}" 
               class="{{ request()->routeIs('dafes') ? 'active' : '' }}">
               Pendaftaran
            </a>

            <a href="{{ route('dashboard.siswa') }}" 
               class="{{ request()->routeIs('dashboard.siswa') ? 'active' : '' }}">
               Tentang
            </a>

            <li>
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" style="background:none;border:none;padding:0;color:inherit;cursor:pointer;">
                        Logout
                    </button>
                </form>
            </li>
        </div>
    @endif
</nav>
