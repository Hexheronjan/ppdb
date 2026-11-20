<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OtpMonitoringController extends Controller
{
    /**
     * Tampilkan daftar OTP aktif dan pencarian berdasarkan Nomor WhatsApp / Nama / Email.
     */
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));
        $now = Carbon::now();

        $query = User::query();

        if ($search !== '') {
            $cleanPhone = preg_replace('/[^0-9]/', '', $search);

            $query->where(function ($q) use ($search, $cleanPhone) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('no_wa', 'LIKE', "%{$search}%");

                if ($cleanPhone !== '') {
                    $altPhone = preg_replace('/^0/', '62', $cleanPhone);
                    $altPhone2 = preg_replace('/^62/', '0', $cleanPhone);
                    $q->orWhere('no_wa', 'LIKE', "%{$cleanPhone}%")
                      ->orWhere('no_wa', 'LIKE', "%{$altPhone}%")
                      ->orWhere('no_wa', 'LIKE', "%{$altPhone2}%");
                }
            });

            // Urutkan: yang punya OTP aktif di paling atas
            $users = $query->orderByRaw("
                CASE 
                    WHEN otp_code IS NOT NULL AND otp_expired_at > '{$now}' THEN 1 
                    ELSE 2 
                END ASC
            ")->orderBy('otp_expired_at', 'desc')->paginate(15)->withQueryString();
        } else {
            // Default: HANYA tampilkan pengguna dengan OTP aktif (belum expired dan belum digunakan)
            $users = $query->whereNotNull('otp_code')
                ->where('otp_expired_at', '>', $now)
                ->orderBy('otp_expired_at', 'desc')
                ->paginate(15);
        }

        $activeOtpCount = User::whereNotNull('otp_code')
            ->where('otp_expired_at', '>', $now)
            ->count();

        return view('admin.otp.index', compact('users', 'search', 'activeOtpCount', 'now'));
    }
}
