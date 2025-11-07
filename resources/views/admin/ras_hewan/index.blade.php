{{-- File: resources/views/perawat/ras_hewan/index.blade.php (contoh) --}}

@extends('layouts.app') {{-- Sesuaikan dengan nama layout utama Anda --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> {{-- Ubah ukuran kolom sesuai kebutuhan --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Ras Hewan 🐶🐱</h5>
                </div>

                <div class="card-body">
                    {{-- Tombol untuk menambah data baru (Jika ada) --}}
                    {{-- <a href="{{ route('perawat.ras_hewan.create') }}" class="btn btn-primary mb-3">
                        Tambah Ras Hewan Baru
                    </a> --}}

                    @if ($rashewan->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            Tidak ada data Ras Hewan yang ditemukan.
                        </div>
                    @else
                        <div class="table-responsive">
                            {{-- Menggunakan kelas table, table-bordered, dan table-striped dari Bootstrap --}}
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">No</th> {{-- Atur lebar agar tidak terlalu lebar --}}
                                        <th>Nama Ras Hewan</th>
                                        <th>Aksi</th> {{-- Tambahkan kolom Aksi --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rashewan as $index => $ras)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $ras->nama_ras }}</td>
                                        <td>
                                            {{-- Contoh tombol aksi --}}
                                            <a href="#" class="btn btn-sm btn-info">Detail</a>
                                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                        </td>
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