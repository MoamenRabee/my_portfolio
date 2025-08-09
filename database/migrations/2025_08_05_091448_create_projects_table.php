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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_ar');
            $table->string('title_en');
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->text('meta_keywords_ar')->nullable();
            $table->text('meta_keywords_en')->nullable();
            $table->string('website_link')->nullable();
            $table->string('google_play_link')->nullable();
            $table->string('app_store_link')->nullable();
            $table->string('github_link')->nullable();
            $table->foreignId('experience_id')->nullable()->constrained('experiences')->nullOnDelete();
            $table->timestamps();

            // Add indexes
            $table->index('slug');
            $table->index('experience_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
