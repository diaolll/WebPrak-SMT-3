@extends('layouts.gxon.main')

@section('title', 'Dashboard Dokter')

@section('content-header')
<h1 class="app-page-title">Dashboard Dokter</h1>
<p class="text-muted">Selamat datang, {{ Auth::user()->nama ?? 'Dokter' }}. Berikut adalah daftar pasien yang ditugaskan kepada Anda hari ini.</p>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom">
                <h5 class="mb-0 card-title fw-bold">
                    <i class="fi fi-rr-stethoscope me-2 text-primary"></i> Pasien Hari Ini
                </h5>
            </div>

            <div class="card-body">
                {{-- PERBAIKAN: Menambahkan deklarasi Carbon di sini --}}
                @php use Carbon\Carbon; @endphp 

                @if ($pasienHariIni->isEmpty())
                    <div class="alert alert-info">
                        Tidak ada pasien baru yang ditugaskan kepada Anda hari ini.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-smooth table-unlined">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th>Waktu Daftar</th>
                                    <th>Nama Pet</th>
                                    <th>Pemilik</th>
                                    <th>Status</th>
                                    <th style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pasienHariIni as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td> 
                                    {{-- Carbon sekarang bisa dipanggil karena sudah dideklarasikan --}}
                                    <td>{{ Carbon::parse($data->created_at)->format('H:i') }}</td> 
                                    <td>{{ $data->pet->nama }}</td>
                                    <td>{{ $data->pet->pemilik->user->nama ?? 'N/A' }}</td>
                                    <td>
                                        @php
                                            $status = $data->status_pemeriksaan ?? 'Menunggu';
                                            $class = ['Menunggu' => 'bg-warning text-dark', 'Diperiksa' => 'bg-primary text-white', 'Selesai' => 'bg-success text-white',][$status] ?? 'bg-secondary text-white';
                                        @endphp
                                        <span class="badge rounded-pill {{ $class }}">{{ $status }}</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary waves-effect">
                                            Mulai Periksa
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