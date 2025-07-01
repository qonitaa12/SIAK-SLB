<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konseling;
use App\Models\Siswa;
use App\Models\Guru;

class KonselingController extends Controller
{
    public function index()
    {
        return view('modul.admin.konseling.index');
    }

    public function getData()
    {
        $konseling = Konseling::select(
                'konseling.id',
                'konseling.tanggal',
                'konseling.kesehatan',
                'konseling.catatan',
                'siswa.nama AS nama_siswa',
                'siswa.nisn',
                'guru.nama',
            )
            ->leftJoin('siswa', 'konseling.id_siswa', '=', 'siswa.id')
            ->leftJoin('guru', 'konseling.id_guru', '=', 'guru.id')
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

        return view('modul.admin.konseling._form', compact('siswa', 'guru'));
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

        return redirect()->back()->with('success', 'Data konseling berhasil disimpan.');
    }

    public function edit($id)
    {
        $konseling = Konseling::findOrFail($id);
        $siswa = Siswa::select('id', 'nama', 'nisn', 'gender', 'kebutuhan_khusus', 'alamat', 'agama', 'anak_ke')->whereNull('deleted_at')->get();
        $guru = Guru::select('id', 'nama')->whereNull('deleted_at')->get();

        return view('modul.admin.konseling.edit', compact('konseling', 'siswa', 'guru'));
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

        return redirect()->route('konseling.index')->with('success', 'Data konseling berhasil diperbarui.');
    }

    public function delete($id)
    {
        Konseling::where('id', $id)->update([
            'deleted_at' => now()
        ]);

        return response()->json(['message' => 'Data konseling berhasil dihapus.']);
    }
}
