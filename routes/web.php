<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;

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

// Contact Form Route
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Contact Form Example Page (for testing)
Route::get('/contact-form', function () {
    return view('contact-form-example-en');
})->name('contact.form');

// Contact Test Page
Route::get('/contact-test', function () {
    return view('contact-test');
})->name('contact.test');

// Contact Simple Form (shows success page)
Route::get('/contact-simple', function () {
    return view('contact-simple');
})->name('contact.simple');

// Contact Popup Form (multilingual with popups)
Route::get('/contact-popup', function () {
    return view('contact-popup');
})->name('contact.popup');
