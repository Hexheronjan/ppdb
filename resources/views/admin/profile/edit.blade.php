@extends('layouts.admin.app')

@section('content')
<div class="container full-container py-5 flex flex-col gap-6">
    <div class="mb-5 my-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h2 class="text-3xl font-semibold">Profil</h2>
    <nav>
        <ol class="flex items-center gap-2">
            <li>
                <a class="font-medium text-sm" href="{{ route('admin.dashboard') }}">Dashboard /</a>
            </li>
            <li class="font-medium text-primary text-sm">Profil</li>
        </ol>
    </nav>
</div>
    <div class="card">
        <div class="card-body flex flex-col gap-6 shadow-md">
    <h2 class="text-2xl font-bold mb-6">Edit Profil</h2>

    @if (session('success'))
        <div class="bg-teal-500 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.profile.update') }}">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}" required
                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" required
                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password (Opsional) -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-medium mb-2">Password Baru (Opsional)</label>
            <input type="password" name="password" id="password"
                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">
        </div>

        <div class="mt-6">
            <button type="submit"
                class="bg-blue-600 text-white py-2 px-4 rounded-md text-sm hover:bg-blue-700 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
        </div>
    </div>
</div>
@endsection
