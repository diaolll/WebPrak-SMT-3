{{-- File: resources/views/perawat/jenis_hewan/create.blade.php --}}

@extends('layouts.app') {{-- Sesuaikan dengan nama layout utama Anda --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> 
            <div class="card">
                
                {{-- Card Header --}}
                <div class="card-header">
                    <h5 class="mb-0">Tambah Jenis Hewan 🐾</h5>
                </div>

                <div class="card-body">
                    
                    {{-- Form Tambah Data --}}
                    {{-- Aksi form ini harus mengarah ke route store yang akan memproses data --}}
                    <form action="{{ route('perawat.jenis_hewan.store') }}" method="POST">
                        @csrf
                        
                        {{-- Field Nama Jenis Hewan --}}
                        <div class="form-group mb-3">
                            <label for="nama_jenis_hewan">Nama Jenis Hewan <span class="text-danger">*</span></label>
                            
                            <input 
                                type="text" 
                                name="nama_jenis_hewan" 
                                id="nama_jenis_hewan" 
                                {{-- Tambahkan kelas is-invalid jika ada error validasi --}}
                                class="form-control @error('nama_jenis_hewan') is-invalid @enderror" 
                                {{-- Menjaga nilai input lama jika validasi gagal --}}
                                value="{{ old('nama_jenis_hewan') }}" 
                                placeholder="Masukkan nama jenis hewan (misal: Anjing, Kucing)"
                                required
                            >
                            
                            {{-- Menampilkan pesan error validasi --}}
                            @error('nama_jenis_hewan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr>
                        
                        {{-- Tombol Aksi --}}
                        <div class="d-flex justify-content-between">
                            {{-- Tombol Kembali --}}
                            <a href="{{ route('admin.jenis_hewan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                            </a>
                            
                            {{-- Tombol Simpan --}}
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Data
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection