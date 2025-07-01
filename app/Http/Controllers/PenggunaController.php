<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Role;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;


class PenggunaController extends Controller
{
    public function index()
    {
        return view('modul.admin.pengguna.index');
    }

    public function getData()
    {
        $pengguna = Pengguna::select('pengguna.id', 'pengguna.username', 'pengguna.nama', 'pengguna.email', 'pengguna.password',
                'role.name', 'guru.nama AS nama_guru', 'siswa.nama AS nama_siswa')
            ->whereNull('pengguna.deleted_at')
            ->leftJoin('role', 'pengguna.role_id', '=', 'role.id')
            ->leftJoin('guru', 'pengguna.id_guru', '=', 'guru.id')
            ->leftJoin('siswa', 'pengguna.id_siswa', '=', 'siswa.id')
            ->get();

            foreach ($pengguna as $item) {
                $item->password = str_repeat('*', 5);
            }
        
        return response()->json([
            'data' => $pengguna
        ]);
    }

    public function create()
    {
        $role = Role::select('id', 'name', 'is_admin')->whereNull('deleted_at')->get();
        $guru = Guru::select('id', 'nama', 'nip')->whereNull('deleted_at')->get();
        $siswa = Siswa::select('id', 'nama', 'nisn', 'gender', 'kebutuhan_khusus', 'alamat', 'agama', 'anak_ke')->whereNull('deleted_at')->get();
        return view('modul.admin.pengguna._form', compact('role', 'guru', 'siswa'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'username' => 'required',
        'nama' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'role_id' => 'required',
    ]);

    // Dapatkan role
    $roleId = $request->input('role_id');

    if ($roleId == 1) { // Admin
        $validated['id_guru'] = null;
        $validated['id_siswa'] = null;
    } elseif ($roleId == 2) { // Guru
        $validated['id_guru'] = $request->input('id_guru');
        $validated['id_siswa'] = null;
    } elseif ($roleId == 3) { // Orang Tua
        $validated['id_guru'] = null;
        $validated['id_siswa'] = $request->input('id_siswa');
    }

    $validated['password'] = Hash::make($validated['password']);
    $validated['created_at'] = now();

    Pengguna::create($validated);

    return redirect()->back()->with('success', 'Data pengguna berhasil disimpan.');
}


    public function edit($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $role = Role::select('id', 'name', 'is_admin')->whereNull('deleted_at')->get();
        $guru = Guru::select('id', 'nama', 'nip')->whereNull('deleted_at')->get();
        $siswa = Siswa::select('id', 'nama', 'nisn', 'gender', 'kebutuhan_khusus', 'alamat', 'agama', 'anak_ke')->whereNull('deleted_at')->get();

        return view('modul.admin.pengguna.edit', compact('pengguna','role', 'guru', 'siswa'));
    }

    public function update(Request $request, $id)
{
    $pengguna = Pengguna::findOrFail($id);

    $validated = $request->validate([
        'username' => 'required',
        'nama' => 'required',
        'email' => 'required',
        'password' => 'required',
        'role_id' => 'required',
    ]);

    $roleId = $request->input('role_id');

    if ($roleId == 1) {
        $validated['id_guru'] = null;
        $validated['id_siswa'] = null;
    } elseif ($roleId == 2) {
        $validated['id_guru'] = $request->input('id_guru');
        $validated['id_siswa'] = null;
    } elseif ($roleId == 3) {
        $validated['id_guru'] = null;
        $validated['id_siswa'] = $request->input('id_siswa');
    }

    $validated['password'] = Hash::make($validated['password']);
    $pengguna->update($validated);

    return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil diperbarui.');
}


    public function delete($id)
    {
        Pengguna::where('id', $id)->update([
            'deleted_at' => now()
        ]);

        return response()->json(['message' => 'Data pengguna berhasil dihapus.']);
    }
}
