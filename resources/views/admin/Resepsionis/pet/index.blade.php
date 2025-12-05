@extends('layouts.gxon.main') 

@section('title', 'Data Pet')

@section('content-header')
<h1 class="app-page-title">Data Pet</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Resepsionis</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Data Pet</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title fw-bold">Tabel Data Pet</h5>
                {{-- Tombol Tambah Pet --}}
                <a href="{{ route('admin.Resepsionis.pet.create') }}" class="btn btn-primary waves-effect waves-light">
                    <i class="fi fi-rr-plus me-1"></i> Tambah Pet
                </a>
            </div>

            <div class="card-body">
                
                {{-- Notifikasi Sukses --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($pets->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Tidak ada data Pet yang ditemukan.
                    </div>
                @else
                    <div class="table-responsive">
                        {{-- Menggunakan table-striped dan table-hover untuk gaya GXON --}}
                        <table class="table table-bordered table-striped table-hover"> 
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th>Nama Pet</th>
                                    <th>Pemilik</th>
                                    <th>Jenis</th>
                                    <th>Ras</th>
                                    <th>Kelamin</th>
                                    <th>Warna / Tanda</th>
                                    <th style="width: 180px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pets as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        {{-- Menggunakan optional chaining untuk mencegah error jika relasi kosong --}}
                                        <td>{{ optional($item->pemilik->user)->nama ?? '-' }}</td>
                                        <td>{{ $item->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                                        <td>{{ $item->rasHewan->nama_ras ?? '-' }}</td>
                                    <td>{{ $item->jenis_kelamin == 'J' ? 'Jantan' : ($item->jenis_kelamin == 'B' ? 'Betina' : $item->jenis_kelamin) }}</td>
                                        <td>{{ $item->warna_tanda }}</td>
                                        
                                        {{-- Kolom Aksi --}}
                                        <td class="text-center">
                                            {{-- Tombol Edit (Gaya GXON) --}}
                                            <a href="{{ route('admin.Resepsionis.pet.edit', $item->idpet) }}"
                                               class="btn btn-sm btn-outline-warning waves-effect me-1" title="Edit">
                                               Edit
                                            </a>

                                            {{-- Tombol Hapus (Gaya GXON) --}}
                                            <form action="{{ route('admin.Resepsionis.pet.destroy', $item->idpet) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger waves-effect"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data Pet ini?')" title="Hapus">
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