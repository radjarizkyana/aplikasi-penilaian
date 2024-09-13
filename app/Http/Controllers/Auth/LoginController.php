<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
        
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('status', 'Masuk berhasil, Selamat datang Admin!');
            } elseif ($user->role == 'pengajar') {
                $pengajar = \App\Models\Pengajar::where('user_id', $user->id)->first();
                $name = $pengajar ? $pengajar->nama : 'Pengajar';
                return redirect()->route('pengajar\penilaian_peserta')->with('status', "Masuk berhasil, Selamat datang $name!");
            } elseif ($user->role == 'peserta') {
                $peserta = \App\Models\Peserta::where('user_id', $user->id)->first();
                $name = $peserta ? $peserta->nama : 'Peserta';
                return redirect()->route('peserta.penilaian.form')->with('status', "Masuk berhasil, Selamat datang $name!");
            }
        }
        

        return redirect()->back()->withErrors([
            'password' => 'Gagal. Silahkan coba lagi.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    }
}
