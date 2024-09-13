<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PenilaianPesertaDetail;
use App\Models\PenilaianPeserta;
use App\Models\Peserta;
use App\Models\Terminal;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelatihan;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Schema;

class PengajarController extends Controller
{
    public function index()
    {  
        
        $pengajars = Pengajar::all();
        return view('pengajar.index', compact('pengajars'));
    }

    public function create()
    {
        return view('pengajar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NIPP' => [
                'required',
                'unique:pengajars,NIPP',
                function ($attribute, $value, $fail) {
                    if (Peserta::where('NIPP', $value)->exists()) {
                        $fail('NIPP sudah ada di data peserta. Silakan gunakan NIPP yang berbeda.');
                    }
                }
            ],
            'nama' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'required|email|unique:pengajars,email',
            'password' => 'required|string|min:6',
        ], [
            'NIPP.unique' => 'NIPP sudah ada. Silakan gunakan NIPP yang berbeda.',
            'email.unique' => 'Email sudah ada. Silakan gunakan email yang berbeda.',
            'password.min' => 'Kata sandi harus minimal 6 karakter.',
        ]);
    
        $user = User::create([
            'username' => $request->NIPP,
            'password' => bcrypt($request->password),
            'role' => 'pengajar',
        ]);
    
        Pengajar::create(array_merge($request->all(), ['user_id' => $user->id]));
        return redirect()->route('pengajar.index')->with('success', 'Pengajar berhasil dibuat.');
    }
    

    public function edit(Pengajar $pengajar)
    {
        return view('pengajar.edit', compact('pengajar'));
    }
    public function update(Request $request, $id)
    {
        $pengajar = Pengajar::findOrFail($id);
        
        $request->validate([
            'NIPP' => [
                'required',
                'unique:pengajars,NIPP,' . $id,
                function ($attribute, $value, $fail) use ($id) {
                    if (Peserta::where('NIPP', $value)->where('id', '!=', $id)->exists()) {
                        $fail('NIPP sudah ada di data peserta. Silakan gunakan NIPP yang berbeda.');
                    }
                }
            ],
            'nama' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('pengajars')->ignore($id),
            ],
            'password' => 'nullable|string|min:6',
        ], [
            'NIPP.unique' => 'NIPP sudah ada. Silakan gunakan NIPP yang berbeda.',
            'email.unique' => 'Email sudah ada. Silakan gunakan email yang berbeda.',
            'password.min' => 'Kata sandi harus minimal 6 karakter.',
        ]);
    
        $pengajar->update($request->only(['NIPP', 'nama', 'perusahaan', 'jabatan', 'email']));
    
        if ($pengajar->user_id) {
            $user = User::find($pengajar->user_id);
            if ($user) {
                $user->username = $request->NIPP;
                if ($request->filled('password')) {
                    $user->password = bcrypt($request->password);
                }
                if (Schema::hasColumn('users', 'email')) {
                    $user->email = $request->email;
                }
                $user->save();
            }
        }
    
        return redirect()->route('pengajar.index')->with('success', 'Pengajar berhasil diperbarui.');
    }
    
    
    public function penilaianPeserta(Request $request)
    {
        $pengajar = Auth::user()->pengajar; 
    
        $bulanInput = $request->input('bulan');
        $tahun = $request->input('tahun');
        $pelatihanId = $request->input('pelatihan_id');
    
        $namaBulanIndonesia = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
    
        $namaBulan = $bulanInput ? $namaBulanIndonesia[$bulanInput] : null;
    
        $penilaianDetails = PenilaianPesertaDetail::whereHas('penilaianPeserta', function ($query) use ($pengajar, $namaBulan, $tahun, $pelatihanId) {
            $query->where('pengajar_id', $pengajar->id);
    
            if ($pelatihanId) {
                $query->where('pelatihan_id', $pelatihanId);
            }
    
            if ($namaBulan) {
                $query->where('bulan_penilaian', $namaBulan);
            }
    
            if ($tahun) {
                $query->where('tahun_penilaian', $tahun);
            }
    
        })->get();
        $pelatihans = Pelatihan::all(); 
    
        return view('pengajar.penilaian_peserta', compact('penilaianDetails', 'pelatihans', 'pelatihanId', 'bulanInput', 'tahun'));
    }
    
    
    

    public function updateNilai(Request $request, $id)
    {
        $request->validate([
            'nilai_pretest' => 'nullable|numeric|min:0|max:100',
            'nilai_posttest' => 'nullable|numeric|min:0|max:100',
        ]);
    
        $detail = PenilaianPesertaDetail::findOrFail($id);
        $detail->nilai_pretest = $request->input('nilai_pretest');
        $detail->nilai_posttest = $request->input('nilai_posttest');
        $detail->save();
    
        $pelatihanId = $request->input('pelatihan_id');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
    
        return redirect()->route('pengajar\penilaian_peserta', [
            'pelatihan_id' => $pelatihanId,
            'bulan' => $bulan,
            'tahun' => $tahun
        ])->with('success', 'Nilai berhasil disimpan.');
    }

    public function destroy(Pengajar $pengajar)
    {
        $pengajar->delete();
        return redirect()->route('pengajar.index')->with('success', 'Pengajar berhasil dihapus.');
    }
}
