@extends('layouts.admin.app')

@section('content')
<div class="container full-container py-5 flex flex-col gap-6">
    <!-- Card Wrapper -->
    <div class="card">
        <div class="card-body flex flex-col gap-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Edit Formulir</h1>
        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.form_groups.update', $formGroup->id_form) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Form</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $formGroup->name) }}" 
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">{{ old('description', $formGroup->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="academic_year" class="block text-sm font-medium text-gray-700">Tahun Ajaran</label>
                        <input type="text" name="academic_year" id="academic_year" value="{{ old('academic_year', $formGroup->academic_year) }}" 
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0" required>
                    </div>

                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <input type="text" name="category" id="category" value="{{ old('category', $formGroup->category) }}" 
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0" required>
                    </div>

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
