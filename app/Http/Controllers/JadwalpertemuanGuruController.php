<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPertemuan;
use App\Models\OrangTua;
use App\Models\Wali;
use App\Models\Guru;
use App\Models\Siswa;

class JadwalpertemuanGuruController extends Controller
{
    public function index()
    {
        return view('modul.guru.jadwalpertemuan.index');
    }
    public function getData()
    {
        $jadwal_pertemuan = JadwalPertemuan::select(
            'jadwal_pertemuan.id', 'jadwal_pertemuan.tanggal', 'jadwal_pertemuan.waktu', 'jadwal_pertemuan.tempat',
            'jadwal_pertemuan.status', 'orang_tua.nama_ayah', 'orang_tua.nama_ibu', 'wali.nama_wali', 'guru.nama as nama_guru'
        )
        ->whereNull('jadwal_pertemuan.deleted_at')
        ->leftJoin('orang_tua', 'jadwal_pertemuan.id_orangtua', '=', 'orang_tua.id')
        ->leftJoin('wali', 'jadwal_pertemuan.id_wali', '=', 'wali.id')
        ->leftJoin('guru', 'jadwal_pertemuan.id_guru', '=', 'guru.id')
        ->get();

        return response()->json(['data' => $jadwal_pertemuan]);
    }

    public function create()
    {
        $guru = Guru::select('id', 'nama', 'nip')->whereNull('deleted_at')->get();
        $siswaList = Siswa::whereHas('orangTua')->orWhereHas('wali')->with(['orangTua', 'wali'])->get();

        return view('modul.guru.jadwalpertemuan._form', compact('guru', 'siswaList'));
    }

     public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required',
            'waktu' => 'required',
            'tempat' => 'required',
            'status' => 'required',
            'id_guru' => 'required',
            'id_siswa' => 'required',
        ]);

        $wali = Wali::where('id_siswa', $validated['id_siswa'])->first();
        $validated['id_wali'] = $wali ? $wali->id : null;

        if (!$wali) {
            $orang_tua = OrangTua::where('id_siswa', $validated['id_siswa'])->first();
            $validated['id_orangtua'] = $orang_tua ? $orang_tua->id : null;
        }

        $validated['created_at'] = now();
        JadwalPertemuan::create($validated);

        return redirect()->back()->with('success', 'Data jadwal pertemuan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwal_pertemuan = JadwalPertemuan::findOrFail($id);
        $guru = Guru::select('id', 'nama', 'nip')->whereNull('deleted_at')->get();
        $siswaList = Siswa::whereHas('orangTua')->orWhereHas('wali')->with(['orangTua', 'wali'])->get();

        return view('modul.guru.jadwalpertemuan.edit', compact('jadwal_pertemuan', 'guru', 'siswaList'));
    }
    
    public function update(Request $request, $id)
    {
        $jadwal_pertemuan = JadwalPertemuan::findOrFail($id);

        $validated = $request->validate([
            'tanggal' => 'required',
            'waktu' => 'required',
            'tempat' => 'required',
            'status' => 'required',
            'id_guru' => 'required',
            'id_siswa' => 'required',
        ]);

        $wali = Wali::where('id_siswa', $validated['id_siswa'])->first();
        $validated['id_wali'] = $wali ? $wali->id : null;

        if (!$wali) {
            $orang_tua = OrangTua::where('id_siswa', $validated['id_siswa'])->first();
            $validated['id_orangtua'] = $orang_tua ? $orang_tua->id : null;
        } else {
            $validated['id_orangtua'] = null;
        }

        $jadwal_pertemuan->update($validated);

        return redirect()->route('guru.jadwal_pertemuan.index')->with('success', 'Data jadwal pertemuan berhasil diperbarui.');
    }

    public function delete($id)
    {
        JadwalPertemuan::where('id', $id)->update(['deleted_at' => now()]);

        return response()->json(['message' => 'Data jadwal pertemuan berhasil dihapus']);
    }

}
