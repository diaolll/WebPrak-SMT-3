@extends('layouts.gxon.main')

@section('content-header')
    <h1 class="app-page-title">
        <span class="icon"><i class="bi bi-calendar-check"></i></span>
        Buat Janji Temu Dokter
    </h1>
@endsection

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-body">

        {{-- Alert success/error --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i> 
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i> 
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.resepsionis.temu_dokter.store') }}" method="POST">
            @csrf

            {{-- PET --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">Pilih Pet</label>
                <select name="idpet" class="form-select" required>
                    <option value="">-- Pilih Pet --</option>
                    @foreach($pets as $pet)
                        <option value="{{ $pet->idpet }}">
                            {{ $pet->nama }}
                            ({{ $pet->jenisHewan->nama_jenis_hewan ?? 'Jenis ?' }} /
                             {{ $pet->rasHewan->nama_ras ?? 'Ras ?' }})
                        </option>
                    @endforeach
                </select>
                @error('idpet') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            {{-- DOKTER --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">Pilih Dokter</label>
                <select name="idrole_user" class="form-select" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($dokter as $d)
                        <option value="{{ $d->idrole_user }}">
                            {{ $d->user->nama }} - {{ $d->user->email }}
                        </option>
                    @endforeach
                </select>
                @error('idrole_user') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-2"></i> Simpan
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
