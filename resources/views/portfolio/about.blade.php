@extends('portfolio.layout')

@section('title', __('message.about') . ' - ' . ($config->site_name ?? 'Portfolio'))

@section('content')
    <!-- Hero Section -->
    <section class="gradient-bg py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-white" data-aos="fade-right">
                    <h1 class="text-5xl font-bold mb-6">
                        {{ __('message.about_me') }}
                    </h1>
                    <h2 class="text-2xl mb-6 text-blue-200">
                        {{ app()->getLocale() == 'ar' ? ($config->name_ar ?? '') : ($config->name_en ?? '') }}
                    </h2>
                    <p class="text-xl text-blue-100 leading-relaxed mb-8">
                        {{ app()->getLocale() == 'ar' ? ($config->job_title_ar ?? '') : ($config->job_title_en ?? '') }}
                    </p>
                    
                    <!-- CV Download Button -->
                    <div class="flex {{ app()->getLocale() == 'ar' ? 'justify-end' : 'justify-start' }}">
                        <a href="{{ route('portfolio.downloadCV') }}" target="_blank"
                           class="inline-flex items-center bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-blue-50 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <i class="fas fa-download {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            {{ app()->getLocale() == 'ar' ? 'تحميل السيرة الذاتية' : 'Download CV' }}
                        </a>
                    </div>
                </div>

                <div class="text-center" data-aos="fade-left">
                    @if($config->profile_image)
                        <img src="{{ asset('storage/' . $config->profile_image) }}"
                            alt="{{ $config->name_ar ?? $config->name_en }}"
                            class="w-80 h-80 rounded-full object-cover shadow-2xl border-8 border-white/20 mx-auto">
                    @else
                        <div
                            class="w-80 h-80 rounded-full bg-white/20 flex items-center justify-center text-6xl text-white mx-auto">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl dark:shadow-gray-900/50 p-8 lg:p-12"
                data-aos="fade-up">
                @if($config->about_me_ar || $config->about_me_en)
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-8 text-center">
                        {{ __('message.hello') }}, {{ __('message.about_me') }}
                        {{ app()->getLocale() == 'ar' ? ($config->name_ar ?? '') : ($config->name_en ?? '') }}
                    </h2>

                    <div class="prose prose-lg max-w-none text-gray-700 dark:text-gray-300 leading-relaxed">
                        {!! nl2br(e(app()->getLocale() == 'ar' ? $config->about_me_ar : $config->about_me_en)) !!}
                    </div>
                @else
                    <div class="text-center py-12">
                        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">
                            {{ __('message.hello') }}, {{ __('message.about_me') }}
                            {{ app()->getLocale() == 'ar' ? ($config->name_ar ?? '') : ($config->name_en ?? '') }}
                        </h2>
                        <p class="text-xl text-gray-600 dark:text-gray-300">
                            {{ __('message.info_coming_soon') }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Quick Facts -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">
                    {{ __('message.quick_facts') }}
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    {{ __('message.quick_facts_desc') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="w-16 h-16 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-briefcase text-2xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    @php
                        $totalExperience = \App\Models\Experience::count();
                    @endphp
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $totalExperience }}+</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('message.years_experience') }}</p>
                </div>

                <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="w-16 h-16 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-project-diagram text-2xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    @php
                        $totalProjects = \App\Models\Project::count();
                    @endphp
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $totalProjects }}+</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('message.completed_projects') }}</p>
                </div>

                <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="w-16 h-16 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-code text-2xl text-green-600 dark:text-green-400"></i>
                    </div>
                    @php
                        $totalSkills = \App\Models\Skill::count();
                    @endphp
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $totalSkills }}+</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('message.technical_skills') }}</p>
                </div>

                <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                    <div
                        class="w-16 h-16 bg-orange-100 dark:bg-orange-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-building text-2xl text-orange-600 dark:text-orange-400"></i>
                    </div>
                    @php
                        $totalCompanies = \App\Models\Experience::distinct('company_name_en')->count();
                    @endphp
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $totalCompanies }}+</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('message.companies') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Information -->
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Details -->
                <div data-aos="fade-right">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">
                        {{ __('message.contact_info') }}
                    </h2>

                    <div class="space-y-6">
                        @if($config->email)
                            <div class="flex items-center">
                                <div
                                    class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center {{ app()->getLocale() == 'ar' ? 'ml-4' : 'mr-4' }}">
                                    <i class="fas fa-envelope text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">{{ __('message.email') }}</h3>
                                    <a href="mailto:{{ $config->email }}"
                                        class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
                                        {{ $config->email }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if($config->phone)
                            <div class="flex items-center">
                                <div
                                    class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center {{ app()->getLocale() == 'ar' ? 'ml-4' : 'mr-4' }}">
                                    <i class="fas fa-phone text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">{{ __('message.phone') }}</h3>
                                    <a href="tel:{{ $config->phone }}"
                                        class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
                                        {{ $config->phone }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if($config->address)
                            <div class="flex items-center">
                                <div
                                    class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center {{ app()->getLocale() == 'ar' ? 'ml-4' : 'mr-4' }}">
                                    <i class="fas fa-map-marker-alt text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">{{ __('message.location') }}</h3>
                                    <p class="text-gray-600 dark:text-gray-300">{{ $config->address }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Social Links -->
                    <div class="mt-8">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ __('message.follow_me') }}</h3>
                        <div class="flex {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-4' : 'space-x-4' }}">
                            @if($config->linkedin)
                                <a href="{{ $config->linkedin }}" target="_blank"
                                    class="w-10 h-10 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center text-blue-600 dark:text-blue-400 hover:bg-blue-200 dark:hover:bg-blue-900/70 transition-colors">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            @endif
                            @if($config->github)
                                <a href="{{ $config->github }}" target="_blank"
                                    class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                    <i class="fab fa-github"></i>
                                </a>
                            @endif
                            @if($config->twitter)
                                <a href="{{ $config->twitter }}" target="_blank"
                                    class="w-10 h-10 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center text-blue-600 dark:text-blue-400 hover:bg-blue-200 dark:hover:bg-blue-900/70 transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            @endif
                            @if($config->facebook)
                                <a href="{{ $config->facebook }}" target="_blank"
                                    class="w-10 h-10 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center text-blue-600 dark:text-blue-400 hover:bg-blue-200 dark:hover:bg-blue-900/70 transition-colors">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            @endif
                            @if($config->instagram)
                                <a href="{{ $config->instagram }}" target="_blank"
                                    class="w-10 h-10 bg-pink-100 dark:bg-pink-900/50 rounded-lg flex items-center justify-center text-pink-600 dark:text-pink-400 hover:bg-pink-200 dark:hover:bg-pink-900/70 transition-colors">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- CV Download & Additional Info -->
                <div data-aos="fade-left">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">
                        {{ __('message.more_about_me') }}
                    </h2>

                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg dark:shadow-gray-900/50 p-6">
                        @if($config->cv)
                            <div class="text-center mb-6">
                                <div
                                    class="w-16 h-16 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-file-pdf text-2xl text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">
                                    {{ __('message.download_resume') }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300 mb-4">
                                    {{ __('message.get_resume_copy') }}
                                </p>
                                <a href="{{ route('portfolio.downloadCV') }}"
                                    class="bg-gradient-to-r from-blue-600 to-blue-600 hover:from-blue-700 hover:to-blue-700 text-white px-6 py-3 rounded-full font-semibold transition-all inline-block transform hover:scale-105 shadow-lg">
                                    <i class="fas fa-download {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                    {{ __('message.download_cv') }}
                                </a>
                            </div>
                        @endif

                        <div class="border-t dark:border-gray-700 pt-6">
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-4">
                                {{ __('message.useful_links') }}
                            </h4>
                            <div class="space-y-3">
                                <a href="{{ route('portfolio.projects') }}"
                                    class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <span
                                        class="text-gray-700 dark:text-gray-300">{{ __('message.view_my_projects') }}</span>
                                    <i
                                        class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} text-blue-600 dark:text-blue-400"></i>
                                </a>
                                <a href="{{ route('portfolio.experiences') }}"
                                    class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <span class="text-gray-700 dark:text-gray-300">{{ __('message.my_experience') }}</span>
                                    <i
                                        class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} text-blue-600 dark:text-blue-400"></i>
                                </a>
                                <a href="{{ route('portfolio.skills') }}"
                                    class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <span class="text-gray-700 dark:text-gray-300">{{ __('message.my_skills') }}</span>
                                    <i
                                        class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} text-blue-600 dark:text-blue-400"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 gradient-bg">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-white mb-6">
                {{ __('message.ready_collaborate') }}
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                {{ __('message.collaborate_desc') }}
            </p>
            <a href="{{ route('portfolio.contact') }}"
                class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-all inline-block transform hover:scale-105 shadow-lg">
                {{ __('message.contact_me_now') }}
            </a>
        </div>
    </section>
@endsection