@extends('layouts.gxon.main') 

@section('title', 'Tambah Hewan Peliharaan')

@section('content-header')
<h1 class="app-page-title">Tambah Hewan Peliharaan</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Master Data</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Pet</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom">
                <h5 class="mb-0 card-title fw-bold">Form Tambah Hewan Peliharaan</h5>
            </div>

            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.daftar_pet.store') }}" method="POST">
                    @csrf 

                    {{-- Nama Hewan --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Hewan <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Pemilik (idpemilik) --}}
                    <div class="mb-3">
                        <label for="idpemilik" class="form-label">Pemilik <span class="text-danger">*</span></label>
                        <select name="idpemilik" id="idpemilik" class="form-select @error('idpemilik') is-invalid @enderror" required>
                            <option value="">Pilih Pemilik</option>
                            @foreach ($pemilik as $p)
                                <option value="{{ $p->idpemilik }}" {{ old('idpemilik') == $p->idpemilik ? 'selected' : '' }}>
                                    {{ $p->user->name ?? $p->user->nama ?? $p->idpemilik }} - ({{ $p->no_wa }})
                                </option>
                            @endforeach
                        </select>
                        @error('idpemilik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Ras Hewan (idras_hewan) --}}
                    <div class="mb-3">
                        <label for="idras_hewan" class="form-label">Ras Hewan <span class="text-danger">*</span></label>
                        <select name="idras_hewan" id="idras_hewan" class="form-select @error('idras_hewan') is-invalid @enderror" required>
                            <option value="">Pilih Ras Hewan</option>
                            @foreach ($rasHewan as $rh)
                                <option value="{{ $rh->idras_hewan }}" {{ old('idras_hewan') == $rh->idras_hewan ? 'selected' : '' }}>
                                    {{ $rh->nama_ras }}
                                </option>
                            @endforeach
                        </select>
                        @error('idras_hewan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="J" {{ old('jenis_kelamin') == 'J' ? 'selected' : '' }}>Jantan</option>
                            <option value="B" {{ old('jenis_kelamin') == 'B' ? 'selected' : '' }}>Betina</option>
                        </select>
                        @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- Warna Tanda --}}
                    <div class="mb-3">
                        <label for="warna_tanda" class="form-label">Warna Tanda</label>
                        <input type="text" name="warna_tanda" id="warna_tanda" class="form-control @error('warna_tanda') is-invalid @enderror" value="{{ old('warna_tanda') }}" placeholder="Contoh: Belang putih di dada">
                        @error('warna_tanda') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>


                    {{-- Tanggal Lahir --}}
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.daftar_pet.index') }}" class="btn btn-outline-secondary waves-effect">
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