<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


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

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
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

    // Redirect + kirim token & email
    return redirect()->route('password.reset', [
        'token' => $token,
        'email' => $request->email,
    ]);
}
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
