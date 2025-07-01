<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiAkademik;
use App\Models\GuruMapel;
use App\Models\KelasSiswa;

class NilaiakademikController extends Controller
{
    public function index()
    {
        return view('modul.admin.nilaiakademik.index');
    }

    public function getData()
    {
        $data = NilaiAkademik::with([
            'guruMapel.guru',
            'guruMapel.mapel',
            'kelasSiswa.siswa',
            'kelasSiswa.kelas'
        ])->get();

        $result = $data->map(function ($item) {
            return [
                'id' => $item->id,
                // 'guru' => $item->guruMapel->guru->nama ?? '-',
                'mapel' => $item->guruMapel->mapel->nama ?? '-',
                'semester' => $item->guruMapel->semester ?? '-',
                'kelas' => $item->kelasSiswa->kelas->nama_kelas ?? '-',
                'siswa' => $item->kelasSiswa->siswa->nama ?? '-',
                'rata_formatif' => $item->rata_formatif,
                'rata_sumatif_cp' => $item->rata_sumatif_cp,
                'rata_sumatif_semester' => $item->rata_sumatif_cp,
                'rata_tingkat_akhir' => $item->rata_tingkat_akhir,
                'evaluasi' => $item->evaluasi,
            ];
        });

        return response()->json(['data' => $result]);
    }


    public function create()
    {
        $guru_mapel = GuruMapel::with(['guru', 'mapel', 'kelas'])->whereNull('deleted_at')->get();
        $kelas_siswa = KelasSiswa::with(['siswa', 'kelas'])->whereNull('deleted_at')->get();

        return view('modul.admin.nilaiakademik._form', compact('guru_mapel', 'kelas_siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_guru_mapel' => 'required|integer',
            'id_kelas_siswa' => 'required|integer',
            'formatif' => 'nullable|array',
            'sumatif_cp' => 'nullable|array',
            'sumatif_semester' => 'nullable|array',
            'tingkat_akhir' => 'nullable|array',
        ]);

        $formatif = collect($request->formatif)->filter(fn($item) => isset($item['nilai']) && $item['nilai'] !== null && $item['nilai'] !== '')->values()->all();
        $sumatif_cp = collect($request->sumatif_cp)->filter(fn($item) => isset($item['nilai']) && $item['nilai'] !== null && $item['nilai'] !== '')->values()->all();
        $sumatif_semester = collect($request->sumatif_semester)->filter(fn($item) => isset($item['nilai']) && $item['nilai'] !== null && $item['nilai'] !== '')->values()->all();
        $tingkat_akhir = collect($request->tingkat_akhir)->filter(fn($item) => isset($item['nilai']) && $item['nilai'] !== null && $item['nilai'] !== '')->values()->all();

        $nilai = new NilaiAkademik();
        $nilai->id_guru_mapel = $request->id_guru_mapel;
        $nilai->id_kelas_siswa = $request->id_kelas_siswa;
        $nilai->formatif = json_encode($formatif);
        $nilai->sumatif_cp = json_encode($sumatif_cp);
        $nilai->sumatif_semester = json_encode($sumatif_semester);
        $nilai->tingkat_akhir = json_encode($tingkat_akhir);

        $nilai->rata_formatif = $this->calculateAverage($formatif);
        $nilai->rata_sumatif_cp = $this->calculateAverage($sumatif_cp);
        $nilai->rata_sumatif_semester = $this->calculateAverage($sumatif_semester);
        $nilai->rata_tingkat_akhir = $this->calculateAverage($tingkat_akhir);

        $nilai->bobot_formatif = $request->bobot_formatif;
        $nilai->bobot_sumatif_cp = $request->bobot_sumatif_cp;
        $nilai->bobot_sumatif_semester = $request->bobot_sumatif_semester;
        $nilai->bobot_tingkat_akhir = $request->bobot_tingkat_akhir;

        // Perhitungan rata-rata total berdasarkan bobot
        $total = (
            ($nilai->rata_formatif * $nilai->bobot_formatif) +
            ($nilai->rata_sumatif_cp * $nilai->bobot_sumatif_cp) +
            ($nilai->rata_sumatif_semester * $nilai->bobot_sumatif_semester) +
            ($nilai->rata_tingkat_akhir * $nilai->bobot_tingkat_akhir)
        );

        $nilai->rata_total = round($total / 100, 2);

        $nilai->evaluasi = $request->evaluasi;

        $nilai->save();

        return redirect()->back()->with('success', 'Data nilai akademik berhasil disimpan.');
    }


