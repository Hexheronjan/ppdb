@extends('layouts.admin.app')
@section('content')
<div class="w-full px-4 lg:px-8 py-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="ti ti-key text-teal-600 text-2xl"></i> Monitoring Kode OTP
            </h1>
            <p class="text-sm text-gray-500 mt-1">Pantau kode OTP yang aktif dan cari pengguna berdasarkan nomor WhatsApp jika pengiriman WA terkendala.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.otp.index') }}"
               style="background-color: #0d9488; color: #ffffff;"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold shadow-sm hover:opacity-90 transition">
                <i class="ti ti-refresh text-base"></i> Segarkan Data
            </a>
        </div>
    </div>

    {{-- Stat Cards & Search Filter --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">
        
        {{-- Card Info Status OTP Aktif --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center flex-shrink-0 text-2xl">
                <i class="ti ti-shield-check"></i>
            </div>
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total OTP Aktif</span>
                <div class="flex items-baseline gap-2 mt-0.5">
                    <span class="text-2xl font-extrabold text-teal-700">{{ $activeOtpCount }}</span>
                    <span class="text-xs text-gray-500 font-medium">kode berlaku</span>
                </div>
            </div>
        </div>

        {{-- Form Pencarian Berdasarkan No WA / Nama --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-200 p-4 flex items-center">
            <form method="GET" action="{{ route('admin.otp.index') }}" class="w-full flex flex-col sm:flex-row items-center gap-3">
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                        <i class="ti ti-search text-lg"></i>
                    </span>
                    <input type="text" name="search" value="{{ $search }}"
                           placeholder="Cari Nomor WhatsApp (contoh: 0812..., 628...), Nama, atau Email..."
                           class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition">
                </div>
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <button type="submit"
                            style="background-color: #0d9488; color: #ffffff;"
                            class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-bold shadow hover:opacity-90 transition border-0 cursor-pointer flex items-center justify-center gap-1.5 whitespace-nowrap">
                        <i class="ti ti-search"></i> Cari
                    </button>
                    @if($search !== '')
                        <a href="{{ route('admin.otp.index') }}"
                           class="w-full sm:w-auto px-4 py-2.5 rounded-xl text-sm font-bold bg-gray-100 text-gray-700 hover:bg-gray-200 transition text-center whitespace-nowrap">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Filter Notice if Searching --}}
    @if($search !== '')
        <div class="mb-4 bg-teal-50 border border-teal-200 rounded-xl px-4 py-3 text-sm text-teal-900 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="ti ti-filter text-teal-600 text-lg"></i>
                <span>Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong> ({{ $users->total() }} data ditemukan)</span>
            </div>
            <a href="{{ route('admin.otp.index') }}" class="text-xs font-bold text-teal-700 hover:underline">
                Tampilkan Hanya OTP Aktif &rarr;
            </a>
        </div>
    @endif

    {{-- Tabel OTP --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-base font-bold text-gray-800 flex items-center gap-2">
                <i class="ti ti-list text-teal-600"></i>
                {{ $search !== '' ? 'Hasil Pencarian Pengguna' : 'Daftar Pengguna dengan OTP Aktif' }}
            </h2>
            <span class="text-xs text-gray-400 font-medium">Halaman {{ $users->currentPage() }} dari {{ $users->lastPage() ?: 1 }}</span>
        </div>

        @if($users->count() === 0)
            <div class="text-center py-16 px-4">
                <div class="w-16 h-16 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-3 text-3xl">
                    <i class="ti ti-shield-off"></i>
                </div>
                @if($search !== '')
                    <h3 class="text-base font-bold text-gray-700">Pengguna Tidak Ditemukan</h3>
                    <p class="text-sm text-gray-500 mt-1 max-w-md mx-auto">
                        Tidak ada pengguna yang cocok dengan kata kunci <strong>"{{ $search }}"</strong>. Pastikan nomor WhatsApp atau nama sudah sesuai.
                    </p>
                    <a href="{{ route('admin.otp.index') }}" class="inline-block mt-4 text-xs font-bold text-teal-600 hover:underline">
                        &larr; Kembali ke Daftar OTP Aktif
                    </a>
                @else
                    <h3 class="text-base font-bold text-gray-700">Tidak Ada Kode OTP Aktif</h3>
                    <p class="text-sm text-gray-500 mt-1 max-w-md mx-auto">
                        Saat ini tidak ada pengguna yang sedang dalam proses verifikasi OTP atau semua kode OTP sebelumnya telah kedaluwarsa / berhasil digunakan.
                    </p>
                @endif
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-xs uppercase font-bold tracking-wide">
                            <th class="py-3.5 px-5">#</th>
                            <th class="py-3.5 px-5">Pengguna</th>
                            <th class="py-3.5 px-5">Nomor WhatsApp</th>
                            <th class="py-3.5 px-5 text-center">Status OTP</th>
                            <th class="py-3.5 px-5">Masa Berlaku</th>
                            <th class="py-3.5 px-5 text-center">Kode OTP</th>
                            <th class="py-3.5 px-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $index => $user)
                        @php
                            $hasOtp = !empty($user->otp_code);
                            $expiredAt = $user->otp_expired_at ? \Carbon\Carbon::parse($user->otp_expired_at) : null;
                            $isActive = $hasOtp && $expiredAt && $expiredAt->isFuture();
                            $expiredTimestamp = $expiredAt ? $expiredAt->timestamp : 0;
                        @endphp
                        <tr id="row-user-{{ $user->id }}" class="hover:bg-gray-50/80 transition {{ $isActive ? 'bg-teal-50/20' : '' }}">
                            <td class="py-4 px-5 text-gray-400 font-medium">
                                {{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}
                            </td>

                            {{-- Nama & Email --}}
                            <td class="py-4 px-5">
                                <div class="font-bold text-gray-900">{{ $user->name }}</div>
                                <div class="text-xs text-gray-400 mt-0.5 flex items-center gap-1">
                                    <i class="ti ti-mail text-xs"></i> {{ $user->email }}
                                </div>
                            </td>

                            {{-- No WhatsApp --}}
                            <td class="py-4 px-5">
                                @if($user->no_wa)
                                    <div class="inline-flex items-center gap-1.5 font-mono text-sm font-bold text-gray-800 bg-gray-100 px-2.5 py-1 rounded-lg border border-gray-200">
                                        <i class="fab fa-whatsapp text-green-600 text-base"></i>
                                        <span>{{ $user->no_wa }}</span>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400 italic">Belum diset</span>
                                @endif
                            </td>

                            {{-- Status OTP --}}
                            <td class="py-4 px-5 text-center">
                                @if($isActive)
                                    <span id="badge-status-{{ $user->id }}" class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 animate-pulse">
                                        <i class="ti ti-circle-check"></i> Aktif
                                    </span>
                                @elseif($hasOtp && $expiredAt && !$expiredAt->isFuture())
                                    <span id="badge-status-{{ $user->id }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600">
                                        <i class="ti ti-clock-off"></i> Kedaluwarsa
                                    </span>
                                @else
                                    <span id="badge-status-{{ $user->id }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">
                                        <i class="ti ti-check"></i> Sudah Digunakan / Kosong
                                    </span>
                                @endif
                            </td>

                            {{-- Waktu Kedaluwarsa --}}
                            <td class="py-4 px-5">
                                @if($isActive)
                                    <div class="text-xs font-bold text-gray-800">
                                        {{ $expiredAt->translatedFormat('d M Y, H:i:s') }} WIB
                                    </div>
                                    <div id="countdown-{{ $user->id }}"
                                         class="live-countdown text-xs font-bold text-teal-600 mt-0.5 flex items-center gap-1"
                                         data-timestamp="{{ $expiredTimestamp }}"
                                         data-user-id="{{ $user->id }}">
                                        <i class="ti ti-hourglass-low"></i> <span>Menghitung...</span>
                                    </div>
                                @elseif($expiredAt)
                                    <div class="text-xs text-gray-500">
                                        {{ $expiredAt->translatedFormat('d M Y, H:i:s') }} WIB
                                    </div>
                                    <div class="text-xs text-red-400 mt-0.5 font-semibold">Sudah Kedaluwarsa</div>
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>

                            {{-- Kode OTP --}}
                            <td class="py-4 px-5 text-center">
                                @if($isActive)
                                    <div id="otp-wrapper-{{ $user->id }}" class="inline-flex items-center gap-2">
                                        <span id="otp-text-{{ $user->id }}"
                                              style="background-color: #f0fdf4; color: #15803d; border: 2px solid #86efac; letter-spacing: 0.2em; font-family: monospace; font-size: 1.25rem; font-weight: 800; padding: 4px 12px; border-radius: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                                            {{ $user->otp_code }}
                                        </span>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400 font-mono">-</span>
                                @endif
                            </td>

                            {{-- Tombol Aksi --}}
                            <td class="py-4 px-5 text-center">
                                @if($isActive)
                                    <button type="button"
                                            id="btn-copy-{{ $user->id }}"
                                            onclick="copyOtp('{{ $user->otp_code }}', 'btn-copy-{{ $user->id }}')"
                                            style="background-color: #2563eb; color: #ffffff;"
                                            class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-xs font-bold shadow-sm hover:opacity-90 transition border-0 cursor-pointer">
                                        <i class="ti ti-copy text-sm"></i>
                                        <span>Salin OTP</span>
                                    </button>
                                @else
                                    <span class="text-xs text-gray-400 italic">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $users->links() }}
                </div>
            @endif
        @endif
    </div>

    {{-- Panduan Penggunaan --}}
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-2xl p-5 text-sm text-blue-900 flex items-start gap-3.5">
        <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0 mt-0.5">
            <i class="ti ti-info-circle text-lg"></i>
        </div>
        <div class="space-y-1">
            <h4 class="font-bold text-blue-950">Petunjuk Penggunaan Fitur OTP untuk Admin:</h4>
            <ul class="list-disc list-inside text-xs text-blue-800 space-y-1">
                <li>Fitur ini berfungsi sebagai solusi darurat apabila sistem WhatsApp Gateway mengalami gangguan atau nomor pendaftar tidak menerima pesan OTP.</li>
                <li>Admin dapat memasukkan <strong>Nomor WhatsApp</strong> atau nama pendaftar pada kolom pencarian di atas.</li>
                <li>Kode OTP langsung terlihat jelas pada kolom <strong>Kode OTP</strong> berwarna hijau.</li>
                <li>Klik tombol <strong>"Salin OTP"</strong> untuk langsung menyalin ke papan klip (*clipboard*) dan menginformasikannya ke pengguna.</li>
                <li>Kode OTP yang telah kedaluwarsa (lewat 5 menit) atau yang sudah berhasil diverifikasi secara otomatis tidak dapat disalin/dilihat sebagai OTP aktif demi keamanan akun.</li>
            </ul>
        </div>
    </div>

</div>

<script>
function copyOtp(code, btnId) {
    if (!code) return;
    navigator.clipboard.writeText(code).then(function() {
        const btn = document.getElementById(btnId);
        if (btn) {
            const originalHtml = btn.innerHTML;
            const originalBg = btn.style.backgroundColor;
            btn.style.backgroundColor = '#16a34a';
            btn.innerHTML = '<i class="ti ti-check text-sm"></i> <span>Tersalin!</span>';
            setTimeout(function() {
                btn.style.backgroundColor = originalBg;
                btn.innerHTML = originalHtml;
            }, 2000);
        }
    }).catch(function(err) {
        alert('Kode OTP: ' + code);
    });
}

// Live Countdown Tiap Detik
function updateLiveCountdowns() {
    const now = Math.floor(Date.now() / 1000);
    const countdownElements = document.querySelectorAll('.live-countdown');

    countdownElements.forEach(el => {
        const targetTimestamp = parseInt(el.getAttribute('data-timestamp'));
        const userId = el.getAttribute('data-user-id');
        const diff = targetTimestamp - now;

        const span = el.querySelector('span');
        if (diff > 0) {
            const minutes = Math.floor(diff / 60);
            const seconds = diff % 60;
            if (minutes > 0) {
                span.textContent = minutes + ' menit ' + (seconds < 10 ? '0' : '') + seconds + ' detik lagi';
            } else {
                span.textContent = seconds + ' detik lagi';
            }
        } else {
            span.textContent = 'Sudah Kedaluwarsa';
            el.className = 'text-xs text-red-500 font-bold mt-0.5 flex items-center gap-1';

            // Ubah badge status jadi Kedaluwarsa
            const badge = document.getElementById('badge-status-' + userId);
            if (badge) {
                badge.className = 'inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600';
                badge.innerHTML = '<i class="ti ti-clock-off"></i> Kedaluwarsa';
            }

            // Nonaktifkan tombol salin
            const btnCopy = document.getElementById('btn-copy-' + userId);
            if (btnCopy) {
                btnCopy.style.display = 'none';
            }

            // Coreng/samarkan OTP yang expired
            const otpText = document.getElementById('otp-text-' + userId);
            if (otpText) {
                otpText.style.backgroundColor = '#f3f4f6';
                otpText.style.borderColor = '#d1d5db';
                otpText.style.color = '#9ca3af';
                otpText.style.textDecoration = 'line-through';
            }
        }
    });
}

setInterval(updateLiveCountdowns, 1000);
updateLiveCountdowns();
</script>
@endsection
