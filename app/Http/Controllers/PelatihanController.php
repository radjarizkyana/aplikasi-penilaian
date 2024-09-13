<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    public function index()
    {
        $pelatihans = Pelatihan::all();
        return view('pelatihan.index', compact('pelatihans'));
    }

    public function create()
    {
        return view('pelatihan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelatihan' => 'required|unique:pelatihans',
        ], [
            'nama_pelatihan.unique' => 'Nama Pelatihan sudah ada. Silakan gunakan Nama Pelatihan yang berbeda.',
        ]);

        Pelatihan::create($request->all());
        return redirect()->route('pelatihan.index')->with('success', 'Pelatihan berhasil dibuat.');
    }

    public function edit(Pelatihan $pelatihan)
    {
        return view('pelatihan.edit', compact('pelatihan'));
    }

    public function update(Request $request, Pelatihan $pelatihan)
    {
        $request->validate([
            'nama_pelatihan' => 'required|unique:pelatihans,nama_pelatihan,' . $pelatihan->id,
        ], [
            'nama_pelatihan.unique' => 'Nama Pelatihan sudah ada. Silakan gunakan Nama Pelatihan yang berbeda.',
        ]);

        $pelatihan->update($request->all());
        return redirect()->route('pelatihan.index')->with('success', 'Pelatihan berhasil diperbarui.');
    }

    public function destroy(Pelatihan $pelatihan)
    {
        $pelatihan->delete();
        return redirect()->route('pelatihan.index')->with('success', 'Pelatihan berhasil dihapus.');
    }
}
