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
        // Add columns only if they don't exist - simple and fast
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'slug')) {
                $table->string('slug')->nullable()->after('id')->index();
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

        // Note: Run 'php artisan projects:generate-slugs' after migration
        // Note: Run 'php artisan projects:add-unique-constraint' after generating slugs
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Drop unique constraint if exists
            try {
                $table->dropUnique(['slug']);
            } catch (Exception $e) {
                // Constraint doesn't exist, continue
            }

            // Drop columns if they exist
            $columnsToRemove = ['slug', 'meta_description_ar', 'meta_description_en', 'meta_keywords_ar', 'meta_keywords_en'];
            $existingColumns = [];

            foreach ($columnsToRemove as $column) {
                if (Schema::hasColumn('projects', $column)) {
                    $existingColumns[] = $column;
                }
            }

            if (!empty($existingColumns)) {
                $table->dropColumn($existingColumns);
            }
        });
    }
};