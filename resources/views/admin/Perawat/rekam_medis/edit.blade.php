@extends('layouts.gxon.main')

@section('title', 'Edit Rekam Medis')

{{-- Content Header GXON --}}
@section('content-header')
<h1 class="app-page-title">Edit Rekam Medis</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Rekam Medis</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Edit Rekam Medis
        </li>
    </ol>
</nav>
@endsection
{{-- End Content Header --}}

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8"> 
        
        <div class="card shadow-sm border-0">

            <div class="card-header border-bottom">
                <h5 class="mb-0 card-title fw-bold">
                    Edit Rekam Medis #{{ $rekam->idrekam_medis }}
                </h5>
            </div>

            <div class="card-body">

                {{-- Error Message --}}
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.Perawat.rekam_medis.update', $rekam->idrekam_medis) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="idpet" value="{{ $rekam->idpet }}">

                    {{-- Anamnesa --}}
                    <div class="mb-3">
                        <label class="form-label">Anamnesa <span class="text-danger">*</span></label>
                        <textarea name="anamnesa"
                                  class="form-control @error('anamnesa') is-invalid @enderror" 
                                  rows="3"
                                  required>{{ old('anamnesa', $rekam->anamnesa) }}</textarea>
                        @error('anamnesa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Temuan Klinis --}}
                    <div class="mb-3">
                        <label class="form-label">Temuan Klinis <span class="text-danger">*</span></label>
                        <textarea name="temuan_klinis"
                                  class="form-control @error('temuan_klinis') is-invalid @enderror" 
                                  rows="3"
                                  required>{{ old('temuan_klinis', $rekam->temuan_klinis) }}</textarea>
                        @error('temuan_klinis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Diagnosa --}}
                    <div class="mb-3">
                        <label class="form-label">Diagnosa <span class="text-danger">*</span></label>
                        <textarea name="diagnosa"
                                  class="form-control @error('diagnosa') is-invalid @enderror" 
                                  rows="3"
                                  required>{{ old('diagnosa', $rekam->diagnosa) }}</textarea>
                        @error('diagnosa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Dokter Pemeriksa --}}
                    <div class="mb-3">
                        <label class="form-label">Dokter Pemeriksa <span class="text-danger">*</span></label>
                        <select name="dokter_pemeriksa" 
                                class="form-control @error('dokter_pemeriksa') is-invalid @enderror"
                                required>
                            <option value="">-- Pilih Dokter --</option>
                            @foreach($dokterList as $dok)
                                <option value="{{ $dok->idrole_user }}"
                                    {{ old('dokter_pemeriksa', $rekam->dokter_pemeriksa) == $dok->idrole_user ? 'selected' : '' }}>
                                    {{ $dok->user->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('dokter_pemeriksa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-between mt-4">

                        <a href="{{ url()->previous() }}" 
                           class="btn btn-outline-secondary waves-effect">
                            <i class="fi fi-rr-arrow-left me-1"></i> Kembali
                        </a>

                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            <i class="fi fi-rr-disk me-1"></i> Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
