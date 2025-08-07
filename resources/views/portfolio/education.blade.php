@extends('portfolio.layout')

@section('title', __('message.education') . ' - ' . ($config->site_name ?? 'Portfolio'))

@section('content')
<!-- Page Header -->
<section class="gradient-bg py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center text-white" data-aos="fade-up">
            <h1 class="text-5xl font-bold mb-6">
                {{ __('message.my_education') }}
            </h1>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto mb-8">
                {{ __('message.education_page_desc') }}
            </p>
            
            <!-- CV Download Button -->
            <div class="text-center">
                <a href="{{ route('portfolio.downloadCV') }}" target="_blank"
                   class="inline-flex items-center bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-blue-50 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <i class="fas fa-download {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    {{ app()->getLocale() == 'ar' ? 'تحميل السيرة الذاتية' : 'Download CV' }}
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Education Timeline -->
<section class="py-20 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($educations->count() > 0)
            <div class="relative">
                <!-- Timeline Line -->
                <div class="absolute left-8 md:left-1/2 transform md:-translate-x-px h-full w-0.5 bg-blue-200 dark:bg-blue-800"></div>
                
                @foreach($educations as $education)
                    <div class="relative flex items-center mb-12 {{ $loop->index % 2 == 0 ? 'md:flex-row-reverse' : '' }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 200 }}">
                        <!-- Timeline Dot -->
                        <div class="absolute {{ app()->getLocale() == 'ar' ? 'right-8 md:right-1/2' : 'left-8 md:left-1/2' }} transform {{ app()->getLocale() == 'ar' ? 'md:translate-x-1/2' : 'md:-translate-x-1/2' }} w-4 h-4 bg-green-600 dark:bg-green-500 rounded-full border-4 border-white dark:border-gray-900 shadow-lg z-10"></div>
                        
                        <!-- Content Card -->
                        <div class="{{ app()->getLocale() == 'ar' ? 'mr-20 md:mr-0' : 'ml-20 md:ml-0' }} md:w-5/12 {{ $loop->index % 2 == 0 ? (app()->getLocale() == 'ar' ? 'md:ml-auto md:pr-8' : 'md:mr-auto md:pl-8') : (app()->getLocale() == 'ar' ? 'md:mr-auto md:pl-8' : 'md:ml-auto md:pr-8') }}">
                            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/50 p-6 card-hover">
                                <!-- Institution Info -->
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/50 rounded-lg flex items-center justify-center {{ app()->getLocale() == 'ar' ? 'ml-4' : 'mr-4' }}">
                                        <i class="fas fa-graduation-cap text-green-600 dark:text-green-400"></i>
                                    </div>
                                    
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                                            {{ app()->getLocale() == 'ar' ? $education->degree_ar : $education->degree_en }}
                                        </h3>
                                        <p class="text-green-600 dark:text-green-400 font-medium">
                                            {{ app()->getLocale() == 'ar' ? $education->institution_ar : $education->institution_en }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Education Details -->
                                @if($education->field_of_study_en || $education->field_of_study_ar)
                                    <div class="mb-4">
                                        <span class="inline-block bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ app()->getLocale() == 'ar' ? $education->field_of_study_ar : $education->field_of_study_en }}
                                        </span>
                                    </div>
                                @endif

                                <!-- GPA -->
                                @if($education->gpa)
                                    <div class="mb-4">
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                            <i class="fas fa-star text-yellow-500 {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                            <span>{{ __('message.gpa') }}: {{ $education->gpa }}{{ $education->gpa_scale ? '/' . $education->gpa_scale : '' }}</span>
                                        </div>
                                    </div>
                                @endif

                                <!-- Duration -->
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300 mb-4">
                                    <i class="fas fa-calendar text-gray-400 {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                    <span>
                                        {{ \Carbon\Carbon::parse($education->start_date)->format('M Y') }}
                                        -
                                        {{ $education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('M Y') : __('message.present') }}
                                    </span>
                                </div>

                                <!-- Location -->
                                @if($education->location)
                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-300 mb-4">
                                        <i class="fas fa-map-marker-alt text-gray-400 {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                        <span>{{ $education->location }}</span>
                                    </div>
                                @endif

                                <!-- Description -->
                                @if($education->description_en || $education->description_ar)
                                    <div class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                        {!! app()->getLocale() == 'ar' ? nl2br(e($education->description_ar)) : nl2br(e($education->description_en)) !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20" data-aos="fade-up">
                <div class="w-24 h-24 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-graduation-cap text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
                    {{ __('message.no_education') }}
                </h3>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ __('message.no_education_desc') }}
                </p>
            </div>
        @endif
    </div>
</section>

<!-- CV Download Section -->
@if($config->cv)
<section class="py-16 bg-white dark:bg-gray-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <div class="bg-gradient-to-r from-blue-600 to-blue-600 rounded-2xl p-8 text-white">
            <i class="fas fa-download text-4xl mb-4"></i>
            <h3 class="text-2xl font-bold mb-4">{{ __('message.download_cv') }}</h3>
            <p class="text-blue-100 mb-6">{{ __('message.download_cv_desc') }}</p>
            <a href="{{ route('portfolio.downloadCV') }}" 
               class="inline-flex items-center bg-white text-blue-600 px-6 py-3 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-300">
                <i class="fas fa-file-pdf {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ __('message.download_pdf') }}
            </a>
        </div>
    </div>
</section>
@endif
@endsection
