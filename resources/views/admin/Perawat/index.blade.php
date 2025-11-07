{{-- File: resources/views/perawat/rekam_medis/index.blade.php --}}

@extends('layouts.app') {{-- Sesuaikan dengan nama layout utama Anda --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Rekam Medis</h5>
                </div>

                <div class="card-body">
                    {{-- Tombol untuk menambah data baru (Jika ada) --}}
                    {{-- <a href="{{ route('perawat.rekam_medis.create') }}" class="btn btn-primary mb-3">
                        Tambah Rekam Medis Baru
                    </a> --}}

                    @if ($RekamMedis->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            Tidak ada data Rekam Medis yang ditemukan.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Rekam Medis</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>ID Pet</th>
                                        <th>Anamnesa</th>
                                        <th>Temuan Klinis</th>
                                        <th>Diagnosa</th>
                                        <th>Dokter Pemeriksa</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($RekamMedis as $rm)
                                    <tr>
                                        <td>{{ $rm->idrekam_medis }}</td>
                                        <td>{{ $rm->created_at ? $rm->created_at->format('d-m-Y H:i') : '-' }}</td>
                                        <td>{{ $rm->idpet }}</td>
                                        <td>{{ $rm->anamnesa }}</td>
                                        <td>{{ $rm->temuan_klinis }}</td>
                                        <td>{{ $rm->diagnosa }}</td>
                                        <td>{{ $rm->dokter_pemeriksa }}</td>
                                        <td>
                                            {{-- Tambahkan tombol aksi di sini, seperti detail atau edit --}}
                                            <a href="#" class="btn btn-sm btn-info">Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                     <div class="mt-3">
                        <a href="{{ route('admin.Perawat.Dashboard_perawat') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection