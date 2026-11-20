<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Formulir Pendaftaran Peserta Didik Baru
        </h2>
    </x-slot>

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8 px-4 sm:px-6 lg:px-8" style="padding-bottom: 120px !important;">
    <div class="max-w-4xl mx-auto" style="margin-bottom: 40px;">
        @if(!$angkatanAktif)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-8 text-center my-12">
                <div class="w-20 h-20 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">
                    <i class="fas fa-lock"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    {{ optional($jadwalPendaftaran)->registrationStatus() === 'ditutup' ? 'Pendaftaran Ditutup' : 'Pendaftaran Belum Dibuka' }}
                </h2>
                @if($jadwalPendaftaran)
                    <p class="text-gray-600 max-w-md mx-auto mb-5">
                        Saat ini pendaftaran santri baru {{ $jadwalPendaftaran->registrationStatus() === 'ditutup' ? 'sudah ditutup.' : 'belum dibuka.' }}
                    </p>
                    <div class="max-w-md mx-auto mb-6 rounded-xl bg-slate-50 border border-slate-200 p-4 text-left space-y-3 text-sm">
                        <div class="flex flex-col sm:flex-row sm:justify-between gap-1">
                            <span class="font-bold text-slate-700"><i class="fas fa-calendar-alt text-teal-600 mr-1"></i> Buka Pendaftaran</span>
                            <span class="text-slate-600">{{ $jadwalPendaftaran->registration_starts_at->translatedFormat('d F Y') }} &bull; {{ $jadwalPendaftaran->registration_starts_at->format('H.i') }} WIB</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:justify-between gap-1">
                            <span class="font-bold text-slate-700"><i class="fas fa-calendar-alt text-teal-600 mr-1"></i> Tutup Pendaftaran</span>
                            <span class="text-slate-600">{{ $jadwalPendaftaran->registration_ends_at->translatedFormat('d F Y') }} &bull; {{ $jadwalPendaftaran->registration_ends_at->format('H.i') }} WIB</span>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mb-6">Silakan kembali sesuai jadwal yang telah ditentukan.</p>
                @else
                    <p class="text-gray-600 max-w-md mx-auto mb-6">Jadwal pendaftaran belum ditentukan oleh pihak sekolah.</p>
                @endif
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-teal-600 text-white font-semibold rounded-lg hover:bg-teal-700 transition">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        @else
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-teal-500 to-cyan-600 px-6 py-8">
                <h1 class="text-3xl font-bold text-white text-center">Formulir PPDB</h1>
                <p class="text-teal-100 text-center mt-2">{{ $angkatanAktif->nama_angkatan }} &mdash; Tahun Ajaran {{ $angkatanAktif->tahun_ajaran }}</p>
            </div>

            <!-- Progress Steps -->
            <div class="px-6 py-4 bg-gray-50 border-b">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded-full bg-teal-500 text-white flex items-center justify-center font-semibold step-indicator" data-step="1">1</div>
                        <span class="text-sm font-medium text-gray-700 hidden sm:inline">Calon Siswa</span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 mx-2 step-line" data-from="1" data-to="2"></div>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-semibold step-indicator" data-step="2">2</div>
                        <span class="text-sm font-medium text-gray-700 hidden sm:inline">Asal Sekolah</span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 mx-2 step-line" data-from="2" data-to="3"></div>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-semibold step-indicator" data-step="3">3</div>
                        <span class="text-sm font-medium text-gray-700 hidden sm:inline">Orang Tua</span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 mx-2 step-line" data-from="3" data-to="4"></div>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-semibold step-indicator" data-step="4">4</div>
                        <span class="text-sm font-medium text-gray-700 hidden sm:inline">Program & Info</span>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form id="registrationForm" class="p-6 space-y-8">
                @csrf

                <!-- ============================================================ -->
                <!-- STEP 1: Data Calon Peserta Didik                             -->
                <!-- ============================================================ -->
                <div class="form-step" data-step="1">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-user-graduate text-teal-500"></i>
                        A. Data Calon Peserta Didik
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                placeholder="Masukkan nama lengkap">
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="jenis_kelamin" id="jenis_kelamin" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                placeholder="Kota/Kabupaten tempat lahir">
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">NISN <span class="text-red-500">*</span> <span class="text-xs text-gray-500">(10 digit)</span></label>
                            <input type="text" name="nisn" id="nisn" required maxlength="10"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                placeholder="Masukkan 10 digit NISN">
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>
                    </div>
                </div>

                <!-- ============================================================ -->
                <!-- STEP 2: Data Asal Sekolah                                    -->
                <!-- ============================================================ -->
                <div class="form-step hidden" data-step="2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-school text-teal-500"></i>
                        B. Data Asal Sekolah
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Asal TK/RA <span class="text-red-500">*</span></label>
                            <input type="text" name="sekolah_asal" id="sekolah_asal" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                placeholder="Nama TK/RA asal">
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                NSM Sekolah Asal <span class="text-red-500">*</span>
                                <span class="inline-block bg-teal-100 text-teal-700 text-xs font-semibold px-2 py-0.5 rounded ml-1">Isi 0 jika dari TK</span>
                            </label>
                            <input type="text" name="nsm" id="nsm" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                placeholder="NSM sekolah asal (0 jika TK)">
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">NPSN Sekolah Asal <span class="text-red-500">*</span></label>
                            <input type="text" name="npsn" id="npsn" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                placeholder="NPSN sekolah asal">
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>

                        <div class="form-group md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Sekolah Asal <span class="text-red-500">*</span></label>
                            <textarea name="alamat_sekolah_asal" id="alamat_sekolah_asal" required rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                placeholder="Alamat lengkap sekolah asal"></textarea>
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>
                    </div>
                </div>

                <!-- ============================================================ -->
                <!-- STEP 3: Data Orang Tua / Wali                               -->
                <!-- ============================================================ -->
                <div class="form-step hidden" data-step="3">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-users text-teal-500"></i>
                        C. Data Orang Tua / Wali
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ayah <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ayah" id="nama_ayah" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                placeholder="Nama lengkap ayah">
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ibu <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ibu" id="nama_ibu" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                placeholder="Nama lengkap ibu">
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor HP / WhatsApp <span class="text-red-500">*</span></label>
                            <input type="text" name="no_hp_wa" id="no_hp_wa" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                placeholder="Contoh: 08123456789">
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>

                        <div class="form-group md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea name="alamat" id="alamat" required rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                placeholder="Alamat lengkap rumah tinggal saat ini"></textarea>
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>
                    </div>
                </div>

                <!-- ============================================================ -->
                <!-- STEP 4: Pilihan Program & Informasi Tambahan                 -->
                <!-- ============================================================ -->
                <div class="form-step hidden" data-step="4">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-clipboard-list text-teal-500"></i>
                        D &amp; E. Pilihan Program &amp; Informasi Tambahan
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan Program <span class="text-red-500">*</span></label>
                            <select name="program_pilihan" id="program_pilihan" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                                <option value="">-- Pilih Program --</option>
                                <option value="Program Khusus">Program Khusus</option>
                                <option value="Bina Prestasi">Bina Prestasi</option>
                            </select>
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mengetahui Informasi PPDB dari <span class="text-red-500">*</span></label>
                            <select name="info_ppdb" id="info_ppdb" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                                <option value="">-- Pilih Sumber Informasi --</option>
                                <option value="Media Sosial">Media Sosial</option>
                                <option value="Website">Website</option>
                                <option value="Teman/Keluarga">Teman/Keluarga</option>
                                <option value="Alumni">Alumni</option>
                                <option value="Spanduk/Brosur">Spanduk/Brosur</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>
                    </div>

                    <!-- Ringkasan sebelum submit -->
                    <div class="mt-8 bg-teal-50 border border-teal-200 rounded-xl p-5">
                        <h3 class="font-semibold text-teal-800 mb-3 flex items-center gap-2"><i class="fas fa-info-circle"></i> Perhatian Sebelum Mengirim</h3>
                        <ul class="text-sm text-teal-700 space-y-1 list-disc list-inside">
                            <li>Pastikan semua data yang Anda masukkan sudah benar.</li>
                            <li>Data yang telah dikirim akan langsung masuk ke sistem pendaftaran.</li>
                            <li>Anda dapat memantau status pendaftaran melalui halaman Dashboard.</li>
                        </ul>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between pt-6 border-t">
                    <button type="button" id="prevBtn"
                        style="display:none"
                        class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition inline-flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Sebelumnya
                    </button>

                    <div class="ml-auto flex gap-3">
                        <button type="button" id="nextBtn"
                            class="px-6 py-3 bg-teal-500 text-white rounded-lg hover:bg-teal-600 font-medium transition inline-flex items-center gap-2">
                            Selanjutnya <i class="fas fa-arrow-right"></i>
                        </button>
                        <button type="submit" id="submitBtn"
                            style="display:none; background-color:#0d9488; color:#ffffff; padding:12px 24px; border-radius:8px; font-weight:700; border:none; cursor:pointer; font-size:14px;"
                            class="inline-flex items-center gap-2">
                            <i class="fas fa-paper-plane"></i> Kirim Pendaftaran
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl p-8 flex flex-col items-center shadow-xl">
        <div class="animate-spin rounded-full h-14 w-14 border-b-4 border-teal-500 mb-4"></div>
        <p class="text-gray-700 font-medium">Sedang mengirim data pendaftaran...</p>
    </div>
