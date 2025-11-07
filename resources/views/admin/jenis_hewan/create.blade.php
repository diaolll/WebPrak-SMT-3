@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tambah Jenis Hewan
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.jenis-hewan.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group mb-3">
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
                            
                            @error('nama_jenis_hewan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection