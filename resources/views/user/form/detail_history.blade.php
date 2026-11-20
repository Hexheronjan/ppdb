<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pendaftaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <!-- Header -->
                <div class="bg-blue-600 text-white text-center py-4 rounded-t-md">
                    <h1 class="text-3xl font-bold">Hasil Seleksi PPDB</h1>
                </div>
                
                <!-- Sub-header -->
                <div class="bg-gray-100 text-center py-3 border-b">
                    <p class="text-lg font-medium text-gray-700">
                        Berdasarkan Seleksi Penerimaan Peserta Didik Baru Sistem {{ $form->category}} {{ $schools->name }} periode {{ $form->academic_year}}, diputuskan bahwa:
                    </p>
                </div>
    
                <!-- Detail Pendaftaran dalam Tabel -->
                <div class="p-6 text-gray-900 mb-5">
                    <table class="w-full border-collapse border border-gray-300 text-sm">
                        <thead>
                            <tr class="bg-gray-200 text-left">
                                <th class="border border-gray-300 px-4 py-2 w-1/4">Informasi</th>
                                <th class="border border-gray-300 px-4 py-2">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Submission ID -->
                            <tr>
                                <td class="border border-gray-300 px-4 py-2 font-semibold">Nomor Pendaftaran</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $submissionId }}</td>
                            </tr>
    
                            <!-- Tanggal Pendaftaran -->
                            <tr>
                                <td class="border border-gray-300 px-4 py-2 font-semibold">Tanggal Pendaftaran</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $registration_date ? \Carbon\Carbon::parse($registration_date)->translatedFormat('l, d F Y') : 'Tidak ada' }}
                                </td>
                            </tr>
    
                            <!-- Status Pendaftaran -->
                            <tr>
                                <td class="border border-gray-300 px-4 py-2 font-semibold">Status Pendaftaran</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <span class="px-2 py-1 rounded-md text-white 
                                        {{ $status == 'diterima' ? 'bg-green-500' : ($status == 'ditolak' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                            </tr>
    
                            <!-- Daftar Field -->
                            @foreach ($fields as $field)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 font-semibold">{{ $field->field_name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $field->value }}
                                        @if ($field->file_path)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $field->file_path) }}" 
                                                     alt="{{ $field->field_name }}" 
                                                     class="w-24 h-24 object-cover rounded-md border">
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Konten Tambahan Jika Status Diterima -->
                    @if ($status == 'diterima')
                        <div class="mt-6 p-4 bg-green-50 border border-green-300 rounded-md">
                            <h2 class="text-xl font-bold text-green-700">Selamat!</h2>
                            <p class="text-green-700 mt-2">
                                Anda dinyatakan <strong>DITERIMA</strong>. Pihak sekolah akan segera menghubungi Anda. 
                                Terimakasih atas kepercayaan Anda memilih sekolah kami.
                            </p>
                        </div>
                        @elseif ($status == 'ditolak')
                        <div class="mt-6 p-4 bg-red-50 border border-red-300 rounded-md">
                            <h2 class="text-xl font-bold text-red-700">Maaf!</h2>
                            <p class="text-red-700 mt-2">
                                Pendaftaran Anda <strong>TIDAK DITERIMA</strong>.
                            </p>
                        </div>
                    @endif
    
                    @if (in_array($status, ['diterima', 'ditolak']))
                        <div class="mt-6 text-right">
                            <a href="{{ route('user.form.download_pdf', $submissionId) }}" 
                            target="_blank"
                            class="inline-block px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-800">
                                Cetak Bukti Pendaftaran (PDF)
                            </a>
                        </div>
                    @endif

                    <!-- Tombol Kembali -->
                    <div class="mt-6 text-right">
                        <a href="{{ route('user.form.history') }}" 
                           class="inline-block px-4 py-2 text-sm font-medium text-white bg-gray-500 rounded-md hover:bg-gray-700">
                            Kembali ke Riwayat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
