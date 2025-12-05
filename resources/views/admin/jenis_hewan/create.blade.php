@extends('layouts.gxon.main') {{-- Mengganti layouts.app menjadi layouts.gxon.main --}}

@section('title', 'Tambah Jenis Hewan')

{{-- Menambahkan slot content-header untuk judul dan breadcrumb GXON --}}
@section('content-header')
<h1 class="app-page-title">Tambah Jenis Hewan</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Master Data</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Jenis Hewan</li>
    </ol>
</nav>
@endsection
{{-- End slot content-header --}}


@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8"> {{-- Menggunakan col-lg-8 untuk form --}}
        <div class="card shadow-sm border-0"> {{-- Struktur Card GXON --}}
            
            <div class="card-header border-bottom">
                <h5 class="mb-0 card-title fw-bold">Form Tambah Jenis Hewan</h5>
            </div>

            <div class="card-body">
                
                {{-- Menampilkan pesan error dari session (jika ada) --}}
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Formulir Input Data --}}
                <form action="{{ route('admin.jenis_hewan.store') }}" method="POST">
                    @csrf 

                    <div class="mb-3">
                        <label for="nama_jenis_hewan" class="form-label">
                            Nama Jenis Hewan <span class="text-danger">*</span>
                        </label>
                        
                        <input 
                            type="text"
                            name="nama_jenis_hewan"
                            id="nama_jenis_hewan"
                            class="form-control @error('nama_jenis_hewan') is-invalid @enderror"
                            value="{{ old('nama_jenis_hewan') }}" 
                            placeholder="Masukkan nama jenis hewan"
                            required
                        >
                        
                        {{-- Menampilkan error validasi spesifik untuk input ini --}}
                        @error('nama_jenis_hewan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        {{-- Tombol Kembali (Gaya GXON) --}}
                        <a href="{{ route('admin.jenis_hewan.index') }}" class="btn btn-outline-secondary waves-effect">
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