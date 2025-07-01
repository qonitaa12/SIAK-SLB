<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use Illuminate\Http\Request;

class AbsensiOrangtuaController extends Controller
{
    public function index()
    {
        return view('modul.orangtua.absensi.index');
    }

    public function getData()
{
    $idSiswa = session('id_siswa');

    if (!$idSiswa) {
        return response()->json(['data' => []]); // Jika tidak login sebagai siswa
    }

    $data = Absensi::with(['guru', 'kelas'])
        ->whereNull('deleted_at')
        ->get();

    // Filter hanya data absensi yang memiliki data untuk siswa ini
    $filteredData = $data->filter(function ($item) use ($idSiswa) {
        return isset($item->data_siswa[$idSiswa]);
    });

    $result = $filteredData->map(function ($item) use ($idSiswa) {
        $dataSiswa = $item->data_siswa[$idSiswa];

        return [
            'id' => $item->id,
            'tanggal' => $item->tanggal->format('Y-m-d'),
            'nama_kelas' => optional($item->kelas)->nama_kelas ?? '-',
            'status_kehadiran' => $dataSiswa['status'] ?? '-',
            'keterangan' => $dataSiswa['keterangan'] ?? '-',
            'dokumentasi' => $item->dokumentasi
        ];
    });

    return response()->json(['data' => $result->values()]);
}




    public function show($id)
    {
        $absensi = Absensi::findOrFail($id);
        $kelas = Kelas::find($absensi->id_kelas);
        $idSiswa = session('id_siswa');

        $kelas_siswa = KelasSiswa::with('siswa')
            ->where('id_kelas', $absensi->id_kelas)
            ->where('id_siswa', $idSiswa)
            ->whereNull('deleted_at')
            ->get();

        return view('modul.orangtua.absensi.show', compact('absensi', 'kelas', 'kelas_siswa'));
    }
}
