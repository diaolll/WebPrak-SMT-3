@extends('layouts.gxon.main') 

@section('title', 'Tambah Kategori Klinis')

{{-- Menambahkan slot content-header untuk judul dan breadcrumb GXON --}}
@section('content-header')
<h1 class="app-page-title">Tambah Kategori Klinis</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Master Data</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Kategori Klinis</li>
    </ol>
</nav>
@endsection
{{-- End slot content-header --}}


@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8"> 
        <div class="card shadow-sm border-0"> 
            
            <div class="card-header border-bottom">
                <h5 class="mb-0 card-title fw-bold">Form Tambah Kategori Klinis</h5>
            </div>

            <div class="card-body">
                
                {{-- Menampilkan pesan error dari session (jika ada) --}}
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Formulir Input Data --}}
                <form action="{{ route('admin.kategori_klinis.store') }}" method="POST">
                    @csrf 
                    
                    <div class="mb-3">
                        <label for="nama_kategori_klinis" class="form-label">
                            Nama Kategori Klinis <span class="text-danger">*</span>
                        </label>
                        
                        <input 
                            type="text"
                            name="nama_kategori_klinis"
                            id="nama_kategori_klinis"
                            class="form-control @error('nama_kategori_klinis') is-invalid @enderror"
                            value="{{ old('nama_kategori_klinis') }}" 
                            placeholder="Masukkan nama kategori klinis"
                            required
                        >
                        
                        @error('nama_kategori_klinis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        {{-- Tombol Kembali (Gaya GXON) --}}
                        <a href="{{ route('admin.kategori_klinis.index') }}" class="btn btn-outline-secondary waves-effect">
                            <i class="fi fi-rr-arrow-left me-1"></i> Kembali
                        </a>

                        {{-- Tombol Simpan (Gaya GXON) --}}
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            <i class="fi fi-rr-disk me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection