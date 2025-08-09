<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddProjectSlugUniqueConstraint extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projects:add-unique-constraint';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add unique constraint to projects slug column';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Adding unique constraint to projects slug column...');

        // Check if unique constraint already exists
        if ($this->hasUniqueConstraint('projects', 'slug')) {
            $this->info('Unique constraint already exists on slug column.');
            return;
        }

        // Check for duplicate slugs
        $duplicates = DB::table('projects')
            ->select('slug', DB::raw('COUNT(*) as count'))
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->groupBy('slug')
            ->having('count', '>', 1)
            ->get();

        if ($duplicates->isNotEmpty()) {
            $this->error('Found duplicate slugs:');
            foreach ($duplicates as $duplicate) {
                $this->line("  - '{$duplicate->slug}' appears {$duplicate->count} times");
            }
            $this->error('Please run "php artisan projects:generate-slugs" first to fix duplicates.');
            return;
        }

        // Add unique constraint
        try {
            Schema::table('projects', function ($table) {
                $table->unique('slug');
            });

            $this->info('✅ Unique constraint added successfully to projects.slug column.');
        } catch (\Exception $e) {
            $this->error('❌ Failed to add unique constraint: ' . $e->getMessage());
        }
    }

    /**
     * Check if unique constraint exists
     */
    private function hasUniqueConstraint($table, $column)
    {
        $indexes = collect(DB::select("SHOW INDEX FROM {$table}"))
            ->where('Key_name', 'like', '%' . $column . '%')
            ->where('Non_unique', 0);

        return $indexes->isNotEmpty();
    }
}
