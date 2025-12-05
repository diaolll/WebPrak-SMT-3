@extends('layouts.gxon.main') 

@section('title', 'Tambah User')

@section('content-header')
<h1 class="app-page-title">Tambah User</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Master Data</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom">
                <h5 class="mb-0 card-title fw-bold">Form Tambah User Baru</h5>
            </div>

            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.user.store') }}" method="POST">
                    @csrf 
                    
                    <h6 class="text-primary mb-3">Data Akun</h6>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama User <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                    
                    <h6 class="text-primary mb-3 mt-4">Atur Role</h6>

                    <div class="mb-3">
                        <label for="roles" class="form-label">Pilih Role (Wajib) <span class="text-danger">*</span></label>
                        <div class="border p-3 rounded @error('roles') border-danger @enderror">
                            @foreach ($roles as $role)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->idrole }}" id="role_{{ $role->idrole }}" 
                                        {{ in_array($role->idrole, old('roles', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_{{ $role->idrole }}">
                                        {{ $role->nama_role }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('roles') 
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary waves-effect">
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