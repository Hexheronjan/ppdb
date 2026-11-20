<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $table = 'orang_tua';

    protected $fillable = [
        'nama_ayah',
        'nama_ibu',
        'no_hp_wa',
        'alamat'
    ];

    protected $casts = [];

    public function santri()
    {
        return $this->hasOne(Santri::class);
    }
}
