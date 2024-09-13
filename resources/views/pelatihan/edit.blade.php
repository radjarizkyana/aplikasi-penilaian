@extends('layouts.app')

@section('title', 'Edit Pelatihan')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Edit Pelatihan</h3>
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
            <form action="{{ route('pelatihan.update', $pelatihan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_pelatihan">Nama Pelatihan</label>
                    <input type="text" name="nama_pelatihan" class="form-control" value="{{ $pelatihan->nama_pelatihan }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="{{ route('pelatihan.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
