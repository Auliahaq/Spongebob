<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;



class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/home')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => bcrypt($request->password),
        'avatar'   => null, // biarkan null (nanti bisa diubah lewat halaman profil)
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
}



        public function showForgotPassword()
    {
    return view('auth.forgot-password');
    }

    public function showForgot()
    {
    return view('auth.forgot-password');
    }


    public function showResetForm(Request $request, $token)
{
    $email = $request->query('email');

    // (Opsional) validasi token & email cocok di DB
    $record = DB::table('password_resets')
                ->where('email', $email)
                ->where('token', $token)
                ->first();
    if (! $record) {
        abort(404);
    }

    return view('auth.reset-password', compact('token','email'));
}

    public function resetPassword(Request $request)
    {
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:6|confirmed',
        'token' => 'required'
    ]);

    // Cek token valid
    $reset = DB::table('password_resets')
        ->where('email', $request->email)
        ->where('token', $request->token)
        ->first();

    if (!$reset) {
        return back()->withErrors(['email' => 'Token tidak valid atau sudah kadaluarsa.']);
    }

    // Update password
    DB::table('users')->where('email', $request->email)
        ->update(['password' => Hash::make($request->password)]);

    // Hapus token
    DB::table('password_resets')->where('email', $request->email)->delete();

    return redirect('/login')->with('status', 'Password berhasil diubah. Silakan login.');
    }

    public function sendResetLink(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $token = Str::random(60);

    DB::table('password_resets')->updateOrInsert(
        ['email' => $request->email],
        ['token' => $token, 'created_at' => now()]
    );

    // Kirim email ke user
    $resetLink = route('password.reset', [
        'token' => $token,
        'email' => $request->email,
    ]);

    Mail::raw("Klik link berikut untuk mereset password Anda:\n\n$resetLink", function ($message) use ($request) {
        $message->to($request->email)
                ->subject('Reset Password Akun Anda');
    });

    return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
