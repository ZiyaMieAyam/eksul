<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Admin - Ekstrakurikuler</title>
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
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
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
            margin-top: 80px;
        }

        .page-title {
            font-size: 2rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 2rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #7f1d1d;
            color: white;
            margin-bottom: 1.5rem;
        }

        .btn-primary:hover {
            background-color: #991b1b;
        }

        .btn-warning {
            background-color: #f59e0b;
            color: white;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .btn-warning:hover {
            background-color: #d97706;
        }

        .btn-danger {
            background-color: #dc2626;
            color: white;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        .btn-success {
            background-color: #10b981;
            color: white;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .btn-success:hover {
            background-color: #059669;
        }

        .btn-info {
            background-color: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .btn-info:hover {
            background-color: #2563eb;
        }

        .table-container {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #7f1d1d;
            color: white;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        tr:hover {
            background-color: #f9fafb;
        }

        .form-container {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-verified {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .back-link {
            display: inline-block;
            margin-top: 1rem;
            color: #7f1d1d;
            text-decoration: none;
            font-weight: 600;
        }

        .back-link:hover {
            text-decoration: underline;
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

        .page-content {
            display: none;
        }

        .page-content.active {
            display: block;
        }

        @media (max-width: 768px) {
            .eskul-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
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
        <h1 id="pageHeader">Dashboard Admin</h1>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <button class="close-btn" onclick="toggleMenu()">×</button>
            <div class="admin-avatar">👤</div>
            <p>Admin</p>
        </div>
        <nav class="sidebar-nav">
            <button class="nav-item active" onclick="navigateTo('dashboard', 'Dashboard Admin', this)">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span>Dashboard</span>
            </button>
            <button class="nav-item" onclick="navigateTo('data-siswa', 'Data Siswa', this)">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span>Data Siswa</span>
            </button>
            <button class="nav-item" onclick="navigateTo('data-pembina', 'Data Pembina', this)">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>Data Pembina</span>
            </button>
            <button class="nav-item" onclick="navigateTo('data-eskul', 'Data Ekstrakurikuler', this)">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                </svg>
                <span>Data Eskul</span>
            </button>
            <button class="nav-item" onclick="navigateTo('daftar-eskul', 'Daftar Ekstrakurikuler', this)">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <span>Daftar Eskul</span>
            </button>
            <button class="nav-item" onclick="navigateTo('absensi', 'Absensi Siswa', this)">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 5H2v7l6.29 6.29c.94.94 2.48.94 3.42 0l3.58-3.58c.94-.94.94-2.48 0-3.42L9 5z"></path>
                    <path d="M6 9.01V9"></path>
                </svg>
                <span>Absensi Siswa</span>
            </button>
            <button class="nav-item" onclick="navigateTo('prestasi', 'Prestasi Siswa', this)">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2z"></path>
                </svg>
                <span>Prestasi Siswa</span>
            </button>
            <button class="nav-item" onclick="navigateTo('verifikasi', 'Verifikasi Prestasi', this)">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 11 12 14 22 4"></polyline>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                </svg>
                <span>Verifikasi Prestasi</span>
            </button>
            <button class="nav-item" onclick="handleLogout()">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
            <p>Admin</p>
            <button class="popup-btn" onclick="closePopup()">OK</button>
        </div>
    </div>

    <div class="main-content">
        <!-- Dashboard -->
        <div id="page-dashboard" class="page-content active">
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

        <!-- Data Siswa -->
        <div id="page-data-siswa" class="page-content">
            <h2 class="page-title">Data Siswa</h2>
            <button class="btn btn-primary" onclick="navigateTo('tambah-siswa', 'Tambah Data Siswa')">+ Tambah Siswa</button>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Ekstrakurikuler</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="siswaTableBody">
                        @forelse($data ?? [] as $i => $siswa)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ optional($siswa->user)->username ?? '-' }}</td>
                            <td>{{ $siswa->nama_siswa }}</td>
                            <td>{{ $siswa->kelas }}</td>
                            <td>{{ $siswa->eskul->nama_eskul ?? '-' }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('guru.edsis', $siswa->id_siswa) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('guru.dsis', $siswa->id_siswa) }}" method="POST" style="display:inline;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center;">Tidak ada data siswa.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tambah Siswa -->
        <div id="page-tambah-siswa" class="page-content">
            <h2 class="page-title">Tambah Data Siswa</h2>
            <div class="form-container">
                <form action="/siswa-store" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" id="nis" name="nis" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" id="nama_siswa" name="nama_siswa" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" id="kelas" name="kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="id_eskul">Ekstrakurikuler</label>
                        <select id="id_eskul" name="id_eskul" required>
                            <option value="">-- Pilih Eskul --</option>
                            @foreach($eskuls ?? [] as $eskul)
                            <option value="{{ $eskul->id_eskul }}">{{ $eskul->nama_eskul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('siswa.index') }}" class="back-link">← Kembali</a>
                </form>
            </div>
        </div>

        <!-- Edit Siswa -->
        <div id="page-edit-siswa" class="page-content">
            <h2 class="page-title">Edit Data Siswa</h2>
            <div class="form-container">
                <form action="/siswa/{{ $siswa->id_siswa ?? '' }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="edit_nis">NIS</label>
                        <input type="text" id="edit_nis" name="nis" value="{{ $siswa->user->username ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_nama_siswa">Nama Siswa</label>
                        <input type="text" id="edit_nama_siswa" name="nama_siswa" value="{{ $siswa->nama_siswa ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_kelas">Kelas</label>
                        <input type="text" id="edit_kelas" name="kelas" value="{{ $siswa->kelas ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_alamat">Alamat</label>
                        <textarea id="edit_alamat" name="alamat">{{ $siswa->alamat ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_id_eskul">Ekstrakurikuler</label>
                        <select id="edit_id_eskul" name="id_eskul" required>
                            <option value="">-- Pilih Eskul --</option>
                            @foreach($eskuls ?? [] as $eskul)
                            <option value="{{ $eskul->id_eskul }}" {{ ($siswa->id_eskul ?? '') == $eskul->id_eskul ? 'selected' : '' }}>
                                {{ $eskul->nama_eskul }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('siswa.index') }}" class="back-link">← Kembali</a>
                </form>
            </div>
        </div>

        <!-- Data Pembina -->
        <div id="page-data-pembina" class="page-content">
            <h2 class="page-title">Data Pembina</h2>
            <button class="btn btn-primary" onclick="navigateTo('tambah-pembina', 'Tambah Data Pembina')">+ Tambah Pembina</button>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama Pembina</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pembinas ?? [] as $i => $p)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $p->user->username ?? '-' }}</td>
                            <td>{{ $p->nama_pembina }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('pembina.edit', $p->id_pembina) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('pembina.destroy', $p->id_pembina) }}" method="POST" style="display:inline;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center;">Tidak ada data pembina.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tambah Pembina -->
        <div id="page-tambah-pembina" class="page-content">
            <h2 class="page-title">Tambah Data Pembina</h2>
            <div class="form-container">
                <form action="{{ route('pembina.store') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="id_user">Pilih User (Username)</label>
                        <select id="id_user" name="id_user" required>
                            <option value="">-- Pilih User Pembina --</option>
                            @foreach(\App\Models\User::where('role','pembina')->get() as $user)
                            <option value="{{ $user->id_user }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_pembina">Nama Pembina</label>
                        <input type="text" id="nama_pembina" name="nama_pembina" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('pembina.index') }}" class="back-link">← Kembali</a>
                </form>
            </div>
        </div>

        <!-- Edit Pembina -->
        <div id="page-edit-pembina" class="page-content">
            <h2 class="page-title">Edit Data Pembina</h2>
            <div class="form-container">
                <form action="{{ route('pembina.update', $pembina->id_pembina ?? '') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="edit_nama_pembina">Nama Pembina</label>
                        <input type="text" id="edit_nama_pembina" name="nama_pembina" value="{{ $pembina->nama_pembina ?? '' }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('pembina.index') }}" class="back-link">← Kembali</a>
                </form>
            </div>
        </div>

        <!-- Data Eskul -->
        <div id="page-data-eskul" class="page-content">
            <h2 class="page-title">Data Ekstrakurikuler</h2>
            <button class="btn btn-primary" onclick="navigateTo('tambah-eskul', 'Tambah Data Eskul')">+ Tambah Eskul</button>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Eskul</th>
                            <th>Jadwal Eskul</th>
                            <th>Materi</th>
                            <th>Pembina Eskul</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($eskuls ?? [] as $i => $eskul)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $eskul->nama_eskul ?? '-' }}</td>
                            <td>{{ $eskul->jadwal_eskul ?? '-' }}</td>
                            <td>{{ $eskul->materi ?? '-' }}</td>
                            <td>{{ $eskul->pembina->nama_pembina ?? 'N/A' }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('eskul.edit', $eskul->id_eskul) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('eskul.destroy', $eskul->id_eskul) }}" method="POST" style="display:inline;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center;">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tambah Eskul -->
        <div id="page-tambah-eskul" class="page-content">
            <h2 class="page-title">Tambah Data Eskul</h2>
            <div class="form-container">
                <form action="{{ route('eskul.store') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="nama_eskul">Nama Eskul</label>
                        <input type="text" id="nama_eskul" name="nama_eskul" required>
                    </div>
                    <div class="form-group">
                        <label for="jadwal_eskul">Jadwal Eskul</label>
                        <input type="text" id="jadwal_eskul" name="jadwal_eskul" placeholder="Contoh: Senin, 15:00-17:00" required>
                    </div>
                    <div class="form-group">
                        <label for="materi">Materi</label>
                        <textarea id="materi" name="materi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="id_pembina">Pembina</label>
                        <select id="id_pembina" name="id_pembina" required>
                            <option value="">-- Pilih Pembina --</option>
                            @foreach($pembinas ?? [] as $pembina)
                            <option value="{{ $pembina->id_pembina }}">{{ $pembina->nama_pembina }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('eskul.index') }}" class="back-link">← Kembali</a>
                </form>
            </div>
        </div>

        <!-- Edit Eskul -->
        <div id="page-edit-eskul" class="page-content">
            <h2 class="page-title">Edit Data Eskul</h2>
            <div class="form-container">
                <form action="{{ route('eskul.update', $eskul->id_eskul ?? '') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="edit_nama_eskul">Nama Eskul</label>
                        <input type="text" id="edit_nama_eskul" name="nama_eskul" value="{{ $eskul->nama_eskul ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_jadwal_eskul">Jadwal Eskul</label>
                        <input type="text" id="edit_jadwal_eskul" name="jadwal_eskul" value="{{ $eskul->jadwal_eskul ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_materi">Materi</label>
                        <textarea id="edit_materi" name="materi">{{ $eskul->materi ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_id_pembina">Pembina</label>
                        <select id="edit_id_pembina" name="id_pembina" required>
                            <option value="">-- Pilih Pembina --</option>
                            @foreach($pembinas ?? [] as $pembina)
                            <option value="{{ $pembina->id_pembina }}" {{ ($eskul->id_pembina ?? '') == $pembina->id_pembina ? 'selected' : '' }}>
                                {{ $pembina->nama_pembina }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('eskul.index') }}" class="back-link">← Kembali</a>
                </form>
            </div>
        </div>

        <!-- Daftar Eskul -->
        <div id="page-daftar-eskul" class="page-content">
            <h2 class="page-title">Daftar Ekstrakurikuler</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Eskul</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($eskuls ?? [] as $eskul)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $eskul->nama_eskul }}</td>
                            <td>
                                <a href="{{ route('guru.absensi.detail', $eskul->id_eskul) }}" class="btn btn-info">Detail Absensi</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align: center;">Tidak ada data ekstrakurikuler</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Absensi Siswa -->
        <div id="page-absensi" class="page-content">
            <h2 class="page-title">Absensi Siswa</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Status Kehadiran</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ahmad Fauzi</td>
                            <td>X RPL 1</td>
                            <td><span class="badge badge-verified">Hadir</span></td>
                            <td>2024-11-26</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Siti Nurhaliza</td>
                            <td>X RPL 2</td>
                            <td><span class="badge badge-verified">Hadir</span></td>
                            <td>2024-11-26</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Budi Santoso</td>
                            <td>XI RPL 1</td>
                            <td><span class="badge badge-pending">Izin</span></td>
                            <td>2024-11-26</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Detail Absensi -->
        <div id="page-detail-absensi" class="page-content">
            <h2 class="page-title">Detail Absensi - VOLI</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Status Kehadiran</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Siti Nurhaliza</td>
                            <td>X RPL 2</td>
                            <td><span class="badge badge-verified">Hadir</span></td>
                            <td>2024-11-26</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Dewi Anggraini</td>
                            <td>X RPL 1</td>
                            <td><span class="badge badge-verified">Hadir</span></td>
                            <td>2024-11-26</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Rina Safitri</td>
                            <td>XI RPL 2</td>
                            <td><span class="badge badge-rejected">Alfa</span></td>
                            <td>2024-11-26</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="#" class="back-link" onclick="navigateTo('daftar-eskul', 'Daftar Ekstrakurikuler'); return false;">← Kembali</a>
        </div>

        <!-- Prestasi Siswa -->
        <div id="page-prestasi" class="page-content">
            <h2 class="page-title">Prestasi Siswa</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Prestasi</th>
                            <th>Eskul</th>
                            <th>Tanggal Diraih</th>
                            <th>Tingkat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Juara 1 Basket Antar Sekolah</td>
                            <td>Basket</td>
                            <td>2024-11-15</td>
                            <td>Kota</td>
                            <td><span class="badge badge-verified">Diverifikasi</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Juara 2 Voli Regional</td>
                            <td>Voli</td>
                            <td>2024-11-10</td>
                            <td>Regional</td>
                            <td><span class="badge badge-verified">Diverifikasi</span></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Juara 3 Futsal Antar SMA</td>
                            <td>Futsal</td>
                            <td>2024-10-20</td>
                            <td>Provinsi</td>
                            <td><span class="badge badge-verified">Diverifikasi</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Verifikasi Prestasi -->
        <div id="page-verifikasi" class="page-content">
            <h2 class="page-title">Verifikasi Prestasi Siswa</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Nama Prestasi</th>
                            <th>Eskul</th>
                            <th>Tanggal Diraih</th>
                            <th>Tingkat</th>
                            <th>Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="verifikasiTableBody">
                        @forelse($prestasis ?? [] as $i => $p)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $p->siswa->nama_siswa }}</td>
                            <td>{{ $p->nama_prestasi }}</td>
                            <td>{{ $p->eskul->nama_eskul }}</td>
                            <td>{{ $p->tanggal_diraih }}</td>
                            <td>{{ $p->tingkat }}</td>
                            <td>
                                @if($p->bukti)
                                <a href="{{ asset('storage/' . $p->bukti) }}" target="_blank" class="btn btn-info" style="padding: 0.25rem 0.75rem; font-size: 0.875rem;">Lihat</a>
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <form action="{{ route('guru.prestasi.update', $p->id_prestasi) }}" method="POST" style="display:inline;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="status" value="Diverifikasi">
                                        <button type="submit" class="btn btn-success" onclick="return confirm('Terima prestasi ini?')">Terima</button>
                                    </form>
                                    <form action="{{ route('guru.prestasi.update', $p->id_prestasi) }}" method="POST" style="display:inline;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="status" value="Ditolak">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak prestasi ini?')">Tolak</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align: center;">Tidak ada prestasi yang perlu diverifikasi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Database Lokal
        var database = {
            siswa: [
                { id: 1, nis: '12345', nama: 'Ahmad Fauzi', kelas: 'X RPL 1', eskul: 'Basket', alamat: 'Jl. Merdeka No. 10' },
                { id: 2, nis: '12346', nama: 'Siti Nurhaliza', kelas: 'X RPL 2', eskul: 'Voli', alamat: 'Jl. Sudirman No. 20' },
                { id: 3, nis: '12347', nama: 'Budi Santoso', kelas: 'XI RPL 1', eskul: 'Futsal', alamat: 'Jl. Gatot Subroto No. 5' }
            ],
            pembina: [
                { id: 1, username: 'pembina01', nama: 'Pak Agus Setiawan' },
                { id: 2, username: 'pembina02', nama: 'Bu Rina Wijaya' },
                { id: 3, username: 'pembina03', nama: 'Pak Dedi Kurniawan' }
            ],
            eskul: [
                { id: 1, nama: 'VOLI', jadwal: 'Senin, 15:00-17:00', materi: 'Teknik passing dan servis', pembina: 'Bu Rina Wijaya' },
                { id: 2, nama: 'BASKET', jadwal: 'Selasa, 15:00-17:00', materi: 'Dribbling dan shooting', pembina: 'Pak Agus Setiawan' },
                { id: 3, nama: 'FUTSAL', jadwal: 'Rabu, 15:00-17:00', materi: 'Passing dan strategi', pembina: 'Pak Dedi Kurniawan' }
            ],
            prestasi: [
                { id: 1, siswa: 'Ahmad Fauzi', nama: 'Juara 1 Basket Antar Sekolah', eskul: 'Basket', tanggal: '2024-11-15', tingkat: 'Kota', status: 'Pending' },
                { id: 2, siswa: 'Siti Nurhaliza', nama: 'Juara 2 Voli Regional', eskul: 'Voli', tanggal: '2024-11-10', tingkat: 'Regional', status: 'Pending' }
            ]
        };

        var editingId = null;

        function toggleMenu() {
            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        function closePopup() {
            document.getElementById('welcomePopup').classList.add('hidden');
        }

        function navigateTo(page, title, element) {
            // Hide all pages
            var pages = document.querySelectorAll('.page-content');
            for (var i = 0; i < pages.length; i++) {
                pages[i].classList.remove('active');
            }

            // Show selected page
            var targetPage = document.getElementById('page-' + page);
            if (targetPage) {
                targetPage.classList.add('active');
            }

            // Update header title
            document.getElementById('pageHeader').textContent = title || 'Dashboard Admin';

            // Update active nav item
            if (element) {
                var navItems = document.querySelectorAll('.nav-item');
                for (var i = 0; i < navItems.length; i++) {
                    navItems[i].classList.remove('active');
                }
                element.classList.add('active');
            }

            // Refresh data tables
            if (page === 'data-siswa') {
                renderSiswaTable();
            } else if (page === 'data-pembina') {
                renderPembinaTable();
            } else if (page === 'data-eskul') {
                renderEskulTable();
            } else if (page === 'verifikasi') {
                renderVerifikasiTable();
            } else if (page === 'dashboard') {
                updateDashboard();
            }

            // Close sidebar if open
            var sidebar = document.getElementById('sidebar');
            if (sidebar.classList.contains('active')) {
                toggleMenu();
            }
        }

        function handleLogout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                alert('Logout berhasil!');
            }
        }

        // ===== SISWA FUNCTIONS =====
        function renderSiswaTable() {
            var tbody = document.getElementById('siswaTableBody');
            if (!tbody) return;

            tbody.innerHTML = '';
            
            if (database.siswa.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" style="text-align: center;">Tidak ada data siswa.</td></tr>';
                return;
            }

            database.siswa.forEach(function(siswa, index) {
                var row = '<tr>' +
                    '<td>' + (index + 1) + '</td>' +
                    '<td>' + siswa.nis + '</td>' +
                    '<td>' + siswa.nama + '</td>' +
                    '<td>' + siswa.kelas + '</td>' +
                    '<td>' + siswa.eskul + '</td>' +
                    '<td>' +
                        '<div class="action-buttons">' +
                            '<button class="btn btn-warning" onclick="editSiswa(' + siswa.id + ')">Edit</button>' +
                            '<button class="btn btn-danger" onclick="deleteSiswa(' + siswa.id + ')">Hapus</button>' +
                        '</div>' +
                    '</td>' +
                '</tr>';
                tbody.innerHTML += row;
            });
        }

        function handleSubmit(event, type) {
            event.preventDefault();
            
            if (type === 'siswa') {
                var nis = document.getElementById('nis').value;
                var nama = document.getElementById('nama_siswa').value;
                var kelas = document.getElementById('kelas').value;
                var alamat = document.getElementById('alamat').value;
                var eskulSelect = document.getElementById('id_eskul');
                var eskul = eskulSelect.options[eskulSelect.selectedIndex].text;

                var newSiswa = {
                    id: Date.now(),
                    nis: nis,
                    nama: nama,
                    kelas: kelas,
                    eskul: eskul,
                    alamat: alamat
                };

                database.siswa.push(newSiswa);
                alert('Data siswa berhasil ditambahkan!');
                navigateTo('data-siswa', 'Data Siswa');
            } 
            else if (type === 'siswa-edit') {
                var nis = document.getElementById('edit_nis').value;
                var nama = document.getElementById('edit_nama_siswa').value;
                var kelas = document.getElementById('edit_kelas').value;
                var alamat = document.getElementById('edit_alamat').value;
                var eskulSelect = document.getElementById('edit_id_eskul');
                var eskul = eskulSelect.options[eskulSelect.selectedIndex].text;

                var index = database.siswa.findIndex(function(s) { return s.id === editingId; });
                if (index !== -1) {
                    database.siswa[index] = {
                        id: editingId,
                        nis: nis,
                        nama: nama,
                        kelas: kelas,
                        eskul: eskul,
                        alamat: alamat
                    };
                    alert('Data siswa berhasil diupdate!');
                    navigateTo('data-siswa', 'Data Siswa');
                }
            }
            else if (type === 'pembina') {
                var userSelect = document.getElementById('id_user');
                var username = userSelect.options[userSelect.selectedIndex].text;
                var nama = document.getElementById('nama_pembina').value;

                var newPembina = {
                    id: Date.now(),
                    username: username,
                    nama: nama
                };

                database.pembina.push(newPembina);
                alert('Data pembina berhasil ditambahkan!');
                navigateTo('data-pembina', 'Data Pembina');
            }
            else if (type === 'pembina-edit') {
                var nama = document.getElementById('edit_nama_pembina').value;

                var index = database.pembina.findIndex(function(p) { return p.id === editingId; });
                if (index !== -1) {
                    database.pembina[index].nama = nama;
                    alert('Data pembina berhasil diupdate!');
                    navigateTo('data-pembina', 'Data Pembina');
                }
            }
            else if (type === 'eskul') {
                var nama = document.getElementById('nama_eskul').value;
                var jadwal = document.getElementById('jadwal_eskul').value;
                var materi = document.getElementById('materi').value;
                var pembinaSelect = document.getElementById('id_pembina');
                var pembina = pembinaSelect.options[pembinaSelect.selectedIndex].text;

                var newEskul = {
                    id: Date.now(),
                    nama: nama,
                    jadwal: jadwal,
                    materi: materi,
                    pembina: pembina
                };

                database.eskul.push(newEskul);
                alert('Data eskul berhasil ditambahkan!');
                navigateTo('data-eskul', 'Data Ekstrakurikuler');
            }
            else if (type === 'eskul-edit') {
                var nama = document.getElementById('edit_nama_eskul').value;
                var jadwal = document.getElementById('edit_jadwal_eskul').value;
                var materi = document.getElementById('edit_materi').value;
                var pembinaSelect = document.getElementById('edit_id_pembina');
                var pembina = pembinaSelect.options[pembinaSelect.selectedIndex].text;

                var index = database.eskul.findIndex(function(e) { return e.id === editingId; });
                if (index !== -1) {
                    database.eskul[index] = {
                        id: editingId,
                        nama: nama,
                        jadwal: jadwal,
                        materi: materi,
                        pembina: pembina
                    };
                    alert('Data eskul berhasil diupdate!');
                    navigateTo('data-eskul', 'Data Ekstrakurikuler');
                }
            }
        }

        function editSiswa(id) {
            var siswa = database.siswa.find(function(s) { return s.id === id; });
            if (siswa) {
                editingId = id;
                document.getElementById('edit_nis').value = siswa.nis;
                document.getElementById('edit_nama_siswa').value = siswa.nama;
                document.getElementById('edit_kelas').value = siswa.kelas;
                document.getElementById('edit_alamat').value = siswa.alamat;
                navigateTo('edit-siswa', 'Edit Data Siswa');
            }
        }

        function deleteSiswa(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data siswa ini?')) {
                database.siswa = database.siswa.filter(function(s) { return s.id !== id; });
                alert('Data siswa berhasil dihapus!');
                renderSiswaTable();
                updateDashboard();
            }
        }

        // ===== PEMBINA FUNCTIONS =====
        function renderPembinaTable() {
            var tbody = document.querySelector('#page-data-pembina tbody');
            if (!tbody) return;

            tbody.innerHTML = '';
            
            if (database.pembina.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" style="text-align: center;">Tidak ada data pembina.</td></tr>';
                return;
            }

            database.pembina.forEach(function(pembina, index) {
                var row = '<tr>' +
                    '<td>' + (index + 1) + '</td>' +
                    '<td>' + pembina.username + '</td>' +
                    '<td>' + pembina.nama + '</td>' +
                    '<td>' +
                        '<div class="action-buttons">' +
                            '<button class="btn btn-warning" onclick="editPembina(' + pembina.id + ')">Edit</button>' +
                            '<button class="btn btn-danger" onclick="deletePembina(' + pembina.id + ')">Hapus</button>' +
                        '</div>' +
                    '</td>' +
                '</tr>';
                tbody.innerHTML += row;
            });
        }

        function editPembina(id) {
            var pembina = database.pembina.find(function(p) { return p.id === id; });
            if (pembina) {
                editingId = id;
                document.getElementById('edit_nama_pembina').value = pembina.nama;
                navigateTo('edit-pembina', 'Edit Data Pembina');
            }
        }

        function deletePembina(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data pembina ini?')) {
                database.pembina = database.pembina.filter(function(p) { return p.id !== id; });
                alert('Data pembina berhasil dihapus!');
                renderPembinaTable();
            }
        }

        // ===== ESKUL FUNCTIONS =====
        function renderEskulTable() {
            var tbody = document.querySelector('#page-data-eskul tbody');
            if (!tbody) return;

            tbody.innerHTML = '';
            
            if (database.eskul.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" style="text-align: center;">Tidak ada data eskul.</td></tr>';
                return;
            }

            database.eskul.forEach(function(eskul, index) {
                var row = '<tr>' +
                    '<td>' + (index + 1) + '</td>' +
                    '<td>' + eskul.nama + '</td>' +
                    '<td>' + eskul.jadwal + '</td>' +
                    '<td>' + eskul.materi + '</td>' +
                    '<td>' + eskul.pembina + '</td>' +
                    '<td>' +
                        '<div class="action-buttons">' +
                            '<button class="btn btn-warning" onclick="editEskul(' + eskul.id + ')">Edit</button>' +
                            '<button class="btn btn-danger" onclick="deleteEskul(' + eskul.id + ')">Hapus</button>' +
                        '</div>' +
                    '</td>' +
                '</tr>';
                tbody.innerHTML += row;
            });
        }

        function editEskul(id) {
            var eskul = database.eskul.find(function(e) { return e.id === id; });
            if (eskul) {
                editingId = id;
                document.getElementById('edit_nama_eskul').value = eskul.nama;
                document.getElementById('edit_jadwal_eskul').value = eskul.jadwal;
                document.getElementById('edit_materi').value = eskul.materi;
                navigateTo('edit-eskul', 'Edit Data Eskul');
            }
        }

        function deleteEskul(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data eskul ini?')) {
                database.eskul = database.eskul.filter(function(e) { return e.id !== id; });
                alert('Data eskul berhasil dihapus!');
                renderEskulTable();
                updateDashboard();
            }
        }

        // ===== VERIFIKASI FUNCTIONS =====
        function renderVerifikasiTable() {
            var tbody = document.getElementById('verifikasiTableBody');
            if (!tbody) return;

            tbody.innerHTML = '';
            
            var pendingPrestasi = database.prestasi.filter(function(p) { return p.status === 'Pending'; });

            if (pendingPrestasi.length === 0) {
                tbody.innerHTML = '<tr><td colspan="8" style="text-align: center;">Tidak ada prestasi yang perlu diverifikasi.</td></tr>';
                return;
            }

            pendingPrestasi.forEach(function(prestasi, index) {
                var row = '<tr>' +
                    '<td>' + (index + 1) + '</td>' +
                    '<td>' + prestasi.siswa + '</td>' +
                    '<td>' + prestasi.nama + '</td>' +
                    '<td>' + prestasi.eskul + '</td>' +
                    '<td>' + prestasi.tanggal + '</td>' +
                    '<td>' + prestasi.tingkat + '</td>' +
                    '<td><a href="#" class="btn btn-info" style="padding: 0.25rem 0.75rem; font-size: 0.875rem;">Lihat</a></td>' +
                    '<td>' +
                        '<div class="action-buttons">' +
                            '<button class="btn btn-success" onclick="verifikasiPrestasi(' + prestasi.id + ', \'terima\')">Terima</button>' +
                            '<button class="btn btn-danger" onclick="verifikasiPrestasi(' + prestasi.id + ', \'tolak\')">Tolak</button>' +
                        '</div>' +
                    '</td>' +
                '</tr>';
                tbody.innerHTML += row;
            });
        }

        function verifikasiPrestasi(id, action) {
            var message = action === 'terima' ? 'menerima' : 'menolak';
            if (confirm('Apakah Anda yakin ingin ' + message + ' prestasi ini?')) {
                var index = database.prestasi.findIndex(function(p) { return p.id === id; });
                if (index !== -1) {
                    database.prestasi[index].status = action === 'terima' ? 'Diverifikasi' : 'Ditolak';
                    alert('Prestasi berhasil ' + (action === 'terima' ? 'diterima' : 'ditolak') + '!');
                    renderVerifikasiTable();
                }
            }
        }

        function updateDashboard() {
            var totalSiswa = database.siswa.length;
            var dataCard = document.querySelector('.data-card .data-info p');
            if (dataCard) {
                dataCard.textContent = totalSiswa + ' Siswa';
            }
        }

        window.onload = function() {
            document.getElementById('welcomePopup').classList.remove('hidden');
            renderSiswaTable();
            updateDashboard();
        };
    </script>
</body>
</html>