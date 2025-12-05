@extends('layouts.gxon.main') 

@section('title', 'Daftar User')

@section('content-header')
<h1 class="app-page-title">Daftar User</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Master Data</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">User</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title fw-bold">Tabel Data User</h5>
                <a href="{{ route('admin.user.create') }}" class="btn btn-primary waves-effect waves-light">
                    <i class="fi fi-rr-plus me-1"></i> Tambah User
                </a>
            </div>

            <div class="card-body">
                
                {{-- Notifikasi --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($users->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Tidak ada data User yang ditemukan.
                    </div>
                @else
                    <div class="table-responsive">
                        
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-light">
                                    <th style="width: 50px;">No</th> 
                                    <th>Nama User</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th style="width: 180px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1}}</td> 
                                    <td>{{ $user->nama }}</td> 
                                    <td>{{ $user->email }}</td> 

                                    <td>
                                      @php
                                        $labels = $user->roles
                                          ->pluck('nama_role') 
                                          ->implode(', ');
                                      @endphp

                                      {{ $labels !== '' ? $labels : '-' }}
                                    </td>
                                    
                                    <td class="text-center">
                                        <a href="{{ route('admin.user.edit', $user->iduser) }}" 
                                            class="btn btn-sm btn-outline-warning waves-effect me-1" title="Edit">
                                            Edit
                                        </a>
                                        
                                        <form action="{{ route('admin.user.destroy', $user->iduser) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger waves-effect" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')" title="Hapus">
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