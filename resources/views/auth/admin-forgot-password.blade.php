<!DOCTYPE html>
<html lang="id">
<head>
    <title>Lupa Password Admin</title>
    @include('layouts.admin.partial.head')
</head>
<body class="bg-white">
    <main class="flex min-h-screen items-center justify-center px-4">
        <div class="w-full max-w-md rounded-lg bg-white p-6 shadow">
            <h1 class="mb-4 text-center text-2xl font-bold">Lupa Password Admin</h1>
            @if (session('status'))
                <div class="mb-4 rounded bg-green-100 p-3 text-green-700">{{ session('status') }}</div>
            @endif
            <form method="POST" action="{{ route('admin.password.email') }}">
                @csrf
                <label class="block text-sm font-medium" for="email">Email admin</label>
                <input class="mt-1 block w-full rounded border-gray-300" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                <button class="mt-5 w-full rounded bg-blue-600 py-2 text-white" type="submit">Kirim Link Reset Password</button>
            </form>
            <a class="mt-4 block text-center text-sm text-blue-600" href="{{ route('form-login-admin') }}">Kembali ke login admin</a>
        </div>
    </main>
</body>
</html>
