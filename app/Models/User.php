<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // <- penting untuk Auth::attempt
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Pemilik;
use App\Models\RoleUser;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'iduser';
    public $timestamps = false;

    protected $fillable = ['nama', 'email', 'password'];
    protected $hidden   = ['password'];

    // otomatis hash ketika set password (Laravel 10+)
    protected $casts = [
        'password' => 'hashed',
    ];

    public function roles() // ini buat relaso ke role sama user nya
    {
        // role_user: (iduser, idrole, status)
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole')
                    ->withPivot('status');
    }

    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }


}



