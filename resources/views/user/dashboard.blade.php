<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Selamat Datang -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    Selamat datang di aplikasi PPDB {{ $schools->name }}
                </div>
            </div>

            <!-- Pendaftaran Santri Baru -->
            <div style="background-color: #059669; color: #ffffff;" class="relative overflow-hidden rounded-2xl shadow-xl mb-6">
                <div class="relative p-6 sm:p-8">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between mb-6">
                        <div>
                            <p style="color: #ffffff; background-color: rgba(255,255,255,.16);" class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-bold tracking-wide">
                                <i class="fas fa-graduation-cap"></i> PPDB ONLINE
                            </p>
                            <h3 style="color: #ffffff;" class="mt-3 text-2xl font-extrabold tracking-wide">Pendaftaran Santri Baru</h3>
                            <p style="color: #ffffff;" class="mt-1 text-sm font-medium">Daftarkan ananda untuk tahun ajaran baru di MI Tahfizh Al Furqon</p>
                        </div>
                        @if($jadwalPendaftaran)
                            @php($statusJadwal = $jadwalPendaftaran->registrationStatus())
                            <span style="color: #ffffff; background-color: rgba(255,255,255,.16); border-color: rgba(255,255,255,.35);" class="inline-flex w-fit items-center gap-2 rounded-full border px-3 py-1.5 text-xs font-bold">
                                <i class="fas {{ $statusJadwal === 'dibuka' ? 'fa-door-open' : ($statusJadwal === 'akan_dibuka' ? 'fa-clock' : 'fa-lock') }}"></i>
                                {{ $statusJadwal === 'dibuka' ? 'Pendaftaran Dibuka' : ($statusJadwal === 'akan_dibuka' ? 'Akan Dibuka' : 'Pendaftaran Ditutup') }}
                            </span>
                        @endif
                    </div>
                    @if($jadwalPendaftaran)
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <div style="background-color: #047857; border-color: rgba(255,255,255,.35); color: #ffffff;" class="rounded-xl border p-4">
                                <div class="flex items-start gap-3">
                                    <span style="background-color: rgba(255,255,255,.16); color: #ffffff;" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg"><i class="fas fa-calendar-check"></i></span>
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wide text-white">Pendaftaran Dibuka</p>
                                        <p class="mt-1 text-base font-extrabold text-white">
                                            {{ $jadwalPendaftaran->registration_starts_at->translatedFormat('d F Y') }}
                                        </p>
                                        <p class="text-sm font-medium text-white"><i class="far fa-clock mr-1"></i>{{ $jadwalPendaftaran->registration_starts_at->format('H.i') }} WIB</p>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color: #047857; border-color: rgba(255,255,255,.35); color: #ffffff;" class="rounded-xl border p-4">
                                <div class="flex items-start gap-3">
                                    <span style="background-color: rgba(255,255,255,.16); color: #ffffff;" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg"><i class="fas fa-calendar-times"></i></span>
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wide text-white">Tutup Pendaftaran</p>
                                        <p class="mt-1 text-base font-extrabold text-white">
                                            {{ $jadwalPendaftaran->registration_ends_at->translatedFormat('d F Y') }}
                                        </p>
                                        <p class="text-sm font-medium text-white"><i class="far fa-clock mr-1"></i>{{ $jadwalPendaftaran->registration_ends_at->format('H.i') }} WIB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($jadwalPendaftaran->keterangan)
                            <div style="background-color: #047857; border-color: rgba(255,255,255,.35); color: #ffffff;" class="mt-3 rounded-xl border px-4 py-3">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-info-circle mt-0.5 text-white"></i>
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wide text-white">Keterangan Pendaftaran</p>
                                        <p class="mt-1 text-sm font-medium leading-relaxed text-white">{{ $jadwalPendaftaran->keterangan }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <p style="background-color: #047857; border-color: rgba(255,255,255,.35); color: #ffffff;" class="rounded-xl border px-4 py-3 text-sm">Jadwal pendaftaran belum ditentukan oleh pihak sekolah.</p>
                    @endif
                    <div class="mt-6">
                        <a href="{{ route('santri.registration') }}"
                            style="background-color: #ffffff; color: #047857;"
                            class="inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-extrabold shadow-lg transition hover:-translate-y-0.5">
                            <i class="fas fa-user-plus"></i> Lihat Pendaftaran <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Daftar Formulir dalam Card -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($formGroup as $form)
                
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-800">{{ $form->name }}</h3>
                            <p class="text-gray-600 mt-2 text-sm">
                                {{ $form->description ?? 'Tidak ada deskripsi.' }}
                            </p>
                            <div class="mt-4">
                                <a href="{{ route('user.form.show', ['id_form' => $form->id_form]) }}"
                                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow">
                                     Lihat Form
                                 </a>
                                 
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3">
                        <p class="text-gray-600">Belum ada formulir lain yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
