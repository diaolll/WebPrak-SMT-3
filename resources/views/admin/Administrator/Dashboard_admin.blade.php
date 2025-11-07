@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {{-- Card utama dengan shadow halus --}}
            <div class="card shadow-sm border-0 rounded-xl"> 
                
                <div class="card-header bg-white border-bottom-0 py-4">
                    <h4 class="mb-0 text-dark font-weight-bolder">
                        <i class="fas fa-calendar-check text-primary mr-2"></i> Kelola Data Master 🏎️
                    </h4>
                </div>

                <div class="card-body p-5 pt-4"> 
                    
                    {{-- Pesan Status Login --}}
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show rounded-lg" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Info User --}}
                    <p class="text-secondary border-bottom pb-4 mb-4">
                        Selamat datang kembali, <span class="font-weight-bold text-dark">{{ session('user_name') }}</span>. Peran Anda saat ini: <span class="font-weight-bold text-dark">{{ session('user_role_name') }}</span>.
                    </p>
                    
                    {{-- Navigasi Menggunakan List Group --}}
                    
                    <h6 class="text-uppercase text-muted small font-weight-bold mb-3">
                        <i class="fas fa-sliders-h mr-2"></i> DATA PENGATURAN SISTEM
                    </h6>
                    <ul class="list-group mb-5 rounded-lg border-0 shadow-sm">
                        
                        {{-- Data Master --}}
                        @php
                            $master_data = [
                                ['route' => 'admin.jenis_hewan.index', 'title' => 'Jenis Hewan', 'icon' => 'fas fa-paw'],
                                ['route' => 'admin.ras_hewan.index', 'title' => 'Ras Hewan', 'icon' => 'fas fa-bone'],
                                ['route' => 'admin.kategori.index', 'title' => 'Kategori Layanan', 'icon' => 'fas fa-list-alt'],
                                ['route' => 'admin.kategori_klinis.index', 'title' => 'Kategori Klinis', 'icon' => 'fas fa-stethoscope'],
                                ['route' => 'admin.kode_tindakan_terapi.index', 'title' => 'Kode Tindakan Terapi', 'icon' => 'fas fa-notes-medical'],
                            ];
                        @endphp

                        @foreach ($master_data as $data)
                            <a href="{{ route($data['route']) }}" class="list-group-item list-group-item-action border-left-0 border-right-0 py-3 d-flex justify-content-between align-items-center transition-hover">
                                <span class="text-dark font-weight-normal">
                                    <i class="{{ $data['icon'] }} fa-fw text-primary mr-3"></i> 
                                    {{ $data['title'] }}
                                </span>
                                <i class="fas fa-chevron-right text-muted small"></i>
                            </a>
                        @endforeach
                    </ul>

                    <h6 class="text-uppercase text-muted small font-weight-bold mb-3">
                        <i class="fas fa-users-cog mr-2"></i> MANAJEMEN AKUN & CLIENT
                    </h6>
                    <ul class="list-group rounded-lg border-0 shadow-sm">
                        
                        {{-- User & Client Management --}}
                        @php
                            $user_data = [
                                ['route' => 'admin.pemilik.index', 'title' => 'Daftar Pemilik (Client)', 'icon' => 'fas fa-users'],
                                ['route' => 'admin.daftar_pet.index', 'title' => 'Daftar Pet (Hewan)', 'icon' => 'fas fa-dog'],
                                ['route' => 'admin.user.index', 'title' => 'User dan Role Akses', 'icon' => 'fas fa-user-shield'],
                            ];
                        @endphp

                        @foreach ($user_data as $data)
                            <a href="{{ route($data['route']) }}" class="list-group-item list-group-item-action border-left-0 border-right-0 py-3 d-flex justify-content-between align-items-center transition-hover">
                                <span class="text-dark font-weight-normal">
                                    <i class="{{ $data['icon'] }} fa-fw text-primary mr-3"></i> 
                                    {{ $data['title'] }}
                                </span>
                                <i class="fas fa-chevron-right text-muted small"></i>
                            </a>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* CSS Tambahan untuk Tampilan Elegan dan Responsif */
.rounded-xl {
    border-radius: 1.25rem !important; /* Sudut lebih lembut */
}
.rounded-t-xl {
    border-top-left-radius: 1.25rem !important;
    border-top-right-radius: 1.25rem !important;
}
.shadow-lg {
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15)!important;
}
.card-header {
    border-bottom: 1px solid #eee !important; /* Border tipis */
}
.list-group-item:first-child {
    border-top-left-radius: 0.75rem !important;
    border-top-right-radius: 0.75rem !important;
    border-top: 1px solid rgba(0,0,0,.125) !important;
}
.list-group-item:last-child {
    border-bottom-left-radius: 0.75rem !important;
    border-bottom-right-radius: 0.75rem !important;
}
.transition-hover:hover {
    background-color: #f8f9fa; 
    color: var(--dark) !important;
    transform: translateY(-1px); /* Efek angkat sedikit saat hover */
    transition: all 0.2s ease-in-out;
}
.text-uppercase.small {
    font-size: 0.7rem; /* Judul kategori lebih kecil */
    letter-spacing: 0.05em; /* Spasi antar huruf */
}
</style>
@endsection