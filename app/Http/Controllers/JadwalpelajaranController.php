<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Guru;


class JadwalpelajaranController extends Controller
{
    public function index()
    {
        return view('modul.admin.jadwalpelajaran.index');
    }

    public function getData()
    {
        $jadwal_pelajaran = JadwalPelajaran::select(
            'jadwal_pelajaran.id', 'jadwal_pelajaran.hari', 'jadwal_pelajaran.jam_mulai', 
            'jadwal_pelajaran.jam_selesai', 'kelas.nama_kelas AS kelas', 'mapel.nama AS nama_mapel', 'guru.nama')
        ->whereNull('jadwal_pelajaran.deleted_at')
        ->leftJoin('kelas', 'jadwal_pelajaran.id_kelas', '=', 'kelas.id')
        ->leftJoin('mapel', 'jadwal_pelajaran.id_mapel', '=', 'mapel.id')
        ->leftJoin('guru', 'jadwal_pelajaran.id_guru', '=', 'guru.id')
        ->get();

        return response()->json([
            'data' => $jadwal_pelajaran
        ]);
    }

    public function create()
    {
        $kelas = Kelas::select('id', 'nama_kelas')->whereNull('deleted_at')->get();
        $mapel = Mapel::select('id', 'nama', 'jumlah_penilaian')->whereNull('deleted_at')->get();
        $guru = Guru::select('id', 'nip', 'nama', 'bidang_ajar', 'jabatan', 'kontak')->whereNull('deleted_at')->get();

        return view('modul.admin.jadwalpelajaran._form', compact('kelas', 'mapel', 'guru'));
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'id_kelas' => 'required',
            'id_mapel' => 'required',
            'id_guru' => 'required',
        ]);

        $validated['created_at'] = now();

        JadwalPelajaran::create($validated);

        return redirect()->back()->with('success', 'Data jadwal berhasil disimpan.');
    }

    public function edit($id)
    {
        $jadwal_pelajaran = JadwalPelajaran::findOrFail($id);
        $kelas = Kelas::select('id', 'nama_kelas')->whereNull('deleted_at')->get();
        $mapel = Mapel::select('id', 'nama', 'jumlah_penilaian')->whereNull('deleted_at')->get();
        $guru = Guru::select('id', 'nip', 'nama', 'bidang_ajar', 'jabatan', 'kontak')->whereNull('deleted_at')->get();

        return view('modul.admin.jadwalpelajaran.edit', compact('jadwal_pelajaran', 'kelas', 'mapel', 'guru'));
    }

    public function update(Request $request, $id)
{
    $jadwal_pelajaran = JadwalPelajaran::findOrFail($id);

    $validated = $request->validate([
        'hari' => 'required',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required',
        'id_kelas' => 'required',
        'id_mapel' => 'required',
        'id_guru' => 'required',
    ]);

    $jadwal_pelajaran->update($validated);

    return redirect()->route('jadwal_pelajaran.index')->with('success', 'Data jadwal pelajaran berhasil diperbarui.');
}

    public function delete($id)
    {
        JadwalPelajaran::where('id', $id)->update([
            'deleted_at' => now()
        ]);

        return response()->json(['message' => 'Data Jadwal pelajaran berhasil dihapus']);
    }
}
