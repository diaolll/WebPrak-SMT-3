@extends('layouts.gxon.main')

@section('title', 'Edit Rekam Medis')

@section('content-header')
<h1 class="app-page-title">Edit Rekam Medis</h1>
<p class="text-muted">Perbarui data rekam medis hewan: {{ $rekam->pet->nama ?? 'N/A' }}</p>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom">
                <h5 class="mb-0 card-title fw-bold text-primary">Form Edit Rekam Medis</h5>
            </div>

            <div class="card-body p-4 p-sm-5">

                {{-- ALERT ERROR --}}
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('admin.dokter.rekam_medis.update', $rekam->idrekam_medis) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <h6 class="text-primary mb-3">Informasi Pemeriksaan</h6>

                    {{-- ANAMNESA --}}
                    <div class="mb-3">
                        <label class="form-label">Anamnesa <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('anamnesa') is-invalid @enderror" 
                                  name="anamnesa" rows="3" required>{{ old('anamnesa', $rekam->anamnesa) }}</textarea>
                        @error('anamnesa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- TEMUAN KLINIS --}}
                    <div class="mb-3">
                        <label class="form-label">Temuan Klinis <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('temuan_klinis') is-invalid @enderror" 
                                  name="temuan_klinis" rows="3" required>{{ old('temuan_klinis', $rekam->temuan_klinis) }}</textarea>
                        @error('temuan_klinis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- DIAGNOSA --}}
                    <div class="mb-3">
                        <label class="form-label">Diagnosa <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('diagnosa') is-invalid @enderror" 
                                  name="diagnosa" rows="3" required>{{ old('diagnosa', $rekam->diagnosa) }}</textarea>
                        @error('diagnosa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- KODE TINDAKAN TERAPI --}}
                    {{-- Blok yang ditambahkan agar sinkron dengan form Create --}}
                    {{-- KODE TINDAKAN TERAPI --}}
<div class="mb-3">
    <label class="form-label">
        Kode Tindakan Terapi <span class="text-danger">*</span>
    </label>
    <select
        name="idkode_tindakan_terapi"
        class="form-control @error('idkode_tindakan_terapi') is-invalid @enderror"
        required>
        <option value="">Pilih Kode Tindakan Terapi</option>
        @foreach($kodeTindakan as $kode)
        {{-- ... --}}
        @endforeach
    </select>
    @error('idkode_tindakan_terapi')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        {{-- Tombol kembali --}}
                        {{-- Menggunakan $rekam->idpet untuk navigasi kembali --}}
                        <a href="{{ route('admin.dokter.rekam_medis.index', $rekam->idpet) }}"
                            class="btn btn-outline-secondary waves-effect">
                            <i class="fi fi-rr-arrow-left me-1"></i> Kembali
                        </a>

                        {{-- Tombol update --}}
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            <i class="fi fi-rr-disk me-1"></i> Update Rekam Medis
                        </button>
                    </div>

                </form>
            </div>

        </div>

    </div>
</div>
@endsection