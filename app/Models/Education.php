<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'degree_ar',
        'degree_en',
        'institution_ar',
        'institution_en',
        'field_of_study_ar',
        'field_of_study_en',
        'gpa',
        'gpa_scale',
        'start_date',
        'end_date',
        'description_ar',
        'description_en',
        'location'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'gpa' => 'decimal:2'
    ];
}
