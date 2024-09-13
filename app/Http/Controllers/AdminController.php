<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Pengajar;
use App\Models\Pelatihan;
use App\Models\Terminal;
use App\Models\PenilaianPesertaDetail;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'peserta_count' => Peserta::count(),
            'pengajar_count' => Pengajar::count(),
            'pelatihan_count' => Pelatihan::count(),
            'terminal_count' => Terminal::count(),
            'penilaianDetails' => PenilaianPesertaDetail::count(),
        ]);
    }

    public function managePenilaianPeserta(Request $request)
    {
        $pelatihans = Pelatihan::all();

        $bulanInput = $request->input('bulan');
        $tahun = $request->input('tahun');
        $pelatihanId = $request->input('pelatihan_id');
    
        $namaBulanIndonesia = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
    
        $namaBulan = $bulanInput ? $namaBulanIndonesia[$bulanInput] : null;
    
        $penilaianDetails = PenilaianPesertaDetail::whereHas('penilaianPeserta', function ($query) use ($namaBulan, $tahun, $pelatihanId) {
    
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
    
        return view('admin.manage_penilaian_peserta', compact('penilaianDetails', 'pelatihans', 'pelatihanId', 'bulanInput', 'tahun'));
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
    
        return back()->with('success', 'Nilai berhasil disimpan.');
    }
    
}
