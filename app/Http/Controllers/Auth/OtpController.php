<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{

    public function showOtpForm()
    {
          $no_wa = session('no_wa');
            return view('auth.verify-otp', compact('no_wa'));
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

        $user->otp_code = null;
        $user->otp_expired_at = null;
        $user->save();

        return redirect()->intended('/user/dashboard');
    }

}
