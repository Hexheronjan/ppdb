<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools'; // Nama tabel
    protected $primaryKey = 'id_school'; // Primary key
    
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'principal_name'
    ];
}
