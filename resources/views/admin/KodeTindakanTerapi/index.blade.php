{{-- resources/views/admin/kode-tindakan-terapi/index.blade.php --}}

@extends('layouts.app') {{-- Pastikan nama layout Anda benar --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10"> {{-- Ukuran kolom disesuaikan karena ada 3 kolom data --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Kode Tindakan Terapi 💉</h5>
                </div>

                <div class="card-body">
                    @if ($kodeTindakanTerapi->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            Tidak ada data Kode Tindakan Terapi yang ditemukan.
                        </div>
                    @else
                        <div class="table-responsive">
                            {{-- BENTUK TABEL (GAYA BOOTSTRAP) DISAMAKAN --}}
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">No</th> 
                                        <th style="width: 150px;">Kode</th> {{-- Beri lebar agar kolom Kode tidak terlalu lebar --}}
                                        <th>Deskripsi Tindakan Terapi</th>
                                        {{-- TANPA KOLOM AKSI --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kodeTindakanTerapi as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1}}</td> 
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->deskripsi_tindakan_terapi }}</td> 
                                        {{-- TANPA SEL AKSI --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                     <div class="mt-3">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection