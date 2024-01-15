<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

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
    protected function redirectTo()
    {
        $isAdmin = Auth::User()->role == "admin";

        if (!$isAdmin) {
            
        return '/';
        }
        return RouteServiceProvider::HOME;
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

        // Periksa apakah email ada dalam data pengguna Google
        if (!isset($googleUser->email)) {
            return redirect('/login')->with('error', 'Email tidak disediakan oleh Google.');
        }

        $user = User::firstOrCreate([
            'email' => $googleUser->email,
        ], [
            'name' => $googleUser->name ?? 'Tanpa Nama',
            'password' => bcrypt(Str::random(16)),
        ]);

        auth()->login($user, true);

        if ($user->role == 'admin') {
            return redirect('/home');
        } else {
            return redirect('/');
        }

    } catch (\Exception $e) {
        // Log atau tangani exception sesuai kebutuhan
        return redirect('/login')->with('error', 'Email belum terdaftar, Silakan register terlebih dahulu!');
    }
}

    

}
