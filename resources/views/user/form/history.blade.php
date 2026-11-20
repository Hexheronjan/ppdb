<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pendaftaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- ===== PENDAFTARAN SANTRI BARU ===== --}}
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="bg-gradient-to-r from-teal-500 to-cyan-600 px-6 py-4 flex items-center gap-3">
                    <i class="fas fa-user-graduate text-white text-xl"></i>
                    <h2 class="text-lg font-bold text-white">Pendaftaran Santri Baru</h2>
                </div>

                <div class="p-6">
                    @if(isset($santriRegistrations) && $santriRegistrations->count() > 0)
                        <div class="space-y-4">
                            @foreach($santriRegistrations as $santri)
                            <div class="border border-gray-200 rounded-xl p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 hover:shadow-md transition">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-teal-100 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-user-graduate text-teal-600 text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 text-base">{{ $santri->nama_lengkap }}</h3>
                                        <p class="text-sm text-gray-500">
                                            <i class="fas fa-school mr-1"></i>{{ $santri->sekolah_asal }}
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">
                                            <i class="fas fa-calendar mr-1"></i>
                                            Daftar: {{ $santri->created_at->translatedFormat('d F Y, H:i') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 sm:flex-col sm:items-end">
                                    {{-- Status Badge --}}
                                    @switch($santri->status)
                                        @case('menunggu_verifikasi')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                                <i class="fas fa-clock"></i> Menunggu Verifikasi
                                            </span>
                                            @break
                                        @case('diverifikasi')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                                <i class="fas fa-check"></i> Diverifikasi
                                            </span>
                                            @break
                                        @case('diterima')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                <i class="fas fa-check-circle"></i> Diterima
                                            </span>
                                            @break
                                        @case('ditolak')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                                <i class="fas fa-times-circle"></i> Ditolak
                                            </span>
                                            @break
                                    @endswitch

                                    <a href="{{ route('santri.registration.status', $santri->id) }}"
                                       class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700 transition">
                                        <i class="fas fa-eye"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-10">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-user-graduate text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium">Belum ada pendaftaran santri.</p>
                            <a href="{{ route('santri.registration') }}"
                               class="inline-block mt-4 px-5 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition text-sm font-semibold">
                                Daftar Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ===== RIWAYAT FORM LAINNYA ===== --}}
            @if(isset($userSubmissions) && $userSubmissions->count() > 0)
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4 flex items-center gap-3">
                    <i class="fas fa-file-alt text-white text-xl"></i>
                    <h2 class="text-lg font-bold text-white">Riwayat Form Lainnya</h2>
                </div>
                <div class="p-6 space-y-4">
                    @foreach ($userSubmissions as $submissionId => $data)
                        <div class="border border-gray-200 rounded-xl p-5 flex items-center justify-between gap-4 hover:shadow-md transition">
                            <div>
                                <h3 class="font-semibold text-gray-800">Pendaftaran #{{ $submissionId }}</h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    <i class="fas fa-calendar mr-1"></i>
                                    {{ $data['registration_date'] ? \Carbon\Carbon::parse($data['registration_date'])->translatedFormat('l, d F Y') : 'Tidak ada tanggal' }}
                                </p>
                                <p class="mt-2 text-sm">
                                    <strong>Status:</strong>
                                    <span class="px-2 py-1 rounded-md text-white text-xs
                                        {{ $data['status'] == 'diterima' ? 'bg-green-500' : ($data['status'] == 'ditolak' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                        {{ ucfirst($data['status']) }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('user.form_submission.detail_history', $submissionId) }}"
                                   class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>

</x-app-layout>
