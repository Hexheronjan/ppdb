@extends('layouts.admin.app')
@section('content')
<div class="w-full px-4 lg:px-8 py-6 max-w-2xl mx-auto">

    <div class="mb-6">
        <a href="{{ route('admin.angkatan.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-teal-600 transition mb-3">
            <i class="ti ti-arrow-left"></i> Kembali ke Daftar Angkatan
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Angkatan Baru</h1>
        <p class="text-sm text-gray-500 mt-1">Isi informasi angkatan dan jadwal buka pendaftaran.</p>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-5 text-sm text-red-700">
            <strong class="block mb-1"><i class="ti ti-alert-circle"></i> Ada kesalahan input:</strong>
            <ul class="list-disc pl-4 space-y-1">
                @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form method="POST" action="{{ route('admin.angkatan.store') }}">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                {{-- Nama Angkatan --}}
                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Nama Angkatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_angkatan" value="{{ old('nama_angkatan') }}"
                           placeholder="Contoh: Angkatan Al-Fatih"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 @error('nama_angkatan') border-red-400 @enderror">
                    @error('nama_angkatan')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Tahun Ajaran --}}
                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Tahun Ajaran <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}"
                           placeholder="Contoh: 2026/2027"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 @error('tahun_ajaran') border-red-400 @enderror">
                    @error('tahun_ajaran')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Tanggal Buka --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Tanggal Buka Pendaftaran <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal_mulai_daftar" value="{{ old('tanggal_mulai_daftar') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 @error('tanggal_mulai_daftar') border-red-400 @enderror">
                    @error('tanggal_mulai_daftar')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jam Buka Pendaftaran <span class="text-red-500">*</span></label>
                    <input type="time" name="jam_mulai_daftar" value="{{ old('jam_mulai_daftar', '08:00') }}" required class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 @error('jam_mulai_daftar') border-red-400 @enderror">
                    @error('jam_mulai_daftar')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jam Tutup Pendaftaran <span class="text-red-500">*</span></label>
                    <input type="time" name="jam_tutup_daftar" value="{{ old('jam_tutup_daftar', '23:59') }}" required class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 @error('jam_tutup_daftar') border-red-400 @enderror">
                    @error('jam_tutup_daftar')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Tanggal Tutup --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Tanggal Tutup Pendaftaran <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal_tutup_daftar" value="{{ old('tanggal_tutup_daftar') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 @error('tanggal_tutup_daftar') border-red-400 @enderror">
                    @error('tanggal_tutup_daftar')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Keterangan --}}
                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Keterangan <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <textarea name="keterangan" rows="3" placeholder="Catatan tambahan mengenai angkatan ini..."
                              class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">{{ old('keterangan') }}</textarea>
                </div>

                {{-- Status Aktif --}}
                <div class="sm:col-span-2 flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                           class="w-4 h-4 text-teal-600 rounded border-gray-300 focus:ring-teal-400">
                    <label for="is_active" class="text-sm font-medium text-gray-700">
                        Aktifkan angkatan ini (pendaftaran bisa dibuka sesuai tanggal)
                    </label>
                </div>
            </div>

            <div class="flex gap-3 mt-6 pt-5 border-t border-gray-100">
                <button type="submit"
                        style="background-color: #059669; color: #ffffff;"
                        class="flex-1 sm:flex-none font-bold text-sm px-6 py-2.5 rounded-lg shadow hover:opacity-90 transition border-0 cursor-pointer flex items-center justify-center gap-2">
                    <i class="ti ti-device-floppy"></i> Simpan Angkatan
                </button>
                <a href="{{ route('admin.angkatan.index') }}"
                   style="background-color: #e5e7eb; color: #374151;"
                   class="flex-1 sm:flex-none text-center font-bold text-sm px-6 py-2.5 rounded-lg hover:bg-gray-300 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
