<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;

class GuruController extends Controller
{
    public function index(){
        return view('modul.admin.guru.index');
    }

    public function getData(){
        $guru = Guru::select('id', 'nip', 'nama', 'bidang_ajar', 'jabatan', 'kontak')
        ->whereNull('deleted_at')->get();

        return response()->json([
            'data' => $guru
        ]);
    }
    public function create(){
        return view('modul.admin.guru._form');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'bidang_ajar' => 'required',
            'jabatan' => 'required',
            'kontak' => 'required',
        ]);

        $validated['created_at'] = now();

        Guru::create($validated);

        return redirect()->back()->with('success', 'Data guru berhasil disimpan.');
   
    }
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('modul.admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $validated = $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'bidang_ajar' => 'required',
            'jabatan' => 'required',
            'kontak' => 'required',
        ]);
        $guru->update($validated);

        return redirect()->route('guru.index')->with('success', 'Data Guru berhasil diperbarui.');
    }
    
        public function delete($id)
    {
        Guru::where('id', $id)->update([
            'deleted_at' => now()
        ]);
    
        return response()->json(['message' => 'Data Guru berhasil dihapus.']);
    }
}
