<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RoleUser;
use App\Models\DaftarPet;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $timestamps = false;

    protected $fillable = [
        'anamnesa',
        'temuan_klinis',
        'diagnosa',
        'idpet',
        'dokter_pemeriksa',
        'created_at',
        'idkode_tindakan_terapi'
    ];

    public function dokter()
    {
        return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa', 'idrole_user');
    }


    public function pet()
    {
        return $this->belongsTo(DaftarPet::class, 'idpet', 'idpet');
    }

    public function detail()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }


}
