{{-- resources/views/admin/kategori-klinis/index.blade.php --}}

@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> 
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Kategori Klinis 🏥</h5>
                </div>

                <div class="card-body">
                    {{-- Tombol Tambah/Aksi (jika ada) diletakkan di sini, tapi kita hilangkan sesuai permintaan sebelumnya --}}

                    @if ($kategoriKlinis->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            Tidak ada data Kategori Klinis yang ditemukan.
                        </div>
                    @else
                        <div class="table-responsive mb-3">
                            {{-- BENTUK TABEL (GAYA BOOTSTRAP) --}}
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">No</th> 
                                        <th>Nama Kategori Klinis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategoriKlinis as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1}}</td> 
                                        <td>{{ $item->nama_kategori_klinis }}</td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    
                    {{-- TOMBOL KEMBALI KE DASHBOARD DITAMBAHKAN DI BAWAH TABEL --}}
                    <div class="mt-3">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection