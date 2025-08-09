<?php

namespace App\Models;

use App\Services\GoogleSearchConsoleService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title_ar',
        'title_en',
        'slug',
        'description_ar',
        'description_en',
        'meta_description_ar',
        'meta_description_en',
        'meta_keywords_ar',
        'meta_keywords_en',
        'website_link',
        'google_play_link',
        'app_store_link',
        'github_link',
        'experience_id',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generate slug when creating
        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = $project->generateSlug($project->title);
            }
        });

        // Regenerate slug when title changes
        static::updating(function ($project) {
            if ($project->isDirty('title') && empty($project->slug)) {
                $project->slug = $project->generateSlug($project->title);
            }
        });

        // Notify Google after creating, updating, or deleting projects
        static::created(function ($project) {
            \App\Services\GoogleSearchConsoleService::quickNotify();
        });

        static::updated(function ($project) {
            \App\Services\GoogleSearchConsoleService::quickNotify();
        });

        static::deleted(function ($project) {
            \App\Services\GoogleSearchConsoleService::quickNotify();
        });
    }

    public function generateSlug()
    {
        $title = $this->title_en ?? $this->title_ar;
        $slug = Str::slug($title);

        // Check if slug exists and append number if needed
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'project_skills');
    }

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }

    // SEO Helper Methods
    public function getMetaTitle()
    {
        $title = app()->getLocale() == 'ar' ? $this->title_ar : $this->title_en;
        return $title;
    }

    public function getMetaDescription()
    {
        $metaDescription = app()->getLocale() == 'ar' ? $this->meta_description_ar : $this->meta_description_en;
        if ($metaDescription) {
            return $metaDescription;
        }

        // Fallback to regular description
        $description = app()->getLocale() == 'ar' ? $this->description_ar : $this->description_en;
        return $description ? Str::limit(strip_tags($description), 160) : '';
    }

    public function getMetaKeywords()
    {
        $keywords = app()->getLocale() == 'ar' ? $this->meta_keywords_ar : $this->meta_keywords_en;
        if ($keywords) {
            return $keywords;
        }

        // Fallback to skills
        return $this->skills->pluck('name')->implode(', ');
    }
}
