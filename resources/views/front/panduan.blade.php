@extends('front.master')

@section('title', __('messages.page_title_guide'))
@section('description', __('messages.page_desc_guide'))

@section('content')
<div class="font-[Poppins] bg-[#181836] text-white flex flex-col flex-grow min-h-screen">
        <x-navbar />

        {{-- Hero Header --}}
        <div class="relative pt-32 pb-16 md:pt-40 md:pb-24 text-center overflow-hidden">
            {{-- Background decorative elements --}}
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-yellow-500/20 blur-[120px] rounded-full pointer-events-none"></div>
            
            <div class="relative z-10 px-4">
                <span class="inline-flex items-center gap-2 py-1 px-3 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 text-sm font-semibold tracking-wider mb-4 uppercase">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    {{ __('messages.document_center') }}
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                    {{ __('messages.download') }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">{{ __('messages.guide') }}</span>
                </h1>
                <p class="text-slate-400 text-base md:text-lg max-w-2xl mx-auto">
                    {{ __('messages.guide_desc') }}
                </p>
            </div>
        </div>
        {{-- Akhir Hero Header --}}

        {{-- Banner Iklan Slider Section --}}
        @if(isset($bannerAds) && $bannerAds->isNotEmpty())
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 relative z-10 w-full">
                <div class="relative rounded-2xl overflow-hidden shadow-xl border border-white/10 group aspect-[100/35] w-full" id="panduanAdBannerSlider">
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
                        const adSlides = document.querySelectorAll('#panduanAdBannerSlider .ad-slide');
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

        {{-- Main Content Section --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20 relative z-10">
            @if($panduans->isEmpty())
                <div class="text-center py-20 bg-white/5 border border-white/10 rounded-2xl">
                    <svg class="w-16 h-16 mx-auto text-slate-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-slate-300 mb-2">{{ __('messages.no_document') }}</h3>
                    <p class="text-slate-500">{{ __('messages.no_document_desc') }}</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach ($panduans as $panduan)
                        <div class="group bg-[#1e1e46] rounded-2xl border border-white/5 hover:border-red-500/30 overflow-hidden shadow-lg hover:shadow-[0_0_30px_rgba(239,68,68,0.15)] transition-all duration-300 flex flex-col h-full">
                            {{-- Thumbnail Image --}}
                            <div class="relative w-full aspect-[4/3] bg-[#14142f] overflow-hidden">
                                @if($panduan->image)
                                    <img src="{{ get_image_url($panduan->image) }}" alt="{{ $panduan->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-600 group-hover:text-red-500/50 transition-colors duration-300">
                                        <svg class="w-20 h-20 mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-xs uppercase tracking-widest font-semibold opacity-70">{{ __('messages.document') }}</span>
                                    </div>
                                @endif
                                
                                {{-- Overlay Gradient --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-[#1e1e46] to-transparent"></div>
                            </div>

                            {{-- Content --}}
                            <div class="p-6 sm:p-8 flex-1 flex flex-col relative z-10 -mt-12">
                                <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 line-clamp-2 leading-tight group-hover:text-red-400 transition-colors duration-300">
                                    {{ $panduan->getLocalizedTitle() }}
                                </h3>
                                
                                <p class="text-slate-400 text-sm sm:text-base leading-relaxed mb-6 line-clamp-3">
                                    {{ $panduan->getLocalizedDescription() ?? __('messages.no_desc_doc') }}
                                </p>
                                
                                <div class="mt-auto pt-6 border-t border-white/5">
                                    <a href="{{ get_image_url($panduan->file_path) }}" 
                                       download
                                       target="_blank"
                                       class="flex items-center justify-center gap-3 w-full py-3 px-6 bg-red-600/10 hover:bg-red-600 text-red-500 hover:text-white border border-red-500/20 rounded-xl font-bold uppercase tracking-wider text-sm transition-all duration-300 group-hover:shadow-[0_0_20px_rgba(239,68,68,0.3)]">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                        {{ __('messages.download_file') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        {{-- Akhir Main Content --}}

        <x-footer />
    </div>
@endsection
