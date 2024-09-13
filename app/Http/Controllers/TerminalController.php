<?php

namespace App\Http\Controllers;

use App\Models\Terminal;
use Illuminate\Http\Request;

class TerminalController extends Controller
{
    public function index()
    {
        $terminals = Terminal::all();
        return view('terminal.index', compact('terminals'));
    }

    public function create()
    {
        return view('terminal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_terminal' => 'required|unique:terminals',
        ], [
            'nama_terminal.unique' => 'Nama Terminal sudah ada. Silakan gunakan Nama Terminal yang berbeda.',
        ]);

        Terminal::create($request->all());
        return redirect()->route('terminal.index')->with('success', 'Terminal berhasil dibuat.');
    }

    public function edit(Terminal $terminal)
    {
        return view('terminal.edit', compact('terminal'));
    }

    public function update(Request $request, Terminal $terminal)
    {
        $request->validate([
            'nama_terminal' => 'required|unique:terminals|string|max:255',
        ], [
            'nama_terminal.unique' => 'Nama Terminal sudah ada. Silakan gunakan Nama Terminal yang berbeda.',
        ]);
    
        $terminal->update($request->all());
    
        return redirect()->route('terminal.index')->with('success', 'Terminal berhasil diperbarui.');
    }

    public function destroy(Terminal $terminal)
    {
        $terminal->delete();
        return redirect()->route('terminal.index')->with('success', 'Terminal berhasil dihapus.');
    }
}
