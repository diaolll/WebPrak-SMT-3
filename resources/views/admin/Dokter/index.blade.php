@extends('layouts.gxon.main')

@section('title', 'Daftar Dokter')

@section('content-header')
<h1 class="app-page-title">Daftar Dokter</h1>
<p class="text-muted">Kelola data profesional Dokter.</p>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title fw-bold">Tabel Data Dokter</h5>
                <a href="{{ route('admin.dokter.create') }}" class="btn btn-primary waves-effect waves-light">
                    <i class="fi fi-rr-plus me-1"></i> Tambah Dokter
                </a>
            </div>

            <div class="card-body">
                
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($dokter->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Tidak ada data Dokter yang ditemukan.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover"> 
                            <thead>
                                <tr class="bg-light">
                                    <th style="width: 50px;">No</th> 
                                    <th>Nama User</th>
                                    <th>Bidang</th>
                                    <th>No HP</th>
                                    <th>Alamat</th>
                                    <th style="width: 180px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dokter as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td> 
                                    <td>{{ $item->user->nama ?? 'N/A' }}</td>
                                    <td>{{ $item->bidang_dokter }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    
                                    <td class="text-center">
                                        <a href="{{ route('admin.dokter.edit', $item->id_dokter) }}" 
                                            class="btn btn-sm btn-outline-warning waves-effect me-1" title="Edit">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.dokter.destroy', $item->id_dokter) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger waves-effect" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data Dokter ini?')" title="Hapus">
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