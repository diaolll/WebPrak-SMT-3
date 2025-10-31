@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} {{ session('user_name') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in! ') }} {{ session('user_role_name') }}

                    <div class="mt-4">
                        <div class="row">
                            
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.jenis_hewan.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-paw"></i> Daftar Jenis Hewan
                                </a>
                            </div>

                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.pemilik.index') }}" class="btn btn-success btn-block">
                                    <i class="fas fa-users"></i> Daftar Pemilik
                                </a>
                            </div>

                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.ras_hewan.index') }}" class="btn btn-info btn-block">
                                    <i class="fas fa-bone"></i> Daftar Ras Hewan
                                </a>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.daftar_pet.index') }}" class="btn btn-warning btn-block">
                                    <i class="fas fa-dog"></i> Daftar Pet
                                </a>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-list"></i> Daftar Kategori
                                </a>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.kategori_klinis.index') }}" class="btn btn-dark btn-block">
                                    <i class="fas fa-stethoscope"></i> Kategori Klinis
                                </a>
                            </div>

                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.kode_tindakan_terapi.index') }}" class="btn btn-danger btn-block">
                                    <i class="fas fa-notes-medical"></i> Kode Tindakan Terapi
                                </a>
                            </div>

                             <div class="col-md-12 mb-2">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-info btn-block">
                                    <i class="fas fa-users-cog"></i> User & Role
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection