@extends('layouts.gxon.main')

@section('title', 'Detail Tindakan & Terapi')

@section('content-header')
<h1 class="app-page-title">Detail Tindakan & Terapi</h1>
<p class="text-muted">Daftar detail tindakan & terapi yang diberikan oleh Dokter</p>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Data Detail Rekam Medis</h5>
        
        {{-- TOMBOL TAMBAH DIHILANGKAN (Perawat hanya View) --}}
    </div>

    <div class="card-body">
        
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
                        <th>Detail Catatan</th>
                        <th width="80" class="text-center">Status</th> {{-- Kolom aksi diganti status --}}
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
                            {{-- TIDAK ADA AKSI EDIT ATAU HAPUS UNTUK PERAWAT --}}
                            <span class="badge bg-success">Dilihat</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <div class="mt-4">
            {{-- Tombol kembali ke Rekam Medis utama pasien (Menggunakan route dokter untuk daftar rekam medis) --}}
            <a href="{{ route('admin.Perawat.rekam_medis.index', $idpet) }}" 
               class="btn btn-outline-secondary waves-effect">
                <i class="fi fi-rr-arrow-left me-1"></i> Kembali ke Rekam Medis 
            </a>
        </div>
    </div>
</div>
@endsection