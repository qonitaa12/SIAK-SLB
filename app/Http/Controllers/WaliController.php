<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wali;
use App\Models\Siswa;

class WaliController extends Controller
{
    public function index()
    {
        return view('modul.admin.wali.index');
    }

    public function getData()
    {
        $wali = Wali::select('wali.id', 'wali.nama_wali', 'wali.tahun_lahir_wali', 'wali.pendidikan_wali', 'wali.pekerjaan_wali',
                'wali.penghasilan_wali', 'wali.nik_wali', 'siswa.nama', 'siswa.nisn')
            ->whereNull('wali.deleted_at')
            ->leftJoin('siswa', 'wali.id_siswa', '=', 'siswa.id')
            ->get();

        return response()->json([
            'data' => $wali
        ]);
    }

    public function create()
    {
        $siswa = Siswa::select('id', 'nama', 'nisn', 'gender', 'kebutuhan_khusus', 'alamat', 'agama', 'anak_ke')
        ->whereNull('deleted_at')
        ->get();

        return view('modul.admin.wali._form', compact('siswa'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_wali' => 'required',
            'tahun_lahir_wali' => 'required',
            'pendidikan_wali' => 'required',
            'pekerjaan_wali' => 'required',
            'penghasilan_wali' => 'required',
            'nik_wali' => 'required',
            'id_siswa' => 'required',
        ]);

        $validated['created_at'] = now();

        Wali::create($validated);

        return redirect()->back()->with('success', 'Data wali berhasil disimpan.');
    }

    public function edit($id)
    {
        $wali = Wali::findOrFail($id);
        $siswa = Siswa::select('id', 'nama', 'nisn', 'gender', 'kebutuhan_khusus', 'alamat', 'agama', 'anak_ke')
        ->whereNull('deleted_at')
        ->get();

        return view('modul.admin.wali.edit', compact('wali','siswa'));
    }

    public function update(Request $request, $id)
    {
        $wali = Wali::findOrFail($id);

        $validated = $request->validate([
            'nama_wali' => 'required',
            'tahun_lahir_wali' => 'required',
            'pendidikan_wali' => 'required',
            'pekerjaan_wali' => 'required',
            'penghasilan_wali' => 'required',
            'nik_wali' => 'required',
            'id_siswa' => 'required',
        ]);

        $wali->update($validated);

        return redirect()->route('wali.index')->with('success', 'Data wali berhasil diperbarui.');
    }

    public function delete($id)
    {
        Wali::where('id', $id)->update([
            'deleted_at' => now()
        ]);

        return response()->json(['message' => 'Data wali berhasil dihapus.']);
    }
}
