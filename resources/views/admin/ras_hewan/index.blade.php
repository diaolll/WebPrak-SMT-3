@extends('layouts.gxon.main') 

@section('title', 'Daftar Ras Hewan')

@section('content-header')
<h1 class="app-page-title">Daftar Ras Hewan</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Master Data</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Ras Hewan</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title fw-bold">Tabel Data Ras Hewan</h5>
                <a href="{{ route('admin.ras_hewan.create') }}" class="btn btn-primary waves-effect waves-light">
                    <i class="fi fi-rr-plus me-1"></i> Tambah Ras Hewan
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

                @if ($rashewan->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Tidak ada data Ras Hewan yang ditemukan.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-light">
                                    <th style="width: 50px;">No</th>
                                    <th>Jenis Hewan</th> {{-- Tambahkan Jenis Hewan --}}
                                    <th>Nama Ras Hewan</th>
                                    <th style="width: 180px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rashewan as $index => $ras)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    {{-- Mengakses Jenis Hewan melalui relasi bersarang di Model RasHewan --}}
                                    <td>{{ $ras->jenisHewan->nama_jenis_hewan ?? 'N/A' }}</td>
                                    <td>{{ $ras->nama_ras }}</td>
                                    <td class="text-center">
                                        {{-- Tombol Edit (Gaya GXON) --}}
                                        <a href="{{ route('admin.ras_hewan.edit', $ras->idras_hewan) }}" 
                                            class="btn btn-sm btn-outline-warning waves-effect me-1" title="Edit">
                                            Edit
                                        </a>
                                        
                                        {{-- Tombol Hapus (Gaya GXON) --}}
                                        <form action="{{ route('admin.ras_hewan.destroy', $ras->idras_hewan) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger waves-effect" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus ras hewan ini?')" title="Hapus">
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