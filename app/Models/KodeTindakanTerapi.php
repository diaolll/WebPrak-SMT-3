<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// PENTING: Import Model Kategori dan KategoriKlinis
use App\Models\Kategori; 
use App\Models\KategoriKlinis; 

class KodeTindakanTerapi extends Model
{
    // Nama tabel di database
    protected $table = 'kode_tindakan_terapi'; 

    // Primary key (sesuai yang digunakan di Controller)
    protected const PRIMARY_KEY = 'idkode_tindakan_terapi';
    protected $primaryKey = self::PRIMARY_KEY; 
    
    // PERBAIKAN UTAMA: Menghapus 'nama_tindakan' dan 'idkategori_klinis' tetap ada
    protected $fillable = [
        'kode', 
        'deskripsi_tindakan_terapi', // Kolom yang BENAR di DB
        'idkategori', 
        'idkategori_klinis' 
    ]; 

    // Non-aktifkan timestamps jika kolom created_at dan updated_at tidak ada
    public $timestamps = false;

    // Definisikan relasi ke Kategori Master
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori', 'idkategori');
    }
    
    // Definisikan relasi ke Kategori Klinis
    public function kategoriKlinis()
    {
        return $this->belongsTo(KategoriKlinis::class, 'idkategori_klinis', 'idkategori_klinis');
    }
}