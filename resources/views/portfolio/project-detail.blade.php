@extends('portfolio.layout')

@section('title', (app()->getLocale() == 'ar' ? $project->title_ar : $project->title_en) . ' - ' . ($config->site_name ?? 'Portfolio'))

@section('content')
    <!-- Project Header -->
    <section class="gradient-bg py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-white" data-aos="fade-up">
                <!-- Breadcrumb -->
                <nav class="mb-8">
                    <ol
                        class="flex items-center {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-2' : 'space-x-2' }} text-purple-200">
                        <li><a href="{{ route('portfolio.index') }}"
                                class="hover:text-white transition-colors">{{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}</a>
                        </li>
                        <li><i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} text-sm"></i></li>
                        <li><a href="{{ route('portfolio.projects') }}"
                                class="hover:text-white transition-colors">{{ app()->getLocale() == 'ar' ? 'المشاريع' : 'Projects' }}</a>
                        </li>
                        <li><i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} text-sm"></i></li>
                        <li class="text-white">{{ app()->getLocale() == 'ar' ? $project->title_ar : $project->title_en }}
                        </li>
                    </ol>
                </nav>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h1 class="text-5xl font-bold mb-6">
                            {{ app()->getLocale() == 'ar' ? $project->title_ar : $project->title_en }}
                        </h1>

                        @if($project->experience)
                            <div class="flex items-center mb-6">
                                @if($project->experience->company_logo)
                                    <img src="{{ asset('storage/' . $project->experience->company_logo) }}"
                                        alt="{{ app()->getLocale() == 'ar' ? $project->experience->company_name_ar : $project->experience->company_name_en }}"
                                        class="w-8 h-8 rounded object-cover {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }}">
                                @endif
                                <span class="text-purple-200">
                                    {{ app()->getLocale() == 'ar' ? 'تم تطويره في' : 'Developed at' }}
                                    {{ app()->getLocale() == 'ar' ? $project->experience->company_name_ar : $project->experience->company_name_en }}
                                </span>
                            </div>
                        @endif

                        <p class="text-xl text-blue-100 mb-8 leading-relaxed">
                            {!! app()->getLocale() == 'ar' ? $project->description_ar : $project->description_en !!}
                        </p>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-4">
                            @if($project->website_link)
                                <a href="{{ $project->website_link }}" target="_blank"
                                    class="btn-primary px-6 py-3 rounded-full font-semibold text-white hover:text-white transition-all">
                                    <i class="fas fa-external-link-alt {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                    {{ app()->getLocale() == 'ar' ? 'مشاهدة الموقع' : 'Live Demo' }}
                                </a>
                            @endif
                            @if($project->github_link)
                                <a href="{{ $project->github_link }}" target="_blank"
                                    class="border-2 border-white text-white px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-600 transition-all">
                                    <i class="fab fa-github {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                    {{ app()->getLocale() == 'ar' ? 'الكود المصدري' : 'Source Code' }}
                                </a>
                            @endif
                            @if($project->google_play_link)
                                <a href="{{ $project->google_play_link }}" target="_blank"
                                    class="border-2 border-white text-white px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-600 transition-all">
                                    <i class="fab fa-google-play {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                    {{ app()->getLocale() == 'ar' ? 'Google Play' : 'Google Play' }}
                                </a>
                            @endif
                            @if($project->app_store_link)
                                <a href="{{ $project->app_store_link }}" target="_blank"
                                    class="border-2 border-white text-white px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-600 transition-all">
                                    <i class="fab fa-app-store {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                    {{ app()->getLocale() == 'ar' ? 'App Store' : 'App Store' }}
                                </a>
                            @endif
                        </div>
                    </div>

                    <div>
                        @if($project->images->first())
                            <img src="{{ asset('storage/' . $project->images->first()->image_path) }}"
                                alt="{{ app()->getLocale() == 'ar' ? $project->title_ar : $project->title_en }}"
                                class="w-full rounded-xl shadow-2xl">
                        @else
                            <div class="w-full h-96 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-project-diagram text-6xl text-white"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Images Gallery -->
    @if($project->images->count() > 1)
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center" data-aos="fade-up">
                    {{ app()->getLocale() == 'ar' ? 'معرض الصور' : 'Project Gallery' }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($project->images as $image)
                        <div class="rounded-lg overflow-hidden shadow-lg card-hover" data-aos="fade-up"
                            data-aos-delay="{{ $loop->index * 100 }}">
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                alt="{{ app()->getLocale() == 'ar' ? $project->title_ar : $project->title_en }}"
                                class="w-full h-64 object-cover cursor-pointer"
                                onclick="openImageModal('{{ asset('storage/' . $image->image_path) }}')">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Technologies Used -->
    @if($project->skills->count() > 0)
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">
                        {{ app()->getLocale() == 'ar' ? 'التقنيات المستخدمة' : 'Technologies Used' }}
                    </h2>
                    <p class="text-xl text-gray-600">
                        {{ app()->getLocale() == 'ar' ? 'الأدوات والتقنيات التي استخدمتها في تطوير هذا المشروع' : 'Tools and technologies used to build this project' }}
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6" data-aos="fade-up" data-aos-delay="200">
                    @foreach($project->skills as $skill)
                        <div class="bg-white rounded-lg p-6 text-center shadow-lg card-hover">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-code text-blue-600 text-xl"></i>
                            </div>
                            <h3 class="font-semibold text-gray-800">
                                {{ app()->getLocale() == 'ar' ? $skill->name_ar : $skill->name_en }}
                            </h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Project Experience Context -->
    @if($project->experience)
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-2xl p-8 lg:p-12" data-aos="fade-up">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-800 mb-4">
                                {{ app()->getLocale() == 'ar' ? 'سياق المشروع' : 'Project Context' }}
                            </h2>
                            <p class="text-gray-600 mb-6">
                                {{ app()->getLocale() == 'ar' ? 'تم تطوير هذا المشروع خلال عملي في' : 'This project was developed during my time at' }}
                                {{ app()->getLocale() == 'ar' ? $project->experience->company_name_ar : $project->experience->company_name_en }}
                                {{ app()->getLocale() == 'ar' ? 'كـ' : 'as' }}
                                {{ app()->getLocale() == 'ar' ? $project->experience->title_ar : $project->experience->title_en }}.
                            </p>
                            <p class="text-gray-700 leading-relaxed">
                                {!! app()->getLocale() == 'ar' ? $project->experience->description_ar : $project->experience->description_en !!}
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('portfolio.experiences') }}"
                                    class="text-blue-600 hover:text-blue-800 font-semibold transition-colors">
                                    {{ app()->getLocale() == 'ar' ? 'مشاهدة جميع خبراتي' : 'View All My Experience' }}
                                    <i
                                        class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} {{ app()->getLocale() == 'ar' ? 'mr-1' : 'ml-1' }}"></i>
                                </a>
                            </div>
                        </div>

                        <div class="text-center">
                            @if($project->experience->company_logo)
                                <img src="{{ asset('storage/' . $project->experience->company_logo) }}"
                                    alt="{{ app()->getLocale() == 'ar' ? $project->experience->company_name_ar : $project->experience->company_name_en }}"
                                    class="w-32 h-32 rounded-xl object-cover mx-auto shadow-lg">
                            @else
                                <div class="w-32 h-32 bg-blue-100 rounded-xl flex items-center justify-center mx-auto">
                                    <i class="fas fa-building text-4xl text-blue-600"></i>
                                </div>
                            @endif

                            <h3 class="text-xl font-bold text-gray-800 mt-4">
                                {{ app()->getLocale() == 'ar' ? $project->experience->company_name_ar : $project->experience->company_name_en }}
                            </h3>
                            <p class="text-gray-600">
                                {{ $project->experience->start_date }} -
                                {{ $project->experience->end_date ?? (app()->getLocale() == 'ar' ? 'حتى الآن' : 'Present') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Related Projects -->
    @php
        $relatedProjects = $project->skills->isNotEmpty()
            ? App\Models\Project::whereHas('skills', function ($query) use ($project) {
                $query->whereIn('skills.id', $project->skills->pluck('id'));
            })->where('id', '!=', $project->id)->take(3)->get()
            : collect();
    @endphp

    @if($relatedProjects->count() > 0)
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">
                        {{ app()->getLocale() == 'ar' ? 'مشاريع مشابهة' : 'Related Projects' }}
                    </h2>
                    <p class="text-xl text-gray-600">
                        {{ app()->getLocale() == 'ar' ? 'مشاريع أخرى قد تهمك' : 'Other projects you might be interested in' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedProjects as $relatedProject)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover" data-aos="fade-up"
                            data-aos-delay="{{ $loop->index * 100 }}">
                            @if($relatedProject->images->first())
                                <img src="{{ asset('storage/' . $relatedProject->images->first()->image_path) }}"
                                    alt="{{ app()->getLocale() == 'ar' ? $relatedProject->title_ar : $relatedProject->title_en }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-500 flex items-center justify-center">
                                    <i class="fas fa-project-diagram text-3xl text-white"></i>
                                </div>
                            @endif

                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-2">
                                    {{ app()->getLocale() == 'ar' ? $relatedProject->title_ar : $relatedProject->title_en }}
                                </h3>
                                <p class="text-gray-600 mb-4">
                                    {!! Str::limit(app()->getLocale() == 'ar' ? $relatedProject->description_ar : $relatedProject->description_en, 100) !!}
                                </p>
                                <a href="{{ route('portfolio.project', $relatedProject->id) }}"
                                    class="text-blue-600 hover:text-blue-800 font-semibold transition-colors">
                                    {{ app()->getLocale() == 'ar' ? 'مشاهدة المشروع' : 'View Project' }}
                                    <i
                                        class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} {{ app()->getLocale() == 'ar' ? 'mr-1' : 'ml-1' }}"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    @push('scripts')
        <script>
            function openImageModal(imageSrc) {
                document.getElementById('modalImage').src = imageSrc;
                document.getElementById('imageModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeImageModal() {
                document.getElementById('imageModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            // Close modal when clicking outside
            document.getElementById('imageModal').addEventListener('click', function (e) {
                if (e.target === this) {
                    closeImageModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeImageModal();
                }
            });
        </script>
    @endpush
@endsection