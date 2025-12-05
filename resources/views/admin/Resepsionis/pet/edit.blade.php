@extends('layouts.gxon.main') 

@section('title', 'Edit Data Pet')

@section('content-header')
<h1 class="app-page-title">Edit Data Pet</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Resepsionis</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Edit Pet</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            
            <div class="card-header border-bottom">
                <h5 class="mb-0 card-title fw-bold">Form Edit Data Pet</h5>
            </div>

            <div class="card-body">
                
                {{-- Notifikasi Error --}}
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.Resepsionis.pet.update', $pet->idpet) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <h6 class="text-primary mb-3">Data Informasi Pet</h6>

                    {{-- Input Nama Pet --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pet <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="nama" 
                               class="form-control @error('nama') is-invalid @enderror" 
                               value="{{ old('nama', $pet->nama) }}" 
                               placeholder="Masukkan nama pet"
                               required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Tanggal Lahir --}}
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                               class="form-control @error('tanggal_lahir') is-invalid @enderror"
                               value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}">
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Jenis Kelamin --}}
                  <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="J" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'J' ? 'selected' : '' }}>Jantan</option>
                            <option value="B" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'B' ? 'selected' : '' }}>Betina</option>
                        </select>
                        @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Input Warna / Tanda --}}
                    <div class="mb-3">
                        <label for="warna_tanda" class="form-label">Warna / Tanda</label>
                        <input type="text" name="warna_tanda" id="warna_tanda"
                               class="form-control @error('warna_tanda') is-invalid @enderror"
                               value="{{ old('warna_tanda', $pet->warna_tanda) }}"
                               placeholder="Contoh: Putih bersih, Hitam dengan bintik coklat">
                        @error('warna_tanda')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <h6 class="text-primary mb-3 mt-4">Keterangan Pemilik & Jenis Hewan</h6>

                    {{-- Input Pemilik --}}
                    <div class="mb-3">
                        <label for="idpemilik" class="form-label">Pemilik <span class="text-danger">*</span></label>
                        <select name="idpemilik" id="idpemilik" 
                                class="form-select @error('idpemilik') is-invalid @enderror" required>
                            <option value="">Pilih Pemilik</option>
                            @foreach($pemilik as $p)
                                <option value="{{ $p->idpemilik }}" 
                                        {{ old('idpemilik', $pet->idpemilik) == $p->idpemilik ? 'selected' : '' }}>
                                    {{ $p->user->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('idpemilik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Jenis Hewan --}}
                    <div class="mb-3">
                        <label for="idjenis_hewan" class="form-label">Jenis Hewan <span class="text-danger">*</span></label>
                        <select name="idjenis_hewan" id="idjenis_hewan" 
                                class="form-select @error('idjenis_hewan') is-invalid @enderror" required>
                            <option value="">Pilih Jenis Hewan</option>
                            @foreach($jenis as $j)
                                <option value="{{ $j->idjenis_hewan }}"
                                        {{ old('idjenis_hewan', $pet->rasHewan->idjenis_hewan ?? '') == $j->idjenis_hewan ? 'selected' : '' }}>
                                    {{ $j->nama_jenis_hewan }}
                                </option>
                            @endforeach
                        </select>
                        @error('idjenis_hewan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Ras Hewan --}}
                    <div class="mb-3">
                        <label for="idras_hewan" class="form-label">Ras Hewan <span class="text-danger">*</span></label>
                        <select name="idras_hewan" id="idras_hewan" 
                                class="form-select @error('idras_hewan') is-invalid @enderror" required>
                            <option value="">Pilih Ras</option>
                            @foreach($ras as $r)
                                <option value="{{ $r->idras_hewan }}" 
                                        data-jenis="{{ $r->idjenis_hewan }}"
                                        class="ras-option"
                                        {{ old('idras_hewan', $pet->idras_hewan) == $r->idras_hewan ? 'selected' : '' }}>
                                    {{ $r->nama_ras }}
                                </option>
                            @endforeach
                        </select>
                        @error('idras_hewan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.Resepsionis.pet.index') }}" class="btn btn-outline-secondary waves-effect">
                            <i class="fi fi-rr-arrow-left me-1"></i> Kembali
                        </a>

                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            <i class="fi fi-rr-disk me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jenisSelect = document.getElementById('idjenis_hewan');
    const rasSelect = document.getElementById('idras_hewan');
    // Hanya memilih opsi ras yang berada di dalam select idras_hewan
    const rasOptions = document.querySelectorAll('#idras_hewan .ras-option'); 

    // Fungsi untuk filter ras berdasarkan jenis
    function filterRasByJenis() {
        const selectedJenis = jenisSelect.value;
        const currentSelectedRas = rasSelect.value;

        // Sembunyikan semua opsi terlebih dahulu
        rasOptions.forEach(option => {
            option.style.display = 'none';
            option.disabled = true;
        });
        
        // Tampilkan hanya yang sesuai
        let isValidSelection = false;
        rasOptions.forEach(option => {
            if (option.dataset.jenis === selectedJenis || selectedJenis === '') {
                option.style.display = '';
                option.disabled = false;
                
                // Cek apakah opsi yang saat ini terpilih termasuk valid
                if (option.value === currentSelectedRas) {
                    isValidSelection = true;
                }
            }
        });
        
        // Reset pilihan jika ras yang terpilih tidak lagi valid
        if (currentSelectedRas && !isValidSelection) {
            rasSelect.value = '';
        }
    }
    
    // Event listener untuk filter
    jenisSelect.addEventListener('change', filterRasByJenis);
    
    // Jalankan filter saat halaman dimuat (penting untuk mempertahankan nilai old/edit)
    filterRasByJenis();
});
</script>
@endsection