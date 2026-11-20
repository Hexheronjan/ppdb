@extends('layouts.admin.app')

@section('content')
<div class="container full-container py-5 flex flex-col gap-6">
    <!-- Card Wrapper -->
    <div class="card">
        <div class="card-body flex flex-col gap-6 shadow-md">
            <h1 class="text-2xl font-bold text-gray-700">Tambah Data Sekolah</h1>

            <!-- Form Create Sekolah -->
            <form action="{{ route('admin.schools.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Nama Sekolah -->
                <div class="mb-4"> 
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Sekolah</label>
                    <input type="text" name="name" id="name" required
                           class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">
                </div>

                <!-- Alamat Sekolah -->
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat Sekolah</label>
                    <textarea name="address" id="address" rows="3" required
                              class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"></textarea>
                </div>

                <!-- Telepon Sekolah -->
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Telepon Sekolah</label>
                    <input type="text" name="phone" id="phone" required
                           class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">
                </div>

                <!-- Email Sekolah -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Sekolah</label>
                    <input type="email" name="email" id="email" required
                           class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">
                </div>

                <!-- Kepala Sekolah -->
                <div class="mb-4">
                    <label for="principal_name" class="block text-sm font-medium text-gray-700">Kepala Sekolah</label>
                    <input type="text" name="principal_name" id="principal_name" required
                           class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end gap-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Simpan
                    </button>
                    <a href="{{ route('admin.schools.index') }}" class="bg-red-500 hover:bg-red-400 text-white font-medium py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
