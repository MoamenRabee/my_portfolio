@extends('portfolio.layout')

@section('title', ($config->name_ar ?? $config->name_en ?? 'Portfolio') . ' - ' . ($config->job_title_ar ?? $config->job_title_en ?? ''))

@section('content')
    <!-- Hero Section -->
    <section class="gradient-bg min-h-screen flex items-center py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-white" data-aos="fade-right">
                    <h1 class="text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                        {{ app()->getLocale() == 'ar' ? ($config->name_ar ?? __('message.hello')) : ($config->name_en ?? __('message.hello')) }}
                    </h1>
                    <h2 class="text-2xl lg:text-3xl mb-6 text-blue-200">
                        {{ app()->getLocale() == 'ar' ? ($config->job_title_ar ?? '') : ($config->job_title_en ?? '') }}
                    </h2>
                    <p class="text-xl mb-8 text-blue-100 leading-relaxed">
                        {{ app()->getLocale() == 'ar' ? ($config->summary_ar ?? '') : ($config->summary_en ?? '') }}
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('portfolio.projects') }}"
                            class="btn-primary px-8 py-3 rounded-full font-semibold text-white hover:text-white transition-all">
                            {{ __('message.view_my_work') }}
                        </a>
                        <a href="{{ route('portfolio.contact') }}"
                            class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-600 transition-all">
                            {{ __('message.contact_me') }}
                        </a>
                        <a href="{{ route('portfolio.downloadCV') }}" target="_blank"
                            class="bg-green-500 text-white px-8 py-3 rounded-full font-semibold hover:bg-green-600 transition-all shadow-lg">
                            <i class="fas fa-download {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            {{ app()->getLocale() == 'ar' ? 'تحميل السيرة الذاتية' : 'Download CV' }}
                        </a>
                    </div>
                </div>

                <div class="text-center" data-aos="fade-left">
                    @if($config->profile_image)
                        <div class="relative inline-block">
                            <img src="{{ asset('storage/' . $config->profile_image) }}"
                                alt="{{ $config->name_ar ?? $config->name_en }}"
                                class="w-80 h-80 rounded-full object-cover shadow-2xl border-8 border-white/20">
                            <div class="inset-0 rounded-full bg-gradient-to-tr from-blue-400/20 to-white/20">
                            </div>
                        </div>
                    @else
                        <div class="w-80 h-80 rounded-full bg-white/20 flex items-center justify-center text-6xl text-white">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Stats -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="w-16 h-16 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-briefcase text-2xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $experiences->count() }}+</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('message.years_experience') }}</p>
                </div>

                <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="w-16 h-16 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-project-diagram text-2xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $projects->count() }}+</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('message.completed_projects') }}</p>
                </div>

                <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="w-16 h-16 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-code text-2xl text-green-600 dark:text-green-400"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $skills->count() }}+</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('message.technical_skills') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects -->
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">
                    {{ __('message.featured_projects') }}
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    {{ __('message.featured_projects_desc') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects->take(6) as $project)
                    <div class="bg-white dark:bg-gray-700 rounded-xl shadow-lg dark:shadow-gray-900/50 overflow-hidden card-hover"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
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
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">
                                {{ app()->getLocale() == 'ar' ? $project->title_ar : $project->title_en }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                {{ Str::limit(app()->getLocale() == 'ar' ? $project->description_ar : $project->description_en, 100) }}
                            </p>

                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($project->skills->take(3) as $skill)
                                    <span class="skill-badge">
                                        {{ app()->getLocale() == 'ar' ? $skill->name_ar : $skill->name_en }}
                                    </span>
                                @endforeach
                            </div>

                            <div class="flex justify-between items-center">
                                <a href="{{ route('portfolio.project', $project->id) }}"
                                    class="text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-100 font-semibold transition-colors">
                                    {{ __('message.view_details') }}
                                    <i
                                        class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} {{ app()->getLocale() == 'ar' ? 'mr-1' : 'ml-1' }}"></i>
                                </a>

                                <div class="flex {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-2' : 'space-x-2' }}">
                                    @if($project->github_link)
                                        <a href="{{ $project->github_link }}" target="_blank"
                                            class="text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white transition-colors">
                                            <i class="fab fa-github text-xl"></i>
                                        </a>
                                    @endif
                                    @if($project->website_link)
                                        <a href="{{ $project->website_link }}" target="_blank"
                                            class="text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white transition-colors">
                                            <i class="fas fa-external-link-alt text-xl"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12" data-aos="fade-up">
                <a href="{{ route('portfolio.projects') }}"
                    class="btn-primary px-8 py-3 rounded-full font-semibold text-white hover:text-white transition-all inline-block">
                    {{ __('message.view_all_projects') }}
                </a>
            </div>
        </div>
    </section>

    <!-- Skills Overview -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">
                    {{ __('message.my_skills') }}
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    {{ __('message.my_skills_desc') }}
                </p>
            </div>

            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                @foreach($skills as $skill)
                    <span class="skill-badge m-1">
                        {{ app()->getLocale() == 'ar' ? $skill->name_ar : $skill->name_en }}
                    </span>
                @endforeach
            </div>

            <div class="text-center mt-8" data-aos="fade-up" data-aos-delay="300">
                <a href="{{ route('portfolio.skills') }}"
                    class="text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-100 font-semibold transition-colors">
                    {{ __('message.view_all_skills') }}
                    <i
                        class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} {{ app()->getLocale() == 'ar' ? 'mr-1' : 'ml-1' }}"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Recent Experience -->
    @if($experiences->count() > 0)
        <section class="py-20 bg-gray-50 dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">
                        {{ __('message.my_experience') }}
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        {{ __('message.my_experience_desc') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($experiences->take(4) as $experience)
                        <div class="bg-white dark:bg-gray-700 rounded-xl shadow-lg dark:shadow-gray-900/50 p-6 card-hover"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div
                                class="flex items-start {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-4' : 'space-x-4' }}">
                                @if($experience->company_logo)
                                    <img src="{{ asset('storage/' . $experience->company_logo) }}"
                                        alt="{{ app()->getLocale() == 'ar' ? $experience->company_name_ar : $experience->company_name_en }}"
                                        class="w-12 h-12 rounded-lg object-cover">
                                @else
                                    <div
                                        class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-building text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                @endif

                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-1">
                                        {{ app()->getLocale() == 'ar' ? $experience->title_ar : $experience->title_en }}
                                    </h3>
                                    <p class="text-blue-600 dark:text-blue-300 font-semibold mb-2">
                                        {{ app()->getLocale() == 'ar' ? $experience->company_name_ar : $experience->company_name_en }}
                                    </p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">
                                        {{ $experience->start_date }} - {{ $experience->end_date ?? __('message.present') }}
                                    </p>
                                    <p class="text-gray-700 dark:text-gray-300">
                                        {{ Str::limit(app()->getLocale() == 'ar' ? $experience->description_ar : $experience->description_en, 150) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12" data-aos="fade-up">
                    <a href="{{ route('portfolio.experiences') }}"
                        class="btn-primary px-8 py-3 rounded-full font-semibold text-white hover:text-white transition-all inline-block">
                        {{ __('message.view_all_experience') }}
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Call to Action -->
    <section class="py-20 gradient-bg">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-white mb-6">
                {{ __('message.have_project') }}
            </h2>
            <p class="text-xl text-blue-100 mb-8 leading-relaxed">
                {{ __('message.lets_collaborate') }}
            </p>
            <a href="{{ route('portfolio.contact') }}"
                class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-all inline-block">
                {{ __('message.start_project') }}
            </a>
        </div>
    </section>
@endsection