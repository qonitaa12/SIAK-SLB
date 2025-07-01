<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Prestasi;

class BerandaController extends Controller
{
    public function index()
    {
        $jumlahSiswa = Siswa::count();
        $jumlahGuru = Guru::count();
        $jumlahKelas = Kelas::count();
        $jumlahPrestasi = Prestasi::count();

        $aktivitas = [];

        $latestSiswa = Siswa::latest()->first();
        if ($latestSiswa) {
            $tanggal = $latestSiswa->created_at->format('d M Y');
            $aktivitas[] = [
                'icon' => 'mdi-account text-primary',
                'text' => "Siswa <strong class='text-primary'>{$latestSiswa->nama}</strong> baru ditambahkan.",
                'date' => $tanggal
            ];
        }

        $latestGuru = Guru::latest()->first();
        if ($latestGuru) {
            $tanggal = $latestGuru->created_at->format('d M Y');
            $aktivitas[] = [
                'icon' => 'mdi-account-tie text-success',
                'text' => "Guru <strong class='text-success'>{$latestGuru->nama}</strong> terakhir ditambahkan.",
                'date' => $tanggal
            ];
        }

        $latestPrestasi = Prestasi::latest()->first();
        if ($latestPrestasi) {
            $nama = $latestPrestasi->nama_prestasi ?: '(Tanpa Nama)';
            $tanggal = $latestPrestasi->created_at->format('d M Y');
            $aktivitas[] = [
                'icon' => 'mdi-star-circle text-warning',
                'text' => "Prestasi <strong class='text-warning'>{$nama}</strong> baru ditambahkan.",
                'date' => $tanggal
            ];
        }

        return view('modul.admin.beranda.index', compact(
            'jumlahSiswa',
            'jumlahGuru',
            'jumlahKelas',
            'jumlahPrestasi',
            'aktivitas'
        ));
    }
}