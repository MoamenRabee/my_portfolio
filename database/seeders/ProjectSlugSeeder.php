<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSlugSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $projects = Project::whereNull('slug')->orWhere('slug', '')->get();

        foreach ($projects as $project) {
            $project->slug = $project->generateSlug();
            $project->save();
        }

        $this->command->info('Generated slugs for ' . $projects->count() . ' projects.');
    }
}
