{{-- resources/views/kategori/index.blade.php --}}

@extends('layouts.app') 

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8"> 
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Kategori 🏷️</h5>
                </div>

                <div class="card-body">
                    {{-- Pengecekan data kosong tetap dipertahankan --}}
                    @if ($kategori->isEmpty()) 
                        <div class="alert alert-warning" role="alert">
                            Tidak ada data Kategori yang ditemukan.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">No</th> 
                                        <th>Nama Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategori as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1}}</td> 
                                        <td>{{ $item->nama_kategori }}</td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                     <div class="mt-3">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection