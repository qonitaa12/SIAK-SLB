<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrangTua;
use App\Models\Siswa;

class OrangtuaController extends Controller
{
    public function index()
    {
        return view('modul.admin.orangtua.index');
    }

    public function getData()
    {
        $orang_tua = OrangTua::select('orang_tua.id', 'orang_tua.nama_ayah', 
        'orang_tua.tahun_lahir_ayah', 'orang_tua.pendidikan_ayah', 
        'orang_tua.pekerjaan_ayah', 'orang_tua.penghasilan_ayah', 
        'orang_tua.nik_ayah', 'orang_tua.nama_ibu', 
        'orang_tua.tahun_lahir_ibu', 'orang_tua.pendidikan_ibu',
        'orang_tua.pekerjaan_ibu', 'orang_tua.penghasilan_ibu', 
        'orang_tua.nik_ibu', 'siswa.nama', 'siswa.nisn')
            ->whereNull('orang_tua.deleted_at')
            ->leftJoin('siswa', 'orang_tua.id_siswa', '=', 'siswa.id')
            ->get();

        return response()->json([
            'data' => $orang_tua
        ]);
    }

    public function create()
    {
        $siswa = Siswa::select('id', 'nama', 'nisn', 'gender', 'kebutuhan_khusus', 'alamat', 'agama', 'anak_ke')
        ->whereNull('deleted_at')
        ->get();

        return view('modul.admin.orangtua._form', compact('siswa'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ayah' => 'required',
            'tahun_lahir_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'penghasilan_ayah' => 'required',
            'nik_ayah' => 'required',
            'nama_ibu' => 'required',
            'tahun_lahir_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'penghasilan_ibu' => 'required',
            'nik_ibu' => 'required',
            'id_siswa' => 'required',
        ]);

        $validated['created_at'] = now();

        OrangTua::create($validated);

        return redirect()->back()->with('success', 'Data orang tua berhasil disimpan.');
    }

    public function edit($id)
    {
        $orang_tua = OrangTua::findOrFail($id);
        $siswa = Siswa::select('id', 'nama', 'nisn', 'gender', 'kebutuhan_khusus', 'alamat', 'agama', 'anak_ke')
        ->whereNull('deleted_at')
        ->get();

        return view('modul.admin.orangtua.edit', compact('orang_tua','siswa'));
    }

    public function update(Request $request, $id)
    {
        $orang_tua = OrangTua::findOrFail($id);

        $validated = $request->validate([
            'nama_ayah' => 'required',
            'tahun_lahir_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'penghasilan_ayah' => 'required',
            'nik_ayah' => 'required',
            'nama_ibu' => 'required',
            'tahun_lahir_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'penghasilan_ibu' => 'required',
            'nik_ibu' => 'required',
            'id_siswa' => 'required',
        ]);

        $orang_tua->update($validated);

        return redirect()->route('orangtua.index')->with('success', 'Data orang tua berhasil diperbarui.');
    }

    public function delete($id)
    {
        OrangTua::where('id', $id)->update([
            'deleted_at' => now()
        ]);

        return response()->json(['message' => 'Data orang tua berhasil dihapus.']);
    }
}
