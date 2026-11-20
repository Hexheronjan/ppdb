<!DOCTYPE html>
<html   lang="en" dir="ltr" >

<head>
	@include('layouts.admin.partial.head2')
	<title>Halaman Verifikasi OTP PPDB</title>
</head>

<body class="bg-gray-100">
	<main>
				<!-- Main Content -->
                <div class="flex flex-col w-full overflow-hidden relative min-h-screen radial-gradient items-center justify-center g-0 px-4 shadow-lg">
                  
                    <div class="justify-center items-center w-full card lg:flex max-w-md shadow-lg p-6 bg-white rounded-lg">
                        <div class="w-full card-body">
                            <a href="../" class="py-4 block">
                                <img src="../assets/images/logos/icon-logo-ppdb.png" alt="" class="mx-auto" />
                            </a>
                            <p class="mb-4 text-gray-500 text-sm text-center">Masukkan OTP yang dikirim ke WhatsApp Anda</p>

                            <form action="{{ route('otp.verify') }}" method="POST" class="max-w-lg mx-auto space-y-4 text-center" onsubmit="combineOtp()">
                                @csrf
                                <input type="hidden" name="no_wa" value="{{ $no_wa }}">
                                <input type="hidden" name="otp_code" id="combined-otp" required />

                                <div class="flex justify-center py-3 space-x-2">
                                    @for ($i = 1; $i <= 6; $i++)
                                        <div>
                                            <label for="otp-{{ $i }}" class="sr-only">OTP {{ $i }}</label>
                                            <input type="text" maxlength="1" id="otp-{{ $i }}"
                                                class="w-12 h-12 text-xl font-bold text-center text-gray-900 
                                                border-b-2 border-[#5d87ff] border-t-0 border-l-0 border-r-0 
                                                focus:border-[#C9A906] focus:ring-0 appearance-none outline-none transition duration-200"

                                                required oninput="toUpperAndNext(this, {{ $i }})" onkeydown="backOnDelete(event, {{ $i }})" />
                                        </div>
                                    @endfor
                                </div>

                                <div class="flex justify-center">
                                    <button type="submit"
                                        class="flex items-center mt-6 justify-center w-32 bg-[#5d87ff] text-white text-base py-2 px-4 rounded-md hover:bg-[#C9A906] transition duration-200">
                                        Verifikasi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <script>
                        function toUpperAndNext(el, index) {
                            el.value = el.value.toUpperCase();
                            if (el.value.length === 1 && index < 6) {
                                document.getElementById('otp-' + (index + 1)).focus();
                            }
                            combineOtp();
                        }

                        function backOnDelete(e, index) {
                            if (e.key === "Backspace" && e.target.value === "" && index > 1) {
                                document.getElementById('otp-' + (index - 1)).focus();
                            }
                        }

                        function combineOtp() {
                            let otp = '';
                            for (let i = 1; i <= 6; i++) {
                                otp += document.getElementById(`otp-${i}`).value;
                            }
                            document.getElementById('combined-otp').value = otp;
                        }
                    </script>
				
			</div>
		<!--end of project-->
	</main>


	@include('layouts.admin.partial.scripts')
</body>

</html>