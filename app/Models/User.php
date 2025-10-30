<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // <- penting untuk Auth::attempt
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function roles()
    {
        // role_user: (iduser, idrole, status)
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole')
                    ->withPivot('status');
    }

}

