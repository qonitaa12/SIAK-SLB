<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function index()
    {
        return view('modul.admin.kelas.index');
    }

    public function getData()
    {
        $kelas = Kelas::select('id', 'nama_kelas')
        ->whereNull('deleted_at')->get();

        return response()->json([
            'data' => $kelas
        ]);
    }

    public function create()
    {
        return view('modul.admin.kelas._form'); // asumsi formnya di file resources/views/kelas/_form.blade.php
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama_kelas' => 'required',
    ]);

    $validated['created_at'] = now();

    Kelas::create($validated);

    return redirect()->back()->with('success', 'Data kelas berhasil disimpan.');
}
    
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('modul.admin.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $validated = $request->validate([
            'nama_kelas' => 'required',
        ]);
        $kelas->update($validated);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }
    
        public function delete($id)
    {
        Kelas::where('id', $id)->update([
            'deleted_at' => now()
        ]);
    
        return response()->json(['message' => 'Data kelas berhasil dihapus.']);
    }
}
