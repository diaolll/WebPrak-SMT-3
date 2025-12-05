@extends('layouts.gxon.main')

@section('title', 'Edit Dokter')

@section('content-header')
<h1 class="app-page-title">Edit Dokter</h1>
<p class="text-muted">Perbarui data profesional Dokter: {{ $dokter->user->nama ?? 'N/A' }}</p>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0"> 
            
            <div class="card-header border-bottom">
                <h5 class="mb-0 card-title fw-bold text-primary">Form Edit Dokter</h5>
            </div>

            <div class="card-body p-4 p-sm-5">
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                
                <form action="{{ route('admin.dokter.update', $dokter->id_dokter) }}" method="POST">
                    @csrf
                    
                    {{-- USER DOKTER (Read Only) --}}
                    <div class="mb-3">
                        <label class="form-label">User Dokter</label>
                        <input type="text" class="form-control" value="{{ $dokter->user->nama ?? 'N/A' }} ({{ $dokter->user->email ?? 'N/A' }})" readonly>
                        {{-- Field ID USER disembunyikan agar bisa dikirim kembali saat update --}}
                        <input type="hidden" name="id_user" value="{{ $dokter->id_user }}">
                    </div>
                    
                    {{-- Alamat --}}
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $dokter->alamat) }}</textarea>
                        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    {{-- No HP --}}
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor HP <span class="text-danger">*</span></label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $dokter->no_hp) }}" required>
                        @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    {{-- Bidang Dokter --}}
                    <div class="mb-3">
                        <label for="bidang_dokter" class="form-label">Bidang Spesialisasi <span class="text-danger">*</span></label>
                        <input type="text" name="bidang_dokter" id="bidang_dokter" class="form-control @error('bidang_dokter') is-invalid @enderror" value="{{ old('bidang_dokter', $dokter->bidang_dokter) }}" required>
                        @error('bidang_dokter')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin', $dokter->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $dokter->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-100">
                        <i class="fi fi-rr-disk me-1"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection