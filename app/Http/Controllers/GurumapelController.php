<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuruMapel;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Kelas;

class GurumapelController extends Controller
{
    public function index()
    {
        return view('modul.admin.gurumapel.index');
    }

    public function getData()
    {
        $guru_mapel = GuruMapel::select('guru_mapel.id', 'guru_mapel.tahun_ajaran','guru_mapel.semester', 'guru.nama', 'mapel.nama AS nama_mapel', 'kelas.nama_kelas')
            ->whereNull('guru_mapel.deleted_at')
            ->leftJoin('guru', 'guru_mapel.id_guru', '=', 'guru.id')
            ->leftJoin('mapel', 'guru_mapel.id_mapel', '=', 'mapel.id')
            ->leftJoin('kelas', 'guru_mapel.id_kelas', '=', 'kelas.id')
            ->get();

        return response()->json([
            'data' => $guru_mapel
        ]);
    }

    public function create()
    {
        $guru = Guru::select('id', 'nama')->whereNull('deleted_at')->get();
        $mapel = Mapel::select('id', 'nama')->whereNull('deleted_at')->get();
        $kelas = Kelas::select('id', 'nama_kelas')->whereNull('deleted_at')->get();

        return view('modul.admin.gurumapel._form', compact('guru', 'mapel', 'kelas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun_ajaran' => 'required',
            'semester' => 'required',
            'id_guru' => 'required',
            'id_mapel' => 'required',
            'id_kelas' => 'required',
        ]);

        $validated['created_at'] = now();

        GuruMapel::create($validated);

        return redirect()->back()->with('success', 'Data guru mapel berhasil disimpan.');
    }

    public function edit($id)
    {
        $guru_mapel = GuruMapel::findOrFail($id);
        $guru = Guru::select('id', 'nama')->whereNull('deleted_at')->get();
        $mapel = Mapel::select('id', 'nama')->whereNull('deleted_at')->get();
        $kelas = Kelas::select('id', 'nama_kelas')->whereNull('deleted_at')->get();

        return view('modul.admin.gurumapel.edit', compact('guru_mapel', 'guru','mapel', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $guru_mapel = GuruMapel::findOrFail($id);

        $validated = $request->validate([
            'tahun_ajaran' => 'required',
            'semester' => 'required',
            'id_guru' => 'required',
            'id_mapel' => 'required',
            'id_kelas' => 'required',
        ]);

        $guru_mapel->update($validated);

        return redirect()->route('guru_mapel.index')->with('success', 'Data guru mapel berhasil diperbarui.');
    }

    public function delete($id)
    {
        GuruMapel::where('id', $id)->update([
            'deleted_at' => now()
        ]);

        return response()->json(['message' => 'Data guru mapel berhasil dihapus.']);
    }
}
