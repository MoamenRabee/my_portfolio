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
        // Step 1: Add columns only if they don't exist
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'slug')) {
                $table->string('slug')->nullable()->after('id');
            }
            if (!Schema::hasColumn('projects', 'meta_description_ar')) {
                $table->text('meta_description_ar')->nullable()->after('description_en');
            }
            if (!Schema::hasColumn('projects', 'meta_description_en')) {
                $table->text('meta_description_en')->nullable()->after('meta_description_ar');
            }
            if (!Schema::hasColumn('projects', 'meta_keywords_ar')) {
                $table->text('meta_keywords_ar')->nullable()->after('meta_description_en');
            }
            if (!Schema::hasColumn('projects', 'meta_keywords_en')) {
                $table->text('meta_keywords_en')->nullable()->after('meta_keywords_ar');
            }
        });

        // Step 2: Generate slugs for existing projects
        $projects = \App\Models\Project::whereNull('slug')->orWhere('slug', '')->get();
        foreach ($projects as $project) {
            $project->slug = $project->generateSlug();
            $project->save();
        }

        // Step 3: Add unique constraint if it doesn't exist
        if (!$this->hasUniqueConstraint('projects', 'slug')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->unique('slug');
            });
        }
    }

    /**
     * Check if unique constraint exists
     */
    private function hasUniqueConstraint($table, $column)
    {
        $indexes = collect(\DB::select("SHOW INDEX FROM {$table}"))
            ->where('Key_name', 'like', '%' . $column . '%')
            ->where('Non_unique', 0);

        return $indexes->isNotEmpty();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if ($this->hasUniqueConstraint('projects', 'slug')) {
                $table->dropUnique(['slug']);
            }

            $columnsToRemove = [];
            if (Schema::hasColumn('projects', 'slug')) {
                $columnsToRemove[] = 'slug';
            }
            if (Schema::hasColumn('projects', 'meta_description_ar')) {
                $columnsToRemove[] = 'meta_description_ar';
            }
            if (Schema::hasColumn('projects', 'meta_description_en')) {
                $columnsToRemove[] = 'meta_description_en';
            }
            if (Schema::hasColumn('projects', 'meta_keywords_ar')) {
                $columnsToRemove[] = 'meta_keywords_ar';
            }
            if (Schema::hasColumn('projects', 'meta_keywords_en')) {
                $columnsToRemove[] = 'meta_keywords_en';
            }

            if (!empty($columnsToRemove)) {
                $table->dropColumn($columnsToRemove);
            }
        });
    }
};
