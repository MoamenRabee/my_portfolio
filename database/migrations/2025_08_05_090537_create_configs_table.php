<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('job_title_ar')->nullable();
            $table->string('job_title_en')->nullable();
            $table->text('summary_ar')->nullable();
            $table->text('summary_en')->nullable();
            $table->text('about_me_ar')->nullable();
            $table->text('about_me_en')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('logo')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('cv')->nullable();
            $table->string('copyright_ar')->nullable();
            $table->string('copyright_en')->nullable();
            $table->string('site_name')->nullable();
            $table->string('site_description')->nullable();
            $table->text('site_keywords')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('github')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('telegram')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('google_play')->nullable();
            $table->string('app_store')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
