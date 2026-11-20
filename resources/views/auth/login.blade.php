<!DOCTYPE html>
<html   lang="en" dir="ltr" >

<head>
	@include('layouts.admin.partial.head2')
	<title>Halaman Login PPDB</title>
</head>

<body class="bg-gray-100">
	<main>
				<!-- Main Content -->
                <div class="flex flex-col w-full  overflow-hidden relative min-h-screen radial-gradient items-center justify-center g-0 px-4">
                  
                    <div class="justify-center items-center w-full card lg:flex max-w-md bg-white shadow-lg p-6 rounded-lg">
                        <div class=" w-full card-body">
                                <a href="../" class="py-4 block"><img src="../assets/images/logos/icon-logo-ppdb.png" alt="" class="mx-auto"/></a>
                                <p class="mb-4 text-gray-500 text-sm text-center">Selamat  Datang</p>
                            <!-- form -->
                            <form method="POST" action="{{ route('otp.send') }}">
                                @csrf
                                <!-- username -->
                                <div class="mb-4">
                                    <label for="forEmail"
                                    class="block text-sm font-semibold mb-2 text-gray-600">Nomor WhatsApp</label>
                                <input type="text" id="forEmail" name="no_wa" placeholder="08XXXXXXXXXX"
                                    value="{{ old('no_wa') }}"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0 " aria-describedby="hs-input-helper-text" required>
                                </div>

                                {{-- Notifikasi error: nomor WA belum terdaftar --}}
                                @if ($errors->has('no_wa'))
                                    @php $errMsg = $errors->first('no_wa'); @endphp
                                    @if ($errMsg === 'no_wa_not_found')
                                    <div class="mb-2 p-3 bg-red-50 border border-red-200 rounded-md text-center">
                                        <p class="text-sm text-red-600 font-medium">Nomor WhatsApp belum terdaftar. Silakan buat akun terlebih dahulu.</p>
                                    </div>
                                    @else
                                    <div class="mb-2 p-3 bg-red-50 border border-red-200 rounded-md text-center">
                                        <p class="text-sm text-red-600">{{ $errMsg }}</p>
                                    </div>
                                    @endif
                                @endif
            
                                    <!-- button -->
                                      <div class="flex justify-center">
                                        <button type="submit"
                                            class="flex items-center mt-6 justify-center w-32 bg-[#5d87ff] text-white text-base py-2 px-4 rounded-md hover:bg-[#C9A906] transition duration-200">
                                            Minta OTP
                                        </button>
                                      </div>
        
                                    <div class="flex justify-center gap-2 items-center mt-4">
                                        <p class="text-base font-medium text-gray-500">Belum punya akun?</p>
                                        <a href="{{ route('register') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">Buat akun</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
				
			</div>
		<!--end of project-->
	</main>


	@include('layouts.admin.partial.scripts')
</body>

</html>