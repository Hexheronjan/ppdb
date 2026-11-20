@extends('layouts.admin.app')
@section('content')

<div class="w-full px-4 lg:px-8 py-6">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-sm text-gray-500 mt-1">Selamat datang, <strong>{{ auth('admin')->user()->name }}</strong>. Pilih menu di bawah untuk mengelola aplikasi.</p>
    </div>

    {{-- Shortcut Cards Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

        {{-- Data Sekolah --}}
        <a href="{{ route('admin.schools.index') }}"
           class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-teal-200 transition-all duration-200 p-6 flex items-start gap-4">
            <div class="w-12 h-12 bg-teal-50 group-hover:bg-teal-100 rounded-xl flex items-center justify-center flex-shrink-0 transition">
                <i class="ti ti-school text-2xl text-teal-600"></i>
            </div>
            <div class="min-w-0">
                <h3 class="font-bold text-gray-800 group-hover:text-teal-700 transition">Data Sekolah</h3>
                <p class="text-sm text-gray-500 mt-0.5 leading-snug">Atur informasi dan profil sekolah pesantren.</p>
                <span class="mt-3 inline-flex items-center gap-1 text-xs font-semibold text-teal-600 group-hover:gap-2 transition-all">
                    Lihat Data <i class="ti ti-arrow-right text-sm"></i>
                </span>
            </div>
        </a>

        {{-- Data Angkatan --}}
        <a href="{{ route('admin.angkatan.index') }}"
           class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-indigo-200 transition-all duration-200 p-6 flex items-start gap-4">
            <div class="w-12 h-12 bg-indigo-50 group-hover:bg-indigo-100 rounded-xl flex items-center justify-center flex-shrink-0 transition">
                <i class="ti ti-calendar-event text-2xl text-indigo-600"></i>
            </div>
            <div class="min-w-0">
                <h3 class="font-bold text-gray-800 group-hover:text-indigo-700 transition">Data Angkatan</h3>
                <p class="text-sm text-gray-500 mt-0.5 leading-snug">Kelola tahun ajaran & jadwal buka pendaftaran santri baru.</p>
                <span class="mt-3 inline-flex items-center gap-1 text-xs font-semibold text-indigo-600 group-hover:gap-2 transition-all">
                    Lihat Data <i class="ti ti-arrow-right text-sm"></i>
                </span>
            </div>
        </a>

        {{-- Data Santri Baru --}}
        <a href="{{ route('admin.santri.index') }}"
           class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-blue-200 transition-all duration-200 p-6 flex items-start gap-4">
            <div class="w-12 h-12 bg-blue-50 group-hover:bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0 transition">
                <i class="ti ti-users text-2xl text-blue-600"></i>
            </div>
            <div class="min-w-0">
                <h3 class="font-bold text-gray-800 group-hover:text-blue-700 transition">Data Santri Baru</h3>
                <p class="text-sm text-gray-500 mt-0.5 leading-snug">Verifikasi, setujui, atau tolak pendaftaran calon santri.</p>
                <span class="mt-3 inline-flex items-center gap-1 text-xs font-semibold text-blue-600 group-hover:gap-2 transition-all">
                    Lihat Data <i class="ti ti-arrow-right text-sm"></i>
                </span>
            </div>
        </a>

        {{-- Monitoring OTP --}}
        <a href="{{ route('admin.otp.index') }}"
           class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all duration-200 p-6 flex items-start gap-4">
            <div class="w-12 h-12 bg-emerald-50 group-hover:bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0 transition">
                <i class="ti ti-key text-2xl text-emerald-600"></i>
            </div>
            <div class="min-w-0">
                <h3 class="font-bold text-gray-800 group-hover:text-emerald-700 transition">Monitoring OTP</h3>
                <p class="text-sm text-gray-500 mt-0.5 leading-snug">Cari dan lihat kode OTP aktif pendaftar jika pesan WA terkendala.</p>
                <span class="mt-3 inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 group-hover:gap-2 transition-all">
                    Lihat Kode OTP <i class="ti ti-arrow-right text-sm"></i>
                </span>
            </div>
        </a>

        {{-- Profil --}}
        <a href="{{ route('admin.profile.edit') }}"
           class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-orange-200 transition-all duration-200 p-6 flex items-start gap-4">
            <div class="w-12 h-12 bg-orange-50 group-hover:bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0 transition">
                <i class="ti ti-user-circle text-2xl text-orange-500"></i>
            </div>
            <div class="min-w-0">
                <h3 class="font-bold text-gray-800 group-hover:text-orange-700 transition">Profil Admin</h3>
                <p class="text-sm text-gray-500 mt-0.5 leading-snug">Ubah nama, email, dan kata sandi akun admin.</p>
                <span class="mt-3 inline-flex items-center gap-1 text-xs font-semibold text-orange-500 group-hover:gap-2 transition-all">
                    Lihat Data <i class="ti ti-arrow-right text-sm"></i>
                </span>
            </div>
        </a>

    </div>

    {{-- Info Pendaftaran --}}
    @php
        $angkatanAktif = \App\Models\Angkatan::open()->first();
    @endphp
    <div class="mt-8 {{ $angkatanAktif ? 'bg-green-50 border-green-200' : 'bg-yellow-50 border-yellow-200' }} border rounded-xl p-4 flex items-start gap-3 text-sm">
        <i class="ti ti-info-circle text-lg mt-0.5 {{ $angkatanAktif ? 'text-green-500' : 'text-yellow-500' }}"></i>
        <div>
            @if($angkatanAktif)
                <span class="{{ $angkatanAktif ? 'text-green-800' : 'text-yellow-800' }}">
                    <strong>Pendaftaran Santri Sedang Buka</strong> — Angkatan <strong>{{ $angkatanAktif->nama_angkatan }}</strong>
                    ({{ $angkatanAktif->tahun_ajaran }}) aktif hingga
                    <strong>{{ \Carbon\Carbon::parse($angkatanAktif->tanggal_tutup_daftar)->translatedFormat('d M Y') }}</strong>.
                </span>
            @else
                <span class="text-yellow-800">
                    <strong>Pendaftaran Santri Saat Ini Ditutup.</strong>
                    Buka menu <a href="{{ route('admin.angkatan.index') }}" class="underline font-semibold">Data Angkatan</a>
                    untuk mengatur jadwal pendaftaran santri baru.
                </span>
            @endif
        </div>
    </div>

</div>
@endsection
