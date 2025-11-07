{{-- resources/views/admin/pet/index.blade.php --}}

@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12"> {{-- Menggunakan col-md-12 karena tabel lebar --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Pet 🐶🐱</h5>
                </div>

                <div class="card-body">
                    @if ($pets->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            Tidak ada data Pet yang ditemukan.
                        </div>
                    @else
                        <div class="table-responsive">
                            {{-- BENTUK TABEL (GAYA BOOTSTRAP) --}}
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">No</th> 
                                        <th>Nama Pet</th>
                                        <th>Tgl Lahir</th>
                                        <th>Warna Tanda</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Ras Hewan</th>
                                        <th>Nama Pemilik</th>
                                        {{-- TANPA KOLOM AKSI --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pets as $index => $pet)
                                    <tr>
                                        <td>{{ $index + 1}}</td> 
                                        <td>{{ $pet->nama }}</td> 
                                        <td>{{ $pet->tanggal_lahir }}</td>
                                        <td>{{ $pet->warna_tanda }}</td>
                                        <td>{{ $pet->jenis_kelamin }}</td> 
                                        <td>{{ $pet->rasHewan->nama_ras }}</td>
                                        <td>{{ $pet->pemilik->user->nama }}</td> 
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