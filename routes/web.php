<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

// Language Switch Route
Route::get('/lang/{locale}', [PortfolioController::class, 'changeLanguage'])->name('lang.switch');

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/projects', [PortfolioController::class, 'projects'])->name('portfolio.projects');
Route::get('/project/{id}', [PortfolioController::class, 'project'])->name('portfolio.project');
Route::get('/experiences', [PortfolioController::class, 'experiences'])->name('portfolio.experiences');
Route::get('/skills', [PortfolioController::class, 'skills'])->name('portfolio.skills');
Route::get('/education', [PortfolioController::class, 'education'])->name('portfolio.education');
Route::get('/certifications', [PortfolioController::class, 'certifications'])->name('portfolio.certifications');
Route::get('/about', [PortfolioController::class, 'about'])->name('portfolio.about');
Route::get('/contact', [PortfolioController::class, 'contact'])->name('portfolio.contact');
Route::get('/download-cv', [PortfolioController::class, 'downloadCV'])->name('portfolio.downloadCV');
