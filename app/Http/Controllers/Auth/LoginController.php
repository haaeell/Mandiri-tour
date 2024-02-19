<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    public function login(Request $request)
{
    // Validasi data input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Mendefinisikan nilai dari variabel $credentials dengan data input
    $credentials = $request->only('email', 'password');

    // Proses autentikasi pengguna menggunakan metode attempt()
    if (Auth::attempt($credentials)) {
        // Cek apakah pengguna memiliki role admin
        if (Auth::user()->role == 'admin') {
            // Jika role adalah admin, arahkan ke halaman admin
            return redirect()->route('home');
        } else {
            // Jika role bukan admin, arahkan sesuai dengan URL halaman sebelumnya atau halaman default
            return redirect()->intended('/');
        }
    } else {
        // Jika autentikasi gagal, arahkan kembali ke halaman login dengan pesan kesalahan
        return redirect('/login')->with('error', 'Email atau password salah. Silakan coba lagi.');
    }
}

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    

    public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')->user();
        
        if (!$googleUser) {
            return redirect('/login')->with('error', 'Tidak dapat mengambil detail pengguna dari Google.');
        }

        if (!isset($googleUser->email)) {
            return redirect('/login')->with('error', 'Email tidak disediakan oleh Google.');
        }

        // Tambahkan pengecekan apakah email sudah terdaftar di tabel users
        $existingUser = User::where('email', $googleUser->email)->first();
        
        if ($existingUser) {
            // Jika email sudah terdaftar, langsung login
            Auth::login($existingUser, true);

            if ($existingUser->role == 'admin') {
                return redirect('/home');
            } else {
                return redirect('/');
            }
        }

        // Jika email belum terdaftar, berikan pesan error khusus
        return redirect('/login')->with('error', 'Email belum terdaftar. Silakan register terlebih dahulu!');

    } catch (\Exception $e) {
        return redirect('/login')->with('error', 'Terjadi kesalahan. Silakan coba lagi atau hubungi administrator.');
    }
}


    

}
