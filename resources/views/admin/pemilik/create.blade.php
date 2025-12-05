@extends('layouts.gxon.main') 

@section('title', 'Tambah Data Pemilik')

@section('content-header')
<h1 class="app-page-title">Tambah Data Pemilik</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Master Data</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Pemilik</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom">
                <h5 class="mb-0 card-title fw-bold">Form Tambah Pemilik & Akun User</h5>
            </div>

            <div class="card-body">
                
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.pemilik.store') }}" method="POST">
                    @csrf 
                    
                    <h6 class="text-primary mb-3">Data Akun User</h6>

                    {{-- Input NAMA PEMILIK --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label">
                            Nama Pemilik <span class="text-danger">*</span>
                        </label>
                        
                        <input 
                            type="text"
                            name="nama"
                            id="nama"
                            class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama') }}" 
                            placeholder="Masukkan nama pemilik"
                            required
                        >
                        
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input EMAIL --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email (Untuk Login) <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="email"
                            name="email"
                            id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" 
                            placeholder="Contoh: nama@example.com"
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input PASSWORD --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Password <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="password"
                            name="password"
                            id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Minimal 8 karakter"
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input KONFIRMASI PASSWORD --}}
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            Konfirmasi Password <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-control"
                            placeholder="Ulangi password"
                            required
                        >
                    </div>
                    
                    <h6 class="text-primary mb-3 mt-4">Data Detail Pemilik</h6>

                    {{-- Input Nomor WhatsApp (no_wa) --}}
                    <div class="mb-3">
                        <label for="no_wa" class="form-label">
                            Nomor WhatsApp <span class="text-danger">*</span>
                        </label>
                        
                        <input 
                            type="text"
                            name="no_wa"
                            id="no_wa"
                            class="form-control @error('no_wa') is-invalid @enderror"
                            value="{{ old('no_wa') }}" 
                            placeholder="Masukkan nomor WhatsApp (misal: 08123xxxx)"
                            required
                        >
                        
                        @error('no_wa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Alamat --}}
                    <div class="mb-3">
                        <label for="alamat" class="form-label">
                            Alamat <span class="text-danger">*</span>
                        </label>
                        
                        <textarea 
                            name="alamat"
                            id="alamat"
                            class="form-control @error('alamat') is-invalid @enderror"
                            rows="3"
                            placeholder="Masukkan alamat lengkap pemilik"
                            required
                        >{{ old('alamat') }}</textarea>
                        
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.pemilik.index') }}" class="btn btn-outline-secondary waves-effect">
                            <i class="fi fi-rr-arrow-left me-1"></i> Kembali
                        </a>

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