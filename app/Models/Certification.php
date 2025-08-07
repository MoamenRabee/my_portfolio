<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $table = 'certifications';

    protected $fillable = [
        'name_ar',
        'name_en',
        'issuing_organization_ar',
        'issuing_organization_en',
        'issue_date',
        'expiry_date',
        'credential_id',
        'credential_url',
        'description_ar',
        'description_en'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date'
    ];
}
