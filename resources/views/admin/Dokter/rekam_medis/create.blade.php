@extends('layouts.gxon.main')

@section('title', 'Tambah Rekam Medis')

@section('content-header')
<h1 class="app-page-title">Tambah Rekam Medis</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Rekam Medis</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Rekam Medis</li>
    </ol>
</nav>
@endsection


@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">

            <div class="card-header border-bottom">
                <h5 class="mb-0 card-title fw-bold">Form Tambah Rekam Medis</h5>
            </div>

            <div class="card-body">

                {{-- Pesan error --}}
                @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
                @endif

                <form action="{{ route('admin.dokter.rekam_medis.store', $pet->idpet) }}" method="POST">
                    @csrf

                    {{-- ANAMNESA --}}
                    <div class="mb-3">
                        <label class="form-label">
                            Anamnesa <span class="text-danger">*</span>
                        </label>
                        <textarea
                            name="anamnesa"
                            class="form-control @error('anamnesa') is-invalid @enderror"
                            rows="3"
                            placeholder="Masukkan anamnesa"
                            required>{{ old('anamnesa') }}</textarea>

                        @error('anamnesa')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TEMUAN KLINIS --}}
                    <div class="mb-3">
                        <label class="form-label">
                            Temuan Klinis <span class="text-danger">*</span>
                        </label>
                        <textarea
                            name="temuan_klinis"
                            class="form-control @error('temuan_klinis') is-invalid @enderror"
                            rows="3"
                            placeholder="Masukkan temuan klinis"
                            required>{{ old('temuan_klinis') }}</textarea>

                        @error('temuan_klinis')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- DIAGNOSA --}}
                    <div class="mb-3">
                        <label class="form-label">
                            Diagnosa <span class="text-danger">*</span>
                        </label>
                        <textarea
                            name="diagnosa"
                            class="form-control @error('diagnosa') is-invalid @enderror"
                            rows="3"
                            placeholder="Masukkan diagnosa"
                            required>{{ old('diagnosa') }}</textarea>

                        @error('diagnosa')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KODE TINDAKAN TERAPI - BLOK INI DIHAPUS TOTAL --}}


                    <div class="d-flex justify-content-between mt-4">
                        {{-- Tombol kembali --}}
                        <a href="{{ route('admin.dokter.rekam_medis.index', $pet->idpet) }}"
                            class="btn btn-outline-secondary waves-effect">
                            <i class="fi fi-rr-arrow-left me-1"></i> Kembali
                        </a>

                        {{-- Tombol simpan --}}
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