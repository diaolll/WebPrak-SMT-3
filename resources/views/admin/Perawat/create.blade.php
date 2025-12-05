@extends('layouts.gxon.main')

@section('title', 'Tambah Perawat') {{-- Tidak perlu isEdit di title saat create --}}

@section('content-header')
<h1 class="app-page-title">Tambah Perawat</h1>
<p class="text-muted">Buat akun User sekaligus data detail Perawat baru.</p>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0"> 
            
            <div class="card-header border-bottom">
                <h5 class="mb-0 card-title fw-bold text-primary">Form Tambah Perawat & User</h5>
            </div>

            <div class="card-body p-4 p-sm-5">
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                
                <form action="{{ route('admin.perawat.store') }}" method="POST">
                    @csrf
                    
                    {{-- INPUTS USER --}}
                    <h6 class="text-primary mb-3">Data Akun User</h6>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama User <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>

                    {{-- INPUTS PERAWAT DETAIL --}}
                    <h6 class="text-primary mb-3 mt-4">Data Detail Perawat</h6>
                    
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat') }}</textarea>
                        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor HP <span class="text-danger">*</span></label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required>
                        @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="pendidikan" class="form-label">Pendidikan Terakhir <span class="text-danger">*</span></label>
                        <input type="text" name="pendidikan" id="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror" value="{{ old('pendidikan') }}" required>
                        @error('pendidikan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-100">
                        <i class="fi fi-rr-disk me-1"></i> Simpan Perawat
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection