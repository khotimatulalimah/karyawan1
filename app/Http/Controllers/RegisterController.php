<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    public function showLoginForm()
{
    return view('login'); // Gantilah dengan nama view login Anda
}

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        // Cek kredensial login dengan kolom name dan password
        if (Auth::attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect()->intended('/app'); // Redirect setelah login berhasil
        }

        // Jika gagal login, redirect kembali dengan pesan error (opsional)
        return back()->withErrors(['login' => 'Nama atau password salah.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('register');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'nama' => ['required', 'min:3', 'max:10'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'max:10'],
            'role' => ['required', 'string', 'in:admin,user']
        ]);

        $incomingFields['name'] = $incomingFields['nama'];
        unset($incomingFields['nama']);

        // Mengenkripsi password
        $incomingFields['password'] = bcrypt($incomingFields['password']);

        // Membuat pengguna baru
        $user = User::create($incomingFields);

        // Login pengguna yang baru terdaftar
        Auth::login($user);

        return redirect('register');
    }
}