@extends('layouts.app')

@section('title', 'Halaman Utama Admin')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white text-center">
        <h2>Halaman Utama Admin</h2>
        </div>
        <div class="card-body">
            <h3 class="text-center mb-3">Selamat datang di halaman utama, Admin!</h3>
            <p class="text-center">Kelola data peserta, pengajar, pelatihan, terminal, dan penilaian peserta melalui halaman utama ini.</p>
            <div class="row justify-content-center">
                
                <div class="col-md-4 mb-4">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Peserta</h5>
                            <p class="card-text">Jumlah: {{ $peserta_count }}</p>
                            <a href="{{ route('peserta.index') }}" class="btn btn-primary">Kelola Peserta</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Pengajar</h5>
                            <p class="card-text">Jumlah: {{ $pengajar_count }}</p>
                            <a href="{{ route('pengajar.index') }}" class="btn btn-primary">Kelola Pengajar</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Pelatihan</h5>
                            <p class="card-text">Jumlah: {{ $pelatihan_count }}</p>
                            <a href="{{ route('pelatihan.index') }}" class="btn btn-primary">Kelola Pelatihan</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Terminal</h5>
                            <p class="card-text">Jumlah: {{ $terminal_count }}</p>
                            <a href="{{ route('terminal.index') }}" class="btn btn-primary">Kelola Terminal</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Penilaian Peserta</h5>
                            <p class="card-text">Jumlah: {{ $penilaianDetails }}</p>
                            <a href="{{ route('admin.penilaian_peserta') }}" class="btn btn-primary">Kelola Penilaian</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
