@extends('layouts.app')

@section('title', 'Data Peserta')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h3>Data Peserta</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('peserta.create') }}" class="btn btn-primary mb-3">Tambah Peserta</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Kembali</a>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>NIPP</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Terminal</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesertas as $peserta)
                    <tr>
                        <td>{{ $peserta->NIPP }}</td>
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ $peserta->jenis_kelamin }}</td>
                        <td>{{ $peserta->terminal->nama_terminal }}</td>
                        <td>{{ $peserta->jabatan }}</td>
                        <td>
                            <a href="{{ route('peserta.edit', $peserta->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('peserta.destroy', $peserta->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin Untuk Menghapus Data Peserta?')">Hapus</button>
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
