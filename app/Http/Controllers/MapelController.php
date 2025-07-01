<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mapel;

class MapelController extends Controller
{
    public function index()
    {
        return view('modul.admin.mapel.index');
    }

    public function getData()
    {
        $mapel = Mapel::select('id', 'nama', 'jumlah_penilaian')
        ->whereNull('deleted_at')->get();

        return response()->json([
            'data' => $mapel
        ]);
    }

    public function create()
    {
        return view('modul.admin.mapel._form'); // asumsi formnya di file resources/views/mapel/_form.blade.php
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required',
        'jumlah_penilaian' => 'required',
    ]);

    $validated['created_at'] = now();

    Mapel::create($validated);

    return redirect()->back()->with('success', 'Data mapel berhasil disimpan.');
}
    
    public function edit($id)
    {
        $mapel = Mapel::findOrFail($id);
        return view('modul.admin.mapel.edit', compact('mapel'));
    }

    public function update(Request $request, $id)
    {
        $mapel = Mapel::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required',
            'jumlah_penilaian' => 'required',
        ]);
        $mapel->update($validated);

        return redirect()->route('mapel.index')->with('success', 'Data mapel berhasil diperbarui.');
    }
    
        public function delete($id)
    {
        Mapel::where('id', $id)->update([
            'deleted_at' => now()
        ]);
    
        return response()->json(['message' => 'Data mapel berhasil dihapus.']);
    }
}
