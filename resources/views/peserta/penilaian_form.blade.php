@extends('layouts.app')

@section('title', 'Form Penilaian Peserta')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Form Penilaian Peserta</h1>
        </div>
        <div class="card-body">
            
    <form action="{{ route('peserta.penilaian.store') }}" method="POST">
        @csrf
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <div class="form-group">
            <label for="pelatihan_id">Pelatihan</label>
            <select name="pelatihan_id" class="form-control" required>
                <option value="">Pilih Pelatihan</option>
                @foreach($pelatihans as $pelatihan)
                    <option value="{{ $pelatihan->id }}">{{ $pelatihan->nama_pelatihan }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="bulan_penilaian">Bulan Penilaian</label>
            <input type="text" name="bulan_penilaian" class="form-control" placeholder="Bulan (contoh: Januari)" value="{{ request('bulan') }}" required>
        </div>

        <div class="form-group">
            <label for="tahun_penilaian">Tahun Penilaian</label>
            <input type="text" name="tahun_penilaian" class="form-control" placeholder="Tahun (contoh: 2024)" value="{{ request('tahun') }}" required>

        </div>

        <div class="form-group">
            <label for="tanggal_penilaian">Tanggal Penilaian</label>
            <input type="text" name="tanggal_penilaian" placeholder="Tanggal (contoh: 01)" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="pengajar_id">Pengajar</label>
            <select name="pengajar_id" class="form-control" required>
                <option value="">Pilih Pengajar</option>
                @foreach($pengajars as $pengajar)
                    <option value="{{ $pengajar->id }}">{{ $pengajar->nama }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
        </div>
    </div>
</div>
@endsection
