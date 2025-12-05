<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    protected $fillable = [
        'anamnesa',
    ];}
