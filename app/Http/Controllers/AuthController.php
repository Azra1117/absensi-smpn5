<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Halaman Login
    public function index()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user()->role);
        }
        return view('auth.login');
    }

    // Proses Login Standard Laravel
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectBasedOnRole(Auth::user()->role);
        }

        return back()->with('error', 'Username atau Password salah');
    }

    // Helper Redirect Role
    private function redirectBasedOnRole($role)
    {
        switch ($role) {
            case 'admin':
                return redirect('/admin');
            case 'guru':
                return redirect('/guru');
            case 'staff':
                return redirect('/staff');
            case 'siswa':
                return redirect('/siswa');
            default:
                return redirect('/admin');
        }
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