</div>

<!-- Success Modal -->
<div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl p-8 max-w-md mx-4 text-center shadow-xl">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-check text-green-500 text-4xl"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Pendaftaran Berhasil!</h3>
        <p class="text-gray-600 mb-6">Data pendaftaran telah berhasil disimpan. Silakan pantau status pendaftaran melalui halaman Dashboard.</p>
        <button onclick="window.location.href='{{ route('user.dashboard') }}'"
            class="px-6 py-3 bg-teal-500 text-white rounded-lg hover:bg-teal-600 font-semibold transition">
            Ke Dashboard
        </button>
    </div>
</div>

<script>
let currentStep = 1;
const totalSteps = 4;

function updateProgress() {
    document.querySelectorAll('.step-indicator').forEach(el => {
        const s = parseInt(el.dataset.step);
        if (s < currentStep) {
            el.classList.remove('bg-gray-300','text-gray-600');
            el.classList.add('bg-green-500','text-white');
            el.innerHTML = '<i class="fas fa-check text-sm"></i>';
        } else if (s === currentStep) {
            el.classList.remove('bg-gray-300','text-gray-600','bg-green-500');
            el.classList.add('bg-teal-500','text-white');
            el.textContent = s;
        } else {
            el.classList.remove('bg-teal-500','text-white','bg-green-500');
            el.classList.add('bg-gray-300','text-gray-600');
            el.textContent = s;
        }
    });
    document.querySelectorAll('.step-line').forEach(el => {
        const from = parseInt(el.dataset.from);
        if (from < currentStep) {
            el.classList.remove('bg-gray-200');
            el.classList.add('bg-teal-500');
        } else {
            el.classList.remove('bg-teal-500');
            el.classList.add('bg-gray-200');
        }
    });
}

