@extends('layouts.app')

@section('title', 'Edit Peserta')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Edit Peserta</h3>
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
            <form action="{{ route('peserta.update', $peserta->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="NIPP">NIPP</label>
                    <input type="text" class="form-control" id="NIPP" name="NIPP" value="{{ old('NIPP', $peserta->NIPP) }}" required>
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $peserta->nama) }}" required>
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ $peserta->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $peserta->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="terminal_id">Terminal</label>
                    <select class="form-control" id="terminal_id" name="terminal_id" required>
                        <option value="">Pilih Terminal</option>
                        @foreach($terminals as $terminal)
                            <option value="{{ $terminal->id }}" {{ $peserta->terminal_id == $terminal->id ? 'selected' : '' }}>
                                {{ $terminal->nama_terminal }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan', $peserta->jabatan) }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="{{ route('peserta.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
