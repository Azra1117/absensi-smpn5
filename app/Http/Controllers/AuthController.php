<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Halaman Login
    public function index()
    {
        // Jika session native sudah ada, langsung lempar ke dashboard sesuai role
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user_id'])) {
            $role = $_SESSION['role'] ?? 'admin';
            if ($role === 'admin') return redirect('/admin');
            if ($role === 'guru') return redirect('/guru');
            if ($role === 'staff') return redirect('/staff');
            if ($role === 'siswa') return redirect('/siswa');
        }

        return view('auth.login');
    }

    // Proses Login (Bypass Laravel Auth pakai Native Session)
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            
            // Mulai Native Session PHP
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->username;
            $_SESSION['role'] = $user->role ?? 'admin';

            switch ($user->role) {
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

        return back()->with('error', 'Username atau Password salah');
    }

    // Logout
    public function logout(Request $request)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        session_unset();
        session_destroy();

        return redirect('/');
    }
}