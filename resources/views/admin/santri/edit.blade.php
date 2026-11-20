@extends('layouts.admin.app')

@section('title', 'Edit Data Santri')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="w-full py-6 px-4 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.santri.show', $santri->id) }}" class="text-teal-600 hover:text-teal-800 mb-2 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Detail
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Edit Data Santri</h1>
        </div>

        @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <ul class="text-red-700 text-sm space-y-1 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.santri.update', $santri->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- A. Data Calon Peserta Didik -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-5 flex items-center gap-2">
                    <i class="fas fa-user-graduate text-teal-500"></i>
                    A. Data Calon Peserta Didik
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $santri->nama_lengkap) }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        @error('nama_lengkap')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            <option value="">Pilih</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $santri->tempat_lahir) }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        @error('tempat_lahir')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $santri->tanggal_lahir?->format('Y-m-d')) }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        @error('tanggal_lahir')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NISN <span class="text-red-500">*</span> <span class="text-xs text-gray-400">(10 digit)</span></label>
                        <input type="text" name="nisn" value="{{ old('nisn', $santri->nisn) }}" required maxlength="10"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        @error('nisn')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <!-- B. Data Asal Sekolah -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-5 flex items-center gap-2">
                    <i class="fas fa-school text-teal-500"></i>
                    B. Data Asal Sekolah
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Asal TK/RA <span class="text-red-500">*</span></label>
                        <input type="text" name="sekolah_asal" value="{{ old('sekolah_asal', $santri->sekolah_asal) }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        @error('sekolah_asal')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NSM Sekolah Asal <span class="text-red-500">*</span> <span class="text-xs text-teal-600">(Isi 0 jika dari TK)</span></label>
                        <input type="text" name="nsm" value="{{ old('nsm', $santri->nsm) }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        @error('nsm')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NPSN Sekolah Asal <span class="text-red-500">*</span></label>
                        <input type="text" name="npsn" value="{{ old('npsn', $santri->npsn) }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        @error('npsn')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Sekolah Asal <span class="text-red-500">*</span></label>
                        <textarea name="alamat_sekolah_asal" rows="3" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">{{ old('alamat_sekolah_asal', $santri->alamat_sekolah_asal) }}</textarea>
                        @error('alamat_sekolah_asal')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <!-- C. Data Orang Tua / Wali -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-5 flex items-center gap-2">
                    <i class="fas fa-users text-teal-500"></i>
                    C. Data Orang Tua / Wali
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $santri->orangTua->nama_ayah ?? '') }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        @error('nama_ayah')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $santri->orangTua->nama_ibu ?? '') }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        @error('nama_ibu')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP / WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" name="no_hp_wa" value="{{ old('no_hp_wa', $santri->orangTua->no_hp_wa ?? '') }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                            placeholder="Contoh: 08123456789">
                        @error('no_hp_wa')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat <span class="text-red-500">*</span></label>
                        <textarea name="alamat" rows="3" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">{{ old('alamat', $santri->orangTua->alamat ?? '') }}</textarea>
                        @error('alamat')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <!-- D & E. Program & Info Tambahan -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-5 flex items-center gap-2">
                    <i class="fas fa-clipboard-list text-teal-500"></i>
                    D &amp; E. Program &amp; Informasi Tambahan
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Program Pilihan <span class="text-red-500">*</span></label>
                        <select name="program_pilihan" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            <option value="">Pilih</option>
                            <option value="Program Khusus" {{ old('program_pilihan', $santri->program_pilihan) == 'Program Khusus' ? 'selected' : '' }}>Program Khusus</option>
                            <option value="Bina Prestasi" {{ old('program_pilihan', $santri->program_pilihan) == 'Bina Prestasi' ? 'selected' : '' }}>Bina Prestasi</option>
                        </select>
                        @error('program_pilihan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mengetahui PPDB dari <span class="text-red-500">*</span></label>
                        <select name="info_ppdb" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            <option value="">Pilih</option>
                            @foreach(['Media Sosial','Website','Teman/Keluarga','Alumni','Spanduk/Brosur','Lainnya'] as $opt)
                            <option value="{{ $opt }}" {{ old('info_ppdb', $santri->info_ppdb) == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                        @error('info_ppdb')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Pendaftaran <span class="text-red-500">*</span></label>
                        <select name="status" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            <option value="menunggu_verifikasi" {{ old('status', $santri->status) == 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                            <option value="diverifikasi" {{ old('status', $santri->status) == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                            <option value="diterima" {{ old('status', $santri->status) == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="ditolak" {{ old('status', $santri->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-3 pb-8">
                <a href="{{ route('admin.santri.show', $santri->id) }}"
                   style="background-color:#e5e7eb; color:#374151; padding:10px 24px; border-radius:8px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:6px;">
                    Batal
                </a>
                <button type="submit"
                    style="background-color:#0d9488; color:#ffffff; padding:10px 24px; border-radius:8px; font-weight:700; border:none; cursor:pointer; font-size:14px; display:inline-flex; align-items:center; gap:8px;">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection