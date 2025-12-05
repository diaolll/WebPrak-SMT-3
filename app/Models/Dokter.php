<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Dokter extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    public $timestamps = false; // Mematikan created_at dan updated_at

    protected $fillable = [
        'alamat',
        'no_hp',
        'bidang_dokter',
        'jenis_kelamin',
        'id_user' // Kunci relasi ke tabel User
    ];

    /**
     * Relasi One-to-One: Dokter dimiliki oleh satu User.
     * Foreign Key di tabel 'dokter' adalah 'id_user',
     * merujuk ke Primary Key 'iduser' di tabel 'user'.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'iduser');
    }
    
}