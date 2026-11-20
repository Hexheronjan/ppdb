@extends('layouts.admin.app')
@section('content')

<div class="container full-container py-5 flex flex-col gap-6">
    <!-- Card Wrapper -->
    <div class="card">
        <div class="card-body flex flex-col gap-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Tambah Kolom</h1>
        <div class="card">
            <div class="card-body">

                <!-- Form -->
                <form method="POST" action="{{ route('admin.form_fields.store', ['form_id' => $formGroup->id_form]) }}" class="flex flex-col gap-6">
                    @csrf

                    <!-- Nama Field -->
                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-700">Nama Kolom</label>
                        <input type="text" id="name" name="name" 
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0 " 
                            placeholder="Nama kolom" required>
                    </div>

                    <!-- Label -->
                    <div>
                        <label for="label" class="mb-2 block text-sm font-medium text-gray-700">Label Kolom</label>
                        <input type="text" id="label" name="label" 
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0 " 
                            placeholder="Label kolom" required>
                    </div>

                    <!-- Jenis Input -->
                    <div>
                        <label for="type" class="mb-2 block text-sm font-medium text-gray-700">Tipe Input</label>
                        <select id="type" name="type" 
                                class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:shadow-xl" required>
                            <option value="text">Text</option>
                            <option value="textarea">Textarea</option>
                            <option value="select">Select</option>
                            <option value="file">File</option>
                            <option value="number">Number</option>
                            <option value="email">Email</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="radio">Radio</option>
                            <option value="date">Date</option>
                        </select>
                    </div>

                    <!-- Placeholder -->
                    <div>
                        <label for="placeholder" class="mb-2 block text-sm font-medium text-gray-700">Placeholder</label>
                        <input type="text" id="placeholder" name="placeholder" 
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0 " 
                            placeholder="Placeholder kolom">
                    </div>

                    <!-- Opsi (jika Select) -->
                    <div>
                        <label for="options" class="mb-2 block text-sm font-medium text-gray-700">Opsi (jika Select)</label>
                        <input type="text" id="options" name="options" 
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0 " 
                            placeholder="Contoh: Opsi 1, Opsi 2, Opsi 3">
                            <p class="text-xs text-gray-500 mt-1">Pisahkan dengan koma (,) untuk beberapa opsi.</p>
                    </div>

                    <!-- Wajib diisi? -->
                    <div class="flex items-center p-2">
                        <input type="checkbox" id="required" name="required" value="1"
                            class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mr-4 p-2"> <!-- Increased right margin -->
                        <label for="required" class="text-sm text-gray-700"> Wajib diisi?</label>
                    </div>
                    

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Simpan
                        </button>
                        <a href="{{ route('admin.form_fields.index', $formGroup->id_form) }}" class="bg-red-500 hover:bg-red-400 text-white font-medium py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
