@extends('front.master')

@section('title', __('messages.page_title_live'))

@section('content')
<div class="font-[Poppins] text-slate-200 flex flex-col flex-grow min-h-screen">
    <x-navbar />

    <section class="relative pt-32 pb-24 min-h-screen bg-[#0d0d1f]">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#181836] via-[#0d0d1f] to-[#0d0d1f] pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-down">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-red-500/10 border border-red-500/20 rounded-full text-red-500 text-xs font-bold uppercase tracking-widest mb-4 shadow-[0_0_15px_rgba(239,68,68,0.2)]">
                    <span class="relative flex h-2.5 w-2.5">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                    </span>
                    {{ __('messages.live_streaming') }}
                </span>
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 uppercase tracking-tight">{{ __('messages.live_broadcast') }}</h1>
                <p class="text-slate-400 text-lg">{{ __('messages.live_desc') }}</p>
            </div>

            @if($liveNow->isEmpty() && $upcomingLives->isEmpty())
                <div class="flex flex-col items-center justify-center p-12 bg-[#181836]/50 backdrop-blur-md rounded-3xl border border-white/5 text-center shadow-2xl">
                    <div class="w-24 h-24 bg-[#0d0d1f] rounded-full flex items-center justify-center mb-6 shadow-xl border border-white/10 relative">
                        <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-28 h-px bg-slate-500 rotate-45 transform origin-center"></div>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">{{ __('messages.no_live') }}</h3>
                    <p class="text-slate-400 max-w-md mx-auto leading-relaxed">{{ __('messages.no_live_desc') }}</p>
                    <a href="{{ route('front.beranda') }}" class="mt-8 px-6 py-3 bg-yellow-500 text-[#181836] font-bold rounded-full hover:bg-yellow-400 transition-colors shadow-lg shadow-yellow-500/20">
                        {{ __('messages.back_to_home') }}
                    </a>
                </div>
            @endif

            {{-- LIVE NOW SECTION --}}
            @if($liveNow->isNotEmpty())
                <div class="mb-20">
                    <h2 class="text-2xl font-bold text-white mb-8 flex items-center gap-3">
                        <div class="w-2 h-8 bg-red-500 rounded-full shadow-[0_0_10px_rgba(239,68,68,0.5)]"></div>
                        {{ __('messages.live_now') }}
                    </h2>
                    <div class="flex flex-col gap-12">
                        @foreach($liveNow as $live)
                            <x-live-stream-player :live="$live" />
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- UPCOMING SECTION --}}
            @if($upcomingLives->isNotEmpty())
                <div>
                    <h2 class="text-2xl font-bold text-white mb-8 flex items-center gap-3">
                        <div class="w-2 h-8 bg-yellow-500 rounded-full shadow-[0_0_10px_rgba(234,179,8,0.5)]"></div>
                        {{ __('messages.upcoming_live') }}
                    </h2>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        @foreach($upcomingLives as $live)
                            <x-live-stream-player :live="$live" />
                        @endforeach
                    </div>
                </div>
            @endif
            {{-- Banner Iklan Section --}}
            @if(isset($bannerAds) && $bannerAds->isNotEmpty())
                <div class="mt-16 pt-12 border-t border-white/5">
                    <div class="relative rounded-2xl overflow-hidden shadow-xl border border-white/10 group aspect-[100/35] w-full" id="adBannerSlider">
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
                            const adSlides = document.querySelectorAll('#adBannerSlider .ad-slide');
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
        </div>
    </section>

    <x-footer />
</div>
@endsection
