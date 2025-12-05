<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'warna_tanda',
        'idpemilik',
        'idras_hewan'
    ];

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    public function jenisHewan()
    {
        return $this->hasOneThrough(
            JenisHewan::class,      // model tujuan
            RasHewan::class,        // model perantara
            'idras_hewan',          // FK di tabel ras_hewan
            'idjenis_hewan',        // FK di tabel jenis_hewan
            'idras_hewan',          // FK di tabel pet
            'idjenis_hewan'         // PK di tabel ras_hewan
        );
    }
}
