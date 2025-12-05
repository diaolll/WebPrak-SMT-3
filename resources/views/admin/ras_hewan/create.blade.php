@extends('layouts.gxon.main') 

@section('title', 'Tambah Ras Hewan')

@section('content-header')
<h1 class="app-page-title">Tambah Ras Hewan</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Master Data</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Ras Hewan</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom">
                <h5 class="mb-0 card-title fw-bold">Form Tambah Ras Hewan</h5>
            </div>

            <div class="card-body">
                
                {{-- Menampilkan pesan error dari session (jika ada) --}}
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Formulir Input Data --}}
                <form action="{{ route('admin.ras_hewan.store') }}" method="POST">
                    @csrf 
                    
                    {{-- DROPDOWN UNTUK MEMILIH JENIS HEWAN --}}
                    <div class="mb-3">
                        <label for="idjenis_hewan" class="form-label">
                            Jenis Hewan <span class="text-danger">*</span>
                        </label>
                        
                        <select 
                            name="idjenis_hewan"
                            id="idjenis_hewan"
                            class="form-select @error('idjenis_hewan') is-invalid @enderror"
                            required
                        >
                            <option value="">Pilih Jenis Hewan</option>
                            {{-- Loop melalui data $jenisHewan yang dikirim dari Controller --}}
                            @foreach ($jenisHewan as $jenis)
                                <option value="{{ $jenis->idjenis_hewan }}" 
                                    {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis_hewan }}
                                </option>
                            @endforeach
                        </select>
                        
                        @error('idjenis_hewan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    {{-- Field Nama Ras Hewan --}}
                    <div class="mb-3">
                        <label for="nama_ras" class="form-label">
                            Nama Ras Hewan <span class="text-danger">*</span>
                        </label>
                        
                        <input 
                            type="text"
                            name="nama_ras"
                            id="nama_ras"
                            class="form-control @error('nama_ras') is-invalid @enderror"
                            value="{{ old('nama_ras') }}" 
                            placeholder="Masukkan nama ras hewan"
                            required
                        >
                        
                        @error('nama_ras')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        {{-- Tombol Kembali (Gaya GXON) --}}
                        <a href="{{ route('admin.ras_hewan.index') }}" class="btn btn-outline-secondary waves-effect">
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