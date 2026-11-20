<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lupa Password</title>
    @include('layouts.admin.partial.head')
</head>
<body class="DEFAULT_THEME bg-white">
    <main>

        <div class="flex flex-col w-full  overflow-hidden relative min-h-screen radial-gradient items-center justify-center g-0 px-4">
                  
            <div class="justify-center items-center w-full card lg:flex max-w-md ">
                <div class=" w-full card-body">
            <h1 class="text-2xl font-bold mb-4 text-center">Lupa Password</h1>
            
            @if (session('status'))
                <div class="bg-green-100 text-green-700 p-3 mb-4 rounded-md text-center">
                    {{ session('status') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required 
                        class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">
                </div>
                
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
                    Kirim Link Reset Password
                </button>
            </form>
        </div>
    </div>
        </div>
    </main>
    @include('layouts.admin.partial.scripts')
</body>
</html>
