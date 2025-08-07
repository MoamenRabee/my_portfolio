<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'job_title_ar',
        'job_title_en',
        'summary_ar',
        'summary_en',
        'about_me_ar',
        'about_me_en',
        'phone',
        'email',
        'address',
        'logo',
        'profile_image',
        'cv',
        'copyright_ar',
        'copyright_en',
        'site_name',
        'site_description',
        'site_keywords',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'youtube',
        'whatsapp',
        'github',
        'pinterest',
        'tiktok',
        'telegram',
        'snapchat',
        'google_play',
        'app_store'
    ];
}
