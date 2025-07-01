<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;
use App\Models\Konseling;
use App\Models\JadwalPertemuan;
use App\Models\NilaiAkademik;
use App\Models\Absensi;
use App\Models\JadwalPelajaran;

class BerandaOrangtuaController extends Controller
{
    public function index()
    {
        $idSiswa = session('id_siswa');
        $idOrangtua = session('id_orangtua');

        $jumlahPrestasi = Prestasi::where('id_siswa', $idSiswa)->count();
        $jumlahKonseling = Konseling::where('id_siswa', $idSiswa)->count();
        $jumlahAbsensi = Absensi::whereJsonContains('data_siswa', [$idSiswa => ['status' => 'Hadir']])->count();
        $jumlahNilai = NilaiAkademik::whereHas('kelasSiswa', function ($q) use ($idSiswa) {
            $q->where('id_siswa', $idSiswa);
        })->count();
        $jumlahJadwal = JadwalPelajaran::count();

        $pertemuanTerdekat = JadwalPertemuan::where('id_orangtua', $idOrangtua)
            ->whereDate('tanggal', '>=', now())
            ->orderBy('tanggal')
            ->first();

        $aktivitas = [];

        $latestNilai = NilaiAkademik::whereHas('kelasSiswa', function ($query) use ($idSiswa) {
            $query->where('id_siswa', $idSiswa);
        })->latest()->first();

        if ($latestNilai) {
            $aktivitas[] = "
                <i class='mdi mdi-clipboard-text text-primary me-2'></i>
                Nilai akademik baru tersedia.
                <span class='badge bg-light text-muted ms-2'>{$latestNilai->created_at->format('d M Y')}</span>
            ";
        }

        $latestKonseling = Konseling::where('id_siswa', $idSiswa)->latest()->first();
        if ($latestKonseling) {
            $aktivitas[] = "
                <i class='mdi mdi-account-voice text-info me-2'></i>
                Sesi konseling terbaru telah dicatat.
                <span class='badge bg-light text-muted ms-2'>{$latestKonseling->created_at->format('d M Y')}</span>
            ";
        }

        $latestPrestasi = Prestasi::where('id_siswa', $idSiswa)->latest()->first();
        if ($latestPrestasi) {
            $aktivitas[] = "
                <i class='mdi mdi-trophy text-warning me-2'></i>
                Prestasi <span class='fw-bold text-warning'>{$latestPrestasi->nama_prestasi}</span> ditambahkan.
                <span class='badge bg-light text-muted ms-2'>{$latestPrestasi->created_at->format('d M Y')}</span>
            ";
        }

        return view('modul.orangtua.beranda.index', compact(
            'jumlahPrestasi',
            'jumlahKonseling',
            'jumlahAbsensi',
            'jumlahNilai',
            'jumlahJadwal',
            'pertemuanTerdekat',
            'aktivitas'
        ));
    }
}