function showStep(step) {
    document.querySelectorAll('.form-step').forEach(el => el.classList.add('hidden'));
    const stepEl = document.querySelector('.form-step[data-step="'+step+'"]');
    if (stepEl) stepEl.classList.remove('hidden');

    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');

    // Gunakan style.display agar tidak konflik dengan Tailwind's "hidden" (display:none !important)
    prevBtn.style.display  = (step === 1) ? 'none' : 'inline-flex';
    nextBtn.style.display  = (step === totalSteps) ? 'none' : 'inline-flex';
    submitBtn.style.display = (step === totalSteps) ? 'inline-flex' : 'none';

    updateProgress();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function validateField(field) {
    const fg = field.closest('.form-group');
    if (!fg) return true;
    const errSpan = fg.querySelector('.error-message');
    let valid = true;
    let msg = '';
    const val = field.value.trim();

    if (field.hasAttribute('required') && !val) {
        valid = false;
        const label = fg.querySelector('label');
        const labelText = label ? label.textContent.replace(/\*.*/,'').trim() : 'Field ini';
        msg = labelText + ' wajib diisi.';
    } else if (val) {
        if (field.id === 'nisn') {
            if (!/^\d{10}$/.test(val)) { valid = false; msg = 'NISN harus tepat 10 digit angka.'; }
        } else if (field.id === 'npsn') {
            if (!/^\d+$/.test(val)) { valid = false; msg = 'NPSN harus berupa angka.'; }
        } else if (field.id === 'nsm') {
            if (!/^\d+$/.test(val)) { valid = false; msg = 'NSM harus berupa angka (isi 0 jika dari TK).'; }
        } else if (field.id === 'no_hp_wa') {
            if (!/^(08|628|\+628)[0-9]{8,13}$/.test(val)) {
                valid = false; msg = 'Format tidak valid. Contoh: 08123456789';
            }
        }
    }

    if (!valid) {
        field.classList.add('border-red-400');
        field.classList.remove('border-green-400');
        if (errSpan) { errSpan.textContent = msg; errSpan.classList.remove('hidden'); }
    } else {
        if (val) { field.classList.add('border-green-400'); field.classList.remove('border-red-400'); }
        else { field.classList.remove('border-red-400','border-green-400'); }
        if (errSpan) errSpan.classList.add('hidden');
    }
    return valid;
}

function validateStep(step) {
    const stepEl = document.querySelector('.form-step[data-step="'+step+'"]');
    if (!stepEl) return true;
    let valid = true;
    stepEl.querySelectorAll('input,select,textarea').forEach(f => {
        if (!validateField(f)) valid = false;
    });
    return valid;
}

function checkDuplicateNisn(nisnField) {
    const val = nisnField.value.trim();
    if (!/^\d{10}$/.test(val)) return;
    fetch('{{ route("santri.registration.checkDuplicate") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ type: 'nisn', value: val })
    })
    .then(r => r.json())
    .then(data => {
        if (data.duplicate) {
            nisnField.classList.add('border-red-400');
            nisnField.classList.remove('border-green-400');
            const fg = nisnField.closest('.form-group');
            if (fg) {
                const errSpan = fg.querySelector('.error-message');
                if (errSpan) { errSpan.textContent = data.message || 'NISN sudah terdaftar.'; errSpan.classList.remove('hidden'); }
            }
        }
    });
}

