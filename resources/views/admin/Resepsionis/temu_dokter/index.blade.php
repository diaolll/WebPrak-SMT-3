@extends('layouts.gxon.main')

@section('content-header')
    <h1 class="app-page-title">
        <i class="bi bi-journal-medical me-2"></i> Daftar Temu Dokter
    </h1>
@endsection

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-body">

        {{-- Notifikasi Berhasil / Error --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">Data Reservasi</h5>
            <a href="{{ route('admin.resepsionis.temu_dokter.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i> Tambah Janji Dokter
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No Urut</th>
                        <th>Nama Pet</th>
                        <th>Dokter</th>
                        <th>Status</th>
                        <th>Waktu Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($reservasi as $r)
                        <tr>
                            <td class="fw-bold">{{ $r->no_urut }}</td>

                            <td>
                                <strong>{{ $r->pet->nama }}</strong><br>
                                <small class="text-muted">
                                    {{ $r->pet->jenisHewan->nama_jenis_hewan ?? '-' }} /
                                    {{ $r->pet->rasHewan->nama_ras ?? '-' }}
                                </small>
                            </td>

                            <td>
                                <i class="bi bi-person-badge me-1"></i>
                                {{ $r->roleUser->user->nama }}
                            </td>

                            <td>
                                @php
                                    $statusMap = [
                                    'P' => ['text' => 'Menunggu','class'=>'bg-info text-white','icon'=>'bi-hourglass-split'],
                                        'S' => ['text' => 'Selesai', 'class' => 'bg-success text-white'],
                                        'D' => ['text' => 'Diperiksa', 'class' => 'bg-primary text-white'],
                                    ];

                                    $status = $statusMap[$r->status] ?? ['text' => 'Tidak diketahui', 'class' => 'bg-secondary'];
                                @endphp

                                <span class="badge rounded-pill {{ $status['class'] }}">
                                    {{ $status['text'] }}
                                </span>
                            </td>

                            <td>
                                <i class="bi bi-clock me-1"></i>
                                {{ \Carbon\Carbon::parse($r->waktu_daftar)->format('d M Y H:i') }}
                            </td>

                            <td>
                                <form action="{{ route('admin.resepsionis.temu_dokter.destroy', $r->idreservasi_dokter) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger rounded-pill px-3">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-calendar-x fs-2 d-block mb-2"></i>
                                Tidak ada data reservasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
@endsection
