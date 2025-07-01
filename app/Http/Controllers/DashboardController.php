<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard utama.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data menu yang aktif saja dari tabel 'menus'
        $menus = Menu::where('is_active', true)->get();

        // Kirim data ke view 'dashboard.index'
        return view('dashboard.index', compact('menus'));
    }
}
