@extends('layouts.app')

@section('title', 'Edit Terminal')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Edit Terminal</h3>
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
            <form action="{{ route('terminal.update', $terminal) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_terminal">Nama Terminal</label>
                    <input type="text" class="form-control" id="nama_terminal" name="nama_terminal" value="{{ old('nama_terminal', $terminal->nama_terminal) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="{{ route('terminal.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
