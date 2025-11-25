<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Ekstrakurikuler</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(135deg, #7f1d1d 0%, #991b1b 100%);
            color: white;
            padding: 1rem 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .menu-btn {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: background-color 0.3s;
        }

        .menu-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .header h1 {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: -280px;
            width: 280px;
            height: 100vh;
            background-color: #7f1d1d;
            color: white;
            transition: left 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-header {
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1.5rem;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: background-color 0.3s;
        }

        .close-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .admin-avatar {
            width: 80px;
            height: 80px;
            background-color: #991b1b;
            border-radius: 50%;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .sidebar-nav {
            padding: 0 1rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s;
            border: none;
            background: none;
            color: white;
            width: 100%;
            text-align: left;
            font-size: 1rem;
        }

        .nav-item:hover, .nav-item.active {
            background-color: #991b1b;
        }

        .nav-item svg {
            width: 20px;
            height: 20px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 999;
        }

        .overlay.active {
            display: block;
        }

        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
        }

        .popup-overlay.hidden {
            display: none;
        }

        .popup-content {
            background: white;
            border-radius: 1.5rem;
            padding: 3rem;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
        }

        .popup-avatar {
            width: 100px;
            height: 100px;
            background-color: #7f1d1d;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
        }

        .popup-content h2 {
            font-size: 2rem;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .popup-content p {
            color: #6b7280;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .popup-btn {
            background-color: #dc2626;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 2rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        .popup-btn:hover {
            background-color: #b91c1c;
        }

        .main-content {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-title {
            font-size: 2rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 2rem;
        }

        .data-card {
            background: linear-gradient(135deg, #7f1d1d 0%, #991b1b 100%);
            border-radius: 1.5rem;
            padding: 2rem;
            color: white;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .data-info h3 {
            font-size: 0.875rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }

        .data-info p {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .data-icon {
            width: 80px;
            height: 80px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }

        .eskul-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .eskul-card {
            background: linear-gradient(135deg, #991b1b 0%, #7f1d1d 100%);
            border-radius: 1rem;
            padding: 2rem;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .eskul-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        }

        .eskul-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .eskul-header h4 {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .eskul-icon {
            font-size: 2.5rem;
        }

        .eskul-count {
            font-size: 1.5rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .eskul-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <button class="menu-btn" onclick="toggleMenu()">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
        <h1>Homepage Admin</h1>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <button class="close-btn" onclick="toggleMenu()">×</button>
            <div class="admin-avatar">👤</div>
            <p>Admin</p>
        </div>
        <nav class="sidebar-nav">
            <button class="nav-item" onclick="navigateTo('admin', event)">
                <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>Admin</span>
            </button>
            <button class="nav-item active" onclick="navigateTo('dashboard', event)">
                <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span>Dashboard</span>
            </button>
            <button class="nav-item" onclick="navigateTo('data-siswa', event)">
                <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span>Data Siswa</span>
            </button>
            <button class="nav-item" onclick="navigateTo('data-pembina', event)">
                <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>Data Pembina</span>
            </button>
            <button class="nav-item" onclick="navigateTo('data-eskul', event)">
                <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                </svg>
                <span>Data Eskul</span>
            </button>
            <button class="nav-item" onclick="navigateTo('absensi', event)">
                <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 5H2v7l6.29 6.29c.94.94 2.48.94 3.42 0l3.58-3.58c.94-.94.94-2.48 0-3.42L9 5z"></path>
                    <path d="M6 9.01V9"></path>
                </svg>
                <span>Absensi Siswa</span>
            </button>
            <button class="nav-item" onclick="navigateTo('keluar', event)">
                <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                <span>Keluar</span>
            </button>
        </nav>
    </div>

    <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

    <div class="popup-overlay" id="welcomePopup">
        <div class="popup-content">
            <div class="popup-avatar">👤</div>
            <h2>Selamat Datang</h2>
            <p>Pembina</p>
            <button class="popup-btn" onclick="closePopup()">OK</button>
        </div>
    </div>

    <div class="main-content">
        <h2 class="page-title">Dashboard</h2>

        <div class="data-card">
            <div class="data-info">
                <h3>Data Siswa</h3>
                <p>104 Siswa</p>
            </div>
            <div class="data-icon">👤</div>
        </div>

        <h3 class="section-title">Ekstrakurikuler</h3>
        <div class="eskul-grid">
            <div class="eskul-card">
                <div class="eskul-header">
                    <h4>VOLI</h4>
                    <span class="eskul-icon">🏐</span>
                </div>
                <p class="eskul-count">20 Siswa</p>
            </div>
            <div class="eskul-card">
                <div class="eskul-header">
                    <h4>BASKET</h4>
                    <span class="eskul-icon">🏀</span>
                </div>
                <p class="eskul-count">29 Siswa</p>
            </div>
            <div class="eskul-card">
                <div class="eskul-header">
                    <h4>FUTSAL</h4>
                    <span class="eskul-icon">⚽</span>
                </div>
                <p class="eskul-count">32 Siswa</p>
            </div>
            <div class="eskul-card">
                <div class="eskul-header">
                    <h4>PMR</h4>
                    <span class="eskul-icon">➕</span>
                </div>
                <p class="eskul-count">7 Siswa</p>
            </div>
            <div class="eskul-card">
                <div class="eskul-header">
                    <h4>RUNNING</h4>
                    <span class="eskul-icon">🏃</span>
                </div>
                <p class="eskul-count">22 Siswa</p>
            </div>
            <div class="eskul-card">
                <div class="eskul-header">
                    <h4>ESPORT</h4>
                    <span class="eskul-icon">🎮</span>
                </div>
                <p class="eskul-count">13 Siswa</p>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        function closePopup() {
            document.getElementById('welcomePopup').classList.add('hidden');
        }

        function navigateTo(page, evt) {
            var navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(function(item) {
                item.classList.remove('active');
            });
            evt.target.closest('.nav-item').classList.add('active');
            toggleMenu();
            
            if (page === 'keluar') {
                if (confirm('Apakah Anda yakin ingin keluar?')) {
                    alert('Logout berhasil!');
                }
            } else {
                console.log('Navigasi ke: ' + page);
            }
        }

        window.onload = function() {
            document.getElementById('welcomePopup').classList.remove('hidden');
        }
    </script>
</body>
</html>