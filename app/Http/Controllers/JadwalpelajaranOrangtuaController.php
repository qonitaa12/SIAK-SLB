<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Guru;

class JadwalpelajaranOrangtuaController extends Controller
{
    public function index()
    {
        return view('modul.orangtua.jadwalpelajaran.index');
    }
    
    public function getData()
    {
        $jadwal_pelajaran = JadwalPelajaran::select(
            'jadwal_pelajaran.id',
            'jadwal_pelajaran.hari',
            'jadwal_pelajaran.jam_mulai',
            'jadwal_pelajaran.jam_selesai',
            'kelas.nama_kelas AS kelas',
            'mapel.nama AS nama_mapel',
            'guru.nama'
        )
        ->whereNull('jadwal_pelajaran.deleted_at')
        ->leftJoin('kelas', 'jadwal_pelajaran.id_kelas', '=', 'kelas.id')
        ->leftJoin('mapel', 'jadwal_pelajaran.id_mapel', '=', 'mapel.id')
        ->leftJoin('guru', 'jadwal_pelajaran.id_guru', '=', 'guru.id')
        ->get();

        return response()->json([
            'data' => $jadwal_pelajaran
        ]);
    }
}
