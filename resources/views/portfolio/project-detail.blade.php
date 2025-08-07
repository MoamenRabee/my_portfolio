@extends('portfolio.layout')

@section('title', (app()->getLocale() == 'ar' ? $project->title_ar : $project->title_en) . ' - ' . ($config->site_name ?? 'Portfolio'))

@push('styles')
<style>
    /* Image hover effects */
    .image-card {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .image-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    
    /* Modal improvements */
    #modalImage {
        transition: transform 0.3s ease, opacity 0.3s ease;
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
    }
    
    /* Responsive image containers */
    .image-container {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    }
    
    .dark .image-container {
        background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
    }
</style>
@endpush

@section('content')
    <!-- Project Header -->
    <section class="gradient-bg py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-white" data-aos="fade-up">
                <!-- Breadcrumb -->
                <nav class="mb-8">
                    <ol
                        class="flex items-center {{ app()->getLocale() == 'ar' ? 'space-x-reverse space-x-2' : 'space-x-2' }} text-blue-200">
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
                                <span class="text-blue-200">
                                    {{ app()->getLocale() == 'ar' ? 'تم تطويره في' : 'Developed at' }}
                                    {{ app()->getLocale() == 'ar' ? $project->experience->company_name_ar : $project->experience->company_name_en }}
                                </span>
                            </div>
                        @endif

                        <p class="text-xl text-blue-100 mb-8 leading-relaxed">
                            {{ app()->getLocale() == 'ar' ? $project->description_ar : $project->description_en }}
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
                            <img src="{{ asset('storage/' . $project->images->first()->image) }}"
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
        <section class="py-20 bg-white dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-12 text-center" data-aos="fade-up">
                    {{ app()->getLocale() == 'ar' ? 'معرض الصور' : 'Project Gallery' }}
                </h2>

                <!-- Responsive Grid Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($project->images as $image)
                        <div class="group image-card rounded-lg overflow-hidden shadow-lg aspect-video bg-gray-100 dark:bg-gray-800 cursor-pointer" data-aos="fade-up"
                            data-aos-delay="{{ $loop->index * 100 }}" onclick="openImageModal('{{ asset('storage/' . $image->image) }}')">
                            <div class="image-container relative w-full h-full">
                                <img src="{{ asset('storage/' . $image->image) }}"
                                    alt="{{ app()->getLocale() == 'ar' ? $project->title_ar : $project->title_en }}"
                                    class="w-full h-full object-contain group-hover:object-cover transition-all duration-500 relative z-10"
                                    style="pointer-events: none;">
                                
                                <!-- Overlay with zoom icon -->
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100 pointer-events-none">
                                    <div class="text-white text-2xl transform scale-75 group-hover:scale-100 transition-transform duration-300">
                                        <i class="fas fa-expand-arrows-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Technologies Used -->
    @if($project->skills->count() > 0)
        <section class="py-20 bg-gray-50 dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">
                        {{ app()->getLocale() == 'ar' ? 'التقنيات المستخدمة' : 'Technologies Used' }}
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300">
                        {{ app()->getLocale() == 'ar' ? 'الأدوات والتقنيات التي استخدمتها في تطوير هذا المشروع' : 'Tools and technologies used to build this project' }}
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6" data-aos="fade-up" data-aos-delay="200">
                    @foreach($project->skills as $skill)
                        <div class="bg-white dark:bg-gray-700 rounded-lg p-6 text-center shadow-lg card-hover">
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-code text-blue-600 dark:text-blue-400 text-xl"></i>
                            </div>
                            <h3 class="font-semibold text-gray-800 dark:text-white">
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
        <section class="py-20 bg-white dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-gradient-to-r from-blue-50 to-blue-50 dark:from-gray-800 dark:to-gray-800 rounded-2xl p-8 lg:p-12" data-aos="fade-up">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">
                                {{ app()->getLocale() == 'ar' ? 'سياق المشروع' : 'Project Context' }}
                            </h2>
                            <p class="text-gray-600 dark:text-gray-300 mb-6">
                                {{ app()->getLocale() == 'ar' ? 'تم تطوير هذا المشروع خلال عملي في' : 'This project was developed during my time at' }}
                                {{ app()->getLocale() == 'ar' ? $project->experience->company_name_ar : $project->experience->company_name_en }}
                                {{ app()->getLocale() == 'ar' ? 'كـ' : 'as' }}
                                {{ app()->getLocale() == 'ar' ? $project->experience->title_ar : $project->experience->title_en }}.
                            </p>
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ app()->getLocale() == 'ar' ? $project->experience->description_ar : $project->experience->description_en }}
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('portfolio.experiences') }}"
                                    class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-semibold transition-colors">
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
                                <div class="w-32 h-32 bg-blue-100 dark:bg-blue-900 rounded-xl flex items-center justify-center mx-auto">
                                    <i class="fas fa-building text-4xl text-blue-600 dark:text-blue-400"></i>
                                </div>
                            @endif

                            <h3 class="text-xl font-bold text-gray-800 dark:text-white mt-4">
                                {{ app()->getLocale() == 'ar' ? $project->experience->company_name_ar : $project->experience->company_name_en }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300">
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
        <section class="py-20 bg-gray-50 dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">
                        {{ app()->getLocale() == 'ar' ? 'مشاريع مشابهة' : 'Related Projects' }}
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300">
                        {{ app()->getLocale() == 'ar' ? 'مشاريع أخرى قد تهمك' : 'Other projects you might be interested in' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedProjects as $relatedProject)
                        <div class="bg-white dark:bg-gray-700 rounded-xl shadow-lg overflow-hidden card-hover" data-aos="fade-up"
                            data-aos-delay="{{ $loop->index * 100 }}">
                            @if($relatedProject->images->first())
                                <img src="{{ asset('storage/' . $relatedProject->images->first()->image) }}"
                                    alt="{{ app()->getLocale() == 'ar' ? $relatedProject->title_ar : $relatedProject->title_en }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-500 flex items-center justify-center">
                                    <i class="fas fa-project-diagram text-3xl text-white"></i>
                                </div>
                            @endif

                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2">
                                    {{ app()->getLocale() == 'ar' ? $relatedProject->title_ar : $relatedProject->title_en }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300 mb-4">
                                    {{ Str::limit(app()->getLocale() == 'ar' ? $relatedProject->description_ar : $relatedProject->description_en, 100) }}
                                </p>
                                <a href="{{ route('portfolio.project', $relatedProject->id) }}"
                                    class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-semibold transition-colors">
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

    <!-- Enhanced Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
        <div class="relative max-w-7xl max-h-full w-full h-full flex items-center justify-center">
            <!-- Loading Spinner -->
            <div id="imageLoader" class="absolute inset-0 flex items-center justify-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-white"></div>
            </div>
            
            <!-- Main Image -->
            <img id="modalImage" src="" alt="" 
                 class="max-w-full max-h-full object-contain rounded-lg shadow-2xl opacity-0 transition-opacity duration-300"
                 onload="this.style.opacity=1; document.getElementById('imageLoader').style.display='none'">
            
            <!-- Controls -->
            <button onclick="closeImageModal()" 
                    class="absolute top-4 right-4 w-10 h-10 bg-black bg-opacity-50 hover:bg-opacity-75 text-white rounded-full flex items-center justify-center text-xl transition-all duration-300">
                <i class="fas fa-times"></i>
            </button>
            
            <!-- Download Button -->
            <button onclick="downloadImage()" 
                    class="absolute top-4 left-4 w-10 h-10 bg-black bg-opacity-50 hover:bg-opacity-75 text-white rounded-full flex items-center justify-center text-lg transition-all duration-300">
                <i class="fas fa-download"></i>
            </button>
            
            <!-- Zoom Controls -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                <button onclick="zoomImage('in')" 
                        class="w-10 h-10 bg-black bg-opacity-50 hover:bg-opacity-75 text-white rounded-full flex items-center justify-center transition-all duration-300">
                    <i class="fas fa-search-plus"></i>
                </button>
                <button onclick="zoomImage('out')" 
                        class="w-10 h-10 bg-black bg-opacity-50 hover:bg-opacity-75 text-white rounded-full flex items-center justify-center transition-all duration-300">
                    <i class="fas fa-search-minus"></i>
                </button>
                <button onclick="resetZoom()" 
                        class="w-10 h-10 bg-black bg-opacity-50 hover:bg-opacity-75 text-white rounded-full flex items-center justify-center transition-all duration-300">
                    <i class="fas fa-undo"></i>
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let currentZoom = 1;
            let currentImageSrc = '';

            // Debug function
            console.log('Image modal script loaded');

            function openImageModal(imageSrc) {
                console.log('Opening modal with image:', imageSrc);
                currentImageSrc = imageSrc;
                const modalImage = document.getElementById('modalImage');
                const imageLoader = document.getElementById('imageLoader');
                
                // Reset image and show loader
                modalImage.style.opacity = '0';
                imageLoader.style.display = 'flex';
                resetZoom();
                
                modalImage.src = imageSrc;
                document.getElementById('imageModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeImageModal() {
                document.getElementById('imageModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
                currentImageSrc = '';
                resetZoom();
            }

            function downloadImage() {
                if (currentImageSrc) {
                    const link = document.createElement('a');
                    link.href = currentImageSrc;
                    link.download = 'project-image.jpg';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            }

            function zoomImage(direction) {
                const modalImage = document.getElementById('modalImage');
                
                if (direction === 'in') {
                    currentZoom = Math.min(currentZoom * 1.2, 3);
                } else {
                    currentZoom = Math.max(currentZoom / 1.2, 0.5);
                }
                
                modalImage.style.transform = `scale(${currentZoom})`;
                modalImage.style.cursor = currentZoom > 1 ? 'move' : 'default';
            }

            function resetZoom() {
                currentZoom = 1;
                const modalImage = document.getElementById('modalImage');
                modalImage.style.transform = 'scale(1)';
                modalImage.style.cursor = 'default';
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

            // Zoom with mouse wheel
            document.getElementById('modalImage').addEventListener('wheel', function(e) {
                e.preventDefault();
                if (e.deltaY < 0) {
                    zoomImage('in');
                } else {
                    zoomImage('out');
                }
            });

            // Pan functionality when zoomed
            let isPanning = false;
            let startX, startY, initialX = 0, initialY = 0;

            document.getElementById('modalImage').addEventListener('mousedown', function(e) {
                if (currentZoom > 1) {
                    isPanning = true;
                    startX = e.clientX - initialX;
                    startY = e.clientY - initialY;
                    this.style.cursor = 'grabbing';
                }
            });

            document.addEventListener('mousemove', function(e) {
                if (isPanning && currentZoom > 1) {
                    e.preventDefault();
                    initialX = e.clientX - startX;
                    initialY = e.clientY - startY;
                    
                    const modalImage = document.getElementById('modalImage');
                    modalImage.style.transform = `scale(${currentZoom}) translate(${initialX/currentZoom}px, ${initialY/currentZoom}px)`;
                }
            });

            document.addEventListener('mouseup', function() {
                if (isPanning) {
                    isPanning = false;
                    const modalImage = document.getElementById('modalImage');
                    modalImage.style.cursor = currentZoom > 1 ? 'move' : 'default';
                }
            });
        </script>
    @endpush
@endsection