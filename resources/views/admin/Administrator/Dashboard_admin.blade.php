@extends('layouts.gxon.main')

@section('title', 'Dashboard Administrator')

@section('content-header')
<h1 class="app-page-title">Dashboard Administrator</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Home</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    
    <!-- STATISTIK SISTEM (GXON STYLE) -->
<div class="col-lg-3 col-md-6 mb-4">
    <div class="card card-body shadow-sm border-0 bg-info-subtle border-start border-info border-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0 text-info">{{ $totalUsers ?? 0 }}</h3>
                <p class="mb-0 text-muted small">Total User</p>
            </div>
            <div class="avatar avatar-md bg-info rounded-circle text-white">
                <i class="fi fi-rr-users"></i>
            </div>
        </div>
        <a href="{{ route('admin.user.index') }}" class="mt-3 text-info d-block fw-semibold small">
            Kelola User <i class="fi fi-rr-arrow-right"></i>
        </a>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card card-body shadow-sm border-0 bg-primary-subtle border-start border-primary border-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0 text-primary">{{ $totalPemilik ?? 0 }}</h3>
                <p class="mb-0 text-muted small">Total Pemilik</p>
            </div>
            <div class="avatar avatar-md bg-primary rounded-circle text-white">
                <i class="fi fi-rr-id-badge"></i>
            </div>
        </div>
        <a href="{{ route('admin.pemilik.index') }}" class="mt-3 text-primary d-block fw-semibold small">
            Lihat Pemilik <i class="fi fi-rr-arrow-right"></i>
        </a>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card card-body shadow-sm border-0 bg-success-subtle border-start border-success border-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0 text-success">{{ $totalPet ?? 0 }}</h3>
                <p class="mb-0 text-muted small">Total Pet</p>
            </div>
            <div class="avatar avatar-md bg-success rounded-circle text-white">
                <i class="fi fi-rr-paw"></i>
            </div>
        </div>
        <a href="{{ route('admin.daftar_pet.index') }}" class="mt-3 text-success d-block fw-semibold small">
            Lihat Data Pet <i class="fi fi-rr-arrow-right"></i>
        </a>
    </div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
    <div class="card card-body shadow-sm border-0 bg-info-subtle border-start border-info border-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0 text-info">{{ $totalDokter ?? 0 }}</h3>
                <p class="mb-0 text-muted small">Total Dokter</p>
            </div>
            <div class="avatar avatar-md bg-info rounded-circle text-white">
                <i class="fi fi-rr-stethoscope"></i>
            </div>
        </div>
        <a href="{{ route('admin.dokter.index') }}" class="mt-3 text-info d-block fw-semibold small">
            Lihat Dokter <i class="fi fi-rr-arrow-right"></i>
        </a>
    </div>
</div>


    <!-- RINGKASAN DATA MASTER -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header border-bottom">
                <h5 class="card-title fw-bold text-dark-75">Ringkasan Data Master</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @php $colors = ['primary', 'success', 'warning', 'info', 'danger', 'secondary', 'dark']; $i = 0; @endphp
                    @foreach ($masterDataCounts as $name => $count)
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center p-3 rounded-3 bg-light-subtle border border-{{ $colors[$i % 7] }}-subtle">
                                <div class="avatar avatar-sm bg-{{ $colors[$i % 7] }} rounded-circle text-white me-3">
                                     <i class="fi fi-rr-box-open"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $count }}</h6>
                                    <p class="mb-0 text-muted small">{{ $name }} Total</p>
                                </div>
                                <a href="#" class="ms-auto text-{{ $colors[$i % 7] }}">
                                     <i class="fi fi-rr-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        @php $i++; @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- END RINGKASAN DATA MASTER -->
    
    <!-- AKSES CEPAT (Quick Actions) -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header border-bottom">
                <h5 class="card-title fw-bold text-dark-75">Akses Cepat & Notifikasi</h5>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">Tindakan Cepat:</p>
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <a href="{{ route('admin.pemilik.create') }}" class="btn btn-sm btn-outline-primary waves-effect">Tambah Pemilik</a>
                    <a href="{{ route('admin.daftar_pet.create') }}" class="btn btn-sm btn-outline-success waves-effect">Tambah Pet</a>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-outline-info waves-effect">Kelola User</a>
                </div>
                
                <p class="text-muted small mb-3">Status Sistem:</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Database Connection
                        <span class="badge bg-success rounded-pill">ONLINE</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Pending Tasks
                        <span class="badge bg-info text-white rounded-pill">12</span> {{-- PERBAIKAN: Menggunakan bg-info text-white --}}
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Unassigned Roles
                        <span class="badge bg-primary rounded-pill">3</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
@endsection