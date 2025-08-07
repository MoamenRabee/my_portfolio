@extends('portfolio.layout')

@section('title', __('message.projects') . ' - ' . ($config->site_name ?? 'Portfolio'))

@section('content')
    <!-- Page Header -->
    <section class="gradient-bg py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center text-white" data-aos="fade-up">
                <h1 class="text-5xl font-bold mb-6">
                    {{ __('message.projects') }}
                </h1>
                <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                    {{ __('message.projects_page_desc') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Projects Grid -->
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($projects->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($projects as $project)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden card-hover" data-aos="fade-up"
                            data-aos-delay="{{ $loop->index * 100 }}">
                            @if($project->images->first())
                                <img src="{{ asset('storage/' . $project->images->first()->image) }}"
                                    alt="{{ app()->getLocale() == 'ar' ? $project->title_ar : $project->title_en }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-500 flex items-center justify-center">
                                    <i class="fas fa-project-diagram text-4xl text-white"></i>
                                </div>
                            @endif

                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                                        {{ app()->getLocale() == 'ar' ? $project->title_ar : $project->title_en }}
                                    </h3>
                                    @if($project->experience)
                                        <span
                                            class="text-xs bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 px-2 py-1 rounded-full">
                                            {{ app()->getLocale() == 'ar' ? $project->experience->company_name_ar : $project->experience->company_name_en }}
                                        </span>
                                    @endif
                                </div>

                                <p class="text-gray-600 dark:text-gray-300 mb-4">
                                    {{ Str::limit(app()->getLocale() == 'ar' ? $project->description_ar : $project->description_en, 120) }}
                                </p>

                                <!-- Skills -->
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach($project->skills->take(4) as $skill)
                                        <span class="skill-badge text-xs">
                                            {{ app()->getLocale() == 'ar' ? $skill->name_ar : $skill->name_en }}
                                        </span>
                                    @endforeach
                                    @if($project->skills->count() > 4)
                                        <span
                                            class="text-xs bg-gray-200 dark:bg-gray-600 text-gray-600 dark:text-gray-300 px-2 py-1 rounded-full">
                                            +{{ $project->skills->count() - 4 }} {{ app()->getLocale() == 'ar' ? 'أخرى' : 'more' }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex justify-between items-center">
                                    <a href="{{ route('portfolio.project', $project->id) }}"
                                        class="text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-100 font-semibold transition-colors">
                                        {{ __('message.view_details') }}
                                        <i
                                            class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} {{ app()->getLocale() == 'ar' ? 'mr-1' : 'ml-1' }}"></i>
                                    </a>

                                    <div class="flex {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-3' : 'space-x-3' }}">
                                        @if($project->github_link)
                                            <a href="{{ $project->github_link }}" target="_blank"
                                                class="text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white transition-colors"
                                                title="GitHub">
                                                <i class="fab fa-github text-xl"></i>
                                            </a>
                                        @endif
                                        @if($project->website_link)
                                            <a href="{{ $project->website_link }}" target="_blank"
                                                class="text-gray-600 hover:text-gray-800 transition-colors" title="Live Demo">
                                                <i class="fas fa-external-link-alt text-xl"></i>
                                            </a>
                                        @endif
                                        @if($project->google_play_link)
                                            <a href="{{ $project->google_play_link }}" target="_blank"
                                                class="text-gray-600 hover:text-gray-800 transition-colors" title="Google Play">
                                                <i class="fab fa-google-play text-xl"></i>
                                            </a>
                                        @endif
                                        @if($project->app_store_link)
                                            <a href="{{ $project->app_store_link }}" target="_blank"
                                                class="text-gray-600 hover:text-gray-800 transition-colors" title="App Store">
                                                <i class="fab fa-app-store text-xl"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20" data-aos="fade-up">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-project-diagram text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-600 mb-4">
                        {{ app()->getLocale() == 'ar' ? 'لا توجد مشاريع حالياً' : 'No Projects Yet' }}
                    </h3>
                    <p class="text-gray-500">
                        {{ app()->getLocale() == 'ar' ? 'سيتم إضافة المشاريع قريباً' : 'Projects will be added soon' }}
                    </p>
                </div>
            @endif
        </div>
    </section>

    <!-- Projects by Experience -->
    @if($projects->whereNotNull('experience_id')->count() > 0)
        <section class="py-20 bg-white dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">
                        {{ __('message.projects_by_experience') }}
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        {{ __('message.projects_experience_desc') }}
                    </p>
                </div>

                @php
                    $experienceProjects = $projects->whereNotNull('experience_id')->groupBy('experience_id');
                @endphp

                @foreach($experienceProjects as $experienceId => $projectGroup)
                    @php
                        $experience = $projectGroup->first()->experience;
                    @endphp
                    <div class="mb-12" data-aos="fade-up">
                        <div class="flex items-center mb-6">
                            @if($experience->company_logo)
                                <img src="{{ asset('storage/' . $experience->company_logo) }}"
                                    alt="{{ app()->getLocale() == 'ar' ? $experience->company_name_ar : $experience->company_name_en }}"
                                    class="w-12 h-12 rounded-lg object-cover {{ app()->getLocale() == 'ar' ? 'ml-4' : 'mr-4' }}">
                            @endif
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                                    {{ app()->getLocale() == 'ar' ? $experience->company_name_ar : $experience->company_name_en }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300">
                                    {{ app()->getLocale() == 'ar' ? $experience->title_ar : $experience->title_en }}
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($projectGroup as $project)
                                <div
                                    class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 transition-colors">
                                    <h4 class="font-semibold text-gray-800 dark:text-white mb-2">
                                        {{ app()->getLocale() == 'ar' ? $project->title_ar : $project->title_en }}
                                    </h4>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                                        {{ Str::limit(app()->getLocale() == 'ar' ? $project->description_ar : $project->description_en, 80) }}
                                    </p>
                                    <div class="flex flex-wrap gap-1 mb-3">
                                        @foreach($project->skills->take(3) as $skill)
                                            <span
                                                class="text-xs bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 px-2 py-1 rounded">
                                                {{ app()->getLocale() == 'ar' ? $skill->name_ar : $skill->name_en }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <a href="{{ route('portfolio.project', $project->id) }}"
                                        class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium transition-colors">
                                        {{ __('message.view_details') }}
                                        <i
                                            class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} {{ app()->getLocale() == 'ar' ? 'mr-1' : 'ml-1' }}"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <!-- Call to Action -->
    <section class="py-20 gradient-bg">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-white mb-6">
                {{ __('message.like_what_you_see') }}
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                {{ __('message.talk_next_project') }}
            </p>
            <a href="{{ route('portfolio.contact') }}"
                class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-all inline-block transform hover:scale-105 shadow-lg">
                {{ __('message.get_in_touch') }}
            </a>
        </div>
    </section>
@endsection