<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index()
    {
        // Set the base URL based on your environment
        $baseUrl = config('app.url');

        // Get all projects
        $projects = Project::all();

        // Get current date for lastmod
        $today = date('Y-m-d');

        // Create XML content
        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Add main pages
        $routes = [
            '/' => ['priority' => '1.0', 'changefreq' => 'monthly'],
            '/projects' => ['priority' => '0.8', 'changefreq' => 'weekly'],
            '/experiences' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            '/skills' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/education' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/certifications' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/about' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            '/contact' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            '/lang/en' => ['priority' => '0.5', 'changefreq' => 'monthly'],
            '/lang/ar' => ['priority' => '0.5', 'changefreq' => 'monthly'],
        ];

        foreach ($routes as $route => $options) {
            $content .= "    <url>\n";
            $content .= "        <loc>" . $baseUrl . $route . "</loc>\n";
            $content .= "        <lastmod>" . $today . "</lastmod>\n";
            $content .= "        <changefreq>" . $options['changefreq'] . "</changefreq>\n";
            $content .= "        <priority>" . $options['priority'] . "</priority>\n";
            $content .= "    </url>\n";
        }

        // Add project pages
        foreach ($projects as $project) {
            $content .= "    <url>\n";
            $content .= "        <loc>" . $baseUrl . "/project/" . $project->slug . "</loc>\n";
            $content .= "        <lastmod>" . $project->updated_at->format('Y-m-d') . "</lastmod>\n";
            $content .= "        <changefreq>monthly</changefreq>\n";
            $content .= "        <priority>0.6</priority>\n";
            $content .= "    </url>\n";
        }

        $content .= '</urlset>';

        // Return XML response
        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}
