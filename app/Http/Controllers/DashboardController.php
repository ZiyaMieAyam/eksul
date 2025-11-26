<?php
// filepath: app/Http/Controllers/DashboardSiswaController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardSiswaController extends Controller
{
    public function index()
    {
        return view('dashboard.siswa');
    }
}

// ============================================================

// filepath: app/Http/Controllers/DashboardGuruController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardGuruController extends Controller
{
    public function index()
    {
        return view('dashboard.guru');
    }
}

// ============================================================

// filepath: app/Http/Controllers/DashboardPembinaController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPembinaController extends Controller
{
    public function index()
    {
        return view('dashboard.pembina');
    }
}