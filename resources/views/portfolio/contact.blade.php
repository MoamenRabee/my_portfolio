@extends('portfolio.layout')

@section('title', __('message.contact') . ' - ' . ($config->site_name ?? 'Portfolio'))

@section('content')
    <!-- Page Header -->
    <section class="gradient-bg py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center text-white" data-aos="fade-up">
                <h1 class="text-5xl font-bold mb-6">
                    {{ __('message.contact_me') }}
                </h1>
                <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                    {{ __('message.contact_page_desc') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Information -->
                <div data-aos="fade-right">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8">
                        {{ __('message.get_in_touch') }}
                    </h2>

                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                        {{ __('message.contact_desc') }}
                    </p>

                    <div class="space-y-6">
                        @if($config->email)
                            <div class="flex items-center group">
                                <div
                                    class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center {{ app()->getLocale() == 'ar' ? 'ml-4' : 'mr-4' }} group-hover:bg-blue-200 dark:group-hover:bg-blue-900/70 transition-colors">
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
                            <div class="flex items-center group">
                                <div
                                    class="w-12 h-12 bg-green-100 dark:bg-green-900/50 rounded-lg flex items-center justify-center {{ app()->getLocale() == 'ar' ? 'ml-4' : 'mr-4' }} group-hover:bg-green-200 dark:group-hover:bg-green-900/70 transition-colors">
                                    <i class="fas fa-phone text-green-600 dark:text-green-400"></i>
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

                        @if($config->whatsapp)
                            <div class="flex items-center group">
                                <div
                                    class="w-12 h-12 bg-green-100 dark:bg-green-900/50 rounded-lg flex items-center justify-center {{ app()->getLocale() == 'ar' ? 'ml-4' : 'mr-4' }} group-hover:bg-green-200 dark:group-hover:bg-green-900/70 transition-colors">
                                    <i class="fab fa-whatsapp text-green-600 dark:text-green-400"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">{{ __('message.whatsapp') }}</h3>
                                    <a href="{{ $config->whatsapp }}" target="_blank"
                                        class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
                                        {{ __('message.send_whatsapp') }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if($config->address)
                            <div class="flex items-center group">
                                <div
                                    class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center {{ app()->getLocale() == 'ar' ? 'ml-4' : 'mr-4' }} group-hover:bg-blue-200 dark:group-hover:bg-blue-900/70 transition-colors">
                                    <i class="fas fa-map-marker-alt text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">{{ __('message.location') }}</h3>
                                    <p class="text-gray-600 dark:text-gray-300">{{ $config->address }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Social Media Links -->
                    <div class="mt-8">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ __('message.follow_me') }}</h3>
                        <div class="flex {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-4' : 'space-x-4' }}">
                            @if($config->linkedin)
                                <a href="{{ $config->linkedin }}" target="_blank"
                                    class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center text-blue-600 dark:text-blue-400 hover:bg-blue-200 dark:hover:bg-blue-900/70 transition-colors card-hover">
                                    <i class="fab fa-linkedin text-xl"></i>
                                </a>
                            @endif
                            @if($config->github)
                                <a href="{{ $config->github }}" target="_blank"
                                    class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors card-hover">
                                    <i class="fab fa-github text-xl"></i>
                                </a>
                            @endif
                            @if($config->twitter)
                                <a href="{{ $config->twitter }}" target="_blank"
                                    class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center text-blue-600 dark:text-blue-400 hover:bg-blue-200 dark:hover:bg-blue-900/70 transition-colors card-hover">
                                    <i class="fab fa-twitter text-xl"></i>
                                </a>
                            @endif
                            @if($config->facebook)
                                <a href="{{ $config->facebook }}" target="_blank"
                                    class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center text-blue-600 dark:text-blue-400 hover:bg-blue-200 dark:hover:bg-blue-900/70 transition-colors card-hover">
                                    <i class="fab fa-facebook text-xl"></i>
                                </a>
                            @endif
                            @if($config->instagram)
                                <a href="{{ $config->instagram }}" target="_blank"
                                    class="w-12 h-12 bg-pink-100 dark:bg-pink-900/50 rounded-lg flex items-center justify-center text-pink-600 dark:text-pink-400 hover:bg-pink-200 dark:hover:bg-pink-900/70 transition-colors card-hover">
                                    <i class="fab fa-instagram text-xl"></i>
                                </a>
                            @endif
                            @if($config->youtube)
                                <a href="{{ $config->youtube }}" target="_blank"
                                    class="w-12 h-12 bg-red-100 dark:bg-red-900/50 rounded-lg flex items-center justify-center text-red-600 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-900/70 transition-colors card-hover">
                                    <i class="fab fa-youtube text-xl"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div data-aos="fade-left">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl dark:shadow-gray-900/50 p-8">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
                            {{ __('message.send_message') }}
                        </h2>

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6" id="contactForm">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        {{ __('message.your_name') }} *
                                    </label>
                                    <input type="text" id="name" name="name" required
                                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                        placeholder="{{ __('message.name_placeholder') }}">
                                    <div class="error-message text-red-500 text-sm mt-1 hidden" id="name-error"></div>
                                </div>

                                <div>
                                    <label for="email"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        {{ __('message.your_email') }} *
                                    </label>
                                    <input type="email" id="email" name="email" required
                                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                        placeholder="{{ __('message.email_placeholder') }}">
                                    <div class="error-message text-red-500 text-sm mt-1 hidden" id="email-error"></div>
                                </div>
                            </div>

                            <div>
                                <label for="phone"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('message.phone') }}
                                </label>
                                <input type="tel" id="phone" name="phone"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    placeholder="{{ __('message.phone') }}">
                                <div class="error-message text-red-500 text-sm mt-1 hidden" id="phone-error"></div>
                            </div>

                            <div>
                                <label for="subject"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('message.subject') }} *
                                </label>
                                <input type="text" id="subject" name="subject" required
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    placeholder="{{ __('message.subject_placeholder') }}">
                                <div class="error-message text-red-500 text-sm mt-1 hidden" id="subject-error"></div>
                            </div>

                            <div>
                                <label for="message"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('message.your_message') }} *
                                </label>
                                <textarea id="message" name="message" rows="5" required
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-vertical"
                                    placeholder="{{ __('message.message_placeholder') }}"></textarea>
                                <div class="error-message text-red-500 text-sm mt-1 hidden" id="message-error"></div>
                            </div>

                            <div>
                                <button type="submit" id="submitBtn"
                                    class="w-full bg-gradient-to-r from-blue-600 to-blue-600 hover:from-blue-700 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all transform hover:scale-105 shadow-lg hover:shadow-xl disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none">
                                    <span id="button-text">{{ __('message.send_message') }}</span>
                                    <i class="fas fa-paper-plane {{ app()->getLocale() == 'ar' ? 'mr-2' : 'ml-2' }}"
                                        id="button-icon"></i>
                                    <div class="hidden" id="loading-spinner">
                                        <div
                                            class="inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin {{ app()->getLocale() == 'ar' ? 'mr-2' : 'ml-2' }}">
                                        </div>
                                        {{ app()->getLocale() == 'ar' ? 'جاري الإرسال...' : 'Sending...' }}
                                    </div>
                                </button>
                            </div>
                        </form>

                        <div class="mt-6 text-center text-sm text-gray-500 dark:text-gray-400">
                            {{ __('message.contact_alternative') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Contact Options -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">
                    {{ __('message.other_ways_connect') }}
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    {{ __('message.choose_contact_method') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @if($config->email)
                    <div class="text-center card-hover bg-blue-50 dark:bg-blue-900/20 rounded-xl p-8" data-aos="fade-up"
                        data-aos-delay="100">
                        <div
                            class="w-16 h-16 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-envelope text-2xl text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">
                            {{ __('message.email_me') }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            {{ __('message.email_desc') }}
                        </p>
                        <a href="mailto:{{ $config->email }}"
                            class="bg-gradient-to-r from-blue-600 to-blue-600 hover:from-blue-700 hover:to-blue-700 text-white px-6 py-2 rounded-full font-semibold transition-all inline-block">
                            {{ __('message.send_email') }}
                        </a>
                    </div>
                @endif

                @if($config->phone)
                    <div class="text-center card-hover bg-green-50 dark:bg-green-900/20 rounded-xl p-8" data-aos="fade-up"
                        data-aos-delay="200">
                        <div
                            class="w-16 h-16 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-phone text-2xl text-green-600 dark:text-green-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">
                            {{ __('message.call_me') }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            {{ __('message.call_desc') }}
                        </p>
                        <a href="tel:{{ $config->phone }}"
                            class="bg-gradient-to-r from-blue-600 to-blue-600 hover:from-blue-700 hover:to-blue-700 text-white px-6 py-2 rounded-full font-semibold transition-all inline-block">
                            {{ __('message.call_now') }}
                        </a>
                    </div>
                @endif

                @if($config->linkedin)
                    <div class="text-center card-hover bg-blue-50 dark:bg-blue-900/20 rounded-xl p-8" data-aos="fade-up"
                        data-aos-delay="300">
                        <div
                            class="w-16 h-16 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fab fa-linkedin text-2xl text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">
                            {{ __('message.linkedin') }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            {{ __('message.linkedin_desc') }}
                        </p>
                        <a href="{{ $config->linkedin }}" target="_blank"
                            class="bg-gradient-to-r from-blue-600 to-blue-600 hover:from-blue-700 hover:to-blue-700 text-white px-6 py-2 rounded-full font-semibold transition-all inline-block">
                            {{ __('message.connect') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Availability Status -->
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl dark:shadow-gray-900/50 p-8">
                <div class="flex items-center justify-center mb-4">
                    <div
                        class="w-4 h-4 bg-green-500 rounded-full {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }} animate-pulse">
                    </div>
                    <span class="text-green-600 dark:text-green-400 font-semibold">
                        {{ __('message.available_for_work') }}
                    </span>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">
                    {{ __('message.ready_next_project') }}
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-6">
                    {{ __('message.project_desc') }}
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    @if($config->cv)
                        <a href="{{ asset('storage/' . $config->cv) }}" target="_blank"
                            class="bg-gradient-to-r from-blue-600 to-blue-600 hover:from-blue-700 hover:to-blue-700 text-white px-6 py-3 rounded-full font-semibold transition-all transform hover:scale-105 shadow-lg">
                            <i class="fas fa-download {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            {{ __('message.download_resume') }}
                        </a>
                    @endif
                    <a href="{{ route('portfolio.projects') }}"
                        class="border-2 border-blue-600 dark:border-blue-400 text-blue-600 dark:text-blue-400 px-6 py-3 rounded-full font-semibold hover:bg-blue-600 hover:text-white dark:hover:bg-blue-600 dark:hover:text-white transition-all transform hover:scale-105">
                        {{ __('message.view_my_work') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Popup -->
    <div id="successPopup"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 max-w-md w-full mx-4 transform scale-75 transition-all duration-300"
            id="successPopupContent">
            <div class="text-center">
                <!-- Success Icon with Animation -->
                <div
                    class="w-20 h-20 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce">
                    <svg class="w-10 h-10 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <!-- Success Title -->
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
                    @if(app()->getLocale() == 'ar')
                        تم الإرسال بنجاح!
                    @else
                        Message Sent Successfully!
                    @endif
                </h3>

                <!-- Success Message -->
                <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                    @if(app()->getLocale() == 'ar')
                        شكراً لتواصلك معنا! تم إرسال رسالتك بنجاح وسنقوم بالرد عليك في أقرب وقت ممكن.
                    @else
                        Thank you for reaching out! Your message has been sent successfully and we'll get back to you as soon as
                        possible.
                    @endif
                </p>

                <!-- Confetti Animation -->
                <div class="relative overflow-hidden rounded-lg mb-6">
                    <div id="confetti-container" class="absolute inset-0 pointer-events-none"></div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 justify-center">
                    <button onclick="closeSuccessPopup()"
                        class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-lg font-semibold transition-all transform hover:scale-105 shadow-lg">
                        @if(app()->getLocale() == 'ar')
                            ممتاز!
                        @else
                            Great!
                        @endif
                    </button>
                    <button onclick="sendAnotherMessage()"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-all transform hover:scale-105 shadow-lg">
                        @if(app()->getLocale() == 'ar')
                            إرسال رسالة أخرى
                        @else
                            Send Another
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Popup -->
    <div id="errorPopup"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 max-w-md w-full mx-4 transform scale-75 transition-all duration-300"
            id="errorPopupContent">
            <div class="text-center">
                <!-- Error Icon -->
                <div
                    class="w-20 h-20 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </div>

                <!-- Error Title -->
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
                    @if(app()->getLocale() == 'ar')
                        حدث خطأ!
                    @else
                        Something went wrong!
                    @endif
                </h3>

                <!-- Error Message -->
                <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed" id="errorMessage">
                    @if(app()->getLocale() == 'ar')
                        عذراً، حدث خطأ أثناء إرسال رسالتك. يرجى المحاولة مرة أخرى.
                    @else
                        Sorry, there was an error sending your message. Please try again.
                    @endif
                </p>

                <!-- Action Buttons -->
                <div class="flex gap-3 justify-center">
                    <button onclick="closeErrorPopup()"
                        class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-6 py-3 rounded-lg font-semibold transition-all transform hover:scale-105 shadow-lg">
                        @if(app()->getLocale() == 'ar')
                            حاول مرة أخرى
                        @else
                            Try Again
                        @endif
                    </button>
                    <button onclick="closeErrorPopup()"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-all transform hover:scale-105 shadow-lg">
                        @if(app()->getLocale() == 'ar')
                            إغلاق
                        @else
                            Close
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Contact form submission with AJAX
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('contactForm');
            const submitBtn = document.getElementById('submitBtn');
            const buttonText = document.getElementById('button-text');
            const buttonIcon = document.getElementById('button-icon');
            const loadingSpinner = document.getElementById('loading-spinner');

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                // Clear previous errors
                clearErrors();

                // Show loading state
                showLoadingState();

                // Prepare form data
                const formData = new FormData(form);

                // Send AJAX request
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showSuccessPopup();
                            form.reset();
                        } else {
                            if (data.errors) {
                                showValidationErrors(data.errors);
                            } else {
                                showErrorPopup(data.message);
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showErrorPopup();
                    })
                    .finally(() => {
                        hideLoadingState();
                    });
            });
        });

        // Show loading state
        function showLoadingState() {
            const submitBtn = document.getElementById('submitBtn');
            const buttonText = document.getElementById('button-text');
            const buttonIcon = document.getElementById('button-icon');
            const loadingSpinner = document.getElementById('loading-spinner');

            submitBtn.disabled = true;
            buttonText.classList.add('hidden');
            buttonIcon.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');
        }

        // Hide loading state
        function hideLoadingState() {
            const submitBtn = document.getElementById('submitBtn');
            const buttonText = document.getElementById('button-text');
            const buttonIcon = document.getElementById('button-icon');
            const loadingSpinner = document.getElementById('loading-spinner');

            submitBtn.disabled = false;
            buttonText.classList.remove('hidden');
            buttonIcon.classList.remove('hidden');
            loadingSpinner.classList.add('hidden');
        }

        // Clear validation errors
        function clearErrors() {
            const errorElements = document.querySelectorAll('.error-message');
            errorElements.forEach(element => {
                element.classList.add('hidden');
                element.textContent = '';
            });
        }

        // Show validation errors
        function showValidationErrors(errors) {
            Object.keys(errors).forEach(field => {
                const errorElement = document.getElementById(field + '-error');
                if (errorElement) {
                    errorElement.textContent = errors[field][0];
                    errorElement.classList.remove('hidden');
                }
            });
        }

        // Show success popup
        function showSuccessPopup() {
            const popup = document.getElementById('successPopup');
            const popupContent = document.getElementById('successPopupContent');

            popup.classList.remove('opacity-0', 'invisible');
            popupContent.classList.remove('scale-75');
            popupContent.classList.add('scale-100');

            createConfetti();

            // Auto close after 5 seconds
            setTimeout(() => {
                closeSuccessPopup();
            }, 5000);
        }

        // Show error popup
        function showErrorPopup(message = null) {
            const popup = document.getElementById('errorPopup');
            const popupContent = document.getElementById('errorPopupContent');
            const errorMessage = document.getElementById('errorMessage');

            if (message) {
                errorMessage.textContent = message;
            }

            popup.classList.remove('opacity-0', 'invisible');
            popupContent.classList.remove('scale-75');
            popupContent.classList.add('scale-100');
        }

        // Close success popup
        function closeSuccessPopup() {
            const popup = document.getElementById('successPopup');
            const popupContent = document.getElementById('successPopupContent');

            popupContent.classList.remove('scale-100');
            popupContent.classList.add('scale-75');
            popup.classList.add('opacity-0', 'invisible');
        }

        // Close error popup
        function closeErrorPopup() {
            const popup = document.getElementById('errorPopup');
            const popupContent = document.getElementById('errorPopupContent');

            popupContent.classList.remove('scale-100');
            popupContent.classList.add('scale-75');
            popup.classList.add('opacity-0', 'invisible');
        }

        // Send another message
        function sendAnotherMessage() {
            closeSuccessPopup();
            document.getElementById('contactForm').scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }

        // Create confetti animation
        function createConfetti() {
            const container = document.getElementById('confetti-container');
            container.innerHTML = '';

            const colors = ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6'];

            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.style.position = 'absolute';
                confetti.style.width = '6px';
                confetti.style.height = '6px';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.top = '-10px';
                confetti.style.opacity = Math.random();
                confetti.style.borderRadius = '50%';
                confetti.style.animation = `fall ${Math.random() * 3 + 2}s linear forwards`;

                container.appendChild(confetti);

                // Remove confetti after animation
                setTimeout(() => {
                    if (confetti.parentNode) {
                        confetti.parentNode.removeChild(confetti);
                    }
                }, 5000);
            }
        }

        // Close popup when clicking outside
        document.addEventListener('click', function (e) {
            const successPopup = document.getElementById('successPopup');
            const errorPopup = document.getElementById('errorPopup');

            if (e.target === successPopup) {
                closeSuccessPopup();
            }
            if (e.target === errorPopup) {
                closeErrorPopup();
            }
        });

        // Add CSS animation for confetti
        const style = document.createElement('style');
        style.textContent = `
                @keyframes fall {
                    0% {
                        transform: translateY(-10px) rotate(0deg);
                        opacity: 1;
                    }
                    100% {
                        transform: translateY(300px) rotate(360deg);
                        opacity: 0;
                    }
                }
            `;
        document.head.appendChild(style);
    </script>
@endsection