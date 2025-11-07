@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            {{-- Card utama dengan shadow halus --}}
            <div class="card shadow-sm border-0 rounded-xl"> 
                
                <div class="card-header bg-white border-bottom-0 py-4">
                    <h4 class="mb-0 text-dark font-weight-bolder">
                        <i class="fas fa-stethoscope text-primary mr-2"></i> Panel Dokter Hewan
                    </h4>
                </div>

                <div class="card-body p-5 pt-3"> 
                    
                    {{-- Info User --}}
                    <p class="text-secondary border-bottom pb-4 mb-4">
                        Selamat datang, Dokter <span class="font-weight-bold text-dark">{{ session('user_name') }}</span>. Peran Anda saat ini: <span class="font-weight-bold text-dark">{{ session('user_role_name') }}</span>.
                    </p>
                    
                    {{-- Navigasi Utama: Fokus Klinis (Menggunakan Route yang Tersedia) --}}
                    
                    <h6 class="text-uppercase text-muted small font-weight-bold mb-3">
                        <i class="fas fa-paw mr-2"></i> REFERENSI DATA HEWAN
                    </h6>
                    
                    <ul class="list-group mb-5 rounded-lg border-0 shadow-sm">
                        
                        {{-- Daftar Jenis Hewan (ROUTE ASLI DARI KODE ANDA) --}}
                        <a href="{{ route('admin.jenis_hewan.index') }}" class="list-group-item list-group-item-action border-left-0 border-right-0 py-3 d-flex justify-content-between align-items-center transition-hover">
                            <span class="text-dark font-weight-normal">
                                <i class="fas fa-paw fa-fw text-primary mr-3"></i> 
                                Daftar Jenis Hewan
                            </span>
                            <i class="fas fa-chevron-right text-muted small"></i>
                        </a>
                        
                    </ul>
                    
                    {{-- Navigasi Lain (Dikomentari atau Dihapus karena tidak ada route) --}}
                    <h6 class="text-uppercase text-muted small font-weight-bold mb-3">
                        <i class="fas fa-file-medical mr-2"></i> REFERENSI DATA KLINIS
                    </h6>

                    <ul class="list-group rounded-lg border-0 shadow-sm">
                        
                        {{-- Ini bisa diarahkan ke halaman Rekam Medis jika route-nya ada --}}
                        <a href="#" class="list-group-item list-group-item-action border-left-0 border-right-0 py-3 d-flex justify-content-between align-items-center transition-hover">
                            <span class="text-dark font-weight-normal">
                                <i class="fas fa-file-medical-alt fa-fw text-secondary mr-3"></i> 
                                **[PERLU ROUTE]** Akses Rekam Medis
                            </span>
                            <i class="fas fa-chevron-right text-muted small"></i>
                        </a>
                        
                    </ul>
                    
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
}
.text-uppercase.small {
    font-size: 0.7rem; 
    letter-spacing: 0.05em; 
}
</style>
@endsection