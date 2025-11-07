{{-- resources/views/admin/pemilik/index.blade.php --}}

@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10"> {{-- Ukuran kolom disesuaikan --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Pemilik 🧑‍💼</h5>
                </div>

                <div class="card-body">
                    @if ($pemilik->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            Tidak ada data Pemilik yang ditemukan.
                        </div>
                    @else
                        <div class="table-responsive">
                            {{-- BENTUK TABEL (GAYA BOOTSTRAP) --}}
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">No</th> 
                                        <th>Nama Pemilik</th>
                                        <th>No WA</th>
                                        <th>Alamat</th>
                                        {{-- KOLOM AKSI DIHILANGKAN --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pemilik as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1}}</td>
                                        <td>{{ $item->user->nama }}</td> 
                                        <td>{{ $item->no_wa }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        {{-- SEL AKSI DIHILANGKAN --}}
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