<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    protected $table = 'santri';

    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nisn',
        'sekolah_asal',
        'nsm',
        'npsn',
        'alamat_sekolah_asal',
        'program_pilihan',
        'info_ppdb',
        'status',
        'tahun_ajaran',
        'angkatan_id',
        'user_id',
        'orang_tua_id'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class);
    }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }

    /**
     * Hitung Kelas Santri secara otomatis berdasarkan tahun pendaftaran:
     * - Tahun Pendaftaran (Tahun 1) = Kelas 1 MTs
     * - Tahun Ke-2 (+1 tahun)       = Kelas 2 MTs
     * - Tahun Ke-3 (+2 tahun)       = Kelas 3 MTs
     * - Tahun Ke-4+                 = Alumni / Lulus
     */
    public function getKelasSekarangAttribute(): string
    {
        $regYear = (int) substr($this->tahun_ajaran ?? '', 0, 4);
        if (!$regYear && $this->created_at) {
            $regYear = (int) $this->created_at->format('Y');
        }
        if (!$regYear) {
            $regYear = (int) date('Y');
        }

        $currentYear = (int) date('Y');
        $diff = $currentYear - $regYear;

        if ($diff <= 0) {
            return 'Kelas 1 MTs';
        } elseif ($diff == 1) {
            return 'Kelas 2 MTs';
        } elseif ($diff == 2) {
            return 'Kelas 3 MTs';
        } else {
            return 'Alumni / Lulus';
        }
    }
}
