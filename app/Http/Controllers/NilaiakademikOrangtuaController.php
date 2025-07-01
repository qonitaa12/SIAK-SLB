<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiAkademik;
use App\Models\GuruMapel;
use App\Models\KelasSiswa;

class NilaiakademikOrangtuaController extends Controller
{
    public function index()
    {
        return view('modul.orangtua.nilaiakademik.index');
    }

    public function getData()
{
    $query = NilaiAkademik::with([
        'guruMapel.guru',
        'guruMapel.mapel',
        'kelasSiswa.siswa',
        'kelasSiswa.kelas'
    ]);

    if (session()->has('id_siswa')) {
        $query->whereHas('kelasSiswa', function ($subQuery) {
            $subQuery->where('id_siswa', session('id_siswa'));
        });
    }

    $data = $query->whereNull('deleted_at')->get();

    $result = $data->map(function ($item) {
        return [
            'id' => $item->id,
            'mapel' => $item->guruMapel->mapel->nama ?? '-',
            'semester' => $item->guruMapel->semester ?? '-',
            'kelas' => $item->kelasSiswa->kelas->nama_kelas ?? '-',
            'siswa' => $item->kelasSiswa->siswa->nama ?? '-',
            'rata_formatif' => $item->rata_formatif,
            'rata_sumatif_cp' => $item->rata_sumatif_cp,
            'rata_sumatif_semester' => $item->rata_sumatif_semester,
            'rata_tingkat_akhir' => $item->rata_tingkat_akhir,
            'evaluasi' => $item->evaluasi,
        ];
    });

    return response()->json(['data' => $result]);
}


    public function getGuruMapelBySiswaDanMapel(Request $request)
    {
        if (!$request->isMethod('post')) {
            return response()->json(['error' => 'Method not allowed'], 405);
        }

        $request->validate([
            'id_kelas_siswa' => 'required|integer',
            'id_mapel' => 'required|integer',
        ]);

        $kelasSiswa = KelasSiswa::with('kelas')->findOrFail($request->id_kelas_siswa);
        $id_kelas = $kelasSiswa->id_kelas;

        $guruMapel = GuruMapel::with('guru')
            ->where('id_kelas', $id_kelas)
            ->where('id_mapel', $request->id_mapel)
            ->first();

        if (!$guruMapel) {
            return response()->json(['message' => 'Data guru mapel tidak ditemukan.'], 404);
        }

        return response()->json([
            'id_guru_mapel' => $guruMapel->id,
            'nama_guru' => $guruMapel->guru->nama,
            'semester' => $guruMapel->semester,
        ]);
    }
}
