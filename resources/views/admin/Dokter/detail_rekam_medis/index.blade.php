@extends('layouts.gxon.main')

@section('title', 'Detail Rekam Medis')

@section('content-header')
<h1 class="app-page-title">Detail Rekam Medis</h1>
<p class="text-muted">Daftar detail tindakan & terapi pasien</p>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Data Detail Rekam Medis</h5>
        <a href="{{ route('admin.dokter.detail_rekam_medis.create', $idrekam_medis) }}"
            class="btn btn-primary btn-sm">
            Tambah Detail
        </a>
    </div>

    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($detailRekamMedis->isEmpty())
        <div class="alert alert-warning">
            Data Detail Rekam Medis belum tersedia.
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 5%">No</th>
                        <th>ID Rekam Medis</th>
                        <th>Kode Tindakan/Terapi</th>
                        <th>Detail</th>
                        <th width="160" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detailRekamMedis as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->idrekam_medis }}</td>
                        
                        {{-- MENAMPILKAN KODE DAN DESKRIPSI DARI RELASI --}}
                        <td>
                            {{ $item->kodeTindakanTerapi->kode ?? $item->idkode_tindakan_terapi }} - 
                            {{ $item->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? 'Data Tindakan Hilang' }}
                        </td>
                        
                        <td>{{ $item->detail }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.dokter.detail_rekam_medis.edit', [$idrekam_medis, $item->iddetail_rekam_medis]) }}"
                                class="btn btn-sm btn-outline-warning me-1">
                                Edit
                            </a>

                            <form action="{{ route('admin.dokter.detail_rekam_medis.destroy', [$idrekam_medis, $item->iddetail_rekam_medis]) }}"
                                method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Yakin hapus data ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <div class="mt-4">
                    {{-- PERBAIKAN: Menggunakan route index yang benar dan menyertakan parameter idrekam_medis --}}
                    <a href="{{ route('admin.dokter.rekam_medis.index', $idpet) }}" 
                       class="btn btn-outline-secondary waves-effect">
                        <i class="fi fi-rr-arrow-left me-1"></i> kembali
                    </a>
                </div>
    </div>
</div>
@endsection