<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konseling;
use App\Models\Siswa;
use App\Models\Guru;

class KonselingOrangtuaController extends Controller
{
    public function index()
    {
        return view('modul.orangtua.konseling.index');
    }

    public function getData()
    {
        $idSiswa = session('id_siswa');

        $konseling = Konseling::select(
                'konseling.id',
                'konseling.tanggal',
                'konseling.kesehatan',
                'konseling.catatan',
                'siswa.nama AS nama_siswa',
                'siswa.nisn',
                'guru.nama AS nama' // ⬅️ alias guru.nama menjadi 'nama'
            )
            ->leftJoin('siswa', 'konseling.id_siswa', '=', 'siswa.id')
            ->leftJoin('guru', 'konseling.id_guru', '=', 'guru.id')
            ->where('konseling.id_siswa', $idSiswa) // ⬅️ tampilkan hanya milik siswa ini
            ->whereNull('konseling.deleted_at')
            ->get();

        return response()->json([
            'data' => $konseling
        ]);
    }
}
