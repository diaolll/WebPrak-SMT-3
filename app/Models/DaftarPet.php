<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Pastikan Anda sudah membuat Model RasHewan, Pemilik, dan User
// agar relasi ini berfungsi.

class DaftarPet extends Model
{
    // 1. Konfigurasi Dasar Model
    protected $table = 'pet'; // Sesuaikan dengan nama tabel Anda
    protected $primaryKey = 'idpet'; // Sesuaikan dengan nama primary key Anda
    
    // Tambahkan kolom yang bisa diisi jika Anda ingin menggunakan fitur mass assignment (opsional)
    // protected $fillable = ['nama', 'tanggal_lahir', 'warna_tanda', 'jenis_kelamin', 'idpemilik', 'idras_hewan'];


    // 2. Definisi Relasi (HARUS DENGAN HURUF KECIL sesuai panggilan di Controller)
    
    /**
     * Relasi Pet ke Pemilik (Many-to-One)
     * Pet memiliki satu pemilik.
     */
    public function pemilik()
    {
        // Parameter: (NamaModelRelasi::class, foreign_key_di_tabel_pet, local_key_di_tabel_pemilik)
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }
    
    /**
     * Relasi Pet ke RasHewan (Many-to-One)
     * Pet memiliki satu ras hewan.
     */
    public function rasHewan()
    {
        // Parameter: (NamaModelRelasi::class, foreign_key_di_tabel_pet, local_key_di_tabel_ras_hewan)
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }
    
    // Jika Anda memiliki idjenis_hewan di tabel pet, tambahkan relasi berikut:
    /*
    public function jenisHewan()
    {
        return $this->belongsTo(JenisHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }
    */
}