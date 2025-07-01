<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaGuruController extends Controller
{
    public function index()
    {
        return view('modul.guru.siswa.index');
    }

    public function getData()
    {
        $siswa = Siswa::select('id', 'nama', 'nisn', 'gender', 'kebutuhan_khusus', 'alamat', 'agama', 'anak_ke')
            ->whereNull('deleted_at')->get();

        return response()->json([
            'data' => $siswa
        ]);
    }

    // Optional: Jika kamu masih ingin lihat detail siswa lewat form (tanpa edit/save), bisa tetap pakai ini
    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('modul.guru.siswa.show', compact('siswa'));
    }
}
