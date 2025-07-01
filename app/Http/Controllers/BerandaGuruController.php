<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Prestasi;
use App\Models\Konseling;
use App\Models\JadwalPertemuan;
use App\Models\JadwalPelajaran;
use App\Models\NilaiAkademik;
use App\Models\Absensi;

class BerandaGuruController extends Controller
{
    public function index()
    {
        $jumlahSiswa = Siswa::count();
        $jumlahPrestasi = Prestasi::count();
        $jumlahKonseling = Konseling::count();
        $jumlahAbsensi = Absensi::count();

        $aktivitas = [];

        $latestKonseling = Konseling::latest()->first();
        if ($latestKonseling) {
            $tanggal = $latestKonseling->created_at->format('d M Y');
            $aktivitas[] = "
                <i class='mdi mdi-account-voice text-info me-2'></i>
                Konseling baru ditambahkan.
                <span class='badge bg-light text-muted ms-2'>{$tanggal}</span>
            ";
        }

        $latestPrestasi = Prestasi::latest()->first();
        if ($latestPrestasi) {
            $nama = $latestPrestasi->nama_prestasi ?: '(Tanpa Nama)';
            $tanggal = $latestPrestasi->created_at->format('d M Y');
            $aktivitas[] = "
                <i class='mdi mdi-trophy text-warning me-2'></i>
                Prestasi <span class='fw-bold text-warning'>{$nama}</span> baru ditambahkan.
                <span class='badge bg-light text-muted ms-2'>{$tanggal}</span>
            ";
        }

        $latestPertemuan = JadwalPertemuan::latest()->first();
        if ($latestPertemuan) {
            $tanggal = $latestPertemuan->created_at->format('d M Y');
            $aktivitas[] = "
                <i class='mdi mdi-calendar-clock text-secondary me-2'></i>
                Jadwal pertemuan terbaru ditambahkan.
                <span class='badge bg-light text-muted ms-2'>{$tanggal}</span>
            ";
        }

        return view('modul.guru.beranda.index', compact(
            'jumlahSiswa',
            'jumlahPrestasi',
            'jumlahKonseling',
            'jumlahAbsensi',
            'aktivitas'
        ));
    }
}
