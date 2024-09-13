@extends('layouts.app')

@section('title', 'Edit Pengajar')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Edit Pengajar</h3>
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
            <form action="{{ route('pengajar.update', $pengajar) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="NIPP">NIPP</label>
                    <input type="text" name="NIPP" class="form-control" value="{{ $pengajar->NIPP }}" required>
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ $pengajar->nama }}" required>
                </div>

                <div class="form-group">
                    <label for="perusahaan">Perusahaan</label>
                    <input type="text" name="perusahaan" class="form-control" value="{{ $pengajar->perusahaan }}" required>
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" value="{{ $pengajar->jabatan }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $pengajar->email }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="{{ route('pengajar.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
