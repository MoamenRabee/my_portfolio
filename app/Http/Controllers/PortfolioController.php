<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Education;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{

    public function changeLanguage($locale)
    {
        if (in_array($locale, ['ar', 'en'])) {
            session()->put('locale', $locale);
            app()->setLocale($locale);
        }

        return redirect()->back();
    }

    public function index()
    {
        $config = Config::first();
        $experiences = Experience::orderBy('start_date', 'desc')->get();
        $projects = Project::with(['skills', 'images', 'experience'])->get();
        $skills = Skill::with('projects')->get();

        return view('portfolio.index', compact('config', 'experiences', 'projects', 'skills'));
    }

    public function projects()
    {
        $config = Config::first();
        $projects = Project::with(['skills', 'images', 'experience'])->get();

        return view('portfolio.projects', compact('config', 'projects'));
    }

    public function project($id)
    {
        $config = Config::first();
        $project = Project::with(['skills', 'images', 'experience'])->findOrFail($id);

        return view('portfolio.project-detail', compact('config', 'project'));
    }

    public function experiences()
    {
        $config = Config::first();
        $experiences = Experience::orderBy('start_date', 'desc')->get();

        return view('portfolio.experiences', compact('config', 'experiences'));
    }

    public function skills()
    {
        $config = Config::first();
        $skills = Skill::with('projects')->get();

        return view('portfolio.skills', compact('config', 'skills'));
    }

    public function about()
    {
        $config = Config::first();
        $educations = Education::orderBy('start_date', 'desc')->get();
        $certifications = Certification::orderBy('issue_date', 'desc')->get();

        return view('portfolio.about', compact('config', 'educations', 'certifications'));
    }

    public function contact()
    {
        $config = Config::first();

        return view('portfolio.contact', compact('config'));
    }

    public function education()
    {
        $config = Config::first();
        $educations = Education::orderBy('start_date', 'desc')->get();

        return view('portfolio.education', compact('config', 'educations'));
    }

    public function certifications()
    {
        $config = Config::first();
        $certifications = Certification::orderBy('issue_date', 'desc')->get();

        return view('portfolio.certifications', compact('config', 'certifications'));
    }

    public function downloadCV()
    {
        $config = Config::first();

        if (!$config || !$config->cv) {
            abort(404, 'CV not found');
        }

        $filePath = storage_path('app/public/' . $config->cv);

        if (!file_exists($filePath)) {
            abort(404, 'CV file not found');
        }

        $fileName = 'CV_' . str_replace(' ', '_', $config->name_en) . '.pdf';

        return Storage::disk('public')->download($config->cv, $fileName);
    }
}
