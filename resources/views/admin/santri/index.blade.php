@extends('layouts.admin.app')

@section('title', 'Manajemen Santri')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="w-full py-6 px-4 lg:px-8">
        
        <!-- Header -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Santri</h1>
                <p class="text-gray-600 text-sm">Kelola data pendaftaran santri baru per tahun ajaran</p>
            </div>
            <div>
                <a href="{{ route('admin.santri.exportPDF') }}"
                   style="background-color: #dc2626; color: #ffffff;"
                   class="px-4 py-2.5 rounded-lg font-bold hover:opacity-90 transition shadow-sm text-sm inline-flex items-center gap-2">
                    <i class="fas fa-file-pdf"></i> Export Semua ke PDF
                </a>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-xl shadow p-4 mb-6">
            <form method="GET" action="{{ route('admin.santri.index') }}" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1 relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari nama santri, NISN, atau nama ayah/ibu..."
                           class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                    <i class="fas fa-search absolute left-3.5 top-3 text-gray-400"></i>
                </div>
                <div class="w-full md:w-48">
                    <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-teal-500">
                        <option value="">Semua Status</option>
                        <option value="menunggu_verifikasi" {{ request('status') == 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                        <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                        <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" style="background-color: #0d9488; color: #ffffff;"
                            class="px-5 py-2.5 rounded-lg text-sm font-semibold hover:opacity-90 transition flex items-center gap-2 border-0 cursor-pointer">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('admin.santri.index') }}" class="px-4 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition text-sm font-semibold flex items-center gap-1">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- JIKA SEDANG FILTER SEARCH ATAU STATUS --}}
        @if(request('search') || request('status'))
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h2 class="text-base font-bold text-gray-800">
                        Hasil Pencarian / Filter ({{ $santri->total() }} Data)
                    </h2>
                    <a href="{{ route('admin.santri.index') }}" class="text-xs text-teal-600 font-bold hover:underline">
                        Lihat Semua per Tahun Ajaran
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase">No</th>
                                <th class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase">Nama Santri</th>
                                <th class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase">Tahun Ajaran</th>
                                <th class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase">NISN</th>
                                <th class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase">Program</th>
                                <th class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase">Nama Ayah</th>
                                <th class="px-6 py-3.5 text-center font-bold text-gray-700 uppercase">Status</th>
                                <th class="px-6 py-3.5 text-center font-bold text-gray-700 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($santri as $idx => $s)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-500 font-medium">{{ $santri->firstItem() + $idx }}</td>
                                <td class="px-6 py-4 font-bold text-gray-900">{{ $s->nama_lengkap }}</td>
                                <td class="px-6 py-4 text-xs font-mono font-semibold text-teal-800">{{ $s->tahun_ajaran ?? '-' }}</td>
                                <td class="px-6 py-4 text-xs font-mono text-gray-800">{{ $s->nisn }}</td>
                                <td class="px-6 py-4 text-xs text-gray-700">{{ $s->program_pilihan ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-700 font-medium">{{ $s->orangTua->nama_ayah ?? '-' }}</td>
                                <td class="px-6 py-4 text-center">
                                    @switch($s->status)
                                        @case('menunggu_verifikasi')
                                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>@break
                                        @case('diverifikasi')
                                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-blue-100 text-blue-800">Diverifikasi</span>@break
                                        @case('diterima')
                                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700">Diterima</span>@break
                                        @case('ditolak')
                                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-700">Ditolak</span>@break
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('admin.santri.show', $s->id) }}"
                                       style="background-color: #0d9488; color: #ffffff;"
                                       class="px-3 py-1.5 rounded-lg text-xs font-bold shadow hover:opacity-90 inline-flex items-center gap-1">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-10 text-center text-gray-500">Data tidak ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($santri->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t">
                    {{ $santri->appends(request()->query())->links() }}
                </div>
                @endif
            </div>

        {{-- TAMPILAN UTAMA: KOTAK / KARTU PER TAHUN AJARAN --}}
        @else
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-folder-open text-teal-600"></i> Daftar Pendaftaran per Tahun Ajaran
                    </h2>
                </div>

                @forelse($grouped as $tahun => $items)
                @php
                    $ag = $items->first()->angkatan;
                @endphp
                <div x-data="{ showData: false }" class="bg-white rounded-2xl shadow border border-gray-200 overflow-hidden transition">
                    {{-- Header Kotak Tahun Ajaran --}}
                    <div style="background: linear-gradient(135deg, #0f766e 0%, #0891b2 100%); color: #ffffff;" class="px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div style="background-color: rgba(255, 255, 255, 0.2);" class="w-12 h-12 rounded-xl flex items-center justify-center text-xl font-bold text-white">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <h3 style="color: #ffffff;" class="text-xl font-extrabold tracking-wide">
                                    Tahun Ajaran {{ $tahun }}
                                </h3>
                                @if($ag)
                                <p style="color: #e0f2fe;" class="text-xs mt-0.5 font-medium">
                                    <i class="fas fa-bookmark mr-1"></i> {{ $ag->nama_angkatan }}
                                </p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <span style="background-color: rgba(255, 255, 255, 0.2); color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.3);" class="px-4 py-1.5 rounded-lg text-xs font-bold">
                                Total Pendaftar: {{ $items->count() }} Santri
                            </span>

                            <button @click="showData = !showData" type="button"
                                    style="background-color: #ffffff; color: #0f766e;"
                                    class="px-4 py-2 rounded-lg text-xs font-extrabold shadow hover:bg-gray-100 transition border-0 cursor-pointer flex items-center gap-2">
                                <span x-text="showData ? 'Sembunyikan Pendaftar' : 'Lihat Data Pendaftar'">Lihat Data Pendaftar</span>
                                <i class="fas" :class="showData ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Tabel Pendaftar (Bisa Dilihat Ketika Tombol Diklik) --}}
                    <div x-show="showData" x-transition class="overflow-x-auto border-t border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase">No</th>
                                    <th class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase">Nama Santri</th>
                                    <th class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase">NISN</th>
                                    <th class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase">Program</th>
                                    <th class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase">Orang Tua</th>
                                    <th class="px-6 py-3.5 text-center font-bold text-gray-700 uppercase">Status</th>
                                    <th class="px-6 py-3.5 text-left font-bold text-gray-700 uppercase">Tanggal Daftar</th>
                                    <th class="px-6 py-3.5 text-center font-bold text-gray-700 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($items as $idx => $s)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-gray-500 font-medium">{{ $idx + 1 }}</td>
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $s->nama_lengkap }}</td>
                                    <td class="px-6 py-4 text-xs font-mono text-gray-800">{{ $s->nisn }}</td>
                                    <td class="px-6 py-4 text-xs text-gray-700">{{ $s->program_pilihan ?? '-' }}</td>
                                    <td class="px-6 py-4 text-gray-700">
                                        <div class="font-semibold">{{ $s->orangTua->nama_ayah ?? '-' }}</div>
                                        <div class="text-xs text-teal-600"><i class="fab fa-whatsapp mr-1"></i>{{ $s->orangTua->no_hp_wa ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @switch($s->status)
                                            @case('menunggu_verifikasi')
                                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800">Menunggu Verifikasi</span>@break
                                            @case('diverifikasi')
                                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-blue-100 text-blue-800">Diverifikasi</span>@break
                                            @case('diterima')
                                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700">Diterima</span>@break
                                            @case('ditolak')
                                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-700">Ditolak</span>@break
                                        @endswitch
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 text-xs font-medium">{{ $s->created_at->translatedFormat('d M Y, H:i') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('admin.santri.show', $s->id) }}"
                                           style="background-color: #0d9488; color: #ffffff;"
                                           class="px-4 py-2 rounded-lg text-xs font-bold shadow hover:opacity-90 inline-flex items-center gap-1">
                                            <i class="fas fa-eye"></i> Detail Pendaftar
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @empty
                <div class="text-center py-16 bg-white rounded-2xl shadow border border-gray-200 text-gray-500">
                    <i class="fas fa-users-slash text-5xl text-gray-300 mb-3 block"></i>
                    <p class="font-bold text-base text-gray-800">Belum Ada Data Pendaftar.</p>
                    <p class="text-sm text-gray-500 mt-1">Gunakan menu <a href="{{ route('admin.angkatan.index') }}" class="text-teal-600 font-bold underline">Data Angkatan</a> untuk membuka pendaftaran santri baru.</p>
                </div>
                @endforelse
            </div>
        @endif

    </div>
</div>
@endsection
