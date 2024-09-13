<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Terminal;
use App\Models\User;
use App\Models\Pelatihan;
use App\Models\Pengajar;
use App\Models\PenilaianPeserta;
use App\Models\PenilaianPesertaDetail;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    public function index()
    {
        $pesertas = Peserta::all();
        return view('peserta.index', compact('pesertas'));
    }
    
    public function create()
    {
        $terminals = Terminal::all();
        return view('peserta.create', compact('terminals'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'NIPP' => [
            'required',
            'unique:pesertas,NIPP',
            function ($attribute, $value, $fail) {
                if (Pengajar::where('NIPP', $value)->exists()) {
                    $fail('NIPP sudah ada di data pengajar. Silakan gunakan NIPP yang berbeda.');
                }
            }
        ],
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:10',
            'terminal_id' => 'required|exists:terminals,id',
            'jabatan' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ], [
            'NIPP.unique' => 'NIPP sudah ada. Silakan gunakan NIPP yang berbeda.',
            'password.min' => 'Kata sandi harus minimal 6 karakter.',
        ]);

        $user = User::create([
            'username' => $request->NIPP,
            'password' => bcrypt($request->password),
            'role' => 'peserta',
        ]);

        Peserta::create([
            'NIPP' => $request->NIPP,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'terminal_id' => $request->terminal_id,
            'user_id' => $user->id,
            'jabatan' => $request->jabatan
        ]);

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil dibuat.');
    }
    
    public function edit($id)
    {
        $peserta = Peserta::find($id);
        $terminals = Terminal::all(); 
        return view('peserta.edit', compact('peserta', 'terminals'));
    }
    
    public function update(Request $request, $id) 
    {
        $request->validate([
            'NIPP' => [
            'required',
            'unique:pesertas,NIPP,' . $id,
            function ($attribute, $value, $fail) {
                if (Pengajar::where('NIPP', $value)->exists()) {
                    $fail('NIPP sudah ada di data pengajar. Silakan gunakan NIPP yang berbeda.');
                }
            }
        ],
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:10',
            'terminal_id' => 'required|exists:terminals,id',
            'jabatan' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ], [
            'NIPP.unique' => 'NIPP sudah ada. Silakan gunakan NIPP yang berbeda.',
            'password.min' => 'Kata sandi harus minimal 6 karakter.',
        ]);
    
        $peserta = Peserta::find($id);

        $user = User::find($peserta->user_id);
        $user->username = $request->NIPP;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        $peserta->NIPP = $request->NIPP;
        $peserta->nama = $request->nama;
        $peserta->jenis_kelamin = $request->jenis_kelamin;
        $peserta->terminal_id = $request->terminal_id;
        $peserta->jabatan = $request->jabatan;
        $peserta->save();

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil diperbarui.');
    }

    public function showPenilaianForm()
    {
        $pelatihans = Pelatihan::all();
        $pengajars = Pengajar::all();

        return view('peserta.penilaian_form', compact('pelatihans', 'pengajars'));
    }

    public function storePenilaian(Request $request)
    {
        $request->validate([
            'pelatihan_id' => 'required|exists:pelatihans,id',
            'bulan_penilaian' => 'required|string',
            'tahun_penilaian' => 'required|string',
            'tanggal_penilaian' => 'required|string',
            'pengajar_id' => 'required|exists:pengajars,id',
        ]);
    
        $peserta = Peserta::where('user_id', Auth::id())->first();
    
        if (!$peserta) {
            return redirect()->back()->with('error', 'Peserta tidak ditemukan.');
        }
    
        $penilaianPeserta = PenilaianPeserta::create([
            'pelatihan_id' => $request->pelatihan_id,
            'bulan_penilaian' => $request->bulan_penilaian,
            'tahun_penilaian' => $request->tahun_penilaian,
            'tanggal_penilaian' => $request->tanggal_penilaian,
            'pengajar_id' => $request->pengajar_id,
        ]);
        
    
        $penilaianPesertaDetail = PenilaianPesertaDetail::create([
            'penilaian_id' => $penilaianPeserta->id,
            'peserta_id' => $peserta->id,
            'nilai_pretest' => 0,
            'nilai_posttest' => 0,
        ]);
    
        return redirect()->route('peserta.penilaian.form')->with('success', 'Penilaian berhasil dibuat.');
    }

    public function destroy($peserta)
    {
        
        $peserta = Peserta::find($peserta);

        if ($peserta) {
            $user = User::find($peserta->user_id);
            if ($user) {
                $user->delete();
            }
            
            $peserta->delete();
        }

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil dihapus.');
    }
}
