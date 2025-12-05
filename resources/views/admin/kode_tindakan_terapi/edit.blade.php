@extends('layouts.gxon.main') 

@section('title', 'Edit Kode Tindakan Terapi')

@section('content-header')
<h1 class="app-page-title">Edit Kode Tindakan Terapi</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Master Data</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Edit Kode Tindakan Terapi</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8"> 
        <div class="card shadow-sm border-0"> 
            
            <div class="card-header border-bottom">
                <h5 class="mb-0 card-title fw-bold">Edit Kode Tindakan Terapi: {{ $kodeTindakan->deskripsi_tindakan_terapi }}</h5>
            </div>

            <div class="card-body">
                
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.kode_tindakan_terapi.update', $kodeTindakan->idkode_tindakan_terapi) }}" method="POST">
                    @csrf 
                    
                    {{-- DROPDOWN KATEGORI MASTER (idkategori) --}}
                    <div class="mb-3">
                        <label for="idkategori" class="form-label">
                            Kategori <span class="text-danger">*</span>
                        </label>
                        
                        <select 
                            name="idkategori"
                            id="idkategori"
                            class="form-select @error('idkategori') is-invalid @enderror"
                            required
                        >
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->idkategori }}" 
                                    {{ old('idkategori', $kodeTindakan->idkategori) == $item->idkategori ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        
                        @error('idkategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- DROPDOWN KATEGORI KLINIS (idkategori_klinis) --}}
                    <div class="mb-3">
                        <label for="idkategori_klinis" class="form-label">
                            Kategori Klinis <span class="text-danger">*</span>
                        </label>
                        
                        <select 
                            name="idkategori_klinis"
                            id="idkategori_klinis"
                            class="form-select @error('idkategori_klinis') is-invalid @enderror"
                            required
                        >
                            <option value="">Pilih Kategori Klinis</option>
                            @foreach ($kategoriKlinis as $item)
                                <option value="{{ $item->idkategori_klinis }}" 
                                    {{ old('idkategori_klinis', $kodeTindakan->idkategori_klinis) == $item->idkategori_klinis ? 'selected' : '' }}>
                                    {{ $item->nama_kategori_klinis }}
                                </option>
                            @endforeach
                        </select>
                        
                        @error('idkategori_klinis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Input KODE --}}
                    <div class="mb-3">
                        <label for="kode" class="form-label">
                            Kode Tindakan <span class="text-danger">*</span>
                        </label>
                        
                        <input 
                            type="text"
                            name="kode"
                            id="kode"
                            class="form-control @error('kode') is-invalid @enderror"
                            value="{{ old('kode', $kodeTindakan->kode) }}" 
                            placeholder="Masukkan kode tindakan (contoh: VET001)"
                            required
                        >
                        
                        @error('kode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Input NAMA TINDAKAN (Dipetakan ke deskripsi_tindakan_terapi) --}}
                    <div class="mb-3">
                        <label for="nama_tindakan" class="form-label">
                            Nama Tindakan / Deskripsi <span class="text-danger">*</span>
                        </label>
                        
                        <input 
                            type="text"
                            name="nama_tindakan"
                            id="nama_tindakan"
                            class="form-control @error('nama_tindakan') is-invalid @enderror"
                            value="{{ old('nama_tindakan', $kodeTindakan->deskripsi_tindakan_terapi) }}" 
                            placeholder="Masukkan nama tindakan (ini akan disimpan sebagai deskripsi)"
                            required
                        >
                        
                        @error('nama_tindakan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.kode_tindakan_terapi.index') }}" class="btn btn-outline-secondary waves-effect">
                            <i class="fi fi-rr-arrow-left me-1"></i> Kembali
                        </a>

                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            <i class="fi fi-rr-disk me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection