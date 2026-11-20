@extends('layouts.admin.app')

@section('content')
<div class="container full-container py-5 flex flex-col gap-6">
    <!-- Card Wrapper -->
    <div class="card">
        <div class="card-body flex flex-col gap-6 shadow-md">
            <h1 class="text-2xl font-bold mb-4 text-gray-700">Kelola Kolom - {{ $formGroup->name }}</h1>

            <!-- Tombol Tambah Field dan Kembali -->
            <div class="mb-4 flex justify-between">
                <a href="{{ route('admin.form_fields.create', $formGroup->id_form) }}" 
                   class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fa fa-plus mr-2"></i> Tambah Kolom
                </a>
                <a href="{{ route('admin.form_groups.index') }}" 
                   class="inline-flex items-center text-gray-500 hover:text-gray-700">
                    <i class="fa fa-arrow-left mr-2"></i> Kembali ke Daftar Formulir
                </a>
            </div>

            <!-- Tabel Field -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-2">
                <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="myTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kolom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Label</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($fields as $field)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $field->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $field->label }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $field->type }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.form_fields.edit', [$formGroup->id_form, $field->id_field]) }}" 
                                       class="px-3 py-2 text-xs font-medium text-white bg-blue-600 rounded-md hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-red-300">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.form_fields.destroy', [$formGroup->id_form, $field->id_field]) }}" 
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus field ini?')"
                                                class="px-3 py-2 text-xs font-medium text-white bg-red-500 rounded-md hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-red-300">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if($fields->isEmpty())
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada field yang tersedia.
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                </div>
                <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
                <script>
                    $('#sidebar-drivers').addClass('active')
                </script>
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
        </div>
    </div>
</div>
@endsection
