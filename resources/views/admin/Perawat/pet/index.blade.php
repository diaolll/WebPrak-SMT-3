@extends('layouts.gxon.main') 

@section('title', 'Daftar Pasien (Pet)')

@section('content-header')
<h1 class="app-page-title">Daftar Pasien (Pet)</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Master Data</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Pasien Hewan</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title fw-bold">Tabel Data Pasien (Pet)</h5>
                {{-- Jika mau tambahkan tombol "Tambah Pet" bisa taruh di sini --}}
            </div>

            <div class="card-body">
                
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if ($pets->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Tidak ada data pasien hewan ditemukan.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover"> 
                            <thead>
                                <tr class="bg-light">
                                    <th style="width: 50px;">No</th>
                                    <th>Nama Hewan</th>
                                    <th>Jenis</th>
                                    <th>Ras</th>
                                    <th>Pemilik</th>
                                    <th style="width: 180px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($pets as $index => $pet)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pet->nama }}</td>
                                    <td>{{ $pet->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                                    <td>{{ $pet->rasHewan->nama_ras ?? '-' }}</td>
                                    <td>{{ $pet->pemilik->user->nama ?? '-' }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.Perawat.rekam_medis.index', $pet->idpet) }}" 
                                           class="btn btn-sm btn-outline-success waves-effect me-1">
                                            Rekam Medis
                                        </a>

                                        {{-- Jika mau ada edit Pet --}}
                                        {{-- 
                                        <a href="{{ route('admin.pet.edit', $pet->idpet) }}" 
                                           class="btn btn-sm btn-outline-warning waves-effect me-1">
                                            Edit
                                        </a>
                                        --}}

                                        {{-- Jika mau ada hapus Pet --}}
                                        {{-- 
                                        <form action="{{ route('admin.pet.destroy', $pet->idpet) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Hapus data hewan ini?')"
                                                    class="btn btn-sm btn-outline-danger waves-effect">
                                                Hapus
                                            </button>
                                        </form>
                                        --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection
