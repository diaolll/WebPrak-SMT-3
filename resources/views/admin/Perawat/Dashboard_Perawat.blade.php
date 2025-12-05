@extends('layouts.gxon.main')

@section('title', 'Dashboard Perawat')

@section('content-header')
<h1 class="app-page-title">Dashboard Perawat</h1>
<p class="text-muted">Selamat datang kembali, {{ session('user_name') }}. Berikut adalah daftar antrian pasien hari ini.</p>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title fw-bold">
                    <i class="fi fi-rr-list-ol me-2 text-primary"></i> Antrian Pemeriksaan Hari Ini
                </h5>
            </div>

            <div class="card-body p-5 pt-3"> 
                
                {{-- PENTING: Deklarasi Carbon --}}
                @php use Carbon\Carbon; @endphp
                
                <h6 class="text-uppercase text-muted small fw-bold mb-3">
                    ANTRIAN PASIEN HARI INI ({{ Carbon::now()->format('d F Y') }})
                </h6>

                @if (empty($rekamMedisAntrian) || $rekamMedisAntrian->isEmpty())
                <div class="alert alert-info" role="alert">
                    Tidak ada pasien dalam antrian hari ini.
                </div>
                @else
                {{-- Tabel Antrian (Gaya GXON) --}}
                <div class="table-responsive shadow-sm rounded-lg border">
                    <table class="table table-hover table-borderless mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Waktu Daftar</th>
                                <th>Nama Pet</th>
                                <th>Jenis/Ras Hewan</th>
                                <th>Nama Pemilik</th>
                                <th>Status</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekamMedisAntrian as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                {{-- Carbon sekarang dapat digunakan --}}
                                <td>{{ Carbon::parse($data->created_at)->format('H:i') }}</td>
                                <td>{{ $data->pet->nama ?? 'N/A' }}</td>
                                <td>{{ $data->pet->rasHewan->jenisHewan->nama_jenis_hewan ?? 'N/A' }} / {{ $data->pet->rasHewan->nama_ras ?? 'N/A' }}</td>
                                <td>{{ $data->pet->pemilik->user->nama ?? 'N/A' }}</td>
                                <td>
                                    @php
                                    $status = $data->status_pemeriksaan ?? 'Menunggu';
                                    $class = [
                                    'Menunggu' => 'bg-warning text-dark',
                                    'Diperiksa' => 'bg-primary text-white',
                                    'Selesai' => 'bg-success text-white',
                                    ][$status] ?? 'bg-secondary text-white';
                                    @endphp
                                    <span class="badge rounded-pill {{ $class }}">{{ $status }}</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary waves-effect">
                                        Periksa
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection