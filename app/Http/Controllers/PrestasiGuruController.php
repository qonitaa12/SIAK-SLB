<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;
use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;

class PrestasiGuruController extends Controller
{
    public function index()
    {
        return view('modul.guru.prestasi.index');
    }

    public function getData()
    {
        $prestasi = Prestasi::select('prestasi.id', 'prestasi.lomba', 'prestasi.tingkat', 'prestasi.juara', 'prestasi.tanggal',
                'prestasi.dokumentasi', 'siswa.nama', 'siswa.nisn')
            ->whereNull('prestasi.deleted_at')
            ->leftJoin('siswa', 'prestasi.id_siswa', '=', 'siswa.id')
            ->get();

        return response()->json([
            'data' => $prestasi
        ]);
    }

    public function create()
    {
        $siswa = Siswa::select('id', 'nama', 'nisn', 'gender', 'kebutuhan_khusus', 'alamat', 'agama', 'anak_ke')
        ->whereNull('deleted_at')
        ->get();
        return view('modul.guru.prestasi._form', compact('siswa'));
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'lomba' => 'required',
        'tingkat' => 'required',
        'juara' => 'required',
        'tanggal' => 'required',
        'dokumentasi' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'id_siswa' => 'required',
    ]);

    if ($request->hasFile('dokumentasi')) {
        $file = $request->file('dokumentasi');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/prestasi'), $filename);
        $validated['dokumentasi'] = 'uploads/prestasi/' . $filename;
    }

    $validated['created_at'] = now();

    Prestasi::create($validated);

        return redirect()->route('guru.prestasi.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $siswa = Siswa::select('id', 'nama', 'nisn', 'gender', 'kebutuhan_khusus', 'alamat', 'agama', 'anak_ke')
        ->whereNull('deleted_at')
        ->get();
        return view('modul.guru.prestasi.edit', compact('prestasi', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);
    
        $validated = $request->validate([
            'lomba' => 'required',
            'tingkat' => 'required',
            'juara' => 'required',
            'tanggal' => 'required',
            'dokumentasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'id_siswa' => 'required',
        ]);
    
        if ($request->hasFile('dokumentasi')) {
            // Hapus file lama jika ada
            if ($prestasi->dokumentasi && file_exists(public_path($prestasi->dokumentasi))) {
                unlink(public_path($prestasi->dokumentasi));
            }
    
            $file = $request->file('dokumentasi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/prestasi'), $filename);
            $validated['dokumentasi'] = 'uploads/prestasi/' . $filename;
        } else {
            // Jangan ubah dokumentasi jika tidak diunggah ulang
            unset($validated['dokumentasi']);
        }
    
        $prestasi->update($validated);

        return redirect()->route('guru.prestasi.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        Prestasi::where('id', $id)->update([
            'deleted_at' => now()
        ]);

        return response()->json(['message' => 'Data prestasi berhasil dihapus.']);
    }
}
