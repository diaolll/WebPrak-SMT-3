@extends('layouts.gxon.main') 

@section('title', 'Dashboard Pemilik')

@section('content-header')
<h1 class="app-page-title">Dashboard Pemilik</h1>
<p class="text-muted">Selamat datang, {{ $ownerName }}. Berikut adalah daftar hewan kesayangan Anda.</p>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title fw-bold">
                    <i class="fi fi-rr-paw me-2 text-primary"></i> Daftar Hewan Kesayangan
                </h5>
            </div>

            <div class="card-body">
                
                {{-- PERBAIKAN: Menggunakan variabel $pets --}}
                @if ($pets->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Anda belum mendaftarkan Hewan Peliharaan di sistem kami.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-smooth table-unlined">
                            <thead>
                                <tr class="bg-light">
                                    <th style="width: 50px;">No</th> 
                                    <th>Nama Pet</th>
                                    <th>Jenis & Ras</th>
                                    <th>Tgl Lahir</th>
                                    <th>Kelamin</th>
                                    <th>Warna Tanda</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pets as $index => $pet) {{-- Menggunakan $pets --}}
                                <tr>
                                    <td>{{ $index + 1}}</td> 
                                    <td>{{ $pet->nama }}</td>
                                    <td>
                                        {{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? 'N/A' }} 
                                        / 
                                        {{ $pet->rasHewan->nama_ras ?? 'N/A' }}
                                    </td>
                                    <td>{{ $pet->tanggal_lahir ? \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d M Y') : '-' }}</td>
                                    <td>{{ $pet->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}</td> 
                                    <td>{{ $pet->warna_tanda ?? '-' }}</td> 
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