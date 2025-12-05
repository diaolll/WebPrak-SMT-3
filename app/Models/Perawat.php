<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    protected $table = 'perawat';
    protected $primaryKey = 'id_perawat';
    public $timestamps = false; // Mematikan created_at dan updated_at

    protected $fillable = [
        'alamat',
        'no_hp',
        'jenis_kelamin',
        'pendidikan',
        'id_user' // Kunci relasi ke tabel User
    ];

    /**
     * Relasi One-to-One: Perawat dimiliki oleh satu User.
     * Foreign Key di tabel 'perawat' adalah 'id_user',
     * merujuk ke Primary Key 'iduser' di tabel 'user'.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'iduser');
    }
}