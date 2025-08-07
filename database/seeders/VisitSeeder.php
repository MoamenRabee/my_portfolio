<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visit;
use Carbon\Carbon;
use Faker\Factory as Faker;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $pages = [
            ['url' => '/', 'title' => 'Home'],
            ['url' => '/projects', 'title' => 'Projects'],
            ['url' => '/experiences', 'title' => 'Experiences'],
            ['url' => '/skills', 'title' => 'Skills'],
            ['url' => '/education', 'title' => 'Education'],
            ['url' => '/certifications', 'title' => 'Certifications'],
            ['url' => '/about', 'title' => 'About'],
            ['url' => '/contact', 'title' => 'Contact'],
        ];

        // Generate visits for the last 30 days
        for ($day = 30; $day >= 0; $day--) {
            $date = Carbon::now()->subDays($day);

            // Random number of visits per day (5-50)
            $visitsPerDay = rand(5, 50);

            for ($i = 0; $i < $visitsPerDay; $i++) {
                $page = $pages[array_rand($pages)];

                Visit::create([
                    'ip_address' => $faker->ipv4,
                    'user_agent' => $faker->userAgent,
                    'page_url' => $page['url'],
                    'page_title' => $page['title'],
                    'referer' => $faker->optional()->url,
                    'country' => $faker->country,
                    'city' => $faker->city,
                    'visited_at' => $date->copy()->addHours(rand(0, 23))->addMinutes(rand(0, 59)),
                ]);
            }
        }
    }
}
