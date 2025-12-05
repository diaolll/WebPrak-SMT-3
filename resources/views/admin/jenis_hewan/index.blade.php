@extends('layouts.gxon.main') 

@section('title', 'Daftar Jenis Hewan')

@section('content-header')
<h1 class="app-page-title">Daftar Jenis Hewan</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Master Data</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Jenis Hewan</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title fw-bold">Tabel Data Jenis Hewan</h5>
                <a href="{{ route('admin.jenis_hewan.create') }}" class="btn btn-primary waves-effect waves-light">
                    <i class="fi fi-rr-plus me-1"></i> Tambah Jenis Hewan
                </a>
            </div>

            <div class="card-body">
                
                {{-- Notifikasi --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if (isset($jenisHewan) && $jenisHewan->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Tidak ada data Jenis Hewan yang ditemukan.
                    </div>
                @else
                    <div class="table-responsive">
                        {{-- Menggunakan table-hover untuk gaya GXON --}}
                        <table class="table table-bordered table-striped table-hover"> 
                            <thead>
                                <tr class="bg-light">
                                    <th style="width: 50px;">No</th> 
                                    <th>Nama Jenis Hewan</th>
                                    <th style="width: 180px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jenisHewan as $index => $item)
                                <tr>
                                    {{-- Nomor Urut --}}
                                    <td>{{ $index + 1 }}</td>
                                    
                                    {{-- Nama Jenis Hewan --}}
                                    <td>{{ $item->nama_jenis_hewan }}</td>
                                    
                                    {{-- Kolom Aksi --}}
                                    <td class="text-center">
                                        {{-- Tombol Edit (Gaya GXON) --}}
                                        <a href="{{ route('admin.jenis_hewan.edit', $item->idjenis_hewan) }}" 
                                            class="btn btn-sm btn-outline-warning waves-effect me-1" title="Edit">
                                            Edit
                                        </a>
                                        
                                        {{-- Tombol Hapus (Gaya GXON) --}}
                                        <form action="{{ route('admin.jenis_hewan.destroy', $item->idjenis_hewan) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger waves-effect" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus jenis hewan ini?')" title="Hapus">
                                                Hapus
                                            </button>
                                        </form>
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