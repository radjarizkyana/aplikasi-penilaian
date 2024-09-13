@extends('layouts.app')

@section('title', 'Tambah Peserta')

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            <h1>Tambah Peserta</h1>
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
            <form action="{{ route('peserta.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="NIPP">NIPP</label>
                    <input type="text" class="form-control" id="NIPP" name="NIPP" required>
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="terminal_id">Terminal</label>
                    <select class="form-control" id="terminal_id" name="terminal_id" required>
                        <option value="">Pilih Terminal</option>
                        @foreach($terminals as $terminal)
                            <option value="{{ $terminal->id }}">{{ $terminal->nama_terminal }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('peserta.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
