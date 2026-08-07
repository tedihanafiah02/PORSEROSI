@extends('front.master')

@section('title', __('messages.page_title_news'))
@section('description', __('messages.page_desc_news'))
@section('keywords', 'berita sepatu roda, berita skateboard, update PB PORSEROSI, olahraga')

@section('content')

<div class="font-[Poppins] bg-[#181836] text-gray-200 flex flex-col flex-grow min-h-screen">
    <x-navbar />

    {{-- Hero / Featured Section (Jumbotron Slider) --}}
    <section id="Featured" class="pt-[80px] md:pt-[90px]">
        @if($featured_articles->isNotEmpty())
            <div class="w-full relative main-carousel shadow-2xl shadow-black/50">
                @foreach($featured_articles as $article)
                    @php
                        $jumboImg = get_image_url($article->thumbnail);
                    @endphp
                    <div class="w-full h-[500px] md:h-[700px] lg:h-[80vh] flex-none group relative overflow-hidden" style="width: 100%;">
                        <img src="{{ $jumboImg }}"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-[10000ms] ease-out group-hover:scale-105" alt="{{ $article->name }}" />
                        <div class="absolute inset-0 bg-gradient-to-t from-[#181836] via-[#181836]/60 to-transparent"></div>
                        <div class="absolute inset-0 bg-black/20"></div> {{-- extra darkening for contrast --}}
                        
                        <div class="absolute bottom-0 left-0 w-full px-6 md:px-16 lg:px-24 pb-16 md:pb-24 z-20 flex flex-col justify-end max-w-[1600px] mx-auto">
                            <div class="flex flex-col gap-4 max-w-4xl animate-fade-in-up">
                                <div class="flex flex-wrap gap-3">
                                    <span class="px-3 py-1 bg-yellow-500 text-black text-[10px] md:text-xs font-bold uppercase tracking-wider rounded-sm shadow-md">
                                        {{ $article->category->name }}
                                    </span>
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md text-white text-[10px] md:text-xs font-semibold rounded-sm">
                                        {{ $article->created_at->format('d M Y') }}
                                    </span>
                                </div>
                                <a href="{{ route('front.details', $article->slug) }}"
                                    class="font-extrabold text-2xl md:text-4xl lg:text-5xl leading-tight text-white hover:text-yellow-400 transition-colors duration-300 drop-shadow-2xl line-clamp-3 mt-1.5">
                                    {{ $article->getLocalizedTitle() }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    {{-- Categories Bar --}}
    <section id="Categories" class="py-5 bg-[#1f1f45]/40 backdrop-blur-md shadow-lg border-y border-white/5 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex gap-3 md:gap-4 overflow-x-auto custom-scrollbar snap-x items-center justify-start xl:justify-center pb-2 md:pb-0">
                <a href="{{ route('front.index') }}" class="snap-start shrink-0 px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300 {{ !request()->routeIs('front.category') ? 'bg-yellow-500 text-black shadow-[0_0_15px_rgba(234,179,8,0.4)]' : 'bg-white/5 text-gray-300 hover:bg-white/10' }}">
                    {{ __('messages.all_news') }}
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('front.category', $category->slug) }}" class="snap-start shrink-0 px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300 bg-white/5 text-gray-300 hover:bg-yellow-500 hover:text-black hover:shadow-[0_0_15px_rgba(234,179,8,0.4)] border border-white/5 flex items-center gap-2 group">
                        @if($category->icon)
                            <img src="{{ get_image_url($category->icon) }}" class="w-4 h-4 object-contain brightness-0 invert opacity-70 group-hover:opacity-100 group-hover:brightness-0 group-hover:invert-0 transition-all" alt="icon">
                        @endif
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>



    {{-- Latest News Section --}}
    <section id="LatestNews" class="py-20 md:py-28 relative bg-[#181836]">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03] pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col items-center mb-16 text-center">
                <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-3 tracking-tight uppercase">
                    {{ __('messages.latest_news') }}
                </h2>
                <div class="w-24 h-1.5 bg-yellow-500 rounded-full shadow-[0_0_10px_rgba(234,179,8,0.5)]"></div>
            </div>

            <!-- Balanced 3-Column Equal Height Responsive Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
                    @php
                        $articleImg = get_image_url($article->thumbnail);
                    @endphp
                    <a href="{{ route('front.details', $article->slug) }}" class="group flex flex-col h-full bg-[#1f1f45] rounded-3xl overflow-hidden border border-white/5 hover:border-yellow-500/50 transition-all duration-500 hover:shadow-[0_15px_30px_rgba(0,0,0,0.4)] hover:-translate-y-2">
                        <div class="relative h-56 md:h-64 overflow-hidden shrink-0">
                            <div class="absolute top-4 left-4 z-10">
                                <span class="px-3 py-1 bg-yellow-500 text-black text-[10px] md:text-xs font-bold uppercase tracking-wider rounded-sm shadow-md">
                                    {{ $article->category->name }}
                                </span>
                            </div>
                            <img src="{{ $articleImg }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="thumbnail" />
                            <div class="absolute inset-0 bg-gradient-to-t from-[#1f1f45]/50 to-transparent"></div>
                        </div>
                        
                        <div class="p-6 md:p-8 flex flex-col flex-1">
                            <div class="flex items-center gap-2 text-xs text-gray-400 mb-3 font-medium">
                                <i class="far fa-calendar-alt"></i> {{ $article->created_at->format('d M Y') }}
                            </div>
                            <h3 class="text-base md:text-lg lg:text-xl font-bold text-white leading-snug mb-4 group-hover:text-yellow-400 transition-colors line-clamp-3">
                                {{ $article->getLocalizedTitle() }}
                            </h3>
                            

                        </div>
                    </a>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-24 bg-[#1f1f45] rounded-3xl border border-white/5">
                        <i class="far fa-newspaper text-7xl text-gray-600 mb-6"></i>
                        <p class="text-gray-400 text-xl font-medium">{{ __('messages.no_news_published') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Banner Iklan Section --}}
    @if(isset($bannerAds) && $bannerAds->isNotEmpty())
        <section class="py-12 bg-[#1f1f45]/20 border-y border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative rounded-3xl overflow-hidden shadow-xl border border-white/10 group aspect-[100/35] w-full" id="newsAdBannerSlider">
                    @foreach($bannerAds as $index => $banner)
                        <div class="ad-slide absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" data-slide-index="{{ $index }}" data-duration="{{ $banner->slide_duration * 1000 }}">
                            <a href="{{ $banner->link }}" target="_blank" class="block w-full h-full">
                                <img src="{{ get_image_url($banner->thumbnail) }}" alt="Iklan" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-[1.01]">
                                <div class="absolute top-3 right-3 bg-[#0d0d1f]/80 backdrop-blur-sm text-[9px] font-bold text-slate-400 px-2 py-0.5 rounded border border-white/10 uppercase tracking-widest z-20">
                                    Ad
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @if($bannerAds->count() > 1)
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const adSlides = document.querySelectorAll('#newsAdBannerSlider .ad-slide');
                    if (adSlides.length > 1) {
                        let currentAdIndex = 0;
                        function showNextAd() {
                            adSlides[currentAdIndex].classList.remove('opacity-100', 'z-10');
                            adSlides[currentAdIndex].classList.add('opacity-0', 'z-0');
                            
                            currentAdIndex = (currentAdIndex + 1) % adSlides.length;
                            
                            adSlides[currentAdIndex].classList.remove('opacity-0', 'z-0');
                            adSlides[currentAdIndex].classList.add('opacity-100', 'z-10');
                            
                            const nextDuration = parseInt(adSlides[currentAdIndex].getAttribute('data-duration')) || 5000;
                            setTimeout(showNextAd, nextDuration);
                        }
                        const firstDuration = parseInt(adSlides[0].getAttribute('data-duration')) || 5000;
                        setTimeout(showNextAd, firstDuration);
                    }
                });
            </script>
        @endif
    @endif

    {{-- Category Sections (Latest For You) --}}
    @foreach ($categories as $index => $category)
        @if(isset($category_sections[$category->slug]) && $category_sections[$category->slug]['articles']->isNotEmpty())
            <section class="py-24 {{ $index % 2 == 0 ? 'bg-[#181836]' : 'bg-[#1b1b3a]' }} border-t border-white/5">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                        <div>
                            <h2 class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-white flex items-center gap-3.5 uppercase">
                                <div class="w-2.5 h-8 md:h-10 bg-yellow-500 rounded-sm shadow-[0_0_10px_rgba(234,179,8,0.5)]"></div>
                                {{ __('messages.news') }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">{{ $category->name }}</span>
                            </h2>
                        </div>
                        <a href="{{ route('front.category', $category->slug) }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white/5 hover:bg-yellow-500 text-white hover:text-black font-bold transition-all duration-300 border border-white/10 hover:border-yellow-500 group">
                            {{ __('messages.see_all') }} <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                        @php 
                             $feat = $category_sections[$category->slug]['featured']; 
                             $isReversed = $index % 2 !== 0;
                             $featImg = $feat ? get_image_url($feat->thumbnail) : '';
                        @endphp

                        @if ($feat)
                            {{-- Featured Category Article --}}
                            <div class="lg:col-span-7 {{ $isReversed ? 'lg:order-2' : 'lg:order-1' }}">
                                <a href="{{ route('front.details', $feat->slug) }}" class="group block relative h-[500px] md:h-[600px] rounded-[2rem] overflow-hidden shadow-2xl border border-white/5 hover:border-yellow-500/50 transition-all duration-500">
                                    <img src="{{ $featImg }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[10s] ease-out group-hover:scale-110" alt="thumbnail">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#181836] via-[#181836]/50 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors duration-500"></div>
                                    
                                    <div class="absolute bottom-0 left-0 w-full p-8 md:p-12 z-10">
                                        <div class="flex items-center gap-3 mb-5">
                                            <span class="inline-block px-4 py-1.5 bg-yellow-500 text-black text-xs font-bold uppercase tracking-wider rounded-sm shadow-lg">{{ __('messages.main_highlight') }}</span>
                                            <span class="text-yellow-400 text-sm font-semibold"><i class="far fa-calendar-alt mr-1"></i> {{ $feat->created_at->format('d F Y') }}</span>
                                        </div>
                                        <h3 class="text-2xl md:text-4xl font-extrabold text-white leading-tight group-hover:text-yellow-400 transition-colors duration-300 line-clamp-3 mb-4">{{ $feat->getLocalizedTitle() }}</h3>
                                    </div>
                                </a>
                            </div>
                        @endif

                        {{-- List Category Articles --}}
                        <div class="lg:col-span-5 flex flex-col gap-6 {{ $isReversed ? 'lg:order-1' : 'lg:order-2' }} justify-center">
                            @foreach($category_sections[$category->slug]['articles']->take(4) as $article)
                                @php
                                    $listImg = get_image_url($article->thumbnail);
                                @endphp
                                <a href="{{ route('front.details', $article->slug) }}" class="group flex items-center gap-5 p-4 md:p-5 rounded-3xl bg-[#1f1f45]/50 border border-white/5 hover:border-yellow-500/50 hover:bg-[#1f1f45] transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                                    <div class="w-28 h-28 md:w-36 md:h-36 shrink-0 rounded-2xl overflow-hidden shadow-lg relative">
                                        <img src="{{ $listImg }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="thumbnail">
                                        <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors duration-300"></div>
                                    </div>
                                    <div class="flex flex-col py-1">
                                        <span class="text-xs text-yellow-500 font-bold uppercase tracking-wider mb-2">{{ $article->category->name }}</span>
                                        <h4 class="text-sm md:text-base lg:text-lg font-bold text-white group-hover:text-yellow-400 transition-colors line-clamp-2 mb-2 leading-snug">{{ $article->getLocalizedTitle() }}</h4>
                                        <span class="text-[11px] text-gray-400 font-medium flex items-center gap-1.5"><i class="far fa-clock"></i> {{ $article->created_at->diffForHumans() }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach

    {{-- Info Jadwal Event --}}
    @if(isset($upcoming_events) && $upcoming_events->isNotEmpty())
    <section id="UpcomingEvents" class="py-16 bg-[#181836] border-t border-white/5 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-[0.05]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-white flex items-center gap-3.5 uppercase tracking-wide">
                                        <div class="w-2.5 h-8 bg-blue-500 rounded-sm shadow-[0_0_10px_rgba(59,130,246,0.5)]"></div>
                                        Agenda & Event <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">Terdekat</span>
                                    </h2>
                                    <p class="text-sm text-gray-400 mt-1.5 ml-6">Jangan lewatkan berbagai kompetisi dan kegiatan menarik PB PORSEROSI.</p>
                </div>
                <a href="{{ route('front.event.daftar') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-white/5 hover:bg-blue-500 text-white hover:text-black font-semibold transition-all duration-300 border border-white/10 hover:border-blue-500 group">
                    Lihat Semua Event <i class="fas fa-clipboard-list transform group-hover:scale-110 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($upcoming_events as $event)
                    <div class="bg-[#1f1f45] rounded-3xl p-6 border border-white/5 hover:border-blue-500/40 hover:bg-[#1f1f45]/80 transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_15px_30px_rgba(0,0,0,0.3)] flex flex-col group relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/10 rounded-bl-[100px] -z-0 transition-transform group-hover:scale-150 duration-500"></div>
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <span class="px-3 py-1 bg-white/10 text-blue-400 text-[10px] uppercase font-bold rounded-md tracking-wider">{{ $event->sport_type == 'all' ? 'Semua Cabor' : ucfirst(str_replace('_', ' ', $event->sport_type)) }}</span>
                            <span class="text-gray-400 text-xs font-semibold px-2 py-1 bg-black/20 rounded-md"><i class="fas fa-map-marker-alt text-red-500 mr-1"></i> {{ $event->location ?? 'Indonesia' }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-1.5 leading-snug group-hover:text-blue-400 transition-colors relative z-10 line-clamp-2">{{ $event->name }}</h3>
                        <p class="text-xs text-gray-400 mb-4 relative z-10 line-clamp-2 leading-relaxed">{{ $event->description ?? 'Kompetisi resmi dari PB PORSEROSI.' }}</p>
                        
                        <div class="mt-auto pt-4 border-t border-white/10 flex items-center gap-3 relative z-10">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 flex flex-col items-center justify-center text-black font-black shadow-lg">
                                <span class="text-[10px] leading-none uppercase">{{ $event->start_date->format('M') }}</span>
                                <span class="text-lg leading-none">{{ $event->start_date->format('d') }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-gray-200">
                                    {{ $event->start_date->format('d M Y') }} 
                                    @if($event->end_date && $event->start_date->ne($event->end_date))
                                        - {{ $event->end_date->format('d M') }}
                                    @endif
                                </span>
                                <span class="text-xs {{ $event->status == 'ongoing' ? 'text-green-400' : 'text-gray-500' }} font-medium">
                                    {{ $event->status == 'ongoing' ? 'Sedang Berlangsung' : 'Akan Datang' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <x-footer />
</div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
    <style>
        .custom-scrollbar::-webkit-scrollbar { height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #eab308; }
        
        /* Jumbotron Flickity Customization */
        .main-carousel {
            height: 500px;
            overflow: hidden;
            width: 100%;
        }
        @media (min-width: 768px) {
            .main-carousel {
                height: 700px;
            }
        }
        @media (min-width: 1024px) {
            .main-carousel {
                height: 80vh;
            }
        }

        .main-carousel .flickity-viewport {
            height: 100% !important;
            width: 100%;
        }
        
        .main-carousel .flickity-page-dots {
            bottom: 30px;
            text-align: right;
            padding-right: 5%;
            z-index: 30;
        }
        @media (min-width: 768px) {
            .main-carousel .flickity-page-dots {
                padding-right: 10%;
                bottom: 50px;
            }
        }
        .main-carousel .flickity-page-dots .dot {
            width: 40px;
            height: 4px;
            border-radius: 2px;
            background: white;
            opacity: 0.3;
            margin: 0 4px;
            transition: all 0.4s ease;
        }
        .main-carousel .flickity-page-dots .dot.is-selected {
            opacity: 1;
            background: #eab308;
            width: 60px;
            box-shadow: 0 0 10px rgba(234,179,8,0.5);
        }
        
        .main-carousel .flickity-prev-next-button {
            width: 38px;
            height: 38px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.25);
            color: white;
            transition: all 0.3s ease;
            border-radius: 50%;
        }
        .main-carousel .flickity-prev-next-button .flickity-button-icon {
            width: 35%;
            height: 35%;
            left: 32.5%;
            top: 32.5%;
        }
        .main-carousel .flickity-prev-next-button:hover {
            background: #eab308;
            color: black;
            border-color: #eab308;
            transform: scale(1.05);
        }
        .main-carousel .flickity-prev-next-button.previous { left: 12px; }
        .main-carousel .flickity-prev-next-button.next { right: 12px; }
        
        @media (min-width: 768px) {
            .main-carousel .flickity-prev-next-button {
                width: 48px;
                height: 48px;
            }
            .main-carousel .flickity-prev-next-button.previous { left: 30px; }
            .main-carousel .flickity-prev-next-button.next { right: 30px; }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .is-selected .animate-fade-in-up {
            animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* News Carousel Styles */
    </style>
@endpush

@push('after-scripts')
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // 1. Hero / Featured Carousel
            var elem = document.querySelector('.main-carousel');
            if (elem) {
                var flkty = new Flickity(elem, {
                    cellAlign: 'left',
                    contain: true,
                    prevNextButtons: true, 
                    pageDots: true,
                    autoPlay: 7000, /* 7 seconds loop */
                    wrapAround: true,
                    pauseAutoPlayOnHover: false,
                    setGallerySize: false,
                    arrowShape: { 
                        x0: 15,
                        x1: 55, y1: 45,
                        x2: 60, y2: 40,
                        x3: 25
                    }
                });
            }
        });
    </script>
@endpush
