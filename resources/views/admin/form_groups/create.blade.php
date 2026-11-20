@extends('layouts.admin.app')

@section('content')
<div class="container full-container py-5 flex flex-col gap-6">
    <!-- Card Wrapper -->
    <div class="card">
        <div class="card-body flex flex-col gap-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Tambah Formulir</h1>
        <div class="card">
            <div class="card-body">
            <form method="POST" action="{{ route('admin.form_groups.store') }}">
                @csrf

                <!-- Input Nama Formulir -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Formulir</label>
                    <input type="text" name="name" id="name" required
                        class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">
                </div>

                <!-- Input Deskripsi Formulir -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                    <textarea name="description" id="description" rows="3"
                        class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"></textarea>
                </div>

                  <!-- Input Tahun Ajaran Formulir -->
                  <div class="mb-4">
                    <label for="acamdemic_year" class="block text-sm font-medium text-gray-700">Tahun Ajaran</label>
                    <input name="academic_year" id="acamdemic_year" rows="3"
                        class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"></input>
                </div>

                 <!-- Input Tahun Kategori Formulir -->
                 <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <input name="category" id="category" rows="3"
                        class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"></input>
                </div>

                <!-- Tombol Simpan -->
                <div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Simpan
                    </button>
                    <a href="{{ route('admin.form_groups.index') }}" class="bg-red-500 hover:bg-red-400 text-white font-medium py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">Batal</a>
                </div>
            </form>
         </div>
       </div>
    </div>
</div>
@endsection
