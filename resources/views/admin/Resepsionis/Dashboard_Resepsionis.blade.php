@extends('layouts.gxon.main')

@section('title', 'Dashboard Resepsionis')

@section('content-header')
@endsection

@section('content')
<div class="row g-4">

    {{-- CTA UTAMA --}}
    <div class="col-12">
        <div class="card shadow-lg border-0 bg-primary text-white text-center p-5 rounded-4">
            <h2 class="fw-bold mb-3">Buat Janji Temu Dokter</h2>
            <p class="mb-4">Klik tombol di bawah untuk mendaftarkan pasien ke dokter secara cepat.</p>

            <a href="{{ route('admin.resepsionis.temu_dokter.create') }}" 
                class="btn btn-light btn-lg fw-bold px-5 py-3 rounded-pill shadow-sm">
                <i class="fi fi-rr-user-add me-2"></i>
                Mulai Buat Temu Dokter
            </a>
        </div>
    </div>

    {{-- STATISTIK --}}
    @php
        $stats = [
            ['value' => $totalReservasi, 'label' => 'Total Temu Dokter Hari Ini', 'color' => 'text-primary'],
            ['value' => $totalSelesai,    'label' => 'Selesai Diperiksa',         'color' => 'text-success'],
            ['value' => $totalMenunggu,   'label' => 'Menunggu Antrian',          'color' => 'text-warning'],
        ];
    @endphp

    @foreach ($stats as $s)
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4 text-center">
                    <div class="display-5 fw-bold {{ $s['color'] }}">
                        {{ $s['value'] ?? 0 }}
                    </div>
                    <p class="text-muted mb-0">{{ $s['label'] }}</p>
                </div>
            </div>
        </div>
    @endforeach


    {{-- TABEL ANTRIAN --}}
    <div class="col-12 mt-4">
        <div class="card shadow-sm border-0 rounded-4">

            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title fw-bold d-flex align-items-center gap-2">
                    <i class="fi fi-rr-list-check text-primary fs-5"></i>
                    Antrian Pasien Hari Ini
                </h5>
            </div>

            <div class="card-body">

                @if ($rekamMedisHariIni->isEmpty())
                    <div class="alert alert-warning text-center py-3 rounded-3">
                        Tidak ada pasien hari ini.
                    </div>

                @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle">
                        <thead>
                            <tr class="bg-light">
                                <th style="width: 60px;" class="text-center">No</th>
                                <th>Waktu</th>
                                <th>Nama Pet</th>
                                <th>Jenis & Ras</th>
                                <th>Pemilik</th>
                                <th style="width: 150px;" class="text-center">Status</th>
                                <th style="width: 150px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($rekamMedisHariIni as $index => $data)
                            
                            @php
                                $statusData = [
                                    'P' => ['text' => 'Menunggu','class'=>'bg-info text-white','icon'=>'bi-hourglass-split'],
                                    'D' => ['text' => 'Diperiksa','class'=>'bg-primary text-white','icon'=>'bi-activity'],
                                    'S' => ['text' => 'Selesai','class'=>'bg-success text-white','icon'=>'bi-check-circle'],
                                    'B' => ['text' => 'Dibatalkan','class'=>'bg-danger text-white','icon'=>'bi-x-circle'],
                                ];

                                $status = $statusData[$data->status] ?? [
                                    'text' => 'Unknown',
                                    'class' => 'bg-secondary text-white',
                                    'icon' => 'bi-question-circle'
                                ];
                            @endphp

                            <tr>
                                <td class="text-center fw-bold">{{ $index + 1 }}</td>

                                <td>{{ \Carbon\Carbon::parse($data->waktu_daftar)->format('d M Y H:i') }}</td>

                                <td class="fw-semibold">{{ $data->pet->nama ?? '-' }}</td>

                                <td>
                                    {{ $data->pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }} /
                                    {{ $data->pet->rasHewan->nama_ras ?? '-' }}
                                </td>

                                <td>{{ $data->pet->pemilik->user->nama ?? '-' }}</td>

                                {{-- BADGE STATUS --}}
                                <td class="text-center">
                                    <span class="badge rounded-pill px-3 py-2 fw-bold d-inline-flex justify-content-center align-items-center {{ $status['class'] }}"
                                        style="min-width: 140px; font-size: .9rem;">
                                        <i class="bi {{ $status['icon'] }} me-1"></i>
                                        {{ $status['text'] }}
                                    </span>
                                </td>

                                {{-- TOMBOL PROSES --}}
                                <td class="text-center">
                                    <button class="btn btn-outline-primary btn-sm rounded-pill updateStatusBtn px-3 py-2 fw-semibold"
                                        data-id="{{ $data->idreservasi_dokter }}"
                                        data-url="{{ route('resepsionis.updateStatus', $data->idreservasi_dokter) }}">
                                        <i class="fi fi-rr-edit me-1"></i>
                                        Proses
                                    </button>
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


{{-- GLOBAL MODAL UPDATE STATUS --}}
<div class="modal fade" id="updateStatusModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Update Status Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="updateStatusForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <label class="fw-semibold mb-2">Status Baru:</label>
                    <select name="status" class="form-select rounded-3 py-2" required>
                        <option value="P">Menunggu</option>
                        <option value="D">Diperiksa</option>
                        <option value="S">Selesai</option>
                        <option value="B">Dibatalkan</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection


{{-- SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const updateBtns = document.querySelectorAll('.updateStatusBtn');
    const form = document.getElementById('updateStatusForm');

    updateBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            form.action = this.dataset.url;
            new bootstrap.Modal(document.getElementById('updateStatusModal')).show();
        });
    });
});
</script>
