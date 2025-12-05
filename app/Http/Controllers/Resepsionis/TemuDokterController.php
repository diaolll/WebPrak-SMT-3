<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Temu_dokter;
use App\Models\DaftarPet;
use App\Models\RoleUser;
use Illuminate\Support\Facades\DB;
use App\Models\RekamMedis;

class TemuDokterController extends Controller
{
    /**
     * Tampilkan daftar reservasi
     */
    public function index()
    {
        $reservasi = Temu_dokter::with([
                'pet.pemilik.user',
                'roleUser.user'
            ])
            ->orderBy('waktu_daftar', 'desc')
            ->get();

        return view('admin.resepsionis.temu_dokter.index', compact('reservasi'));
    }

    /**
     * Hapus data reservasi
     */
    public function destroy($id)
    {
        try {
            $temu = Temu_dokter::findOrFail($id);
            $temu->delete();

            return back()->with('success', 'Data janji temu berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Form tambah reservasi
     */
    public function create()
    {
        // Ambil pet + pemilik
        $pets = DaftarPet::with([
            'pemilik.user',
            'jenisHewan',
            'rasHewan'
        ])->get();

        // Ambil semua dokter (role = 2)
        $dokter = RoleUser::with('user')
                    ->where('idrole', 2)
                    ->get();

        return view('admin.resepsionis.temu_dokter.create', compact('pets', 'dokter'));
    }

    /**
     * Simpan data reservasi
     */
    public function store(Request $request)
    {
        $request->validate([
            'idpet'        => 'required|exists:pet,idpet',
            'idrole_user'  => 'required|exists:role_user,idrole_user',
        ]);

        DB::beginTransaction();

        try {
            // Hitung nomor urut harian
            $noUrut = Temu_dokter::whereDate('waktu_daftar', now()->toDateString())
                        ->count() + 1;

            Temu_dokter::create([
                'no_urut'      => $noUrut,
                'waktu_daftar' => now(),
                'status'       => 'P',   // DEFAULT: P = Menunggu
                'idpet'        => $request->idpet,
                'idrole_user'  => $request->idrole_user,
            ]);

            DB::commit();

            return redirect()
                ->route('admin.resepsionis.temu_dokter.form_norut')
                ->with([
                    'success' => "Berhasil mendaftar! Nomor urut: $noUrut",
                    'no_urut' => $noUrut
                ]);

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', 'Gagal daftar temu dokter: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan nomor urut
     */
    public function nomorUrut()
    {
        $noUrut = session('no_urut');

        // Fallback jika session hilang
        if (!$noUrut) {
            $last = Temu_dokter::latest('waktu_daftar')->first();
            $noUrut = $last ? $last->no_urut : '-';
        }

        return view('admin.resepsionis.temu_dokter.form_norut', compact('noUrut'));
    }

    public function updateStatus(Request $request, $idreservasi_dokter)
    {
        $request->validate([
            'status' => 'required|in:P,D,S,B'
        ]);

        $td = Temu_dokter::findOrFail($idreservasi_dokter);

        $td->status = $request->status;
        $td->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }

}
