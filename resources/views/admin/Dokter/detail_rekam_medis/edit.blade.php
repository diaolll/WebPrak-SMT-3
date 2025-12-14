@extends('layouts.gxon.main')

@section('title', 'Edit Detail Rekam Medis')

@section('content-header')
<h1 class="app-page-title">Edit Detail Rekam Medis</h1>
<p class="text-muted">Perbarui data detail tindakan</p>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.dokter.detail_rekam_medis.update', [$idrekam_medis, $detailRekamMedis->iddetail_rekam_medis]) }}"
            method="POST">
            @csrf
            @method('PUT')

            {{-- 1. INPUT UNTUK KODE TINDAKAN/TERAPI --}}
            <div class="mb-3">
                <label for="idkode_tindakan_terapi" class="form-label">Tindakan/Terapi yang Diberikan</label>
                <select name="idkode_tindakan_terapi" 
                    id="idkode_tindakan_terapi" 
                    class="form-control @error('idkode_tindakan_terapi') is-invalid @enderror" 
                    required>
                    
                    <option value="">-- Pilih Tindakan/Terapi --</option>
                    @foreach ($kodeTindakan as $kode)
                        <option value="{{ $kode->idkode_tindakan_terapi }}" 
                            {{ (old('idkode_tindakan_terapi', $detailRekamMedis->idkode_tindakan_terapi) == $kode->idkode_tindakan_terapi) ? 'selected' : '' }}>
                            
                            {{-- Menggunakan kode dan deskripsi --}}
                            {{ $kode->kode ?? $kode->idkode_tindakan_terapi }} - {{ $kode->deskripsi_tindakan_terapi ?? 'Nama Tidak Tersedia' }} 
                        </option>
                    @endforeach
                </select>
                @error('idkode_tindakan_terapi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- 2. INPUT UNTUK DETAIL CATATAN --}}
            <div class="mb-3">
                <label class="form-label" for="detail">Detail Catatan</label>
                <textarea name="detail"
                    id="detail"
                    class="form-control @error('detail') is-invalid @enderror"
                    rows="3"
                    placeholder="Masukkan detail tindakan dan terapi"
                    required>{{ old('detail', $detailRekamMedis->detail) }}</textarea>
                @error('detail')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                {{-- TOMBOL KEMBALI: Sudah benar, mengarah ke index detail rekam medis menggunakan parameter idrekam_medis --}}
                <a href="{{ route('admin.dokter.detail_rekam_medis.index', $idrekam_medis) }}"
                    class="btn btn-secondary">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection