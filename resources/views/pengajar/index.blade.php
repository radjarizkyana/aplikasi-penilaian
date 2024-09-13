@extends('layouts.app')

@section('title', 'Data Pengajar')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h3>Data Pengajar</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('pengajar.create') }}" class="btn btn-primary mb-3">Tambah Pengajar</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Kembali</a>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>NIPP</th>
                        <th>Nama</th>
                        <th>Perusahaan</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengajars as $pengajar)
                    <tr>
                        <td>{{ $pengajar->NIPP }}</td>
                        <td>{{ $pengajar->nama }}</td>
                        <td>{{ $pengajar->perusahaan }}</td>
                        <td>{{ $pengajar->jabatan }}</td>
                        <td>{{ $pengajar->email }}</td>
                        <td>
                            <a href="{{ route('pengajar.edit', $pengajar->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pengajar.destroy', $pengajar->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin Untuk Menghapus Data Pengajar?')">Hapus</button>
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
