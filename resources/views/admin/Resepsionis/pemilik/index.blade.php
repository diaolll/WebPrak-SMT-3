@extends('layouts.gxon.main')

@section('title', 'Daftar Pemilik')

@section('content-header')
<h1 class="app-page-title">Daftar Pemilik</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Master Data</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Pemilik</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">

        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title fw-bold">Tabel Data Pemilik</h5>
                <a href="{{ route('admin.resepsionis.pemilik.create') }}" class="btn btn-primary waves-effect waves-light">
                    <i class="fi fi-rr-plus me-1"></i> Tambah Pemilik
                </a>
            </div>

            <div class="card-body">

                {{-- Alert --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                {{-- Jika data kosong --}}
                @if ($pemilik->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Tidak ada data Pemilik yang ditemukan.
                    </div>
                @else

                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class="bg-light">
                                <th style="width: 50px;">No</th>
                                <th>Nama Pemilik</th>
                                <th>Email</th>
                                <th>Nomor WA</th>
                                <th>Alamat</th>
                                <th style="width: 180px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pemilik as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->user->nama ?? $item->user->name ?? 'N/A' }}</td>
                                <td>{{ $item->user->email ?? 'N/A' }}</td>
                                <td>{{ $item->no_wa }}</td>
                                <td>{{ $item->alamat }}</td>

                                <td class="text-center">
                                    <a href="{{ route('admin.resepsionis.pemilik.edit', $item->idpemilik) }}"
                                        class="btn btn-sm btn-outline-warning waves-effect me-1" title="Edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.resepsionis.pemilik.destroy', $item->idpemilik) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger waves-effect"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pemilik ini?')"
                                            title="Hapus">
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
