<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;    
use App\Models\Role;
use App\Models\RoleUser;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|min:4',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    $user = User::with(['roles' => function ($query) {
        $query->where('status', 1);
    }])
        ->where('email', $request->input('email'))
        ->first();

    if (!$user) {
        return redirect()->back()
            ->withErrors(['email' => 'Email tidak ditemukan.'])
            ->withInput();
    }

    // Cek password
    if (!\Hash::check($request->password, $user->password)) {
        return redirect()->back()
            ->withErrors(['password' => 'Password salah.'])
            ->withInput();
    }

    // Ambil nama role
    $namaRole = Role::where('idrole', $user->roles[0]->idrole ?? null)->first();

    // Login user ke session
    Auth::login($user);

    // Simpan session user
    $request->session()->put([
        'user_id' => $user->iduser,
        'user_name' => $user->nama,
        'user_email' => $user->email,
        'user_role' => $user->roles[0]->idrole ?? 'user',
        'user_role_name' => $namaRole->nama_role ?? 'User',
        'user_status' => $user->roles[0]->status ?? 'active'
    ]);

    $roles = $user->roles[0]->idrole ?? null;

    switch ($roles) {
        case 1:
            return redirect()->intended('/home')->with('success', 'Login berhasil!');
        case 2:
            return redirect()->intended('/resepsionis')->with('success', 'Login berhasil!');
        default:
            return redirect()->intended('/home')->with('success', 'Login berhasil!');
    }

    // Redirect ke /home (Sesuai gambar, bukan switch case)
}

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Logout berhasil!');
}




}
