<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Santri;
use App\Models\OrangTua;
use App\Models\Angkatan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SantriRegistrationController extends Controller
{
    public function showForm()
    {
        // Cek apakah ada angkatan yang sedang membuka pendaftaran hari ini
        $angkatanAktif = Angkatan::open()->orderBy('tanggal_mulai_daftar')->first();
        $jadwalPendaftaran = $angkatanAktif
            ?: Angkatan::where('is_active', true)
                ->orderByRaw("CASE WHEN tanggal_mulai_daftar >= ? THEN 0 ELSE 1 END", [now()->toDateString()])
                ->orderBy('tanggal_mulai_daftar')
                ->first();

        return view('santri.registration', compact('angkatanAktif', 'jadwalPendaftaran'));
    }

    public function showStatus($id)
    {
        $santri = Santri::with(['orangTua'])
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('santri.status', compact('santri'));
    }

    public function store(Request $request)
    {
        $angkatanAktif = Angkatan::open()->orderBy('tanggal_mulai_daftar')->first();
        if (!$angkatanAktif) {
            return response()->json([
                'success' => false,
                'message' => 'Pendaftaran saat ini belum dibuka atau sudah ditutup.',
            ], 422);
        }

        // 1. Cek duplikasi manual terlebih dahulu sebelum validasi lainnya
        $duplicateSantri = Santri::where('nisn', $request->nisn)->first();

        if ($duplicateSantri) {
            return response()->json([
                'success' => false,
                'message' => 'Data santri sudah pernah didaftarkan.',
                'errors' => [
                    'nisn' => ['Data santri dengan NISN ini sudah pernah didaftarkan.']
                ]
            ], 422);
        }

        // Validasi data
        $validator = Validator::make($request->all(), [
            // Data Calon Peserta Didik
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nisn' => 'required|digits:10',
            
            // Data Asal Sekolah
            'sekolah_asal' => 'required|string|max:255',
            'nsm' => 'required|numeric',
            'npsn' => 'required|numeric',
            'alamat_sekolah_asal' => 'required|string',
            
            // Data Orang Tua/Wali
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'no_hp_wa' => ['required', 'string', 'regex:/^(08|628|\\+628)[0-9]{8,13}$/'],
            'alamat' => 'required|string',
            
            // Pilihan Program & Info Tambahan
            'program_pilihan' => 'required|in:Program Khusus,Bina Prestasi',
            'info_ppdb' => 'required|in:Media Sosial,Website,Teman/Keluarga,Alumni,Spanduk/Brosur,Lainnya',
        ], [
            // Custom error messages
            'nisn.digits' => 'NISN harus terdiri dari 10 digit',
            'no_hp_wa.regex' => 'Format nomor HP/WhatsApp tidak valid (contoh: 08123456789)',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Normalisasi nomor HP/WA ke format 62xxx
            $noHpWa = $request->no_hp_wa;
            $noHpWa = preg_replace('/^\+/', '', $noHpWa);
            if (preg_match('/^08/', $noHpWa)) {
                $noHpWa = '62' . substr($noHpWa, 1);
            }

            DB::transaction(function () use ($request, $noHpWa, $angkatanAktif, &$santri) {
            $orangTua = OrangTua::create([
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'no_hp_wa' => $noHpWa,
                'alamat' => $request->alamat,
            ]);

            $santri = Santri::create([
                'nama_lengkap'        => $request->nama_lengkap,
                'jenis_kelamin'       => $request->jenis_kelamin,
                'tempat_lahir'        => $request->tempat_lahir,
                'tanggal_lahir'       => $request->tanggal_lahir,
                'nisn'                => $request->nisn,
                'sekolah_asal'        => $request->sekolah_asal,
                'nsm'                 => $request->nsm,
                'npsn'                => $request->npsn,
                'alamat_sekolah_asal' => $request->alamat_sekolah_asal,
                'program_pilihan'     => $request->program_pilihan,
                'info_ppdb'           => $request->info_ppdb,
                'status'              => 'menunggu_verifikasi',
                'tahun_ajaran'        => $angkatanAktif ? $angkatanAktif->tahun_ajaran : date('Y') . '/' . (date('Y') + 1),
                'angkatan_id'         => $angkatanAktif ? $angkatanAktif->id : null,
                'user_id'             => auth()->id(),
                'orang_tua_id'        => $orangTua->id,
            ]);
            });

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil disimpan',
                'santri_id' => $santri->id
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function checkDuplicate(Request $request)
    {
        $type = $request->input('type');
        $value = $request->input('value');

        if ($type !== 'nisn' || !$value) {
            return response()->json(['duplicate' => false]);
        }

        $duplicate = Santri::where('nisn', $value)->exists();

        return response()->json([
            'duplicate' => $duplicate,
            'message' => $duplicate ? 'Data santri sudah pernah didaftarkan.' : null
        ]);
    }
}
