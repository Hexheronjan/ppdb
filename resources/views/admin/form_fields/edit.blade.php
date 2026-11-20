@extends('layouts.admin.app')

@section('content')
<div class="container full-container py-5 flex flex-col gap-6">
    <!-- Card Wrapper -->
    <div class="card">
        <div class="card-body flex flex-col gap-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Edit Kolom</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.form_fields.update', ['form_id' => $formGroup->id_form, 'field_id' => $field->id_field]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Kolom</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $field->name) }}"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0" required>
                    </div>

                    <div class="mb-4">
                        <label for="type" class="block text-sm font-medium text-gray-700">Tipe Input</label>
                        <select name="type" id="type" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:shadow-xl" required>
                            <option value="text" {{ $field->type == 'text' ? 'selected' : '' }}>Text</option>
                            <option value="textarea" {{ $field->type == 'textarea' ? 'selected' : '' }}>Textarea</option>
                            <option value="select" {{ $field->type == 'select' ? 'selected' : '' }}>Select</option>
                            <option value="file" {{ $field->type == 'file' ? 'selected' : '' }}>File</option>
                            <option value="number" {{ $field->type == 'number' ? 'selected' : '' }}>Number</option>
                            <option value="email" {{ $field->type == 'email' ? 'selected' : '' }}>Email</option>
                            <option value="checkbox" {{ $field->type == 'checkbox' ? 'selected' : '' }}>Checkbox</option>
                            <option value="radio" {{ $field->type == 'radio' ? 'selected' : '' }}>Radio</option>
                            <option value="date" {{ $field->type == 'date' ? 'selected' : '' }}>Date</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="label" class="block text-sm font-medium text-gray-700">Label</label>
                        <input type="text" name="label" id="label" value="{{ old('label', $field->label) }}"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0" required>
                    </div>

                    <div class="mb-4">
                        <label for="placeholder" class="block text-sm font-medium text-gray-700">Placeholder</label>
                        <input type="text" name="placeholder" id="placeholder" value="{{ old('placeholder', $field->placeholder) }}"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">
                    </div>

                    <div class="mb-4">
                        <label for="options" class="block text-sm font-medium text-gray-700">Options (untuk Select, Checkbox, Radio)</label>
                        <input type="text" name="options" id="options" value="{{ old('options', $field->options) }}"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">
                        <p class="text-xs text-gray-500 mt-1">Pisahkan dengan koma (,) untuk beberapa opsi.</p>
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="required" {{ $field->required ? 'checked' : '' }}
                                class="rounded border-gray-300 shadow-sm">
                            <span class="ml-2 text-sm text-gray-700">Wajib diisi?</span>
                        </label>
                    </div>

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
@endsection
