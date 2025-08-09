<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Add columns without unique constraint first
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('id');
            $table->text('meta_description_ar')->nullable()->after('description_en');
            $table->text('meta_description_en')->nullable()->after('meta_description_ar');
            $table->text('meta_keywords_ar')->nullable()->after('meta_description_en');
            $table->text('meta_keywords_en')->nullable()->after('meta_keywords_ar');
        });

        // Step 2: Generate slugs for existing projects
        $projects = \App\Models\Project::whereNull('slug')->orWhere('slug', '')->get();
        foreach ($projects as $project) {
            $project->slug = $project->generateSlug();
            $project->save();
        }

        // Step 3: Add unique constraint after slugs are generated
        Schema::table('projects', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'meta_description_ar', 'meta_description_en', 'meta_keywords_ar', 'meta_keywords_en']);
        });
    }
};
