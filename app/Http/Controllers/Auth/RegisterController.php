<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;

class RegisterController extends Controller
{
    // ... (Bagian RegistersUsers, $redirectTo, __construct(), dan validator() tetap sama)

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // 1. Buat user baru
        $user = User::create([
            'nama' => $data['name'], // CATATAN: Ubah 'name' menjadi 'nama' sesuai model User
            'email' => $data['email'],
            // Hashing password otomatis jika menggunakan $casts di model User (Laravel 10+)
            // Jika tidak, tetap gunakan Hash::make() seperti di bawah.
            'password' => Hash::make($data['password']),
        ]);

        // 2. Tentukan ID Role default
        // CARA A: Tentukan ID secara langsung (Jika ID role default sudah pasti)
        $defaultRoleId = 3; // Ganti dengan ID role yang sesuai, misal 3 untuk 'Pengguna'

        // ATAU

        // CARA B: Cari Role berdasarkan nama (Lebih fleksibel)
        // Pastikan Anda telah mengimpor `use App\Models\Role;` di atas.
        $defaultRole = Role::where('nama_role', 'Pengguna')->first(); // Ganti 'Pengguna' dengan nama role default Anda
        $defaultRoleId = $defaultRole ? $defaultRole->idrole : null;

        // 3. Lampirkan Role ke User
        if ($defaultRoleId) {
            // Karena relasi roles() menggunakan withPivot('status'),
            // kita harus menyertakan nilai untuk 'status'.
            // Asumsi: status default saat registrasi adalah 1 (aktif).
            $user->roles()->attach($defaultRoleId, ['status' => 1]);
        }

        return $user;
    }
}

