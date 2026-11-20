<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Carbon;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // View yang digunakan bersama
    }

    public function showLoginAdminForm()
    {
        return view('auth.login-admin'); // View khusus untuk admin
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'no_wa' => 'required|exists:users,no_wa',
        ], [
            'no_wa.exists' => 'no_wa_not_found',
        ]);

        $otp = random_int(100000, 999999);

        $user = User::where('no_wa', $request->no_wa)->first();
        $user->otp_code = $otp;
        $user->otp_expired_at = Carbon::now()->addMinutes(5);
        $user->save();

        // Kirim OTP ke WhatsApp
        $this->sendOtpToWhatsapp($user->no_wa, $otp);

        session(['no_wa' => $user->no_wa]);
        return redirect()->route('otp.verify.form');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'no_wa' => 'required',
            'otp_code' => 'required',
        ]);

        $user = User::where('no_wa', $request->no_wa)
            ->where('otp_code', $request->otp_code)
            ->where('otp_expired_at', '>', Carbon::now())
            ->first();

        if (!$user) {
            return back()->withErrors(['otp_code' => 'Kode OTP salah atau sudah kedaluwarsa.']);
        }

        Auth::login($user);

        // Reset kode OTP setelah login
        $user->otp_code = null;
        $user->otp_expired_at = null;
        $user->save();

        return redirect()->intended('/user/dashboard');
    }

    private function sendOtpToWhatsapp($nomorWA, $otp)
    {
        $apiKey = env('ONESENDER_API_KEY');
        $apiUrl = env('ONESENDER_API_URL');

        // Ubah 08xxx jadi format internasional +62xxx
        $nomorWA = "+" . preg_replace('/^0/', '62', trim($nomorWA));

        $message = "*Kode OTP Login*\n\n"
                . "Halo, berikut adalah kode OTP untuk login ke akun PPDB Anda:\n\n"
                . "*$otp*\n\n"
                . "Kode ini hanya berlaku selama 5 menit.\n\n"
                . "Jangan bagikan kode ini kepada siapa pun.";

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer $apiKey",
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($apiUrl, [
                "recipient_type" => "individual",
                "to" => $nomorWA,
                "type" => "text",
                "text" => [
                    "body" => $message
                ]
            ]);

            // Log atau tangani respons jika diperlukan
            \Log::info('OTP dikirim ke WA: ' . $nomorWA, [
                'response' => $response->json()
            ]);
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim OTP via Onesender', [
                'error' => $e->getMessage()
            ]);
        }
    }

    public function loginAdmin(Request $request)
    {
        // Validasi input
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        // Cek di tabel admin
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard'); // Redirect admin
        }

        // Jika gagal
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        // Logout berdasarkan guard
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else {
            Auth::guard('web')->logout();
        }

        return redirect()->route('login');
    }
}
