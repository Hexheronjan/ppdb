@extends('layouts.admin.app')

@section('content')
<div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">
            Pendaftar untuk {{ $formGroup->name }}
        </h1>

        @if(count($submissions))
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border border-gray-200 text-sm" id="myTable">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left border-b">#</th>
                            <th class="px-4 py-3 text-left border-b">Nomor Pendaftaran</th>
                            <th class="px-4 py-3 text-left border-b">Nama Peserta</th>
                            <th class="px-4 py-3 text-left border-b">Status</th>
                            <th class="px-4 py-3 text-center border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($submissions as $index => $fields)
                            @php
                                $submissionId = $index;
                                $nama = collect($fields)->firstWhere('field_name', 'Nama Lengkap')?->value ?? '-';
                                $status = collect($fields)->first()?->status ?? 'pending';
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border-b">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border-b font-medium text-gray-700">#{{ $submissionId }}</td>
                                <td class="px-4 py-2 border-b">{{ $nama }}</td>
                                <td class="px-4 py-2 border-b">
                                    <span class="inline-block px-2 py-1 rounded-lg text-xs font-semibold
                                        {{ $status === 'diterima' ? 'bg-green-100 text-green-800' : ($status === 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-center border-b">
                                    <a href="{{ route('admin.form_submission.detail_submission', $submissionId) }}"
                                    class="inline-block px-3 py-1 text-sm text-white bg-blue-600 rounded-md hover:bg-blue-700 transition">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                 <script>
                    $(document).ready(function() {
                        var table = $('#myTable').DataTable();
            
                        $('#lokasiFilter').on('change', function() {
                            var selectedValue = $(this).val();
                            table.column(6).search(selectedValue).draw(); // Misalnya, kolom lokasi adalah kolom kedua
                        });
                    });
                </script>
            </div>
        @else
            <p class="text-gray-500 text-sm">Belum ada pendaftar untuk form ini.</p>
        @endif
    </div>
</div>


@endsection