document.getElementById('nextBtn').addEventListener('click', function() {
    if (validateStep(currentStep)) { currentStep++; showStep(currentStep); saveDraft(); }
});
document.getElementById('prevBtn').addEventListener('click', function() {
    currentStep--; showStep(currentStep);
});

document.getElementById('registrationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    let valid = true;
    for (let i = 1; i <= totalSteps; i++) {
        if (!validateStep(i)) {
            if (valid) { valid = false; currentStep = i; showStep(i); }
        }
    }
    if (!valid) return;

    const loadingModal = document.getElementById('loadingModal');
    const successModal = document.getElementById('successModal');
    loadingModal.classList.remove('hidden');

    fetch('{{ route("santri.registration.store") }}', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: new FormData(this)
    })
    .then(r => r.json().then(data => ({ status: r.status, body: data })))
    .then(({ status, body }) => {
        loadingModal.classList.add('hidden');
        if (body.success) {
            clearDraft();
            successModal.classList.remove('hidden');
        } else if (body.errors) {
            let firstStepWithError = null;
            for (const [key, messages] of Object.entries(body.errors)) {
                const el = document.getElementById(key) || document.getElementsByName(key)[0];
                if (el) {
                    validateField(el); // trigger display
                    const fg = el.closest('.form-group');
                    if (fg) {
                        const errSpan = fg.querySelector('.error-message');
                        if (errSpan) { errSpan.textContent = messages[0]; errSpan.classList.remove('hidden'); }
                        el.classList.add('border-red-400');
                    }
                    if (!firstStepWithError) {
                        const stepEl = el.closest('.form-step');
                        if (stepEl) firstStepWithError = parseInt(stepEl.dataset.step);
                    }
                }
            }
            if (firstStepWithError) { currentStep = firstStepWithError; showStep(currentStep); }
        } else {
            alert('Terjadi kesalahan: ' + (body.message || 'Silakan coba lagi.'));
        }
    })
    .catch(err => { loadingModal.classList.add('hidden'); alert('Koneksi error: ' + err.message); });
});

// Per-field validation events
document.querySelectorAll('#registrationForm input,#registrationForm select,#registrationForm textarea').forEach(f => {
    f.addEventListener('blur', function() { validateField(this); });
    f.addEventListener('input', function() { if (this.classList.contains('border-red-400')) validateField(this); });
});
const nisnEl = document.getElementById('nisn');
if (nisnEl) nisnEl.addEventListener('blur', function() { checkDuplicateNisn(this); });

// ================== AUTOSAVE / DRAFT ==================
const DRAFT_KEY = 'ppdb_form_draft_v2';

function getFields() {
    return document.querySelectorAll('#registrationForm input:not([type=hidden]),#registrationForm select,#registrationForm textarea');
}

function saveDraft() {
    const draft = {};
    getFields().forEach(f => { if (f.name) draft[f.name] = f.value; });
    localStorage.setItem(DRAFT_KEY, JSON.stringify(draft));
}

function restoreDraft() {
    let draft; try { draft = JSON.parse(localStorage.getItem(DRAFT_KEY)); } catch(e) { return; }
    if (!draft) return;
    let hasData = false;
    getFields().forEach(f => { if (f.name && draft[f.name]) { f.value = draft[f.name]; hasData = true; } });
    if (hasData) showDraftBanner();
}

function clearDraft() { localStorage.removeItem(DRAFT_KEY); }

function showDraftBanner() {
    if (document.getElementById('draftBanner')) return;
    const banner = document.createElement('div');
    banner.id = 'draftBanner';
    banner.style.cssText = 'position:fixed;top:0;left:0;right:0;z-index:9999;background:#0d9488;color:white;padding:10px 20px;display:flex;align-items:center;justify-content:space-between;font-size:14px;box-shadow:0 2px 8px rgba(0,0,0,.2)';
    banner.innerHTML = '<span>&#128221; <strong>Draft tersimpan</strong> — Data sebelumnya telah dipulihkan secara otomatis.</span><button id="clearDraftBtn" style="background:rgba(255,255,255,.25);border:none;color:white;padding:4px 14px;border-radius:6px;cursor:pointer;font-size:13px;margin-left:16px">Hapus Draft</button>';
    document.body.prepend(banner);
    document.getElementById('clearDraftBtn').onclick = function() {
        clearDraft(); getFields().forEach(f => f.value = ''); banner.remove();
    };
    setTimeout(() => { if (banner.parentNode) banner.remove(); }, 10000);
}

getFields().forEach(f => { f.addEventListener('input', saveDraft); f.addEventListener('change', saveDraft); });

restoreDraft();
showStep(1);
</script>
</x-app-layout>
