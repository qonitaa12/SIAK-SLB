<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelasSiswa;
use App\Models\Kelas;
use App\Models\Siswa;

class KelassiswaController extends Controller
{
    public function index()
    {
        return view('modul.admin.kelassiswa.index');
    }

    public function getData()
    {
        $kelas_siswa = KelasSiswa::select('kelas_siswa.id', 'kelas_siswa.tahun', 'kelas.nama_kelas', 'siswa.nama', 'siswa.nisn')
            ->whereNull('kelas_siswa.deleted_at')
            ->leftJoin('kelas', 'kelas_siswa.id_kelas', '=', 'kelas.id')
            ->leftJoin('siswa', 'kelas_siswa.id_siswa', '=', 'siswa.id')
            ->get();

        return response()->json([
            'data' => $kelas_siswa
        ]);
    }
    public function getSiswaByKelas($id)
    {
        $kelas_siswa = KelasSiswa::with('siswa')
            ->where('id_kelas', $id)
            ->get();

        $siswaList = $kelas_siswa->map(function ($item) {
            return [
                'id' => $item->siswa->id,
                'nama' => $item->siswa->nama,
            ];
        });

        return response()->json([
            'siswa' => $siswaList,
        ]);
    }


    public function create()
    {
        $kelas = Kelas::select('id', 'nama_kelas')->whereNull('deleted_at')->get();
        $siswa = Siswa::select('id', 'nama', 'nisn', 'gender', 'kebutuhan_khusus', 'alamat', 'agama', 'anak_ke')->whereNull('deleted_at')->get();

        return view('modul.admin.kelassiswa._form', compact('kelas', 'siswa'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required',
            'id_kelas' => 'required',
            'id_siswa' => 'required',
        ]);

        $validated['created_at'] = now();

        KelasSiswa::create($validated);

        return redirect()->back()->with('success', 'Data kelas siswa berhasil disimpan.');
    }

    public function edit($id)
    {
        $kelas_siswa = KelasSiswa::findOrFail($id);
        $kelas = Kelas::select('id', 'nama_kelas')->whereNull('deleted_at')->get();
        $siswa = Siswa::select('id', 'nama', 'nisn', 'gender', 'kebutuhan_khusus', 'alamat', 'agama', 'anak_ke')->whereNull('deleted_at')->get();

        return view('modul.admin.kelassiswa.edit', compact('kelas_siswa', 'kelas','siswa'));
    }

    public function update(Request $request, $id)
    {
        $kelas_siswa = KelasSiswa::findOrFail($id);

        $validated = $request->validate([
            'tahun' => 'required',
            'id_kelas' => 'required',
            'id_siswa' => 'required',
        ]);

        $kelas_siswa->update($validated);

        return redirect()->route('kelas_siswa.index')->with('success', 'Data kelas siswa berhasil diperbarui.');
    }

    public function delete($id)
    {
        KelasSiswa::where('id', $id)->update([
            'deleted_at' => now()
        ]);

        return response()->json(['message' => 'Data kelas siswa berhasil dihapus.']);
    }
}
