<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<style>
    :root{
        --sidebar-collapsed-width: 6.5rem;
        --sidebar-expanded-width: 16rem;
    }
    .sidebar { transition: width 0.25s ease; width: var(--sidebar-collapsed-width); }
    .sidebar.expanded{ width: var(--sidebar-expanded-width); }
    .nav-text { transition: opacity 0.15s ease, transform 0.15s ease; }
    .sidebar .nav-text{ opacity:1; }
    .sidebar.collapsed .nav-text{ opacity:0; transform:translateX(-8px); pointer-events:none; position:absolute; }
    aside.sidebar { z-index:50; top:0; left:0; height:100vh; position:fixed; }

    /* NEW: layout nav item with icon above text */
    .nav-item{
        display:flex;
        flex-direction:column;
        align-items:center;
        gap:0.25rem;
        padding:0.5rem 0.75rem;
    }
    .nav-item img.icon-img{
        width:1.25rem;
        height:1.25rem;
        object-fit:contain;
        display:block;
    }
    .nav-item .nav-text{
        font-size:0.75rem;
        line-height:1;
        text-align:center;
        white-space:nowrap;
        display:block;
    }

    /* Hide logout text saat collapsed */
    .logout-item .nav-text {
        opacity: 0;
        pointer-events: none;
        position: absolute;
    }
    .sidebar.expanded .logout-item .nav-text {
        opacity: 1;
        pointer-events: auto;
        position: static;
    }
</style>

<aside class="sidebar group bg-gradient-to-b from-red-700 to-red-800 text-white flex flex-col overflow-hidden">
    <div class="border-b border-white py-6 px-4 flex flex-col items-center min-h-[120px]">
        <img src="{{ asset('gambar/orang_putih.webp') }}" alt="avatar" class="w-12 h-12 rounded-sm mb-2">
        <h3 class="nav-text text-sm font-semibold">Admin</h3>
    </div>

    <nav class="flex-1 py-4 space-y-1 px-2">
        <a href="{{ route('dashboard.guru') }}" class="nav-item hover:bg-white/10 rounded">
            <img src="{{ asset('gambar/rumah.webp') }}" alt="rumah" class="icon-img">
            <span class="nav-text">Dashboard</span>
        </a>

        <a href="{{ route('siswa.index') }}" class="nav-item hover:bg-white/10 rounded">
            <img src="{{ asset('gambar/org_lulus.webp') }}" alt="lulus" class="icon-img">
            <span class="nav-text">Data Siswa</span>
        </a>

        <a href="{{ route('guru.dapim') }}" class="nav-item hover:bg-white/10 rounded">
             <img src="{{ asset('gambar/org_ppn_tls.webp') }}" alt="papan tulis" class="icon-img">
            <span class="nav-text">Data Pembina</span>
        </a>

        <a href="{{ route('eskul.index') }}" class="nav-item hover:bg-white/10 rounded">
            <img src="{{ asset('gambar/coin.webp') }}" alt="koin" class="icon-img">
            <span class="nav-text">Data Eskul</span>
        </a>

        <a href="{{ route('guru.absensi') }}" class="nav-item hover:bg-white/10 rounded">
           <img src="{{ asset('gambar/org.webp') }}" alt="rumah" class="icon-img">
           <span class="nav-text">Absensi</span>
        </a>

        <a href="{{ route('guru.prestasi.verifikasi') }}" class="nav-item hover:bg-white/10 rounded">
            <svg class="icon-img" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="20" height="20"><path d="M12 2l3 7h7l-5.5 4.1L20 22l-8-5-8 5 1.5-8.9L0 9h7l3-7z" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span class="nav-text">Verifikasi Prestasi</span>
        </a>
    </nav>

    <div class="p-4 border-t border-white/10">
        <a href="{{ route('logout') }}" class="logout-item nav-item hover:bg-white/10 rounded">
             <img src="{{ asset('gambar/keluar.webp') }}" alt="keluar" class="icon-img">
            <span class="nav-text">Keluar</span>
        </a>
    </div>
</aside>

<script>
    (function(){
        const aside = document.querySelector('aside.sidebar');
        if(!aside) return;
        aside.addEventListener('mouseenter', ()=> aside.classList.add('expanded'));
        aside.addEventListener('mouseleave', ()=> aside.classList.remove('expanded'));
    })();
</script>