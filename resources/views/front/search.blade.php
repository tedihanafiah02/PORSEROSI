@extends('front.master')
@section('content')

<div class="font-[Poppins] bg-[#181836] text-gray-200 flex flex-col flex-grow min-h-screen relative overflow-hidden">
    <x-navbar />

    {{-- Glowing Decorative Background Blobs --}}
    <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-yellow-500/10 blur-[150px] rounded-full pointer-events-none z-0"></div>
    <div class="absolute top-40 right-1/4 w-[500px] h-[500px] bg-blue-500/10 blur-[150px] rounded-full pointer-events-none z-0"></div>
    <div class="absolute bottom-20 left-10 w-[300px] h-[300px] bg-yellow-500/5 blur-[120px] rounded-full pointer-events-none z-0"></div>

    {{-- Hero & Search Header Section --}}
    <header class="relative z-10 pt-32 pb-12 md:pt-40 md:pb-16 text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center gap-6">
            <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 text-[11px] font-bold tracking-widest uppercase animate-pulse">
                <i class="fas fa-search"></i> {{ __('messages.search_result') }}
            </span>
            
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-white tracking-tight leading-none uppercase">
                {!! __('messages.explore_news') !!}
            </h1>
            
            <p class="text-gray-400 max-w-xl text-xs md:text-sm leading-relaxed">
                Temukan informasi terpercaya, berita terbaru, agenda kompetisi, serta profil atlet sepatu roda dan skateboard PB PORSEROSI.
            </p>

            {{-- Slim Search Bar --}}
            <form action="{{ route('front.search') }}" method="GET" class="w-full max-w-[460px] relative mt-2 group">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-[50px] blur opacity-15 group-hover:opacity-30 group-focus-within:opacity-50 transition duration-300"></div>
                <div class="relative w-full flex items-center p-[10px_20px] transition-all duration-300 gap-3 bg-[#1e1e46]/80 backdrop-blur-md border border-white/10 group-focus-within:border-yellow-500 rounded-[50px] shadow-xl">
                    <div class="w-5 h-5 flex items-center justify-center text-gray-400 group-focus-within:text-yellow-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                            <path fill-rule="evenodd" d="M10 2a8 8 0 0 1 5.29 13.934l4.387 4.386a1 1 0 0 1-1.414 1.415l-4.386-4.387A8 8 0 1 1 10 2Zm0 2a6 6 0 1 0 4.243 10.243A6 6 0 0 0 10 4Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input autocomplete="off" type="text" id="search-bar" name="keyword"
                        value="{{ $keyword }}"
                        placeholder="{{ __('messages.search_news_placeholder') }}"
                        class="bg-transparent border-none text-white appearance-none text-sm font-medium placeholder:font-normal placeholder:text-gray-500 outline-none focus:ring-0 w-full" />
                </div>
            </form>

            {{-- Categories List --}}
            <div class="w-full flex flex-col items-center gap-3 mt-4">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ __('messages.category') }}</span>
                <div class="flex flex-wrap justify-center gap-2 max-w-2xl">
                    @foreach ($categories as $category)
                        <a href="{{ route('front.category', $category->slug) }}"
                            class="rounded-full px-4 py-2 flex gap-2 font-bold text-[11px] transition-all duration-300 border border-white/5 bg-white/5 hover:bg-white/10 hover:border-yellow-500 text-gray-300 hover:text-white hover:shadow-[0_0_15px_rgba(234,179,8,0.3)] whitespace-nowrap items-center uppercase tracking-wide">
                            <div class="flex w-4 h-4 shrink-0">
                                <img src="{{ get_image_url($category->icon) }}" alt="icon" class="w-full h-full object-contain" />
                            </div>
                            <span>{{ $category->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </header>

    {{-- Banner Iklan Slider Section --}}
    @if(isset($bannerAds) && $bannerAds->isNotEmpty())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8 relative z-10 w-full">
            <div class="relative rounded-2xl overflow-hidden shadow-xl border border-white/10 group aspect-[100/35] w-full" id="searchAdBannerSlider">
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
        @if($bannerAds->count() > 1)
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const adSlides = document.querySelectorAll('#searchAdBannerSlider .ad-slide');
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

    <!-- Search Result Section -->
    <section id="search-result" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex items-start flex-col gap-6 pb-20 relative z-10">
        <div class="flex items-center justify-between w-full border-b border-white/5 pb-4">
            <h2 class="text-lg md:text-xl font-bold flex items-center gap-2">
                <span class="w-1.5 h-6 bg-yellow-500 rounded-full shadow-[0_0_10px_rgba(234,179,8,0.5)]"></span>
                {{ __('messages.search_result') }} 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">"{{ ucfirst($keyword) }}"</span>
            </h2>
            <span class="text-[11px] text-gray-400 font-bold bg-white/5 px-3 py-1.5 rounded-full border border-white/5 uppercase tracking-wide">
                {{ $articles->total() }} {{ __('messages.news') }} ditemukan
            </span>
        </div>

        <div id="search-cards" class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 items-stretch mt-2">
            @forelse($articles as $article)
                <a href="{{ route('front.details', $article->slug) }}" class="card group h-full">
                    <div class="flex flex-col h-full transition-all duration-500 border border-white/5 hover:border-yellow-500/50 rounded-2xl overflow-hidden bg-[#1f1f45]/50 hover:bg-[#1f1f45] hover:shadow-[0_15px_30px_rgba(0,0,0,0.4)] hover:shadow-yellow-500/5 hover:-translate-y-2">
                        <!-- Thumbnail -->
                        <div class="thumbnail-container h-[200px] relative overflow-hidden shrink-0">
                            <div class="badge absolute left-4 top-4 z-20 flex p-[6px_14px] bg-yellow-500 text-black rounded-md shadow-md">
                                <p class="text-[10px] leading-none font-bold uppercase tracking-wider">{{ $article->category->name }}</p>
                            </div>
                            <img src="{{ get_image_url($article->thumbnail) }}" alt="thumbnail-img"
                                class="w-full h-full object-cover transition-all duration-700 group-hover:scale-105" />
                            <div class="absolute inset-0 bg-gradient-to-t from-[#181836]/60 to-transparent opacity-90"></div>
                        </div>

                        <!-- Card Info -->
                        <div class="flex flex-col grow p-6 justify-between gap-4">
                            <h3 class="text-base font-bold text-white group-hover:text-yellow-400 transition-colors duration-300 line-clamp-3 leading-snug">
                                {{ $article->getLocalizedTitle() }}
                            </h3>
                            <div class="flex items-center justify-between pt-4 border-t border-white/5 text-[11px] text-gray-400 font-semibold uppercase tracking-wider">
                                <span class="flex items-center gap-1.5">
                                    <i class="far fa-calendar-alt text-yellow-500"></i> {{ $article->created_at->format('d M Y') }}
                                </span>
                                <span class="text-yellow-500 group-hover:translate-x-1.5 transition-transform duration-300">
                                    {{ __('messages.read_more') }} <i class="fas fa-arrow-right ml-1"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-20 bg-[#1f1f45]/30 rounded-2xl border border-white/5 text-center px-4">
                    <div class="w-16 h-16 bg-white/5 rounded-2xl flex items-center justify-center border border-white/10 text-gray-500 mb-4 shadow-lg">
                        <i class="far fa-folder-open text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-300 mb-1">{{ __('messages.no_articles_found') }}</h3>
                    <p class="text-sm text-gray-500">Silakan coba cari dengan kata kunci lain atau periksa ejaan Anda.</p>
                </div>
            @endforelse
        </div>

        {{-- Custom Pagination --}}
        @if($articles->lastPage() > 1)
            <nav class="flex justify-center items-center gap-2 mt-12 w-full relative z-20" aria-label="Pagination">
                {{-- Previous Page Link --}}
                @if($articles->onFirstPage())
                    <span class="w-9 h-9 flex items-center justify-center rounded-lg bg-white/5 border border-white/5 text-gray-500 cursor-not-allowed text-xs">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $articles->previousPageUrl() }}&keyword={{ urlencode($keyword) }}" class="w-9 h-9 flex items-center justify-center rounded-lg bg-[#1f1f45]/50 border border-white/10 hover:border-yellow-500 text-gray-300 hover:text-white text-xs transition-all shadow-md">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                @endif

                {{-- Page Numbers --}}
                @for($i = 1; $i <= $articles->lastPage(); $i++)
                    @if($i == $articles->currentPage())
                        <span class="w-9 h-9 flex items-center justify-center rounded-lg bg-yellow-500 text-black font-bold text-xs shadow-[0_0_15px_rgba(234,179,8,0.4)] border border-yellow-500">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $articles->url($i) }}&keyword={{ urlencode($keyword) }}" class="w-9 h-9 flex items-center justify-center rounded-lg bg-[#1f1f45]/50 border border-white/10 hover:border-yellow-500 text-gray-300 hover:text-white text-xs transition-all hover:bg-[#1f1f45]">
                            {{ $i }}
                        </a>
                    @endif
                @endfor

                {{-- Next Page Link --}}
                @if($articles->hasMorePages())
                    <a href="{{ $articles->nextPageUrl() }}&keyword={{ urlencode($keyword) }}" class="w-9 h-9 flex items-center justify-center rounded-lg bg-[#1f1f45]/50 border border-white/10 hover:border-yellow-500 text-gray-300 hover:text-white text-xs transition-all shadow-md">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="w-9 h-9 flex items-center justify-center rounded-lg bg-white/5 border border-white/5 text-gray-500 cursor-not-allowed text-xs">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                @endif
            </nav>
        @endif
    </section>

    <x-footer />
</div>
@endsection
