@extends('layouts.gxon.main') 

@section('title', 'Rekam Medis - ' . $pet->nama)

@section('content-header')
<h1 class="app-page-title">Rekam Medis - {{ $pet->nama }}</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Rekam Medis</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $pet->nama }}</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">

            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title fw-bold">Data Rekam Medis</h5>

                <a href="{{ route('admin.dokter.rekam_medis.create', $pet->idpet) }}" 
                   class="btn btn-primary waves-effect waves-light">
                    <i class="fi fi-rr-plus me-1"></i> Tambah Rekam Medis
                </a>
            </div>

            <div class="card-body">

                {{-- Notifikasi --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                {{-- Tabel --}}
                @if ($rekam->isEmpty())
                    <div class="alert alert-warning">Belum ada rekam medis untuk hewan ini.</div>
                @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class="bg-light">
                                <th style="width: 160px;">Tanggal</th>
                                <th>Anamnesa</th>
                                <th>Temuan Klinis</th>
                                <th>Diagnosa</th>
                                <th>Dokter Pemeriksa</th>
                                <th class="text-center" style="width: 220px;">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach ($rekam as $r)
                            <tr>
                                <td>{{ $r->created_at ? date('d-m-Y H:i', strtotime($r->created_at)) : '-' }}</td>
                                <td>{{ $r->anamnesa }}</td>
                                <td>{{ $r->temuan_klinis }}</td>
                                <td>{{ $r->diagnosa }}</td>
                                <td>{{ $r->dokter->user->nama ?? '-' }}</td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center">

                                        {{-- DETAIL --}}
                                        <a href="#"
                                           class="btn btn-sm btn-outline-info waves-effect me-1 d-flex align-items-center">
                                            <i class="fi fi-rr-eye me-1"></i> Detail
                                        </a>

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.dokter.rekam_medis.edit', $r->idrekam_medis) }}" 
                                           class="btn btn-sm btn-outline-warning waves-effect me-1 d-flex align-items-center">
                                            <i class="fi fi-rr-edit me-1"></i> Edit
                                        </a>

                                        {{-- HAPUS --}}
                                        <form method="POST" 
                                              action="{{ route('admin.dokter.rekam_medis.destroy', $r->idrekam_medis) }}"
                                              onsubmit="return confirm('Yakin ingin menghapus rekam medis ini?')">
                                            @csrf 
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-outline-danger waves-effect d-flex align-items-center">
                                                <i class="fi fi-rr-trash me-1"></i> Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                @endif

                {{-- Tombol Kembali (pojok kiri bawah, di dalam card) --}}
                <div class="mt-4">
                    <a href="{{ route('admin.dokter.pet.index') }}" 
                       class="btn btn-outline-secondary waves-effect">
                        <i class="fi fi-rr-arrow-left me-1"></i> Data Pasien
                    </a>
                </div>

            </div> {{-- END CARD BODY --}}

        </div>
    </div>
</div>
@endsection
