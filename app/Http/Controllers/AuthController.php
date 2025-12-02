<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login sesuai role
     */
    public function showLogin($role)
    {
        return view('auth.login', ['role' => $role]);
    }

    /**
     * Tampilkan halaman register
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            switch ($user->role) {
                case 'dinas':
                    return redirect()->route('dashboard.dinas');
                case 'kepala_sekolah':
                    return redirect()->route('dashboard.kepsek');
                case 'guru':
                    return redirect()->route('dashboard.guru');
                case 'siswa':
                    return redirect()->route('dashboard.siswa');
                case 'orang_tua':
                    return redirect()->route('dashboard.orangtua');
                default:
                    return redirect()->route('home');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    /**
     * Proses register
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('login.role', ['role' => $request->role])
            ->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
