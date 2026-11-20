<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Angkatan extends Model
{
    protected $table = 'angkatan';

    protected $fillable = [
        'nama_angkatan',
        'tahun_ajaran',
        'tanggal_mulai_daftar',
        'tanggal_tutup_daftar',
        'jam_mulai_daftar',
        'jam_tutup_daftar',
        'is_active',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_mulai_daftar' => 'date',
        'tanggal_tutup_daftar' => 'date',
        'is_active'            => 'boolean',
    ];

    public function santri()
    {
        return $this->hasMany(Santri::class);
    }

    /**
     * Cek apakah pendaftaran angkatan ini sedang buka hari ini.
     */
    public function isPendaftaranOpen(): bool
    {
        return $this->registrationStatus() === 'dibuka';
    }

    public function registrationStatus(): string
    {
        if (!$this->is_active) {
            return 'nonaktif';
        }

        $now = now();
        if ($now->lt($this->registration_starts_at)) {
            return 'akan_dibuka';
        }

        return $now->lte($this->registration_ends_at) ? 'dibuka' : 'ditutup';
    }

    public function getRegistrationStartsAtAttribute(): Carbon
    {
        return $this->tanggal_mulai_daftar->copy()
            ->setTimeFromTimeString($this->jam_mulai_daftar ?: '00:00:00');
    }

    public function getRegistrationEndsAtAttribute(): Carbon
    {
        // Data lama tanpa jam tetap berlaku sepanjang hari terakhirnya.
        return $this->tanggal_tutup_daftar->copy()
            ->setTimeFromTimeString($this->jam_tutup_daftar ?: '23:59:59');
    }

    /**
     * Scope: hanya angkatan yang sedang buka pendaftarannya hari ini.
     */
    public function scopeOpen($query)
    {
        $today = now()->toDateString();
        $time = now()->format('H:i:s');
        return $query->where('is_active', true)
            ->where(function ($query) use ($today, $time) {
                $query->where('tanggal_mulai_daftar', '<', $today)
                    ->orWhere(function ($query) use ($today, $time) {
                        $query->where('tanggal_mulai_daftar', $today)
                            ->whereRaw("COALESCE(jam_mulai_daftar, '00:00:00') <= ?", [$time]);
                    });
            })
            ->where(function ($query) use ($today, $time) {
                $query->where('tanggal_tutup_daftar', '>', $today)
                    ->orWhere(function ($query) use ($today, $time) {
                        $query->where('tanggal_tutup_daftar', $today)
                            ->whereRaw("COALESCE(jam_tutup_daftar, '23:59:59') >= ?", [$time]);
                    });
            });
    }
}
