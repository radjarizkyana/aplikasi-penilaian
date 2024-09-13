@extends('layouts.app')

@section('title', 'Data Terminal')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h3>Data Terminal</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('terminal.create') }}" class="btn btn-primary mb-3">Tambah Terminal</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Kembali</a>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama Terminal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($terminals as $terminal)
                    <tr>
                        <td>{{ $terminal->nama_terminal }}</td>
                        <td>
                            <a href="{{ route('terminal.edit', $terminal->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('terminal.destroy', $terminal->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin Untuk Menghapus Data Terminal?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
