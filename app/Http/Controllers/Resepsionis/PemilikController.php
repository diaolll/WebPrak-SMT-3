<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Exception;

class PemilikController extends Controller
{
    // INDEX
    public function index()
    {
        $pemilik = Pemilik::with('user')->get();
        return view('admin.resepsionis.pemilik.index', compact('pemilik'));
    }

    // CREATE FORM
    public function create()
    {
        return view('admin.resepsionis.pemilik.create');
    }

    // STORE
    public function store(Request $request)
    {
        try {
            $data = $this->validatePemilik($request);
            $this->createPemilikAndUser($data);

            return redirect()->route('admin.resepsionis.pemilik.index')
                ->with('success', 'Pemilik berhasil ditambahkan.');

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    // EDIT FORM
    public function edit($idpemilik)
    {
        $pemilik = Pemilik::with('user')->findOrFail($idpemilik);
        return view('admin.resepsionis.pemilik.edit', compact('pemilik'));
    }

    // UPDATE
    public function update(Request $request, $idpemilik)
    {
        try {
            $data = $this->validatePemilik($request, $idpemilik);
            $this->updatePemilikAndUser($idpemilik, $data);

            return redirect()->route('admin.resepsionis.pemilik.index')
                ->with('success', 'Pemilik berhasil diperbarui.');

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    // DELETE
    public function destroy($idpemilik)
    {
        try {
            $pemilik = Pemilik::findOrFail($idpemilik);
            $userId = $pemilik->iduser;

            $pemilik->delete();
            User::destroy($userId);

            return back()->with('success', 'Pemilik berhasil dihapus.');

        } catch (Exception $e) {
            return back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    // VALIDATION
    protected function validatePemilik(Request $request, $id = null)
    {
        $pemilik = $id ? Pemilik::find($id) : null;
        $userId = $pemilik->iduser ?? null;

        return $request->validate([
            'nama'   => ['required', 'string', 'max:255'],
            'no_wa'  => ['required', Rule::unique('pemilik', 'no_wa')->ignore($id, 'idpemilik')],
            'alamat' => ['required'],

            'email'  => [
                'required', 'email',
                Rule::unique('user', 'email')->ignore($userId, 'iduser'),
            ],

            'password' => [$id ? 'nullable' : 'required', 'min:8', 'confirmed'],
        ]);
    }

    // AUTO INCREMENT MANUAL
    protected function getNextIdPemilik()
    {
        return (Pemilik::max('idpemilik') ?? 0) + 1;
    }

    // CREATE USER + PEMILIK
    protected function createPemilikAndUser($data)
    {
        // BUAT USER
        $user = User::create([
            'nama'     => ucwords($data['nama']),
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'idrole'   => 5, // role Pemilik
        ]);

        // BUAT PEMILIK
        return Pemilik::create([
            'idpemilik' => $this->getNextIdPemilik(),
            'no_wa'     => $data['no_wa'],
            'alamat'    => $data['alamat'],
            'iduser'    => $user->iduser,
        ]);
    }

    // UPDATE USER + PEMILIK
    protected function updatePemilikAndUser($idpemilik, $data)
    {
        $pemilik = Pemilik::with('user')->findOrFail($idpemilik);

        // UPDATE USER
        $updateUser = [
            'nama'  => ucwords($data['nama']),
            'email' => $data['email'],
        ];

        if (!empty($data['password'])) {
            $updateUser['password'] = Hash::make($data['password']);
        }

        $pemilik->user->update($updateUser);

        // UPDATE PEMILIK
        $pemilik->update([
            'no_wa'  => $data['no_wa'],
            'alamat' => $data['alamat'],
        ]);
    }
}
