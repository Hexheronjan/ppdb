@extends('layouts.admin.app')

@section('title', 'Detail Santri')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="w-full py-6 px-4 lg:px-8">

        {{-- Header --}}
        <div class="mb-6 flex items-start justify-between flex-wrap gap-4">
            <div>
                <a href="{{ route('admin.santri.index') }}" class="text-teal-600 hover:text-teal-800 mb-1 inline-flex items-center gap-1 text-sm">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                </a>
                <h1 class="text-2xl font-bold text-gray-900 mt-1">Detail Santri</h1>
            </div>
            <div class="flex gap-2 flex-wrap">
                <a href="{{ route('admin.santri.edit', $santri->id) }}"
                   style="background-color:#2563eb; color:#ffffff; padding:8px 16px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:6px;">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.santri.exportSinglePDF', $santri->id) }}"
                   style="background-color:#dc2626; color:#ffffff; padding:8px 16px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:6px;">
                    <i class="fas fa-file-pdf"></i> Unduh PDF
                </a>
                <form action="{{ route('admin.santri.destroy', $santri->id) }}" method="POST" class="inline"
                      onsubmit="return confirm('Hapus data santri ini? Tindakan tidak dapat dibatalkan.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background-color:#fee2e2; color:#b91c1c; padding:8px 16px; border-radius:8px; font-size:13px; font-weight:600; border:none; cursor:pointer; display:inline-flex; align-items:center; gap:6px;">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- ============================================================ --}}
            {{-- KOLOM KIRI: Data Santri (2/3 lebar)                         --}}
            {{-- ============================================================ --}}
            <div class="xl:col-span-2 space-y-5">

                {{-- A. Data Calon Peserta Didik --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-3 border-b bg-gray-50 flex items-center gap-2">
                        <i class="fas fa-user-graduate text-teal-500"></i>
                        <h2 class="font-bold text-gray-800 text-sm uppercase tracking-wide">A. Data Calon Peserta Didik</h2>
                    </div>
                    <div class="divide-y divide-gray-50">
                        <div class="grid grid-cols-1 sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-gray-100">
                            <div class="px-5 py-4">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Nama Lengkap</p>
                                <p class="text-gray-900 font-semibold">{{ $santri->nama_lengkap }}</p>
                            </div>
                            <div class="px-5 py-4">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Jenis Kelamin</p>
                                <p class="text-gray-900 font-semibold">{{ $santri->jenis_kelamin ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-gray-100 border-t border-gray-100">
                            <div class="px-5 py-4">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Tempat Lahir</p>
                                <p class="text-gray-900 font-semibold">{{ $santri->tempat_lahir }}</p>
                            </div>
                            <div class="px-5 py-4">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Tanggal Lahir</p>
                                <p class="text-gray-900 font-semibold">{{ $santri->tanggal_lahir?->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="border-t border-gray-100 px-5 py-4">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">NISN</p>
                            <p class="text-gray-900 font-semibold font-mono">{{ $santri->nisn }}</p>
                        </div>
                    </div>
                </div>

                {{-- B. Data Asal Sekolah --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-3 border-b bg-gray-50 flex items-center gap-2">
                        <i class="fas fa-school text-teal-500"></i>
                        <h2 class="font-bold text-gray-800 text-sm uppercase tracking-wide">B. Data Asal Sekolah</h2>
                    </div>
                    <div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-gray-100">
                            <div class="px-5 py-4">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Nama TK / RA Asal</p>
                                <p class="text-gray-900 font-semibold">{{ $santri->sekolah_asal }}</p>
                            </div>
                            <div class="px-5 py-4">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">NSM Sekolah Asal</p>
                                <p class="text-gray-900 font-semibold font-mono">{{ $santri->nsm ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="border-t border-gray-100 px-5 py-4">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">NPSN Sekolah Asal</p>
                            <p class="text-gray-900 font-semibold font-mono">{{ $santri->npsn ?? '-' }}</p>
                        </div>
                        <div class="border-t border-gray-100 px-5 py-4">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Alamat Sekolah Asal</p>
                            <p class="text-gray-900 font-semibold">{{ $santri->alamat_sekolah_asal ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- C. Data Orang Tua / Wali --}}
                @if($santri->orangTua)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-3 border-b bg-gray-50 flex items-center gap-2">
                        <i class="fas fa-users text-teal-500"></i>
                        <h2 class="font-bold text-gray-800 text-sm uppercase tracking-wide">C. Data Orang Tua / Wali</h2>
                    </div>
                    <div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-gray-100">
                            <div class="px-5 py-4">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Nama Ayah</p>
                                <p class="text-gray-900 font-semibold">{{ $santri->orangTua->nama_ayah }}</p>
                            </div>
                            <div class="px-5 py-4">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Nama Ibu</p>
                                <p class="text-gray-900 font-semibold">{{ $santri->orangTua->nama_ibu }}</p>
                            </div>
                        </div>
                        <div class="border-t border-gray-100 px-5 py-4">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Nomor HP / WhatsApp</p>
                            <p class="text-gray-900 font-semibold">{{ $santri->orangTua->no_hp_wa ?? '-' }}</p>
                        </div>
                        <div class="border-t border-gray-100 px-5 py-4">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Alamat</p>
                            <p class="text-gray-900 font-semibold">{{ $santri->orangTua->alamat ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                @endif

                {{-- D & E. Program & Info Tambahan --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-3 border-b bg-gray-50 flex items-center gap-2">
                        <i class="fas fa-clipboard-list text-teal-500"></i>
                        <h2 class="font-bold text-gray-800 text-sm uppercase tracking-wide">D & E. Program & Informasi Tambahan</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-gray-100">
                        <div class="px-5 py-4">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Program Pilihan</p>
                            <p class="text-gray-900 font-semibold">{{ $santri->program_pilihan ?? '-' }}</p>
                        </div>
                        <div class="px-5 py-4">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Mengetahui PPDB dari</p>
                            <p class="text-gray-900 font-semibold">{{ $santri->info_ppdb ?? '-' }}</p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ============================================================ --}}
            {{-- KOLOM KANAN: Status & Info (1/3 lebar)                      --}}
            {{-- ============================================================ --}}
            <div class="space-y-5">

                {{-- Status Pendaftaran --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-3 border-b bg-gray-50 flex items-center gap-2">
                        <i class="fas fa-info-circle text-teal-500"></i>
                        <h2 class="font-bold text-gray-800 text-sm uppercase tracking-wide">Status Pendaftaran</h2>
                    </div>
                    <div class="px-5 py-5">
                        <div class="mb-4">
                            @switch($santri->status)
                                @case('menunggu_verifikasi')
                                    <span style="background:#fef9c3; color:#854d0e; padding:5px 14px; border-radius:20px; font-size:13px; font-weight:700; display:inline-flex; align-items:center; gap:5px;">
                                        <i class="fas fa-clock"></i> Menunggu Verifikasi
                                    </span>@break
                                @case('diverifikasi')
                                    <span style="background:#dbeafe; color:#1e40af; padding:5px 14px; border-radius:20px; font-size:13px; font-weight:700; display:inline-flex; align-items:center; gap:5px;">
                                        <i class="fas fa-check"></i> Diverifikasi
                                    </span>@break
                                @case('diterima')
                                    <span style="background:#dcfce7; color:#166534; padding:5px 14px; border-radius:20px; font-size:13px; font-weight:700; display:inline-flex; align-items:center; gap:5px;">
                                        <i class="fas fa-check-circle"></i> Diterima
                                    </span>@break
                                @case('ditolak')
                                    <span style="background:#fee2e2; color:#991b1b; padding:5px 14px; border-radius:20px; font-size:13px; font-weight:700; display:inline-flex; align-items:center; gap:5px;">
                                        <i class="fas fa-times-circle"></i> Ditolak
                                    </span>@break
                            @endswitch
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Ubah Status</label>
                            <select id="statusSelect" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                <option value="menunggu_verifikasi" {{ $santri->status == 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                <option value="diverifikasi" {{ $santri->status == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                                <option value="diterima" {{ $santri->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="ditolak" {{ $santri->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <button id="updateStatusBtn"
                                style="margin-top:10px; width:100%; background-color:#0d9488; color:#ffffff; padding:10px 16px; border-radius:8px; font-size:14px; font-weight:700; border:none; cursor:pointer;">
                                <i class="fas fa-save"></i> Simpan Status
                            </button>
                            <p id="statusMsg" style="font-size:12px; margin-top:8px; display:none;"></p>
                        </div>
                    </div>
                </div>

                {{-- Info Pendaftaran --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-3 border-b bg-gray-50 flex items-center gap-2">
                        <i class="fas fa-calendar text-teal-500"></i>
                        <h2 class="font-bold text-gray-800 text-sm uppercase tracking-wide">Info Pendaftaran</h2>
                    </div>
                    <div class="divide-y divide-gray-50 px-5">
                        <div class="py-3">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Tahun Ajaran</p>
                            <p class="text-gray-800 font-semibold text-sm">{{ $santri->tahun_ajaran ?? '-' }}</p>
                        </div>
                        <div class="py-3">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Tanggal Daftar</p>
                            <p class="text-gray-800 font-semibold text-sm">{{ $santri->created_at->translatedFormat('d F Y, H:i') }}</p>
                        </div>
                        <div class="py-3">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Akun Pendaftar</p>
                            <p class="text-gray-800 font-semibold text-sm break-all">{{ $santri->user->email ?? '-' }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('updateStatusBtn').addEventListener('click', function () {
    const status = document.getElementById('statusSelect').value;
    const msg = document.getElementById('statusMsg');
    this.disabled = true;
    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';

    fetch('{{ route("admin.santri.updateStatus", $santri->id) }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ status: status })
    })
    .then(r => r.json())
    .then(data => {
        msg.style.display = 'block';
        msg.style.color = '#16a34a';
        msg.innerHTML = '<i class="fas fa-check-circle"></i> ' + (data.message || 'Status berhasil diperbarui.');
        setTimeout(() => location.reload(), 1200);
    })
    .catch(() => {
        msg.style.display = 'block';
        msg.style.color = '#dc2626';
        msg.innerHTML = '<i class="fas fa-exclamation-circle"></i> Terjadi kesalahan. Silakan coba lagi.';
        this.disabled = false;
        this.innerHTML = '<i class="fas fa-save"></i> Simpan Status';
    });
});
</script>
@endsection