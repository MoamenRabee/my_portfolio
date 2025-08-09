<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $projects = Project::select('slug', 'updated_at')->get();
        $config = Config::first();

        $content = view('sitemap.sitemap', compact('projects', 'config'))->render();

        return response($content, 200, [
            'Content-Type' => 'text/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600'
        ]);
    }

    public function projects()
    {
        $projects = Project::select('slug', 'updated_at', 'created_at')->get();

        $content = view('sitemap.sitemap', compact('projects'))->render();

        return response($content, 200, [
            'Content-Type' => 'text/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600'
        ]);
    }
}
