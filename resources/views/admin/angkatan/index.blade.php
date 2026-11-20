@extends('layouts.admin.app')
@section('content')
<div class="w-full px-4 lg:px-8 py-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Angkatan & Form Pendaftaran</h1>
            <p class="text-sm text-gray-500 mt-1">Buat angkatan baru dan kelola jadwal buka/tutup pendaftaran santri per tahun ajaran.</p>
        </div>
    </div>

    {{-- Alert Success / Error --}}
    @if(session('success'))
        <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 mb-5 text-sm font-semibold">
            <i class="ti ti-circle-check text-green-500 text-lg"></i>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 mb-5 text-sm font-semibold">
            <i class="ti ti-alert-circle text-red-500 text-lg"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- FORM TAMBAH ANGKATAN BARU (Langsung di halaman ini) --}}
    <div x-data="{ openForm: true }" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-4">
            <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <i class="ti ti-calendar-plus text-teal-600 text-xl"></i> Form Buat Angkatan & Tahun Ajaran Baru
            </h2>
            <button @click="openForm = !openForm" type="button"
                    style="background-color: #0d9488; color: #ffffff;"
                    class="px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm border-0 cursor-pointer flex items-center gap-1">
                <span x-text="openForm ? 'Sembunyikan Form' : '+ Tambah Angkatan Baru'">+ Tambah Angkatan Baru</span>
            </button>
        </div>

        <div x-show="openForm" x-transition>
            <form method="POST" action="{{ route('admin.angkatan.store') }}">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    {{-- Nama Angkatan --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">
                            Nama Angkatan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_angkatan" value="{{ old('nama_angkatan') }}" required
                               placeholder="Contoh: Angkatan Al-Fatih 2027"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">
                    </div>

                    {{-- Tahun Ajaran --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">
                            Tahun Ajaran <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}" required
                               placeholder="Contoh: 2027/2028"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">
                    </div>

                    {{-- Tanggal Buka --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">
                            Tanggal Buka <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_mulai_daftar" value="{{ old('tanggal_mulai_daftar', date('Y-m-d')) }}" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">
                    </div>

                    {{-- Tanggal Tutup --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">
                            Tanggal Tutup <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_tutup_daftar" value="{{ old('tanggal_tutup_daftar', date('Y-12-31')) }}" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">
                    </div>

                    {{-- Jam Buka --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Jam Buka <span class="text-red-500">*</span></label>
                        <input type="time" name="jam_mulai_daftar" value="{{ old('jam_mulai_daftar', '08:00') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">
                    </div>

                    {{-- Jam Tutup --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Jam Tutup <span class="text-red-500">*</span></label>
                        <input type="time" name="jam_tutup_daftar" value="{{ old('jam_tutup_daftar', '23:59') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">
                    </div>

                    {{-- Keterangan --}}
                    <div class="sm:col-span-2 lg:col-span-3">
                        <label class="block text-xs font-bold text-gray-700 mb-1">Keterangan / Catatan Pendaftaran</label>
                        <input type="text" name="keterangan" value="{{ old('keterangan') }}"
                               placeholder="Contoh: Pendaftaran Santri Baru Gelombang 1"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex items-end">
                        <button type="submit"
                                style="background-color: #0d9488; color: #ffffff;"
                                class="w-full py-2 px-4 rounded-lg font-bold text-sm shadow hover:opacity-90 transition border-0 cursor-pointer flex items-center justify-center gap-2">
                            <i class="ti ti-device-floppy text-base"></i> Simpan & Buka Form
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Daftar Angkatan --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <i class="ti ti-list text-teal-600"></i> Daftar Angkatan & Jadwal Pendaftaran
            </h2>
            <span class="text-xs text-gray-500 font-medium">Total: {{ $angkatan->count() }} Angkatan</span>
        </div>

        @if($angkatan->count() === 0)
            <div class="text-center py-12 text-gray-400">
                <i class="ti ti-calendar-off text-5xl block mb-3"></i>
                <p class="font-medium text-base text-gray-600">Belum ada data angkatan.</p>
                <p class="text-sm mt-1">Gunakan form di atas untuk menambahkan angkatan dan membuka pendaftaran.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-xs uppercase font-bold tracking-wide">
                            <th class="py-3.5 px-5">#</th>
                            <th class="py-3.5 px-5">Nama Angkatan</th>
                            <th class="py-3.5 px-5">Tahun Ajaran</th>
                            <th class="py-3.5 px-5">Buka Pendaftaran</th>
                            <th class="py-3.5 px-5">Tutup Pendaftaran</th>
                            <th class="py-3.5 px-5 text-center">Status</th>
                            <th class="py-3.5 px-5 text-center">Pendaftar</th>
                            <th class="py-3.5 px-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($angkatan as $i => $ag)
                        @php
                            $mulai = $ag->registration_starts_at;
                            $tutup = $ag->registration_ends_at;
                            $status = $ag->registrationStatus();
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-5 text-gray-400 font-medium">{{ $i + 1 }}</td>
                            <td class="py-4 px-5">
                                <div class="font-bold text-gray-900">{{ $ag->nama_angkatan }}</div>
                                @if($ag->keterangan)
                                    <div class="text-xs text-gray-400 mt-0.5">{{ $ag->keterangan }}</div>
                                @endif
                            </td>
                            <td class="py-4 px-5">
                                <span class="font-mono text-teal-800 font-bold bg-teal-50 px-2.5 py-1 rounded border border-teal-200 text-xs">
                                    {{ $ag->tahun_ajaran }}
                                </span>
                            </td>
                            <td class="py-4 px-5 text-gray-600 font-medium">{{ $mulai->translatedFormat('d M Y') }}<div class="text-xs text-gray-400">{{ $mulai->format('H.i') }} WIB</div></td>
                            <td class="py-4 px-5 text-gray-600 font-medium">{{ $tutup->translatedFormat('d M Y') }}<div class="text-xs text-gray-400">{{ $tutup->format('H.i') }} WIB</div></td>
                            <td class="py-4 px-5 text-center">
                                @if($status === 'nonaktif')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500">
                                        <i class="ti ti-eye-off"></i> Nonaktif
                                    </span>
                                @elseif($status === 'dibuka')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 animate-pulse">
                                        <i class="ti ti-door-enter"></i> Buka (Aktif)
                                    </span>
                                @elseif($status === 'ditutup')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-600">
                                        <i class="ti ti-lock"></i> Ditutup
                                    </span>
                                @elseif($status === 'akan_dibuka')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">
                                        <i class="ti ti-clock"></i> Akan Dibuka
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-5 text-center">
                                <span class="font-bold text-teal-700 text-base">{{ $ag->santri_count }}</span>
                                <span class="text-gray-400 text-xs ml-0.5">santri</span>
                            </td>
                            <td class="py-4 px-5 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.angkatan.edit', $ag->id) }}"
                                       style="background-color: #2563eb; color: #ffffff;"
                                       class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm hover:opacity-90 transition">
                                        <i class="ti ti-edit"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.angkatan.destroy', $ag->id) }}"
                                          onsubmit="return confirm('Hapus angkatan {{ $ag->nama_angkatan }}? Pastikan tidak ada santri terdaftar.')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                style="background-color: #dc2626; color: #ffffff;"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm hover:opacity-90 transition border-0 cursor-pointer">
                                            <i class="ti ti-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Info Footer --}}
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4 text-sm text-blue-800 flex items-start gap-3">
        <i class="ti ti-info-circle text-blue-500 mt-0.5 text-lg"></i>
        <div>
            <strong>Info Pengoperasian:</strong>
            Saat admin mengisi dan menyimpan form angkatan di atas dengan status aktif, sistem pendaftaran santri baru akan **otomatis dibuka** untuk tahun ajaran tersebut. Data pendaftar santri baru secara otomatis dikelompokkan dalam kotak/kartu tahun ajaran di menu <a href="{{ route('admin.santri.index') }}" class="underline font-bold text-blue-900">Data Santri Baru</a>.
        </div>
    </div>
</div>

@endsection
