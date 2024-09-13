@extends('layouts.app')

@section('title', 'Data Form Penilaian Peserta')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3>Data Form Penilaian Pengajar</h3>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="GET" action="{{ route('pengajar\penilaian_peserta') }}">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <select class="form-control" name="pelatihan_id">
                                    <option value="">Pilih Pelatihan</option>
                                    @foreach($pelatihans as $pelatihan)
                                        <option value="{{ $pelatihan->id }}" {{ request('pelatihan_id') == $pelatihan->id ? 'selected' : '' }}>
                                            {{ $pelatihan->nama_pelatihan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <select class="form-control" name="bulan">
                                    <option value="">Pilih Bulan</option>
                                    @for($m=1; $m<=12; $m++)
                                        <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="tahun">
                                    <option value="">Pilih Tahun</option>
                                    @for($y=date('Y'); $y>=2000; $y--)
                                        <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="filter">
                                <button type="submit" class="btn btn-primary px-3">Cari</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nama Peserta</th>
                                    <th>NIPP</th>
                                    <th>Terminal</th>
                                    <th>Jabatan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nilai Pretest</th>
                                    <th>Nilai Posttest</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($penilaianDetails) && $penilaianDetails->count() > 0)
                                    @foreach ($penilaianDetails as $detail)
                                        <tr>
                                            <td>{{ $detail->peserta->nama }}</td>
                                            <td>{{ $detail->peserta->NIPP }}</td>
                                            <td>{{ $detail->peserta->terminal->nama_terminal }}</td>
                                            <td>{{ $detail->peserta->jabatan }}</td>
                                            <td>{{ $detail->peserta->jenis_kelamin }}</td>
                                            <td>
                                                <input type="number" class="form-control input-nilai" name="nilai_pretest" form="form-{{ $detail->id }}" value="{{ $detail->nilai_pretest }}" />
                                            </td>
                                            <td>
                                                <input type="number" class="form-control input-nilai" name="nilai_posttest" form="form-{{ $detail->id }}" value="{{ $detail->nilai_posttest }}" />
                                            </td>
                                            <td>
                                                <form id="form-{{ $detail->id }}" action="{{ route('pengajar.updateNilai', $detail->id) }}" method="POST" class="d-flex justify-content-center">
                                                    @csrf

                                                    <input type="hidden" name="pelatihan_id" value="{{ request('pelatihan_id') }}">
                                                    <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                                                    <input type="hidden" name="tahun" value="{{ request('tahun') }}">

                                                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                                                </form>
                                            </td>
                                        </tr>
                                     @endforeach
                                @else
                                     <tr>
                                        <td colspan="8" class="text-center">Tidak ada data penilaian yang ditemukan.</td>
                                     </tr>
                                @endif
                            </tbody>
                        </table>
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection