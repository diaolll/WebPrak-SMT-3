

@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Daftar User 👥</h5>
                </div>

                <div class="card-body">
                    
                    @if ($users->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            Tidak ada data User yang ditemukan.
                        </div>
                    @else
                        <div class="table-responsive">
                            
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">No</th> 
                                        <th>Nama User</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        
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
                                            // LOGIKA UNTUK MENAMPILKAN ROLE (TETAP SAMA)
                                            $labels = $user->roles
                                              ->sortByDesc(fn($r) => (int) $r->pivot->status)   
                                              ->map(fn($r) => $r->nama_role.' ('.($r->pivot->status ? 'Aktif' : 'Nonaktif').')')
                                              ->implode(', ');
                                          @endphp

                                          {{ $labels !== '' ? $labels : '-' }}
                                        </td>
                                        
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