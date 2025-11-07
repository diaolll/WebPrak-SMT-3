@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0 rounded-xl"> 
                
                <div class="card-header bg-white border-bottom-0 py-4">
                    <h4 class="mb-0 text-dark font-weight-bolder">
                        <i class="fas fa-home text-primary mr-2"></i> Dashboard Pemilik
                    </h4>
                </div>

                <div class="card-body p-5 pt-3"> 
                    
                    {{-- Info User --}}
                    <p class="text-secondary border-bottom pb-4 mb-4">
                        Selamat datang kembali, <span class="font-weight-bold text-dark">{{ session('user_name') }}</span>.
                        @if ($pemilik)
                            Berikut adalah daftar hewan peliharaan (Pet) yang terdaftar di bawah akun Anda.
                        @else
                            Anda belum memiliki profil Pemilik.
                        @endif
                    </p>
                    
                    <h6 class="text-uppercase text-muted small font-weight-bold mb-3">
                        <i class="fas fa-dog mr-2"></i> DAFTAR PET SAYA
                    </h6>
                    
                    {{-- Cek apakah ada data Pet --}}
                    @if ($listPetSaya->isEmpty())
                        <div class="alert alert-info" role="alert">
                            Anda belum mendaftarkan hewan peliharaan.
                            {{-- Tambahkan tombol daftar jika ada route-nya --}}
                            <a href="#" class="btn btn-sm btn-info ml-3">Daftarkan Pet Baru</a>
                        </div>
                    @elseif (!$pemilik)
                        <div class="alert alert-warning" role="alert">
                            Silakan buat profil pemilik terlebih dahulu.
                        </div>
                    @else
                        {{-- Tabel Daftar Pet --}}
                        <div class="table-responsive shadow-sm rounded-lg border">
                            <table class="table table-hover table-borderless mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width: 50px;">No</th> 
                                        <th>Nama Pet</th>
                                        <th>Jenis Hewan</th>
                                        <th>Ras Hewan</th>
                                        <th>Tanggal Lahir</th>
                                        <th style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listPetSaya as $index => $pet)
                                    <tr>
                                        <td>{{ $index + 1 }}</td> 
                                        <td>{{ $pet->nama }}</td>
                                        {{-- Mengakses relasi yang sudah di load --}}
                                        <td>{{ $pet->jenisHewan->nama_jenis_hewan ?? 'N/A' }}</td> 
                                        <td>{{ $pet->rasHewan->nama_ras_hewan ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d/m/Y') }}</td>
                                        <td>
                                            {{-- Ganti '#' dengan route yang benar untuk melihat Rekam Medis --}}
                                            <a href="#" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-medical"></i> Riwayat
                                            </a>
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
</div>

<style>
/* CSS Tambahan untuk Tampilan Elegan, Clean, dan Shadow Halus */
.rounded-xl {
    border-radius: 1.25rem !important;
}
.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075)!important;
}
.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.03);
}
.card-header {
    border-bottom: 1px solid #eee !important;
}
.text-uppercase.small {
    font-size: 0.7rem; 
    letter-spacing: 0.05em; 
}
</style>
@endsection