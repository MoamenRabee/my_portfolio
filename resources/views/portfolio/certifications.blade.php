@extends('portfolio.layout')

@section('title', __('message.certifications') . ' - ' . ($config->site_name ?? 'Portfolio'))

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    /* Ensure equal height cards */
    .certification-card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .certification-card .card-content {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .certification-card .card-footer {
        margin-top: auto;
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="gradient-bg py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center text-white" data-aos="fade-up">
            <h1 class="text-5xl font-bold mb-6">
                {{ __('message.my_certifications') }}
            </h1>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto mb-8">
                {{ __('message.certifications_page_desc') }}
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

<!-- Certifications Grid -->
<section class="py-20 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($certifications->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($certifications as $certification)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/50 p-6 card-hover h-full flex flex-col" data-aos="fade-up" data-aos-delay="{{ $loop->index * 200 }}">
                        <!-- Certification Header -->
                        <div class="text-center mb-6">
                            <!-- Certificate Icon -->
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-certificate text-white text-2xl"></i>
                            </div>
                            
                            <!-- Certificate Name -->
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2 line-clamp-2">
                                {{ app()->getLocale() == 'ar' ? $certification->name_ar : $certification->name_en }}
                            </h3>
                            
                            <!-- Issuing Organization -->
                            <p class="text-blue-600 dark:text-blue-400 font-medium">
                                {{ app()->getLocale() == 'ar' ? $certification->issuing_organization_ar : $certification->issuing_organization_en }}
                            </p>
                        </div>

                        <!-- Certificate Details -->
                        <div class="space-y-3 flex-grow">
                            <!-- Issue Date -->
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <i class="fas fa-calendar-alt text-gray-400 {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }} w-4 flex-shrink-0"></i>
                                <span>
                                    {{ __('message.issued') }}: {{ \Carbon\Carbon::parse($certification->issue_date)->format('M Y') }}
                                </span>
                            </div>

                            <!-- Expiry Date -->
                            @if($certification->expiry_date)
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-calendar-times text-gray-400 {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }} w-4 flex-shrink-0"></i>
                                    <span>
                                        {{ __('message.expires') }}: {{ \Carbon\Carbon::parse($certification->expiry_date)->format('M Y') }}
                                    </span>
                                </div>
                            @else
                                <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                                    <i class="fas fa-infinity text-green-400 {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }} w-4 flex-shrink-0"></i>
                                    <span>{{ __('message.no_expiry') }}</span>
                                </div>
                            @endif

                            <!-- Credential ID -->
                            @if($certification->credential_id)
                                <div class="flex items-start text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-id-card text-gray-400 {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }} w-4 flex-shrink-0 mt-0.5"></i>
                                    <span class="break-all">{{ __('message.credential_id') }}: <code class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-xs">{{ $certification->credential_id }}</code></span>
                                </div>
                            @endif
                            
                            <!-- Description -->
                            @if($certification->description_en || $certification->description_ar)
                                <div class="mt-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed line-clamp-3">
                                        {{ app()->getLocale() == 'ar' ? $certification->description_ar : $certification->description_en }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Card Footer - Fixed at Bottom -->
                        <div class="mt-auto pt-4">
                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-3 mb-4">
                                @if($certification->credential_url)
                                    <a href="{{ $certification->credential_url }}" 
                                       target="_blank" 
                                       class="flex-1 inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-300">
                                        <i class="fas fa-external-link-alt {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                        {{ __('message.view_credential') }}
                                    </a>
                                @endif
                                
                                @if($certification->verification_url)
                                    <a href="{{ $certification->verification_url }}" 
                                       target="_blank" 
                                       class="flex-1 inline-flex items-center justify-center border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors duration-300">
                                        <i class="fas fa-check-circle {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                        {{ __('message.verify') }}
                                    </a>
                                @endif
                            </div>

                            <!-- Validity Status -->
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                @if($certification->expiry_date && \Carbon\Carbon::parse($certification->expiry_date)->isPast())
                                    <span class="inline-flex items-center bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 px-3 py-1.5 rounded-full text-xs font-medium w-full justify-center">
                                        <i class="fas fa-exclamation-triangle {{ app()->getLocale() == 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        {{ __('message.expired') }}
                                    </span>
                                @elseif($certification->expiry_date && \Carbon\Carbon::parse($certification->expiry_date)->diffInDays() <= 30)
                                    <span class="inline-flex items-center bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 px-3 py-1.5 rounded-full text-xs font-medium w-full justify-center">
                                        <i class="fas fa-clock {{ app()->getLocale() == 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        {{ __('message.expires_soon') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 px-3 py-1.5 rounded-full text-xs font-medium w-full justify-center">
                                        <i class="fas fa-check-circle {{ app()->getLocale() == 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        {{ __('message.valid') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20" data-aos="fade-up">
                <div class="w-24 h-24 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-certificate text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
                    {{ __('message.no_certifications') }}
                </h3>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ __('message.no_certifications_desc') }}
                </p>
            </div>
        @endif
    </div>
</section>



<!-- CV Download Section -->
@if($config->cv)
<section class="py-16 bg-gray-50 dark:bg-gray-900">
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
