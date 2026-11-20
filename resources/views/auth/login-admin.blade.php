<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	@include('layouts.admin.partial.head2')
	<title>Halaman Login PPDB</title>
</head>

<body class="bg-gray-100">
	<main>
		<!-- Main Content -->
		<div class="flex flex-col w-full overflow-hidden relative min-h-screen radial-gradient items-center justify-center g-0 px-4">
			<div class="justify-center items-center w-full card lg:flex max-w-md bg-white shadow-lg p-6 rounded-lg">
				<div class="w-full card-body">
					<a href="../" class="py-4 block"><img src="../assets/images/logos/icon-logo-ppdb.png" alt="" class="mx-auto"/></a>
					<p class="mb-4 text-gray-500 text-sm text-center">Selamat Datang</p>

					@if ($errors->any())
						<div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 text-xs font-semibold rounded-lg text-left">
							<ul class="list-disc list-inside space-y-1">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					@if (session('status'))
						<div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 text-xs font-semibold rounded-lg text-left">
							{{ session('status') }}
						</div>
					@endif

					<!-- form -->
					<form method="POST" action="{{ route('login-admin') }}">
						@csrf
						<!-- username -->
						<div class="mb-4">
							<label for="forEmail" class="block text-sm font-semibold mb-2 text-gray-600">Email</label>
							<input type="email" id="forEmail" name="email" value="{{ old('email') }}"
								class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0" aria-describedby="hs-input-helper-text" required>
						</div>
						<!-- password -->
						<div class="mb-6">
							<label for="forPassword" class="block text-sm font-semibold mb-2 text-gray-600">Password</label>
							<div style="position: relative; width: 100%;">
								<input type="password" id="forPassword" name="password"
									style="padding-right: 42px;"
									class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0" aria-describedby="hs-input-helper-text" required>
								<button type="button" onclick="togglePasswordVisibility('forPassword', this)" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: transparent; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; padding: 0; color: #9ca3af;" class="hover:text-gray-600 focus:outline-none">
									<svg class="eye-open" style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
									</svg>
									<svg class="eye-closed" style="width: 20px; height: 20px; display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
									</svg>
								</button>
							</div>
						</div>
						<!-- checkbox -->
						<div class="flex justify-between items-center">
							<div class="flex items-center">
								<input type="checkbox" name="remember" value="1" class="shrink-0 mt-0.5 border-gray-200 rounded-[4px] text-blue-600 focus:ring-blue-500" id="hs-default-checkbox" checked>
								<label for="hs-default-checkbox" class="text-sm text-gray-600 ms-3">Ingat saya</label>
							</div>
						</div>
						<!-- button -->
						<div class="flex justify-center">
							<button type="submit"
								class="flex items-center mt-6 justify-center w-32 bg-[#5d87ff] text-white text-base py-2 px-4 rounded-md hover:bg-[#C9A906] transition duration-200">
								Login
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--end of project-->
	</main>

	<script>
		function togglePasswordVisibility(inputId, btn) {
			const input = document.getElementById(inputId);
			const eyeOpen = btn.querySelector('.eye-open');
			const eyeClosed = btn.querySelector('.eye-closed');
			if (input.type === 'password') {
				input.type = 'text';
				eyeOpen.style.display = 'none';
				eyeClosed.style.display = 'block';
			} else {
				input.type = 'password';
				eyeOpen.style.display = 'block';
				eyeClosed.style.display = 'none';
			}
		}
	</script>

	@include('layouts.admin.partial.scripts')
</body>

</html>
