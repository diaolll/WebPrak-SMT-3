@extends('layouts.gxon.main') 

@section('title', 'Daftar Hewan Peliharaan')

@section('content-header')
<h1 class="app-page-title">Daftar Hewan Peliharaan</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Master Data</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Pet</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title fw-bold">Tabel Data Hewan Peliharaan</h5>
                <a href="{{ route('admin.daftar_pet.create') }}" class="btn btn-primary waves-effect waves-light">
                    <i class="fi fi-rr-plus me-1"></i> Tambah Hewan Peliharaan
                </a>
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
                        Tidak ada data Hewan Peliharaan yang ditemukan.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover"> 
                            <thead>
                                <tr class="bg-light">
                                    <th style="width: 50px;">No</th> 
                                    <th>Nama Pet</th>
                                    <th>Pemilik</th>
                                    <th>Jenis & Ras</th>
                                    <th>Tgl Lahir</th>
                                    <th>Kelamin</th>
                                    <th>Warna Tanda</th>
                                    <th style="width: 180px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pets as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    {{-- Ambil nama pemilik dari relasi user --}}
                                    <td>{{ $item->pemilik->user->nama ?? $item->pemilik->user->name ?? 'N/A' }}</td>
                                    {{-- Mengakses Jenis Hewan (melalui Ras Hewan) dan Nama Ras --}}
                                    <td>
                                        {{ $item->rasHewan->jenisHewan->nama_jenis_hewan ?? 'N/A' }} 
                                        / 
                                        {{ $item->rasHewan->nama_ras ?? 'N/A' }}
                                    </td>
                                    <td>{{ $item->tanggal_lahir ? \Carbon\Carbon::parse($item->tanggal_lahir)->format('d M Y') : '-' }}</td>
                                    {{-- Terjemahkan J/B ke Jantan/Betina --}}
                                    <td>{{ $item->jenis_kelamin == 'J' ? 'Jantan' : ($item->jenis_kelamin == 'B' ? 'Betina' : $item->jenis_kelamin) }}</td>
                                    <td>{{ $item->warna_tanda ?? '-' }}</td> 
                                    
                                    <td class="text-center">
                                        <a href="{{ route('admin.daftar_pet.edit', $item->idpet) }}" 
                                            class="btn btn-sm btn-outline-warning waves-effect me-1" title="Edit">
                                            Edit
                                        </a>
                                        
                                        <form action="{{ route('admin.daftar_pet.destroy', $item->idpet) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger waves-effect" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus hewan ini?')" title="Hapus">
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
                
            </div>
        </div>
    </div>
</div>
@endsection