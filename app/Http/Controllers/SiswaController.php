<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        return view('modul.admin.siswa.index');
    }

    public function getData()
    {
        $siswa = Siswa::select('id', 'nama', 'nisn', 'gender', 'kebutuhan_khusus', 'alamat', 'agama', 'anak_ke')
        ->whereNull('deleted_at')->get();

        return response()->json([
            'data' => $siswa
        ]);
    }
    public function create()
    {
        return view('modul.admin.siswa._form'); 
    }
    public function store(Request $request)
    {
    $validated = $request->validate([
        'nama' => 'required',
        'nipd' => 'required',
        'nisn' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required',
        'nik' => 'required',
        'agama' => 'required',
        'alamat' => 'required',
        'jenis_tinggal' => 'required',
        'alat_transportasi' => 'required',
        'no_hp' => 'required',
        'kebutuhan_khusus' => 'required',
        'anak_ke' => 'required',
        'jarak_rumah' => 'required',
        'gender' => 'required',
        'penerima_kps' => 'required',
        'no_kps' => 'required_if:penerima_kps,1',
        'penerima_kip' => 'required',
        'no_kip' => 'required_if:penerima_kip,1',
        'nama_kip' => 'required_if:penerima_kip,1',
        'layak_kip' => 'required',
        'no_kks' => 'required_if:layak_kip,1',
        'alasan_layak' => 'required_if:layak_kip,1',
    ]);

    $validated['created_at'] = now();

    Siswa::create($validated);

    return redirect()->back()->with('success', 'Data siswa berhasil disimpan.');
}
    
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('modul.admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required',
            'nipd' => 'required',
            'nisn' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nik' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'jenis_tinggal' => 'required',
            'alat_transportasi' => 'required',
            'no_hp' => 'required',
            'kebutuhan_khusus' => 'required',
            'anak_ke' => 'required',
            'jarak_rumah' => 'required',
            'gender' => 'required',
            'penerima_kps' => 'required',
            'no_kps' => 'required_if:penerima_kps,1',
            'penerima_kip' => 'required',
            'no_kip' => 'required_if:penerima_kip,1',
            'nama_kip' => 'required_if:penerima_kip,1',
            'layak_kip' => 'required',
            'no_kks' => 'required_if:layak_kip,1',
            'alasan_layak' => 'required_if:layak_kip,1',
        ]);
        $siswa->update($validated);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }
    
        public function delete($id)
    {
        Siswa::where('id', $id)->update([
            'deleted_at' => now()
        ]);
    
        return response()->json(['message' => 'Data siswa berhasil dihapus.']);
    }
}
