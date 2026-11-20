@extends('layouts.admin.app')

@section('content')
<div class="container full-container py-5 flex flex-col gap-6">
    <div class="mb-5 my-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-3xl font-semibold">Data Sekolah</h2>
        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-sm" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li class="font-medium text-primary text-sm">Data Sekolah</li>
            </ol>
        </nav>
    </div>

    <!-- Card Wrapper -->
    <div class=" rounded-lg p-6">
        <div class="card">
            <div class="card-body flex flex-col gap-6 shadow-md">
        @forelse ($schools as $school)
        <div class="mb-8">
            <h3 class="text-xl font-bold text-gray-700 mb-4">Data Sekolah - {{ $school->name }}</h3>
            <table class="w-full border-collapse border border-gray-300 text-sm rounded-md overflow-hidden">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="border border-gray-300 px-4 py-2 w-1/4">Informasi</th>
                        <th class="border border-gray-300 px-4 py-2">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 font-semibold">Nama Sekolah</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $school->name }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 font-semibold">Telepon</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $school->phone }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 font-semibold">Alamat</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $school->address }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 font-semibold">Kepala Sekolah</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $school->principal_name }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Tombol Edit -->
            <div class="mt-4 text-right">
                <a href="{{ route('admin.schools.edit', $school->id_school) }}" 
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:ring-2 focus:outline-none focus:ring-blue-300">
                    <i class="fa fa-edit mr-1"></i>Edit
                </a>
            </div>
        </div>
        </div>
        </div>
        @empty
        <p class="text-gray-500 text-center">Tidak ada data sekolah yang tersedia.</p>
        @endforelse
    </div>
</div>
@endsection
