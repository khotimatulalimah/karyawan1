<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required',
        ]);

        if (Auth::attempt(['name' => $credentials['loginname'], 'password' => $credentials['loginpassword']])) {
            $request->session()->regenerate();
            return redirect()->route('sale.index'); // Redirect ke halaman sale.index
        }

        return back()->withErrors([
            'loginname' => 'Login gagal. Silakan periksa kembali nama atau password Anda.',
        ]);
    }
}
