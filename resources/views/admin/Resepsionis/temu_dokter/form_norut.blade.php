@extends('layouts.gxon.main')

@section('content-header')
    <h1 class="app-page-title">Nomor Antrian</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body text-center">

        <h3>Berhasil Mendaftar!</h3>
        <p>Silakan tunjukkan nomor antrian ini ke petugas.</p>

        <div class="display-4 fw-bold mt-3">
            {{ session('no_urut') ? 'A-' . session('no_urut') : 'A-??' }}
        </div>

        <a href="{{ route('admin.resepsionis.temu_dokter.index') }}" class="btn btn-primary mt-4">
            Kembali ke daftar
        </a>

    </div>
</div>

@endsection
