<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormGroup;
use App\Models\School;
use App\Models\Angkatan;

class UserController extends Controller
{
    public function dashboard()
    {
        // Ambil sekolah dengan ID tertentu, atau buat default jika tidak ada
        $schools = School::find(1) ?? new School(['name' => 'MI Tahfizh Al Furqon']);
        
        // Ambil semua form group beserta atributnya
        $formGroup = FormGroup::select('id_form', 'name', 'description')->where('is_active', true)->get();
        $angkatanAktif = Angkatan::open()->orderBy('tanggal_mulai_daftar')->first();
        $jadwalPendaftaran = $angkatanAktif
            ?: Angkatan::where('is_active', true)
                ->orderByRaw("CASE WHEN tanggal_mulai_daftar >= ? THEN 0 ELSE 1 END", [now()->toDateString()])
                ->orderBy('tanggal_mulai_daftar')
                ->first();
    
        return view('user.dashboard', compact('formGroup', 'schools', 'angkatanAktif', 'jadwalPendaftaran'));
    }
    
}
