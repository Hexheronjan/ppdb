<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = [
        'field_name', 
        'value', 
        'submission_id',
        'user_id',
        'status',
        'file_path',
        'form_group_id',
        'registration_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function formGroup()
    {
        return $this->belongsTo(FormGroup::class, 'form_group_id', 'id_form');
    }
}

