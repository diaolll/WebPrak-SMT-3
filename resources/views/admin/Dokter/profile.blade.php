@extends('layouts.gxon.main')

@section('content-header')
<div class="d-flex flex-wrap gap-3 align-items-center justify-content-between">
    <div class="clearfix">
        <h1 class="app-page-title">Profil Saya</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.Dokter.Dashboard_dokter') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Profil</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="row">

    {{-- ================= PROFILE CARD ================= --}}
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap gap-4 align-items-center">

                    <div class="d-flex align-items-center">
                        <div class="position-relative">
                            <div class="avatar avatar-xxl rounded-circle">
                                <img src="{{ asset('assets/images/avatar/fotogw.jpg') }}">
                            </div>
                        </div>

                        <div class="ms-3">
                            <h4 class="fw-bold mb-0">{{ $user->nama}}</h4>
                            <small>ID User: {{ $user->iduser }}</small>

                            <div class="d-flex flex-wrap gap-1 mt-2">
                                @forelse ($roles as $role)
                                    <span class="badge rounded-pill text-bg-primary">
                                        {{ $role->nama_role }}
                                    </span>
                                @empty
                                    <span class="badge text-bg-danger">
                                        Tidak Ada Role
                                    </span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ================= INFORMASI DASAR ================= --}}
    <div class="col-lg-12 mt-3">
        <div class="card">
            <div class="card-body">

                <div class="mb-3">
                    <span class="mb-1">Nama Lengkap</span>
                    <p class="text-dark fw-semibold mb-0">{{ $user->nama }}</p>
                </div>

                <div class="mb-3">
                    <span class="mb-1">Email</span>
                    <p class="text-dark fw-semibold mb-0">{{ $user->email }}</p>
                </div>

                <div class="mb-3">
                    <span class="mb-1">Bidang Dokter</span>
                    <p class="text-dark fw-semibold mb-0">
                        {{ optional($dokter)->bidang_dokter ?? '-' }}
                    </p>
                </div>

                <div class="mb-3">
                    <span class="mb-1">Nomor HP</span>
                    <p class="text-dark fw-semibold mb-0">
                        {{ optional($dokter)->no_hp ?? '-' }}
                    </p>
                </div>

                <div class="mb-3">
                    <span class="mb-1">Alamat</span>
                    <p class="text-dark fw-semibold mb-0">
                        {{ optional($dokter)->alamat ?? '-' }}
                    </p>
                </div>

                <div class="mb-3">
                    <span class="mb-1">Jenis Kelamin</span>
                    <p class="text-dark fw-semibold mb-0">
                        {{ optional($dokter)->jenis_kelamin == 'L' 
                            ? 'Laki-laki' 
                            : (optional($dokter)->jenis_kelamin == 'P' ? 'Perempuan' : '-') 
                        }}
                    </p>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
