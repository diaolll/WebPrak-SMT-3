@extends('layouts.gxon.main')

@section('title', 'Tambah Rekam Medis')

@section('content-header')
<h1 class="app-page-title">Tambah Rekam Medis</h1>
<p class="text-muted">Tambahkan rekam medis untuk hewan: {{ $pet->nama_pet }}</p>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">

            <div class="card-header border-bottom">
                <h5 class="mb-0 card-title fw-bold text-primary">Form Rekam Medis</h5>
            </div>

            <div class="card-body p-4 p-sm-5">

                <form action="{{ route('admin.Perawat.rekam_medis.store', $pet->idpet) }}" method="POST">
                    @csrf
                    
                    {{-- ANAMNESA --}}
                    <div class="mb-3">
                        <label class="form-label">Anamnesa <span class="text-danger">*</span></label>
                        <textarea name="anamnesa" class="form-control" required>{{ old('anamnesa') }}</textarea>
                    </div>

                    {{-- TEMUAN KLINIS --}}
                    <div class="mb-3">
                        <label class="form-label">Temuan Klinis <span class="text-danger">*</span></label>
                        <textarea name="temuan_klinis" class="form-control" required>{{ old('temuan_klinis') }}</textarea>
                    </div>

                    {{-- DIAGNOSA --}}
                    <div class="mb-3">
                        <label class="form-label">Diagnosa <span class="text-danger">*</span></label>
                        <textarea name="diagnosa" class="form-control" required>{{ old('diagnosa') }}</textarea>
                    </div>

                    {{-- DROPDOWN DOKTER PEMERIKSA --}}
                    <div class="mb-3">
                        <label class="form-label">Dokter Pemeriksa <span class="text-danger">*</span></label>
                        <select name="dokter_pemeriksa" class="form-select" required>
                            <option value="">-- Pilih Dokter --</option>
                            @foreach ($dokters as $dok)
                                <option value="{{ $dok->idrole_user }}"
                                    {{ old('dokter_pemeriksa') == $dok->idrole_user ? 'selected':'' }}>
                                    {{ $dok->user->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fi fi-rr-disk me-1"></i> Simpan Rekam Medis
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
