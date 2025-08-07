@extends('portfolio.layout')

@section('title', __('message.skills') . ' - ' . ($config->site_name ?? 'Portfolio'))

@section('content')
    <!-- Page Header -->
    <section class="gradient-bg py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center text-white" data-aos="fade-up">
                <h1 class="text-5xl font-bold mb-6">
                    {{ __('message.my_skills') }}
                </h1>
                <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                    {{ __('message.skills_page_desc') }}
                </p>
            </div>
        </div>
    </section>

    <!-- All Skills -->
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($skills->count() > 0)
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">
                        {{ __('message.all_skills') }}
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        {{ __('message.all_skills_desc') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($skills as $skill)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/50 p-6 text-center card-hover"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-code text-2xl text-white"></i>
                            </div>

                            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-3">
                                {{ app()->getLocale() == 'ar' ? $skill->name_ar : $skill->name_en }}
                            </h3>

                            @if($skill->projects->count() > 0)
                                <p class="text-gray-600 dark:text-gray-300 mb-4">
                                    {{ __('message.used_in') }}
                                    {{ $skill->projects->count() }}
                                    {{ app()->getLocale() == 'ar' ? ($skill->projects->count() == 1 ? __('message.project_singular') : __('message.project_plural')) : ($skill->projects->count() == 1 ? __('message.project_singular') : __('message.project_plural')) }}
                                </p>

                                <!-- Related Projects -->
                                <div class="space-y-2">
                                    @foreach($skill->projects->take(3) as $project)
                                        <a href="{{ route('portfolio.project', $project->id) }}"
                                            class="block text-sm bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 px-3 py-2 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors">
                                            {{ app()->getLocale() == 'ar' ? $project->title_ar : $project->title_en }}
                                        </a>
                                    @endforeach

                                    @if($skill->projects->count() > 3)
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                            +{{ $skill->projects->count() - 3 }}
                                            {{ app()->getLocale() == 'ar' ? 'مشاريع أخرى' : 'more projects' }}
                                        </p>
                                    @endif
                                </div>
                            @else
                                <p class="text-gray-500 dark:text-gray-400">
                                    {{ app()->getLocale() == 'ar' ? 'لم يتم استخدامها في مشاريع بعد' : 'Not used in projects yet' }}
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20" data-aos="fade-up">
                    <div
                        class="w-24 h-24 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-code text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-600 dark:text-gray-400 mb-4">
                        {{ app()->getLocale() == 'ar' ? 'لا توجد مهارات مضافة حالياً' : 'No Skills Added Yet' }}
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        {{ app()->getLocale() == 'ar' ? 'سيتم إضافة المهارات قريباً' : 'Skills will be added soon' }}
                    </p>
                </div>
            @endif
        </div>
    </section>

    <!-- Skills by Project Usage -->
    @if($skills->where('projects')->count() > 0)
        <section class="py-20 bg-white dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">
                        {{ __('message.most_used_skills') }}
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        {{ __('message.most_used_skills_desc') }}
                    </p>
                </div>

                @php
                    $popularSkills = $skills->filter(function ($skill) {
                        return $skill->projects->count() > 0;
                    })->sortByDesc(function ($skill) {
                        return $skill->projects->count();
                    })->take(6);
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($popularSkills as $skill)
                        <div class="bg-gradient-to-br from-blue-50 to-blue-50 dark:from-blue-900/20 dark:to-blue-900/20 rounded-xl p-6"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="flex items-center mb-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-500 rounded-lg flex items-center justify-center {{ app()->getLocale() == 'ar' ? 'ml-4' : 'mr-4' }}">
                                    <i class="fas fa-star text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                                        {{ app()->getLocale() == 'ar' ? $skill->name_ar : $skill->name_en }}
                                    </h3>
                                    <p class="text-blue-600 dark:text-blue-400 font-semibold">
                                        {{ $skill->projects->count() }} {{ app()->getLocale() == 'ar' ? 'مشاريع' : 'projects' }}
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-2">
                                @foreach($skill->projects->take(4) as $project)
                                    <div class="flex items-center justify-between bg-white dark:bg-gray-800 rounded-lg p-3">
                                        <span class="text-gray-700 dark:text-gray-300 font-medium">
                                            {{ Str::limit(app()->getLocale() == 'ar' ? $project->title_ar : $project->title_en, 25) }}
                                        </span>
                                        <a href="{{ route('portfolio.project', $project->id) }}"
                                            class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
                                            <i class="fas fa-external-link-alt text-sm"></i>
                                        </a>
                                    </div>
                                @endforeach

                                @if($skill->projects->count() > 4)
                                    <p class="text-center text-gray-500 dark:text-gray-400 text-sm mt-2">
                                        +{{ $skill->projects->count() - 4 }} {{ app()->getLocale() == 'ar' ? 'أخرى' : 'more' }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Independent Skills -->
    @php
        $independentSkills = $skills->filter(function ($skill) {
            return $skill->projects->count() == 0;
        });
    @endphp

    @if($independentSkills->count() > 0)
        <section class="py-20 bg-gray-50 dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">
                        {{ __('message.additional_skills') }}
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        {{ __('message.additional_skills_desc') }}
                    </p>
                </div>

                <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex flex-wrap justify-center gap-3">
                        @foreach($independentSkills as $skill)
                            <span class="skill-badge text-lg">
                                {{ app()->getLocale() == 'ar' ? $skill->name_ar : $skill->name_en }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Skills Statistics -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">
                    {{ __('message.skills_statistics') }}
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    {{ __('message.skills_statistics_desc') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center bg-gradient-to-br from-blue-50 to-blue-50 dark:from-blue-900/20 dark:to-blue-900/20 rounded-xl p-8"
                    data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="w-16 h-16 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-layer-group text-2xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $skills->count() }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('message.total_skills') }}</p>
                </div>

                <div class="text-center bg-gradient-to-br from-blue-50 to-white dark:from-blue-900/20 dark:to-gray-900/20 rounded-xl p-8"
                    data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="w-16 h-16 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-project-diagram text-2xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    @php
                        $usedSkills = $skills->filter(function ($skill) {
                            return $skill->projects->count() > 0;
                        })->count();
                    @endphp
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $usedSkills }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('message.used_in_projects') }}</p>
                </div>

                <div class="text-center bg-gradient-to-br from-blue-50 to-blue-50 dark:from-blue-900/20 dark:to-blue-900/20 rounded-xl p-8"
                    data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="w-16 h-16 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-line text-2xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    @php
                        $avgProjectsPerSkill = $usedSkills > 0 ? round($skills->sum(function ($skill) {
                            return $skill->projects->count();
                        }) / $usedSkills, 1) : 0;
                    @endphp
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $avgProjectsPerSkill }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('message.avg_projects_per_skill') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 gradient-bg">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-white mb-6">
                {{ __('message.interested_in_skills') }}
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                {{ __('message.skills_project_desc') }}
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('portfolio.projects') }}"
                    class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-all transform hover:scale-105 shadow-lg">
                    {{ __('message.view_my_work') }}
                </a>
                <a href="{{ route('portfolio.contact') }}"
                    class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-600 transition-all transform hover:scale-105">
                    {{ __('message.contact_me') }}
                </a>
            </div>
        </div>
    </section>
@endsection