<!DOCTYPE html>
<html lang="id">
<head>
    <title>Reset Password Admin</title>
    @include('layouts.admin.partial.head')
</head>
<body class="bg-white">
    <main class="flex min-h-screen items-center justify-center px-4">
        <div class="w-full max-w-md rounded-lg bg-white p-6 shadow">
            <h1 class="mb-4 text-center text-2xl font-bold">Reset Password Admin</h1>
            <form method="POST" action="{{ route('admin.password.store') }}">
                @csrf
                <input name="token" type="hidden" value="{{ $token }}">
                <label class="block text-sm font-medium" for="email">Email admin</label>
                <input class="mt-1 block w-full rounded border-gray-300" id="email" name="email" type="email" value="{{ old('email', $email) }}" required>
                <label class="mt-4 block text-sm font-medium" for="password">Password baru</label>
                <input class="mt-1 block w-full rounded border-gray-300" id="password" name="password" type="password" required>
                <label class="mt-4 block text-sm font-medium" for="password_confirmation">Konfirmasi password baru</label>
                <input class="mt-1 block w-full rounded border-gray-300" id="password_confirmation" name="password_confirmation" type="password" required>
                <button class="mt-5 w-full rounded bg-blue-600 py-2 text-white" type="submit">Simpan Password Baru</button>
            </form>
        </div>
    </main>
</body>
</html>
