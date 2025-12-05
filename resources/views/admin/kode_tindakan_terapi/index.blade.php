@extends('layouts.gxon.main') 

@section('title', 'Daftar Kode Tindakan Terapi')

@section('content-header')
<h1 class="app-page-title">Daftar Kode Tindakan Terapi</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Master Data</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Kode Tindakan Terapi</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title fw-bold">Tabel Data Kode Tindakan Terapi</h5>
                <a href="{{ route('admin.kode_tindakan_terapi.create') }}" class="btn btn-primary waves-effect waves-light">
                    <i class="fi fi-rr-plus me-1"></i> Tambah Kode Tindakan
                </a>
            </div>

            <div class="card-body">
                
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if ($kodeTindakan->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Tidak ada data Kode Tindakan Terapi yang ditemukan.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover"> 
                            <thead>
                                <tr class="bg-light">
                                    <th style="width: 50px;">No</th> 
                                    <th>Kode</th>
                                    <th>Nama Tindakan</th>
                                    <th>Kategori Master</th>
                                    <th>Kategori Klinis</th>
                                    <th style="width: 180px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kodeTindakan as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->deskripsi_tindakan_terapi}}</td>
                                    <td>{{ $item->kategori->nama_kategori ?? 'N/A' }}</td>
                                    <td>{{ $item->kategoriKlinis->nama_kategori_klinis ?? 'N/A' }}</td>
                                    
                                    <td class="text-center">
                                        <a href="{{ route('admin.kode_tindakan_terapi.edit', $item->idkode_tindakan_terapi) }}" 
                                            class="btn btn-sm btn-outline-warning waves-effect me-1" title="Edit">
                                            Edit
                                        </a>
                                        
                                        <form action="{{ route('admin.kode_tindakan_terapi.destroy', $item->idkode_tindakan_terapi) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger waves-effect" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus tindakan ini?')" title="Hapus">
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