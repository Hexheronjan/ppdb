<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pendaftaran
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-teal-50 py-10 px-4">
        <div class="max-w-4xl mx-auto space-y-6">

            {{-- Tombol Kembali --}}
            <a href="{{ route('user.form.history') }}" class="inline-flex items-center gap-2 text-teal-600 hover:text-teal-800 font-medium text-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
            </a>

            {{-- STATUS CARD --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-teal-500 to-cyan-600 px-6 py-6 text-center">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-3">
                        @switch($santri->status)
                            @case('diterima')
                                <i class="fas fa-check-circle text-white text-4xl"></i>
                                @break
                            @case('ditolak')
                                <i class="fas fa-times-circle text-white text-4xl"></i>
                                @break
                            @case('diverifikasi')
                                <i class="fas fa-check text-white text-4xl"></i>
                                @break
                            @default
                                <i class="fas fa-clock text-white text-4xl"></i>
                        @endswitch
                    </div>
                    <h1 class="text-2xl font-bold text-white">{{ $santri->nama_lengkap }}</h1>
                    <p class="text-teal-100 text-sm mt-1">Pendaftaran Peserta Didik Baru</p>
                </div>

                <div class="px-6 py-5">
                    {{-- Status Badge --}}
                    <div class="text-center mb-6">
                        @switch($santri->status)
                            @case('menunggu_verifikasi')
                                <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-yellow-100 text-yellow-800 font-semibold text-base">
                                    <i class="fas fa-clock"></i> Menunggu Verifikasi
                                </span>
                                <p class="text-gray-500 text-sm mt-2">Data Anda sedang dalam proses verifikasi oleh admin.</p>
                                @break
                            @case('diverifikasi')
                                <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-blue-100 text-blue-800 font-semibold text-base">
                                    <i class="fas fa-check"></i> Diverifikasi
                                </span>
                                <p class="text-gray-500 text-sm mt-2">Data Anda telah diverifikasi. Harap tunggu pengumuman selanjutnya.</p>
                                @break
                            @case('diterima')
                                <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-green-100 text-green-800 font-semibold text-base">
                                    <i class="fas fa-check-circle"></i> Diterima
                                </span>
                                <p class="text-gray-500 text-sm mt-2">Selamat! Pendaftaran Anda telah diterima.</p>
                                @break
                            @case('ditolak')
                                <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-red-100 text-red-800 font-semibold text-base">
                                    <i class="fas fa-times-circle"></i> Ditolak
                                </span>
                                <p class="text-gray-500 text-sm mt-2">Maaf, pendaftaran Anda tidak dapat diproses lebih lanjut.</p>
                                @break
                        @endswitch
                    </div>

                    {{-- Info Singkat Grid --}}
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-sm">
                        <div class="bg-gray-50 rounded-xl p-3">
                            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Tanggal Daftar</p>
                            <p class="text-gray-800 font-semibold">{{ $santri->created_at->translatedFormat('d F Y') }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-3">
                            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">NISN</p>
                            <p class="text-gray-800 font-semibold">{{ $santri->nisn }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-3">
                            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Tahun Ajaran</p>
                            <p class="text-gray-800 font-semibold">{{ $santri->tahun_ajaran ?? '-' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-3">
                            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Program Pilihan</p>
                            <p class="text-gray-800 font-semibold">{{ $santri->program_pilihan ?? '-' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-3">
                            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Jenis Kelamin</p>
                            <p class="text-gray-800 font-semibold">{{ $santri->jenis_kelamin ?? '-' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-3">
                            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Sekolah Asal</p>
                            <p class="text-gray-800 font-semibold">{{ $santri->sekolah_asal ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DATA LENGKAP --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b bg-gray-50">
                    <h2 class="text-base font-bold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-user text-teal-500"></i> A. Data Calon Peserta Didik
                    </h2>
                </div>
                <div class="px-6 py-5 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Nama Lengkap</p>
                        <p class="text-gray-800 font-semibold">{{ $santri->nama_lengkap }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Jenis Kelamin</p>
                        <p class="text-gray-800 font-semibold">{{ $santri->jenis_kelamin ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Tempat Lahir</p>
                        <p class="text-gray-800 font-semibold">{{ $santri->tempat_lahir }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Tanggal Lahir</p>
                        <p class="text-gray-800 font-semibold">{{ \Carbon\Carbon::parse($santri->tanggal_lahir)->translatedFormat('d F Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">NISN</p>
                        <p class="text-gray-800 font-semibold">{{ $santri->nisn }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b bg-gray-50">
                    <h2 class="text-base font-bold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-school text-teal-500"></i> B. Data Asal Sekolah
                    </h2>
                </div>
                <div class="px-6 py-5 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Nama TK/RA Asal</p>
                        <p class="text-gray-800 font-semibold">{{ $santri->sekolah_asal ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">NSM Sekolah Asal</p>
                        <p class="text-gray-800 font-semibold">{{ $santri->nsm ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">NPSN Sekolah Asal</p>
                        <p class="text-gray-800 font-semibold">{{ $santri->npsn ?? '-' }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Alamat Sekolah Asal</p>
                        <p class="text-gray-800 font-semibold">{{ $santri->alamat_sekolah_asal ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b bg-gray-50">
                    <h2 class="text-base font-bold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-users text-teal-500"></i> C. Data Orang Tua / Wali
                    </h2>
                </div>
                <div class="px-6 py-5 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Nama Ayah</p>
                        <p class="text-gray-800 font-semibold">{{ $santri->orangTua->nama_ayah ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Nama Ibu</p>
                        <p class="text-gray-800 font-semibold">{{ $santri->orangTua->nama_ibu ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Nomor HP / WhatsApp</p>
                        <p class="text-gray-800 font-semibold">{{ $santri->orangTua->no_hp_wa ?? '-' }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Alamat</p>
                        <p class="text-gray-800 font-semibold">{{ $santri->orangTua->alamat ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b bg-gray-50">
                    <h2 class="text-base font-bold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-clipboard-list text-teal-500"></i> D & E. Program & Informasi Tambahan
                    </h2>
                </div>
                <div class="px-6 py-5 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Program Pilihan</p>
                        <p class="text-gray-800 font-semibold">{{ $santri->program_pilihan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Mengetahui PPDB dari</p>
                        <p class="text-gray-800 font-semibold">{{ $santri->info_ppdb ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- Info kontak --}}
            <div class="bg-teal-50 border border-teal-200 rounded-xl p-4 text-sm text-teal-800 flex items-start gap-3">
                <i class="fas fa-info-circle text-teal-500 mt-0.5"></i>
                <div>
                    <strong>Informasi:</strong> Jika ada pertanyaan mengenai status pendaftaran, silakan hubungi pengurus sekolah melalui WhatsApp.
                </div>
            </div>

        </div>
    </div>
</x-app-layout>