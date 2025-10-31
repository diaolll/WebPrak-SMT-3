<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $primaryKey = 'idrole_user';
    public $timestamps = false;
    protected $fillable = [
        'idrole',
        'iduser',
    ];
}