@extends('layouts.admin.app')

@section('content')
<div class="container full-container py-5 flex flex-col gap-6">
    <!-- Card Wrapper -->
    <div class="card">
        <div class="card-body flex flex-col gap-6 shadow-md">
            <h1 class="text-2xl font-bold text-gray-700">Data Sekolah</h1>
            
            <!-- Tombol Tambah Data Sekolah -->
            <div class="mb-4">
                <a href="{{ route('admin.schools.create') }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fa fa-plus mr-2"></i> Tambah Data Sekolah
                </a>
            </div>
            
            <!-- Tabel Data Sekolah -->
            <div class="grid grid-cols-1 gap-6 p-5">
            @forelse ($schools as $index => $school)
            <div class="bg-white rounded-lg shadow-md p-6 border border-gray-300 dark:bg-gray-800">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Data Sekolah</h2>
                <div class="space-y-4">
                    <div class="flex flex-col">
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Nama Sekolah:</label>
                        <span class="mt-1 block p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $school->name }}</span>
                    </div>
                    <div class="flex flex-col">
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Telepon:</label>
                        <span class="mt-1 block p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $school->phone }}</span>
                    </div>
                    <div class="flex flex-col">
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Email:</label>
                        <span class="mt-1 block p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $school->address }}</span>
                    </div>
                    <div class="flex flex-col">
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Kepala Sekolah:</label>
                        <span class="mt-1 block p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $school->principal_name }}</span>
                    </div>
                </div>
                <div class="mt-4">
                <a href="{{ route('admin.schools.edit', $school->id_school) }}" 
                                       class="px-3 py-2 text-xs font-medium text-white bg-blue-600 rounded-md hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-red-300">
                                       <i class="fa fa-edit"></i>
                                        Edit
                                    </a>
                </div>
            </div>
            @endforelse
    </div>
            </div>
        </div>
    </div>
</div>
@endsection
