{{-- resources/views/resepsionis/dashboard.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {{-- Card utama dengan shadow halus --}}
            <div class="card shadow-sm border-0 rounded-xl"> 
                
                <div class="card-header bg-white border-bottom-0 py-4">
                    <h4 class="mb-0 text-dark font-weight-bolder">
                        <i class="fas fa-calendar-check text-primary mr-2"></i> Antrian Pendaftaran
                    </h4>
                </div>

                <div class="card-body p-5 pt-3"> 
                    
                    {{-- Info User --}}
                    <p class="text-secondary border-bottom pb-4 mb-4">
                        Selamat datang, <span class="font-weight-bold text-dark">{{ session('user_name') }}</span>. Tugas Anda: mengelola antrian pasien yang mendaftar hari ini ({{ \Carbon\Carbon::now()->format('d F Y') }}).
                    </p>
                    
                    <h6 class="text-uppercase text-muted small font-weight-bold mb-3">
                        <i class="fas fa-list-ol mr-2"></i> DAFTAR PASIEN HARI INI
                    </h6>
                    
                    @if (empty($rekamMedisHariIni) || $rekamMedisHariIni->isEmpty())
                        <div class="alert alert-info" role="alert">
                            Tidak ada pasien yang mendaftar pada hari ini.
                        </div>
                    @else
                        {{-- Tabel Antrian --}}
                        <div class="table-responsive shadow-sm rounded-lg border">
                            <table class="table table-hover table-borderless mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width: 50px;">No</th> 
                                        <th>Waktu Daftar</th>
                                        <th>Nama Pet</th>
                                        <th>Jenis/Ras Hewan</th>
                                        <th>Nama Pemilik</th>
                                        <th>Status</th>
                                        <th style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rekamMedisHariIni as $index => $data)
                                    <tr>
                                        <td>{{ $index + 1 }}</td> 
                                        {{-- Menggunakan created_at atau kolom waktu pendaftaran --}}
                                        <td>{{ \Carbon\Carbon::parse($data->created_at)->format('H:i') }}</td> 
                                        <td>{{ $data->pet->nama }}</td>
                                        {{-- Asumsi relasi Pet -> RasHewan ada --}}
                                        <td>{{ $data->pet->rasHewan->nama_ras ?? 'N/A' }}</td> 
                                        {{-- Mengakses relasi Pet -> Pemilik -> User --}}
                                        <td>{{ $data->pet->pemilik->user->nama }}</td>
                                        <td>
                                            @php
                                                // Asumsi kolom 'status_pemeriksaan' ada
                                                $status = $data->status_pemeriksaan ?? 'Menunggu';
                                                $class = [
                                                    'Menunggu' => 'bg-warning text-dark',
                                                    'Diperiksa' => 'bg-primary text-white',
                                                    'Selesai' => 'bg-success text-white',
                                                ][$status] ?? 'bg-secondary text-white';
                                            @endphp
                                            <span class="badge rounded-pill {{ $class }}">{{ $status }}</span>
                                        </td>
                                        <td>
                                            {{-- Tombol untuk Resepsionis (misalnya: Masuk ke Ruang Periksa/Ganti Status) --}}
                                            <a href="#" class="btn btn-sm btn-primary">
                                                Proses
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
.card-header {
    border-bottom: 1px solid #eee !important;
}
.text-uppercase.small {
    font-size: 0.7rem; 
    letter-spacing: 0.05em; 
}
/* Menyesuaikan badge Bootstrap */
.badge.bg-warning { background-color: #ffc107 !important; border: 1px solid #ffc107; }
.badge.bg-primary { background-color: #007bff !important; }
.badge.bg-success { background-color: #28a745 !important; }
</style>
@endsection