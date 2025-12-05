<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temu_dokter extends Model
{
    protected $table = 'temu_dokter'; // ← NAMA TABEL ASLI

    protected $primaryKey = 'idreservasi_dokter'; // PK kamu

    public $timestamps = false; // karena tabel tidak punya created_at / updated_at

    protected $fillable = [
        'no_urut',
        'waktu_daftar',
        'status',
        'idpet',
        'idrole_user'
    ];

    public function pet()
    {
        return $this->belongsTo(DaftarPet::class, 'idpet', 'idpet');
    }

    public function roleUser()
    {
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }
}
