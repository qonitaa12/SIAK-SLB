<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konseling;
use App\Models\Siswa;
use App\Models\Guru;

class KonselingGuruController extends Controller
{
    public function index()
    {
        return view('modul.guru.konseling.index');
    }

    public function getData()
{
    $idGuru = session('id_guru'); // ambil dari sesi login

    if (!$idGuru) {
        return response()->json(['data' => [], 'message' => 'ID guru tidak ditemukan di sesi login.']);
    }

    $konseling = Konseling::select(
            'konseling.id',
            'konseling.tanggal',
            'konseling.kesehatan',
            'konseling.catatan',
            'siswa.nama AS nama_siswa',
            'siswa.nisn',
            'guru.nama'
        )
        ->leftJoin('siswa', 'konseling.id_siswa', '=', 'siswa.id')
        ->leftJoin('guru', 'konseling.id_guru', '=', 'guru.id')
        ->where('konseling.id_guru', $idGuru) // 🔥 filter berdasarkan guru yang login
        ->whereNull('konseling.deleted_at')
        ->get();

    return response()->json([
        'data' => $konseling
    ]);
}


    public function create()
    {
        $siswa = Siswa::select('id', 'nama', 'nisn', 'gender', 'kebutuhan_khusus', 'alamat', 'agama', 'anak_ke')->whereNull('deleted_at')->get();
        $guru = Guru::select('id', 'nama')->whereNull('deleted_at')->get();
        return view('modul.guru.konseling._form', compact('siswa', 'guru'));
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'tanggal' => 'required',
        'kesehatan' => 'required',
        'catatan' => 'required',
        'id_siswa' => 'required',
        'id_guru' => 'required',
    ]);


    $validated['created_at'] = now();

    Konseling::create($validated);

        return redirect()->route('guru.konseling.index')->with('success', 'Data konseling berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $konseling = Konseling::findOrFail($id);
        $siswa = Siswa::select('id', 'nama', 'nisn', 'gender', 'kebutuhan_khusus', 'alamat', 'agama', 'anak_ke')->whereNull('deleted_at')->get();
        $guru = Guru::select('id', 'nama')->whereNull('deleted_at')->get();
        return view('modul.guru.konseling.edit', compact('konseling', 'siswa', 'guru'));
    }

    public function update(Request $request, $id)
    {
        $konseling = Konseling::findOrFail($id);

        $validated = $request->validate([
            'tanggal' => 'required',
            'kesehatan' => 'required',
            'catatan' => 'required',
            'id_siswa' => 'required',
            'id_guru' => 'required',
        ]);
    
        $konseling->update($validated);

        return redirect()->route('guru.konseling.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        Konseling::where('id', $id)->update([
            'deleted_at' => now()
        ]);

        return response()->json(['message' => 'Data Konseling berhasil dihapus.']);
    }
}
