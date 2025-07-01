<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    public function index()
    {
        return view('modul.admin.absensi.index');
    }

    public function getData()
{
    $data = Absensi::with(['guru', 'kelas'])->whereNull('deleted_at')->get();

    $result = $data->map(function ($item) {
        $data_siswa = $item->data_siswa ?? [];

        // Ambil semua id siswa dari kelas yang terkait
        $siswa_kelas = \App\Models\KelasSiswa::where('id_kelas', $item->id_kelas)
                            ->whereNull('deleted_at')
                            ->pluck('id_siswa')
                            ->toArray();

        // Filter hanya siswa yang benar-benar dari kelas ini
        $filtered = collect($data_siswa)->filter(function ($val, $key) use ($siswa_kelas) {
            return in_array($key, $siswa_kelas);
        });

        return [
            'id' => $item->id,
            'tanggal' => $item->tanggal->format('Y-m-d'),
            'nama_guru' => optional($item->guru)->nama ?? '-',
            'nama_kelas' => optional($item->kelas)->nama_kelas ?? '-',
            'jumlah_hadir' => $filtered->where('status', 'Hadir')->count(),
            'jumlah_izin' => $filtered->where('status', 'Izin')->count(),
            'jumlah_alfa' => $filtered->where('status', 'Tidak Hadir')->count(),
            'dokumentasi' => $item->dokumentasi
        ];
    });

    return response()->json(['data' => $result]);
}


    public function create()
    {
        $guru = Guru::whereNull('deleted_at')->get();

        // Ambil hanya kelas yang memiliki siswa (kelas_siswa tidak null)
        $daftarKelas = Kelas::whereHas('kelasSiswa', function ($query) {
            $query->whereNull('deleted_at');
        })
        ->with(['kelasSiswa' => function ($query) {
            $query->whereNull('deleted_at')->with('siswa');
        }])
        ->whereNull('deleted_at')
        ->get();


        return view('modul.admin.absensi._form', compact('guru', 'daftarKelas'));
    }



    public function store(Request $request)
{
    $request->validate([
        'id_guru' => 'required|integer',
        'kelas_yang_dipilih' => 'required|integer|exists:kelas,id',
        'tanggal' => 'required|date',
        'data_siswa' => 'required|array',
        'dokumentasi' => 'nullable|image|max:2048'
    ]);

    $path = null;
    if ($request->hasFile('dokumentasi')) {
        $path = $request->file('dokumentasi')->store('dokumentasi', 'public');
    }

    Absensi::create([
        'id_guru' => $request->id_guru,
        'id_kelas' => $request->kelas_yang_dipilih, // ✅ PENTING: Ambil dari dropdown
        'tanggal' => $request->tanggal,
        'data_siswa' => $request->data_siswa,
        'dokumentasi' => $path,
        'created_at' => now()
    ]);

    return redirect()->back()->with('success', 'Data absensi berhasil disimpan.');
}


    public function edit($id)
    {
        $absensi = Absensi::findOrFail($id);
        $guru = Guru::whereNull('deleted_at')->get();
        $kelas = Kelas::whereNull('deleted_at')->get();

        return view('modul.admin.absensi.edit', compact('absensi', 'guru', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $absensi = Absensi::findOrFail($id);

        $request->validate([
            'id_guru' => 'required|integer',
            'id_kelas' => 'required|integer',
            'tanggal' => 'required|date',
            'data_siswa' => 'required|array',
            'dokumentasi' => 'nullable|image|max:2048'
        ]);

        $path = $absensi->dokumentasi;
        if ($request->hasFile('dokumentasi')) {
            if ($path) Storage::disk('public')->delete($path);
            $path = $request->file('dokumentasi')->store('dokumentasi', 'public');
        }

        $absensi->update([
            'id_guru' => $request->id_guru,
            'id_kelas' => $request->id_kelas,
            'tanggal' => $request->tanggal,
            'data_siswa' => $request->data_siswa,
            'dokumentasi' => $path,
            'updated_at' => now()
        ]);

        return redirect()->route('absensi_admin.index')->with('success', 'Data absensi berhasil diperbarui.');
    }

    public function delete($id)
    {
        Absensi::where('id', $id)->update(['deleted_at' => now()]);
        return response()->json(['message' => 'Data absensi berhasil dihapus.']);
    }

    public function getSiswaByKelas($id)
    {
        $kelasSiswa = KelasSiswa::with('siswa')
            ->where('id_kelas', $id)
            ->whereNull('deleted_at')
            ->get();

        $data = $kelasSiswa->map(function ($item) {
            return [
                'id' => $item->siswa->id,
                'nama' => $item->siswa->nama,
                'id_kelas_siswa' => $item->id
            ];
        });

        return response()->json($data);
    }

}
