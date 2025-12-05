<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pemilik extends Model
{
    protected $table = 'pemilik'; 
    protected $primaryKey = 'idpemilik'; 
    protected $fillable = ['no_wa', 'alamat', 'iduser', 'idpemilik']; // <<< PERBAIKAN PENTING
    public $timestamps = false; 

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}