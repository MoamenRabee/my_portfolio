<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', ($config && $config->site_name) ? $config->site_name : 'Portfolio')</title>
    <meta name="description" content="{{ ($config && $config->site_description) ? $config->site_description : '' }}">
    <meta name="keywords" content="{{ ($config && $config->site_keywords) ? $config->site_keywords : '' }}">
    @if($config && $config->logo)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $config->logo) }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/' . $config->logo) }}">
    @endif

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'arabic': ['Cairo', 'sans-serif'],
                        'english': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family:
                {{ app()->getLocale() == 'ar' ? "'Cairo', sans-serif" : "'Inter', sans-serif" }}
            ;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }

        .dark .gradient-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .dark .card-hover:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        }

        .navbar-glass {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }

        .dark .navbar-glass {
            background: rgba(31, 41, 55, 0.9);
        }

        .skill-badge {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            margin: 0.125rem;
            display: inline-block;
        }

        .dark .skill-badge {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
        }

        /* RTL Support */
        [dir="rtl"] .space-x-reverse> :not([hidden])~ :not([hidden]) {
            --tw-space-x-reverse: 1;
        }

        /* Dark mode transitions */
        * {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        /* Portfolio Dropdown Styles */
        .dropdown-menu {
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .group:hover .dropdown-menu {
            transform: translateY(0);
        }

        .dropdown-arrow {
            transition: transform 0.3s ease;
        }

        .group:hover .dropdown-arrow {
            transform: rotate(180deg);
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <!-- Navigation -->
    <nav class="navbar-glass fixed w-full top-0 z-50 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('portfolio.index') }}"
                        class="flex items-center {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-2' : 'space-x-2' }}">
                        @if($config && $config->logo)
                            <img src="{{ asset('storage/' . $config->logo) }}" alt="Logo" class="h-8 w-8 rounded-full">
                        @endif
                        <span
                            class="font-bold text-xl text-gray-800 dark:text-gray-200">{{ ($config && $config->site_name) ? $config->site_name : 'Portfolio' }}</span>
                    </a>
                </div>

                <div
                    class="hidden md:flex items-center {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-6' : 'space-x-6' }}">
                    <a href="{{ route('portfolio.index') }}"
                        class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium">
                        {{ __('message.home') }}
                    </a>
                    <a href="{{ route('portfolio.about') }}"
                        class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium">
                        {{ __('message.about') }}
                    </a>

                    <!-- Portfolio Dropdown -->
                    <div class="relative group">
                        <button
                            class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium flex items-center">
                            {{ __('message.portfolio') }}
                            <i
                                class="fas fa-chevron-down text-xs {{ app()->getLocale() == 'ar' ? 'mr-1' : 'ml-1' }} dropdown-arrow"></i>
                        </button>

                        <div
                            class="dropdown-menu absolute {{ app()->getLocale() == 'ar' ? 'right-0' : 'left-0' }} mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg dark:shadow-gray-900/50 border border-gray-200 dark:border-gray-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible z-50">
                            <div class="p-2">
                                <a href="{{ route('portfolio.experiences') }}"
                                    class="flex items-center px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded-md transition-colors">
                                    <i
                                        class="fas fa-briefcase text-blue-500 {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }} w-4"></i>
                                    {{ __('message.experiences') }}
                                </a>
                                <!-- <a href="{{ route('portfolio.education') }}" 
                                   class="flex items-center px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded-md transition-colors">
                                    <i class="fas fa-graduation-cap text-green-500 {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }} w-4"></i>
                                    {{ __('message.education') }}
                                </a>
                                <a href="{{ route('portfolio.certifications') }}" 
                                   class="flex items-center px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded-md transition-colors">
                                    <i class="fas fa-certificate text-blue-500 {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }} w-4"></i>
                                    {{ __('message.certifications') }}
                                </a> -->
                                <div class="border-t border-gray-200 dark:border-gray-600 my-2"></div>
                                <a href="{{ route('portfolio.projects') }}"
                                    class="flex items-center px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded-md transition-colors">
                                    <i
                                        class="fas fa-code text-orange-500 {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }} w-4"></i>
                                    {{ __('message.projects') }}
                                </a>
                                <a href="{{ route('portfolio.skills') }}"
                                    class="flex items-center px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded-md transition-colors">
                                    <i
                                        class="fas fa-tools text-red-500 {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }} w-4"></i>
                                    {{ __('message.skills') }}
                                </a>

                                <!-- CV Download -->
                                <div class="border-t border-gray-200 dark:border-gray-600 my-1"></div>
                                <a href="{{ route('portfolio.downloadCV') }}" target="_blank"
                                    class="flex items-center px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/20 hover:text-green-600 dark:hover:text-green-400 rounded-md transition-colors">
                                    <i
                                        class="fas fa-download text-green-500 {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }} w-4"></i>
                                    {{ app()->getLocale() == 'ar' ? 'تحميل السيرة الذاتية' : 'Download CV' }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('portfolio.contact') }}"
                        class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium">
                        {{ __('message.contact') }}
                    </a>

                    <!-- Language Switch -->
                    <div
                        class="flex items-center {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-1' : 'space-x-1' }}">
                        <a href="{{ route('lang.switch', 'ar') }}"
                            class="px-2 py-1 rounded text-xs {{ app()->getLocale() == 'ar' ? 'bg-blue-600 text-white' : 'text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400' }} transition-colors font-medium">
                            {{ __('message.arabic') }}
                        </a>
                        <span class="text-gray-400 text-xs">|</span>
                        <a href="{{ route('lang.switch', 'en') }}"
                            class="px-2 py-1 rounded text-xs {{ app()->getLocale() == 'en' ? 'bg-blue-600 text-white' : 'text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400' }} transition-colors font-medium">
                            {{ __('message.english') }}
                        </a>
                    </div>

                    <!-- Dark Mode Toggle -->
                    <button onclick="toggleDarkMode()"
                        class="p-2 rounded-lg text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                        <i class="fas fa-moon dark:hidden text-sm"></i>
                        <i class="fas fa-sun hidden dark:block text-sm"></i>
                    </button>
                </div>

                <!-- Mobile menu button -->
                <div
                    class="md:hidden flex items-center {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-3' : 'space-x-3' }}">
                    <!-- Dark Mode Toggle Mobile -->
                    <button onclick="toggleDarkMode()"
                        class="p-2 rounded-lg text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                        <i class="fas fa-moon dark:hidden"></i>
                        <i class="fas fa-sun hidden dark:block"></i>
                    </button>

                    <button id="mobile-menu-button"
                        class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu"
            class="md:hidden hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('portfolio.index') }}"
                    class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium">
                    {{ __('message.home') }}
                </a>
                <a href="{{ route('portfolio.about') }}"
                    class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium">
                    {{ __('message.about') }}
                </a>
                <a href="{{ route('portfolio.experiences') }}"
                    class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium">
                    {{ __('message.experiences') }}
                </a>
                <a href="{{ route('portfolio.education') }}"
                    class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium">
                    {{ __('message.education') }}
                </a>
                <a href="{{ route('portfolio.certifications') }}"
                    class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium">
                    {{ __('message.certifications') }}
                </a>
                <a href="{{ route('portfolio.projects') }}"
                    class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium">
                    {{ __('message.projects') }}
                </a>
                <a href="{{ route('portfolio.skills') }}"
                    class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium">
                    {{ __('message.skills') }}
                </a>

                <!-- CV Download Mobile -->
                <div class="border-t border-gray-200 dark:border-gray-600 my-2"></div>
                <a href="{{ route('portfolio.downloadCV') }}" target="_blank"
                    class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors font-medium">
                    <i class="fas fa-download {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    {{ app()->getLocale() == 'ar' ? 'تحميل السيرة الذاتية' : 'Download CV' }}
                </a>

                <a href="{{ route('portfolio.contact') }}"
                    class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium">
                    {{ __('message.contact') }}
                </a>

                <!-- Language Switch Mobile -->
                <div class="px-3 py-2 border-t border-gray-200 dark:border-gray-600 mt-2">
                    <div class="flex {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-4' : 'space-x-4' }}">
                        <a href="{{ route('lang.switch', 'ar') }}"
                            class="px-3 py-1 rounded {{ app()->getLocale() == 'ar' ? 'bg-blue-600 text-white' : 'text-gray-600 dark:text-gray-400' }} transition-colors text-sm">
                            {{ __('message.arabic') }}
                        </a>
                        <a href="{{ route('lang.switch', 'en') }}"
                            class="px-3 py-1 rounded {{ app()->getLocale() == 'en' ? 'bg-blue-600 text-white' : 'text-gray-600 dark:text-gray-400' }} transition-colors text-sm">
                            {{ __('message.english') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer
        class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 dark:from-gray-900 dark:via-blue-950 dark:to-gray-900">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=" 60" height="60" viewBox="0 0 60 60"
            xmlns="http://www.w3.org/2000/svg" %3E%3Cg fill="none" fill-rule="evenodd" %3E%3Cg fill="%239C92AC"
            fill-opacity="0.03" %3E%3Ccircle cx="7" cy="7" r="7" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <!-- About Section -->
                <div class="md:col-span-2">
                    <div class="flex items-center mb-6">
                        @if($config && $config->logo)
                            <img src="{{ asset('storage/' . $config->logo) }}" alt="Logo"
                                class="h-10 w-10 rounded-full {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }}">
                        @endif
                        <h3
                            class="text-2xl font-bold bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">
                            {{ ($config && ($config->name_ar ?? $config->name_en)) ? (app()->getLocale() == 'ar' ? $config->name_ar : $config->name_en) : 'Portfolio' }}
                        </h3>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed max-w-md">
                        {{ ($config && ($config->summary_ar ?? $config->summary_en)) ? (app()->getLocale() == 'ar' ? $config->summary_ar : $config->summary_en) : '' }}
                    </p>

                    <!-- Social Media -->
                    <div class="flex {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-4' : 'space-x-4' }}">
                        @if($config && $config->facebook)
                            <a href="{{ $config->facebook }}" target="_blank"
                                class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center text-white hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-110 hover:shadow-lg">
                                <i class="fab fa-facebook"></i>
                            </a>
                        @endif
                        @if($config && $config->twitter)
                            <a href="{{ $config->twitter }}" target="_blank"
                                class="w-10 h-10 bg-gradient-to-r from-sky-500 to-sky-600 rounded-full flex items-center justify-center text-white hover:from-sky-600 hover:to-sky-700 transition-all duration-300 transform hover:scale-110 hover:shadow-lg">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif
                        @if($config && $config->linkedin)
                            <a href="{{ $config->linkedin }}" target="_blank"
                                class="w-10 h-10 bg-gradient-to-r from-blue-700 to-blue-800 rounded-full flex items-center justify-center text-white hover:from-blue-800 hover:to-blue-900 transition-all duration-300 transform hover:scale-110 hover:shadow-lg">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        @endif
                        @if($config && $config->github)
                            <a href="{{ $config->github }}" target="_blank"
                                class="w-10 h-10 bg-gradient-to-r from-gray-700 to-gray-800 rounded-full flex items-center justify-center text-white hover:from-gray-800 hover:to-gray-900 transition-all duration-300 transform hover:scale-110 hover:shadow-lg">
                                <i class="fab fa-github"></i>
                            </a>
                        @endif
                        @if($config && $config->instagram)
                            <a href="{{ $config->instagram }}" target="_blank"
                                class="w-10 h-10 bg-gradient-to-r from-pink-600 to-blue-600 rounded-full flex items-center justify-center text-white hover:from-pink-700 hover:to-blue-700 transition-all duration-300 transform hover:scale-110 hover:shadow-lg">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div
                            class="w-1 h-6 bg-gradient-to-b from-blue-400 to-blue-600 rounded-full {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }}">
                        </div>
                        {{ __('message.nav_quick_links') }}
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('portfolio.about') }}"
                                class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center group">
                                <i
                                    class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} text-xs text-blue-400 opacity-0 group-hover:opacity-100 transition-all duration-300 {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                {{ __('message.about') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('portfolio.projects') }}"
                                class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center group">
                                <i
                                    class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} text-xs text-blue-400 opacity-0 group-hover:opacity-100 transition-all duration-300 {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                {{ __('message.projects') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('portfolio.experiences') }}"
                                class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center group">
                                <i
                                    class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} text-xs text-blue-400 opacity-0 group-hover:opacity-100 transition-all duration-300 {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                {{ __('message.experiences') }}
                            </a>
                        </li>
                        <!-- <li>
                            <a href="{{ route('portfolio.education') }}"
                                class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center group">
                                <i
                                    class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} text-xs text-blue-400 opacity-0 group-hover:opacity-100 transition-all duration-300 {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                {{ __('message.education') }}
                            </a>
                        </li> -->
                        <!-- <li>
                            <a href="{{ route('portfolio.certifications') }}"
                                class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center group">
                                <i
                                    class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} text-xs text-blue-400 opacity-0 group-hover:opacity-100 transition-all duration-300 {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                {{ __('message.certifications') }}
                            </a>
                        </li> -->
                        <li>
                            <a href="{{ route('portfolio.contact') }}"
                                class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center group">
                                <i
                                    class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} text-xs text-blue-400 opacity-0 group-hover:opacity-100 transition-all duration-300 {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                {{ __('message.contact') }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-6 flex items-center">
                        <div
                            class="w-1 h-6 bg-gradient-to-b from-blue-400 to-blue-600 rounded-full {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }}">
                        </div>
                        {{ __('message.contact_info') }}
                    </h3>
                    <ul class="space-y-4">
                        @if($config && $config->email)
                            <li class="flex items-center text-gray-300 group">
                                <div
                                    class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }} group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-300">
                                    <i class="fas fa-envelope text-sm text-white"></i>
                                </div>
                                <span
                                    class="text-sm group-hover:text-white transition-colors duration-300">{{ $config->email }}</span>
                            </li>
                        @endif
                        @if($config && $config->phone)
                            <li class="flex items-center text-gray-300 group">
                                <div
                                    class="w-8 h-8 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }} group-hover:from-green-600 group-hover:to-green-700 transition-all duration-300">
                                    <i class="fas fa-phone text-sm text-white"></i>
                                </div>
                                <span
                                    class="text-sm group-hover:text-white transition-colors duration-300">{{ $config->phone }}</span>
                            </li>
                        @endif
                        @if($config && $config->address)
                            <li class="flex items-center text-gray-300 group">
                                <div
                                    class="w-8 h-8 bg-gradient-to-r from-red-500 to-red-600 rounded-lg flex items-center justify-center {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }} group-hover:from-red-600 group-hover:to-red-700 transition-all duration-300">
                                    <i class="fas fa-map-marker-alt text-sm text-white"></i>
                                </div>
                                <span
                                    class="text-sm group-hover:text-white transition-colors duration-300">{{ $config->address }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="border-t border-gray-700/50 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm mb-4 md:mb-0"
                        dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                        {{ $config && app()->getLocale() == 'ar' ?
    $config->copyright_ar : $config->copyright_en 
                            }}
                    </p>
                    <div
                        class="flex items-center {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-6' : 'space-x-6' }} text-sm text-gray-400">
                        <span class="flex items-center">
                            <i class="fas fa-heart text-red-500 {{ app()->getLocale() == 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                            {{ app()->getLocale() == 'ar' ? 'صُنع بحب' : 'Made with Love' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Dark Mode Toggle
        function toggleDarkMode() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('darkMode', 'false');
            } else {
                html.classList.add('dark');
                localStorage.setItem('darkMode', 'true');
            }
        }

        // Initialize dark mode from localStorage
        document.addEventListener('DOMContentLoaded', function () {
            const darkMode = localStorage.getItem('darkMode');
            if (darkMode === 'true' || (!darkMode && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>