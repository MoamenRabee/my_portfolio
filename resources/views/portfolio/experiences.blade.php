@extends('portfolio.layout')

@section('title', __('message.experiences') . ' - ' . ($config->site_name ?? 'Portfolio'))

@section('content')
<!-- Page Header -->
<section class="gradient-bg py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center text-white" data-aos="fade-up">
            <h1 class="text-5xl font-bold mb-6">
                {{ __('message.my_experience') }}
            </h1>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                {{ __('message.experience_page_desc') }}
            </p>
        </div>
    </div>
</section>

<!-- Experience Timeline -->
<section class="py-20 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($experiences->count() > 0)
            <div class="relative">
                <!-- Timeline Line -->
                <div class="absolute left-8 md:left-1/2 transform md:-translate-x-px h-full w-0.5 bg-blue-200 dark:bg-blue-800"></div>
                
                @foreach($experiences as $experience)
                    <div class="relative flex items-center mb-12 {{ $loop->index % 2 == 0 ? 'md:flex-row-reverse' : '' }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 200 }}">
                        <!-- Timeline Dot -->
                        <div class="absolute {{ app()->getLocale() == 'ar' ? 'right-8 md:right-1/2' : 'left-8 md:left-1/2' }} transform {{ app()->getLocale() == 'ar' ? 'md:translate-x-1/2' : 'md:-translate-x-1/2' }} w-4 h-4 bg-blue-600 dark:bg-blue-500 rounded-full border-4 border-white dark:border-gray-900 shadow-lg z-10"></div>
                        
                        <!-- Content Card -->
                        <div class="{{ app()->getLocale() == 'ar' ? 'mr-20 md:mr-0' : 'ml-20 md:ml-0' }} md:w-5/12 {{ $loop->index % 2 == 0 ? (app()->getLocale() == 'ar' ? 'md:ml-auto md:pr-8' : 'md:mr-auto md:pl-8') : (app()->getLocale() == 'ar' ? 'md:mr-auto md:pl-8' : 'md:ml-auto md:pr-8') }}">
                            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/50 p-6 card-hover">
                                <!-- Company Info -->
                                <div class="flex items-center mb-4">
                                    @if($experience->company_logo)
                                        <img src="{{ asset('storage/' . $experience->company_logo) }}" 
                                             alt="{{ app()->getLocale() == 'ar' ? $experience->company_name_ar : $experience->company_name_en }}" 
                                             class="w-12 h-12 rounded-lg object-cover {{ app()->getLocale() == 'ar' ? 'ml-4' : 'mr-4' }}">
                                    @else
                                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center {{ app()->getLocale() == 'ar' ? 'ml-4' : 'mr-4' }}">
                                            <i class="fas fa-building text-blue-600 dark:text-blue-400"></i>
                                        </div>
                                    @endif
                                    
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                                            {{ app()->getLocale() == 'ar' ? $experience->title_ar : $experience->title_en }}
                                        </h3>
                                        <p class="text-blue-600 dark:text-blue-400 font-semibold">
                                            {{ app()->getLocale() == 'ar' ? $experience->company_name_ar : $experience->company_name_en }}
                                        </p>
                                    </div>
                                </div>
                                
                                <!-- Date and Location -->
                                <div class="flex flex-wrap items-center gap-4 mb-4 text-sm text-gray-600 dark:text-gray-400">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                        {{ $experience->start_date }} - {{ $experience->end_date ?? __('message.present') }}
                                    </div>
                                    @if($experience->location)
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                            {{ $experience->location }}
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Description -->
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                                    {{ app()->getLocale() == 'ar' ? $experience->description_ar : $experience->description_en }}
                                </p>
                                
                                <!-- Related Projects -->
                                @php
                                    $experienceProjects = $experience->projects ?? collect();
                                @endphp
                                @if($experienceProjects->count() > 0)
                                    <div class="border-t dark:border-gray-600 pt-4">
                                        <h4 class="font-semibold text-gray-800 dark:text-white mb-2">
                                            {{ __('message.related_projects') }}
                                        </h4>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($experienceProjects->take(3) as $project)
                                                <a href="{{ route('portfolio.project', $project->id) }}" 
                                                   class="text-sm bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 px-3 py-1 rounded-full hover:bg-blue-200 dark:hover:bg-blue-900/70 transition-colors">
                                                    {{ app()->getLocale() == 'ar' ? $project->title_ar : $project->title_en }}
                                                </a>
                                            @endforeach
                                            @if($experienceProjects->count() > 3)
                                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                                    +{{ $experienceProjects->count() - 3 }} {{ __('message.more') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Date Badge (Mobile) -->
                        <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 {{ $loop->index % 2 == 0 ? '-translate-y-12' : 'translate-y-12' }}">
                            <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                {{ \Carbon\Carbon::parse($experience->start_date)->format('Y') }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20" data-aos="fade-up">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-briefcase text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-600 mb-4">
                    {{ app()->getLocale() == 'ar' ? 'لا توجد خبرات مضافة حالياً' : 'No Experience Added Yet' }}
                </h3>
                <p class="text-gray-500">
                    {{ app()->getLocale() == 'ar' ? 'سيتم إضافة الخبرات قريباً' : 'Experience will be added soon' }}
                </p>
            </div>
        @endif
    </div>
</section>

<!-- Skills Overview -->
@if($config->about_me_ar || $config->about_me_en)
<section class="py-20 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div data-aos="fade-right">
                <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-6">
                    {{ __('message.about_professional_journey') }}
                </h2>
                <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                    {{ app()->getLocale() == 'ar' ? $config->about_me_ar : $config->about_me_en }}
                </p>
                <a href="{{ route('portfolio.about') }}" 
                   class="bg-gradient-to-r from-blue-600 to-blue-600 hover:from-blue-700 hover:to-blue-700 text-white px-6 py-3 rounded-full font-semibold transition-all inline-block transform hover:scale-105 shadow-lg">
                    {{ __('message.learn_more_about_me') }}
                </a>
            </div>
            
            <div data-aos="fade-left">
                @if($config->profile_image)
                    <img src="{{ asset('storage/' . $config->profile_image) }}" 
                         alt="{{ $config->name_ar ?? $config->name_en }}" 
                         class="w-full max-w-md mx-auto rounded-2xl shadow-2xl">
                @else
                    <div class="w-full max-w-md mx-auto h-96 bg-gray-200 dark:bg-gray-600 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-user text-6xl text-gray-400 dark:text-gray-500"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- Experience Summary -->
<section class="py-20 bg-gray-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">
                {{ __('message.experience_summary') }}
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                {{ __('message.experience_summary_desc') }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-calendar-alt text-2xl text-blue-600 dark:text-blue-400"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $experiences->count() }}+</h3>
                <p class="text-gray-600 dark:text-gray-300">{{ __('message.years_experience') }}</p>
            </div>
            
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-building text-2xl text-blue-600 dark:text-blue-400"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $experiences->count() }}</h3>
                <p class="text-gray-600 dark:text-gray-300">{{ __('message.companies') }}</p>
            </div>
            
            <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-project-diagram text-2xl text-blue-600 dark:text-blue-400"></i>
                </div>
                @php
                    $totalProjects = \App\Models\Project::whereNotNull('experience_id')->count();
                @endphp
                <h3 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $totalProjects }}+</h3>
                <p class="text-gray-600 dark:text-gray-300">{{ __('message.work_projects') }}</p>
            </div>
            
            <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                <div class="w-16 h-16 bg-orange-100 dark:bg-orange-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-code text-2xl text-orange-600 dark:text-orange-400"></i>
                </div>
                @php
                    $totalSkills = \App\Models\Skill::count();
                @endphp
                <h3 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $totalSkills }}+</h3>
                <p class="text-gray-600 dark:text-gray-300">{{ __('message.technical_skills') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 gradient-bg">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        <h2 class="text-4xl font-bold text-white mb-6">
            {{ __('message.interested_working_together') }}
        </h2>
        <p class="text-xl text-blue-100 mb-8">
            {{ __('message.discuss_experience_help') }}
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('portfolio.contact') }}" 
               class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-all">
                {{ __('message.contact_me') }}
            </a>
            <a href="{{ route('portfolio.projects') }}" 
               class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-600 transition-all">
                {{ __('message.view_my_work') }}
            </a>
        </div>
    </div>
</section>
@endsection
