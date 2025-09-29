<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Klien;
use App\Models\Paket;
use App\Models\Pesanan;
use App\Models\Proyek;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKlien = Klien::count();
        $totalPaket = Paket::count();
        $totalPesanan = Pesanan::count();
        $totalProyek = Proyek::count();
        
        return view('admin.dashboard', compact('totalKlien', 'totalPaket', 'totalPesanan', 'totalProyek'));
    }
}
