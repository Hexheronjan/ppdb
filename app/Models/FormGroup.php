<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormGroup extends Model
{
    use HasFactory;

    protected $table = 'form_groups'; // Nama tabel di database
    protected $primaryKey = 'id_form'; // Kolom primary key yang digunakan

    protected $fillable = ['name', 'description', 'academic_year', 'category', 'is_active'];

    public function fields()
    {
        return $this->hasMany(FormField::class, 'id_form', 'id_form'); // Relasi ke tabel fields
    }

    public function formSubmissions()
{
    return $this->hasMany(FormSubmission::class, 'form_group_id', 'id_form');
}
}
