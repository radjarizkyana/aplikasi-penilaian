@extends('layouts.app')

@section('title', 'Tambah Terminal')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Tambah Terminal</h1>
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
            <form action="{{ route('terminal.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_terminal">Nama Terminal</label>
                    <input type="text" class="form-control" name="nama_terminal" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('terminal.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
