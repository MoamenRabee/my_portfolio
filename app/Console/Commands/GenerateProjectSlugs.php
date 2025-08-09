<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateProjectSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projects:generate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for existing projects';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating slugs for existing projects...');

        $projects = Project::whereNull('slug')->orWhere('slug', '')->get();

        if ($projects->isEmpty()) {
            $this->info('No projects need slug generation.');
            return;
        }

        $progressBar = $this->output->createProgressBar($projects->count());
        $progressBar->start();

        foreach ($projects as $project) {
            $project->slug = $project->generateSlug();
            $project->save();
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();
        $this->info('Successfully generated slugs for ' . $projects->count() . ' projects.');
    }
}
