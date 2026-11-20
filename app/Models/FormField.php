<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $table = 'form_fields'; // Nama tabel
    protected $primaryKey = 'id_field'; // Primary key

    protected $fillable = ['id_form', 'name', 'type', 'label', 'placeholder', 'options', 'required'];

    public function formGroup()
    {
        return $this->belongsTo(FormGroup::class, 'id_form', 'id_form'); // Relasi ke form_groups
    }
}
