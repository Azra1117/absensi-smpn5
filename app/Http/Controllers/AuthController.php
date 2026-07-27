<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Halaman Login
    public function index()
    {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            switch (Auth::user()->role) {

                case 'admin':
                    return redirect('/admin');

                case 'guru':
                    return redirect('/guru');

                case 'staff':
                    return redirect('/staff');

                case 'siswa':
                    return redirect('/siswa');

                default:
                    Auth::logout();
                    return back()->with('error','Role tidak ditemukan');
            }
        }

        return back()->with('error','Username atau Password salah');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}