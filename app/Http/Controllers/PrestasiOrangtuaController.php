<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;
use App\Models\Siswa;

class PrestasiOrangtuaController extends Controller
{
    public function index()
    {
        // Ambil data prestasi beserta nama siswa, urut berdasarkan tanggal terbaru
        $prestasi = Prestasi::select('prestasi.*', 'siswa.nama')
            ->leftJoin('siswa', 'prestasi.id_siswa', '=', 'siswa.id')
            ->whereNull('prestasi.deleted_at')
            ->orderBy('prestasi.tanggal', 'desc')
            ->get();

        return view('modul.orangtua.prestasi.index', compact('prestasi'));
    }
}
