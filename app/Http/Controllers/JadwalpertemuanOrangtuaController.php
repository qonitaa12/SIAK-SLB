<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPertemuan;
use App\Models\OrangTua;
use App\Models\Wali;
use App\Models\Guru;
use App\Models\Siswa;

class JadwalpertemuanOrangtuaController extends Controller
{
    public function index()
    {
        return view('modul.orangtua.jadwalpertemuan.index');
    }

    public function getData()
    {
        $idSiswa = session('id_siswa');

        if (!$idSiswa) {
            return response()->json(['data' => []]);
        }

        // Cari id orang tua & wali berdasarkan id_siswa
        $orangTua = OrangTua::where('id_siswa', $idSiswa)->first();
        $wali = Wali::where('id_siswa', $idSiswa)->first();

        $idOrangTua = $orangTua?->id ?? null;
        $idWali = $wali?->id ?? null;

        $jadwal_pertemuan = JadwalPertemuan::select(
                'jadwal_pertemuan.id',
                'jadwal_pertemuan.tanggal',
                'jadwal_pertemuan.waktu',
                'jadwal_pertemuan.tempat',
                'jadwal_pertemuan.status',
                'orang_tua.nama_ayah',
                'orang_tua.nama_ibu',
                'wali.nama_wali',
                'guru.nama as nama_guru'
            )
            ->leftJoin('orang_tua', 'jadwal_pertemuan.id_orangtua', '=', 'orang_tua.id')
            ->leftJoin('wali', 'jadwal_pertemuan.id_wali', '=', 'wali.id')
            ->leftJoin('guru', 'jadwal_pertemuan.id_guru', '=', 'guru.id')
            ->whereNull('jadwal_pertemuan.deleted_at')
            ->where(function ($query) use ($idOrangTua, $idWali) {
                if ($idOrangTua) {
                    $query->orWhere('jadwal_pertemuan.id_orangtua', $idOrangTua);
                }
                if ($idWali) {
                    $query->orWhere('jadwal_pertemuan.id_wali', $idWali);
                }
            })
            ->get();

        return response()->json(['data' => $jadwal_pertemuan]);
    }
}
