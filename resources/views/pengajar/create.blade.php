@extends('layouts.app')

@section('title', 'Tambah Pengajar')

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            <h1>Tambah Pengajar</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('pengajar.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="NIPP">NIPP</label>
                    <input type="text" class="form-control" name="NIPP" required>
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="perusahaan">Perusahaan</label>
                    <input type="text" class="form-control" name="perusahaan" required>
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" class="form-control" name="jabatan" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('pengajar.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
