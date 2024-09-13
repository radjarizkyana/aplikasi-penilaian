@extends('layouts.app')

@section('title', 'Data Pelatihan')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h3>Data Pelatihan</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('pelatihan.create') }}" class="btn btn-primary mb-3">Tambah Pelatihan</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Kembali</a>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama Pelatihan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pelatihans as $pelatihan)
                    <tr>
                        <td>{{ $pelatihan->nama_pelatihan }}</td>
                        <td>
                            <a href="{{ route('pelatihan.edit', $pelatihan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pelatihan.destroy', $pelatihan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin Untuk Menghapus Data Pelatihan?')">Hapus</button>
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