    public function edit($id)
    {
        $nilai = NilaiAkademik::findOrFail($id);
        $guru_mapel = GuruMapel::with(['guru', 'mapel', 'kelas'])->get();
        $kelas_siswa = KelasSiswa::with(['siswa', 'kelas'])->get();

        return view('modul.admin.nilaiakademik.edit', compact('nilai', 'guru_mapel', 'kelas_siswa'));
    }

    public function update(Request $request, $id)
    {
        $nilai = NilaiAkademik::findOrFail($id);

        $request->validate([
            'id_guru_mapel' => 'required|integer',
            'id_kelas_siswa' => 'required|integer',
            'formatif' => 'nullable|array',
            'sumatif_cp' => 'nullable|array',
            'sumatif_semester' => 'nullable|array',
            'tingkat_akhir' => 'nullable|array',
        ]);

        $formatif = collect($request->formatif)->filter(fn($item) => isset($item['nilai']) && $item['nilai'] !== null && $item['nilai'] !== '')->values()->all();
        $sumatif_cp = collect($request->sumatif_cp)->filter(fn($item) => isset($item['nilai']) && $item['nilai'] !== null && $item['nilai'] !== '')->values()->all();
        $sumatif_semester = collect($request->sumatif_semester)->filter(fn($item) => isset($item['nilai']) && $item['nilai'] !== null && $item['nilai'] !== '')->values()->all();
        $tingkat_akhir = collect($request->tingkat_akhir)->filter(fn($item) => isset($item['nilai']) && $item['nilai'] !== null && $item['nilai'] !== '')->values()->all();

        $nilai->id_guru_mapel = $request->id_guru_mapel;
        $nilai->id_kelas_siswa = $request->id_kelas_siswa;
        $nilai->formatif = json_encode($formatif);
        $nilai->sumatif_cp = json_encode($sumatif_cp);
        $nilai->sumatif_semester = json_encode($sumatif_semester);
        $nilai->tingkat_akhir = json_encode($tingkat_akhir);

        $nilai->rata_formatif = $this->calculateAverage($formatif);
        $nilai->rata_sumatif_cp = $this->calculateAverage($sumatif_cp);
        $nilai->rata_sumatif_semester = $this->calculateAverage($sumatif_semester);
        $nilai->rata_tingkat_akhir = $this->calculateAverage($tingkat_akhir);

        $nilai->bobot_formatif = $request->bobot_formatif;
        $nilai->bobot_sumatif_cp = $request->bobot_sumatif_cp;
        $nilai->bobot_sumatif_semester = $request->bobot_sumatif_semester;
        $nilai->bobot_tingkat_akhir = $request->bobot_tingkat_akhir;

        // Perhitungan rata-rata total berdasarkan bobot
        $total = (
            ($nilai->rata_formatif * $nilai->bobot_formatif) +
            ($nilai->rata_sumatif_cp * $nilai->bobot_sumatif_cp) +
            ($nilai->rata_sumatif_semester * $nilai->bobot_sumatif_semester) +
            ($nilai->rata_tingkat_akhir * $nilai->bobot_tingkat_akhir)
        );

        $nilai->rata_total = round($total / 100, 2);

        $nilai->evaluasi = $request->evaluasi;

        $nilai->save();

        return redirect()->route('nilai_akademik.index')->with('success', 'Data nilai akademik berhasil diperbarui.');
    }


   private function calculateAverage($array)
    {
        $array = is_array($array) ? $array : [];

        $filtered = array_filter($array, function ($item) {
            return isset($item['nilai']) && is_numeric($item['nilai']);
        });

        $total = array_sum(array_column($filtered, 'nilai'));
        $count = count($filtered);

        return $count > 0 ? round($total / $count, 2) : null;
    }


    public function delete($id)
    {
        NilaiAkademik::where('id', $id)->update(['deleted_at' => now()]);
        return response()->json(['message' => 'Data nilai akademik berhasil dihapus.']);
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
