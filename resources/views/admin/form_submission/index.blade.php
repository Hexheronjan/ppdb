@extends('layouts.admin.app')

@section('content')
<div class="container full-container py-5 flex flex-col gap-6">
    <div class="">
        <div class="p-5 flex flex-col gap-6">
    <!-- Card Wrapper -->
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Formulir PPDB {{ $nama_sekolah }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($formGroups as $group)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="p-5 flex flex-col gap-3">
                            <h2 class="text-xl font-semibold text-gray-700">{{ $group->name }}</h2>
                            <div class="flex items-center gap-3">
                                <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                                    <!-- Ikon Formulir -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M9 8h6m2 12H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm">{{ $group->description ?? 'Tidak ada deskripsi.' }}</p>
                            <p class="text-gray-500 text-sm mt-1">
                                Total Pendaftar: <strong>{{ $group->submission_count }}</strong>
                            </p>
                            <a href="{{ route('admin.form_submission.group', $group->id_form) }}" 
                                class="mt-3 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 text-center inline-block transition-colors duration-300">
                                Lihat Pendaftar
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
