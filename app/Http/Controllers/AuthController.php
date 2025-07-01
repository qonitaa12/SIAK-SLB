<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Menampilkan form login
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari user berdasarkan username
        $user = Pengguna::where('username', $request->username)->first();

        // Cek apakah user ada dan password cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Username atau password salah.']);
        }

        // Simpan session manual (bukan auth bawaan Laravel)
        session([
            'user_id' => $user->id,
            'username' => $user->username,
            'role_id' => $user->role_id,
            'nama' => $user->nama,
            'id_siswa' => $user->id_siswa,
            'id_guru' => $user->id_guru, // ✅ atau relasi: $user->guru->id
        ]);


        // Redirect berdasarkan role
        switch ($user->role_id) {
            case 1:
                return redirect('/beranda_admin');
            case 2:
                return redirect('/beranda_guru');
            case 3:
                return redirect('/beranda_orangtua');
            default:
                return redirect('/login')->withErrors(['login' => 'Role tidak dikenal.']);
        }
    }

    public function logout(Request $request)
    {
        // Hapus semua data session
        session()->flush();

        // Redirect ke halaman login
        return redirect('/login');
    }
}
