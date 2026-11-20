<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_wa' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'no_wa.unique' => 'no_wa_already_registered',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
        ]);

        // Simpan user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'password' => Hash::make($request->password),
        ]);

        // Generate OTP
        $otp = random_int(100000, 999999);
        $user->otp_code = $otp;
        $user->otp_expired_at = Carbon::now()->addMinutes(5);
        $user->save();

        // Kirim OTP via WhatsApp
        $this->sendOtpToWhatsapp($user->no_wa, $otp);

        session(['no_wa' => $user->no_wa]);
        return redirect()->route('otp.verify.form');
    }

    // Salin dari LoginController, sesuaikan jika diperlukan
    private function sendOtpToWhatsapp($nomorWA, $otp)
    {
        $apiKey = env('ONESENDER_API_KEY');
        $apiUrl = env('ONESENDER_API_URL');

        $nomorWA = "+" . preg_replace('/^0/', '62', trim($nomorWA));

        $message = "*Kode OTP Registrasi*\n\n"
            . "Halo, berikut adalah kode OTP untuk verifikasi akun Anda:\n\n"
            . "*$otp*\n\n"
            . "Kode ini hanya berlaku selama 5 menit.\n\n"
            . "Jangan bagikan kode ini kepada siapa pun.";

        try {
            Http::withHeaders([
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
        } catch (\Exception $e) {
            \Log::error('Gagal kirim OTP: '.$e->getMessage());
        }
    }
}
