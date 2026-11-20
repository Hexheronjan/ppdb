@extends('layouts.admin.app')

@section('content')
<div class="container full-container py-5 flex flex-col gap-6">
    <!-- Card Wrapper -->
    <div class="card">
        <div class="card-body flex flex-col gap-6 shadow-md">
            <h1 class="text-2xl font-bold text-gray-700">Daftar Formulir PPDB</h1>

            <!-- Tombol Tambah Formulir -->
            <div class="mb-4">
                <a href="{{ route('admin.form_groups.create') }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fa fa-plus mr-2"></i> Tambah Formulir
                </a>
            </div>

            <!-- Tabel Daftar Formulir -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-2">
                <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="myTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Formulir</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($formGroups as $group)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $group->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $group->description ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 rounded-lg text-xs font-semibold
                                {{ $group->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $group->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.form_groups.edit', $group->id_form) }}"
                               class="px-3 py-2 text-xs font-medium text-white bg-blue-600 rounded-md hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300">
                                <i class="fa fa-edit mr-1"></i> Edit
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.form_groups.destroy', $group->id_form) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus formulir ini?')"
                                        class="px-3 py-2 text-xs font-medium text-white bg-red-500 rounded-md hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-red-300">
                                    <i class="fa fa-trash mr-1"></i> Hapus
                                </button>
                            </form>

                            <!-- Tombol Kelola Field -->
                            <a href="{{ route('admin.form_fields.index', $group->id_form) }}"
                               class="px-3 py-2 text-xs font-medium text-white bg-cyan-500 rounded-md hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-red-300">
                                <i class="fa fa-cogs mr-1"></i> Kelola Kolom
                            </a>

                            <form action="{{ route('admin.form_groups.toggle', $group->id_form) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="px-3 py-2 text-xs font-medium text-white {{ $group->is_active ? 'bg-yellow-500 hover:bg-yellow-700' : 'bg-teal-500 hover:bg-green-700' }} rounded-md">
                                    <i class="fa fa-power-off mr-1"></i>
                                    {{ $group->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                        </td>
                        </tr>
                        @endforeach
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
