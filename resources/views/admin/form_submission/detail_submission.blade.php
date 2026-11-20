@extends('layouts.admin.app')

@section('content')
<div class="container full-container py-5 flex flex-col gap-6 rounded-lg">
    <!-- Header -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-600 text-white text-center py-4 rounded-t-lg">
            <h1 class="text-3xl font-bold">Detail Pendaftaran #{{ $submissionId }}</h1>
        </div>
        
        <div class="bg-gray-100 text-center py-3 border-b">
            <p class="text-lg font-medium text-gray-700">
                Informasi lengkap mengenai pendaftaran dengan ID #{{ $submissionId }}
            </p>
        </div>
    </div>

    <!-- Detail Pendaftaran dalam Card -->
    <div class="bg-white shadow-md rounded-lg p-6 rounded-lg">
        <table class="w-full border-collapse border border-gray-300 text-sm rounded-md overflow-hidden">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="border border-gray-300 px-4 py-2 w-1/4">Informasi</th>
                    <th class="border border-gray-300 px-4 py-2">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fields as $field)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 font-semibold">
                            {{ $field->file_path ? 'Lampiran - ' . $field->field_name : $field->field_name }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if ($field->file_path)
                                <a href="{{ asset('storage/' . $field->file_path) }}" 
                                data-lightbox="lampiran" target="_blank" download 
                                title="Lampiran {{ $field->field_name }}">
                                    <img src="{{ asset('storage/' . $field->file_path) }}" 
                                        alt="{{ $field->field_name }}" 
                                        class="w-24 h-24 object-cover rounded-md border hover:opacity-75 transition duration-200">
                                </a>
                            @else
                                {{ $field->value }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Form untuk Memperbarui Status -->
    @php
        $currentStatus = $fields->first()->status ?? 'pending';
    @endphp
    <div class="bg-white shadow-md rounded-lg px-4 py-2">
        <h2 class="p-2 text-xl font-bold mb-4">Konfirmasi Pendaftaran</h2>
        <form action="{{ route('admin.form_submission.updateStatus', $submissionId) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="status" class="block mb-2 font-medium text-gray-700">Pilih Status</label>
                <select name="status" id="status" class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm" onchange="this.form.submit()">
                    <option value="pending" @selected($currentStatus == 'pending')>Pending</option>
                    <option value="diterima" @selected($currentStatus == 'diterima')>Diterima</option>
                    <option value="ditolak" @selected($currentStatus == 'ditolak')>Ditolak</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-500 rounded-md hover:bg-green-700">
                Perbarui Status
            </button>
        </form>
    </div>
    
    <!-- Tombol Kembali -->
    <div class="flex justify-end gap-2">
        <a href="{{ route('admin.form_submission.downloadPDF', $submissionId) }}"
        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 shadow-md">
        <i class="fa fa-file-pdf mr-1"></i> Unduh PDF
    </a>
    <a href="{{ route('admin.form_submission.group', $formGroupId) }}" 
       class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-500 rounded-md hover:bg-gray-700 shadow-md">
        Kembali ke Daftar
    </a>
    </div>
</div>
@endsection
