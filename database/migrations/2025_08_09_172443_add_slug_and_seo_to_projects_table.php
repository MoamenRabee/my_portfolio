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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->unique()->after('id');
            $table->text('meta_description_ar')->nullable()->after('description_en');
            $table->text('meta_description_en')->nullable()->after('meta_description_ar');
            $table->text('meta_keywords_ar')->nullable()->after('meta_description_en');
            $table->text('meta_keywords_en')->nullable()->after('meta_keywords_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['slug', 'meta_description_ar', 'meta_description_en', 'meta_keywords_ar', 'meta_keywords_en']);
        });
    }
};
