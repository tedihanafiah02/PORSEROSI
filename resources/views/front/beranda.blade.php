@extends('front.master')

@section('title', 'PB PORSEROSI | Persatuan Olahraga Sepatu Roda Seluruh Indonesia')
@section('description', 'Organisasi induk olahraga sepatu roda dan skateboard Indonesia. Pembinaan atlet, kompetisi nasional & internasional termasuk ASEAN Games.')
@section('keywords', 'PB PORSEROSI, sepatu roda, skateboard, inline skate, roller sports, ASEAN Games, atlet Indonesia')

@section('content')

    <div class="font-[Poppins] text-slate-200 overflow-hidden flex flex-col flex-grow min-h-screen">
        <x-navbar />
        
        {{-- Alert Penipuan (Hanya di Beranda) --}}
        <x-fraud-alert />

        {{-- 1. Jumbotron --}}
        <section class="relative min-h-screen flex items-center overflow-hidden bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ get_image_url('assets/images/siapindo/hero-pbporserosi.webp') }}');">

            {{-- Overlay biar teks lebih jelas --}}
            <div class="absolute inset-0 bg-[#181836]/70"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10">

                {{-- Mobile: center --}}
                {{-- Desktop ke atas: kiri 75% | kanan 25% + text-left --}}
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-10 ">

                    {{-- Kolom Kiri --}}
                    <div class="lg:col-span-3 space-y-6 text-white text-center lg:text-left">

                        <p class="text-sm font-bold uppercase tracking-widest text-yellow-500">
                            {{ __('messages.welcome') }}
                        </p>

                        <h1 class="text-2xl md:text-4xl lg:text-6xl font-bold leading-tight max-w-4xl text-slate-100 drop-shadow-lg">
                            {{ __('messages.hero_title') }}
                        </h1>

                        <p class="text-slate-300 text-base md:text-lg max-w-2xl mx-auto lg:mx-0">
                            {{ __('messages.hero_subtitle') }}
                        </p>

                        {{-- Button --}}
                        <div class="flex justify-center lg:justify-start pt-2">

                            <a href="{{ route('front.profil') }}"
                                class="inline-flex items-center justify-center
                                px-10 py-4 rounded-xl
                                border border-yellow-500/50
                                bg-gradient-to-r from-yellow-500 to-yellow-600
                                text-[#181836] font-bold text-sm sm:text-base
                                hover:from-yellow-400 hover:to-yellow-500
                                hover:border-yellow-400
                                hover:shadow-[0_0_20px_rgba(234,179,8,0.4)]
                                hover:-translate-y-1
                                transition-all duration-300">
                                {{ __('messages.profile_btn') }}
                            </a>

                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="hidden lg:block lg:col-span-1">
                        {{-- kosong --}}
                    </div>

                </div>
            </div>
        </section>
        {{-- jumbotron --}}

        {{-- 2. Partner Section (2 Baris Berlawanan Arah) --}}
        <section class="py-20 bg-[#1f1f42] border-y border-white/5 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
                    <h2 class="text-3xl font-extrabold text-slate-100 uppercase tracking-tight mb-4">{{ __('messages.our_partner') }}</h2>
                    <p class="text-slate-400">{{ __('messages.partner_subtitle') }}</p>
                </div>

                @php
                    $row1Partners = $partners->where('row', 1);
                    $row2Partners = $partners->where('row', 2);
                    
                    // Jika Baris 2 kosong, kita bagi rata dari semua partner secara otomatis
                    if($row2Partners->isEmpty() && $partners->count() > 1) {
                        $half = ceil($partners->count() / 2);
                        $row1Partners = $partners->take($half);
                        $row2Partners = $partners->skip($half);
                    }
                @endphp

                <div class="relative w-full flex flex-col gap-10">
                    <!-- Baris 1: Jalan ke Kanan (marqueeRight) -->
                    @if($row1Partners->isNotEmpty())
                    <div class="w-full overflow-hidden relative partner-mask">
                        <div class="flex gap-12 md:gap-16 items-center w-max animate-marquee-right hover:animation-paused" style="animation-duration: 90s;">
                            {{-- Looping 12 kali agar berapapun jumlah partner (sedikit/banyak), selalu penuh dan mulus tanpa renggang --}}
                            @for($i = 0; $i < 12; $i++)
                                @foreach ($row1Partners as $partner)
                                    @php
                                        $wrapperTag = $partner->link ? 'a' : 'div';
                                        $wrapperHref = $partner->link ? 'href="' . $partner->link . '" target="_blank"' : '';
                                    @endphp
                                    <{!! $wrapperTag !!} {!! $wrapperHref !!} class="flex flex-col items-center justify-center gap-3 w-28 md:w-36 shrink-0 group cursor-pointer">
                                        <div class="relative transition-all duration-500 group-hover:scale-110">
                                            <img src="{{ get_image_url($partner->logo_path) }}" alt="{{ $partner->getLocalizedAlt() ?? $partner->name }}" class="h-16 md:h-20 w-auto object-contain drop-shadow-[0_0_10px_rgba(255,255,255,0.2)] group-hover:drop-shadow-[0_0_20px_rgba(255,255,255,0.4)] brightness-110 group-hover:brightness-125 transition-all duration-500">
                                        </div>
                                        <span class="text-[10px] md:text-xs font-bold text-slate-400 group-hover:text-yellow-500 text-center transition-colors leading-tight uppercase tracking-widest">{{ $partner->name }}</span>
                                    </{!! $wrapperTag !!}>
                                @endforeach
                            @endfor
                        </div>
                    </div>
                    @endif

                    <!-- Baris 2: Jalan ke Kiri (marqueeLeft) -->
                    @if($row2Partners->isNotEmpty())
                    <div class="w-full overflow-hidden relative partner-mask mt-6">
                        <div class="flex gap-12 md:gap-16 items-center w-max animate-marquee-left hover:animation-paused" style="animation-duration: 90s;">
                            {{-- Looping 12 kali agar selalu penuh dan mulus tanpa renggang --}}
                            @for($i = 0; $i < 12; $i++)
                                @foreach ($row2Partners as $partner)
                                    @php
                                        $wrapperTag = $partner->link ? 'a' : 'div';
                                        $wrapperHref = $partner->link ? 'href="' . $partner->link . '" target="_blank"' : '';
                                    @endphp
                                    <{!! $wrapperTag !!} {!! $wrapperHref !!} class="flex flex-col items-center justify-center gap-3 w-28 md:w-36 shrink-0 group cursor-pointer">
                                        <div class="relative transition-all duration-500 group-hover:scale-110">
                                            <img src="{{ get_image_url($partner->logo_path) }}" alt="{{ $partner->getLocalizedAlt() ?? $partner->name }}" class="h-16 md:h-20 w-auto object-contain drop-shadow-[0_0_10px_rgba(255,255,255,0.2)] group-hover:drop-shadow-[0_0_20px_rgba(255,255,255,0.4)] brightness-110 group-hover:brightness-125 transition-all duration-500">
                                        </div>
                                        <span class="text-[10px] md:text-xs font-bold text-slate-400 group-hover:text-yellow-500 text-center transition-colors leading-tight uppercase tracking-widest">{{ $partner->name }}</span>
                                    </{!! $wrapperTag !!}>
                                @endforeach
                            @endfor
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="text-center mt-12">
                    <a href="{{ route('front.partner') }}" class="inline-block px-8 py-3 rounded-full text-sm font-bold bg-yellow-500 text-[#181836] hover:bg-yellow-400 shadow-[0_0_15px_rgba(234,179,8,0.3)] transition-all duration-300">
                        {{ __('messages.see_all_partners') }}
                    </a>
                </div>
            </div>
        </section>

        {{-- 3. About Section --}}
        <section class="py-24 relative bg-[#181836]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <!-- Bagian Gambar -->
                    <div class="w-full lg:w-1/2 relative" data-aos="fade-right">
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl group border border-white/10">
                            <img class="w-full h-[500px] object-cover transition-transform duration-700 group-hover:scale-105" src="{{ get_image_url('assets/images/porserosi/pb7.webp') }}" alt="Tentang PB PORSEROSI" />
                            <div class="absolute inset-0 bg-[#181836]/20 group-hover:bg-transparent transition-colors"></div>
                        </div>
                        <!-- Dekorasi -->
                        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-3xl -z-10 hidden md:block shadow-[0_0_30px_rgba(234,179,8,0.3)]"></div>
                        <div class="absolute -top-6 -left-6 w-32 h-32 bg-white/5 rounded-full -z-10 hidden md:block backdrop-blur-sm border border-white/10"></div>
                    </div>

                    <!-- Bagian Teks -->
                    <div class="w-full lg:w-1/2 flex flex-col justify-center" data-aos="fade-left">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-2 h-8 bg-yellow-500 rounded-full shadow-[0_0_10px_rgba(234,179,8,0.5)]"></div>
                            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-100 uppercase tracking-tight">
                                {{ __('messages.about_porserosi') }}
                            </h2>
                        </div>
                        <p class="text-slate-400 leading-relaxed text-lg mb-8">
                            {{ __('messages.about_desc') }}
                        </p>

                        <h3 class="text-xl font-bold text-slate-200 mb-5 border-b border-white/10 pb-2">{{ __('messages.main_focus') }}</h3>
                        <ul class="space-y-4 mb-10">
                            <li class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full bg-yellow-500/20 text-yellow-500 flex items-center justify-center shrink-0 mt-1 border border-yellow-500/30">
                                    <i class="fas fa-medal text-sm"></i>
                                </div>
                                <div>
                                    <strong class="block text-slate-200">{{ __('messages.pro_coaching') }}</strong>
                                    <span class="text-slate-400 text-sm">{{ __('messages.pro_coaching_desc') }}</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full bg-yellow-500/20 text-yellow-500 flex items-center justify-center shrink-0 mt-1 border border-yellow-500/30">
                                    <i class="fas fa-globe-asia text-sm"></i>
                                </div>
                                <div>
                                    <strong class="block text-slate-200">{{ __('messages.intl_achievements') }}</strong>
                                    <span class="text-slate-400 text-sm">{{ __('messages.intl_achievements_desc') }}</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full bg-yellow-500/20 text-yellow-500 flex items-center justify-center shrink-0 mt-1 border border-yellow-500/30">
                                    <i class="fas fa-network-wired text-sm"></i>
                                </div>
                                <div>
                                    <strong class="block text-slate-200">{{ __('messages.national_network') }}</strong>
                                    <span class="text-slate-400 text-sm">{{ __('messages.national_network_desc') }}</span>
                                </div>
                            </li>
                        </ul>

                        <a href="{{ route('front.profil') }}" class="inline-block w-max bg-white/10 hover:bg-yellow-500 hover:text-[#181836] border border-white/20 hover:border-yellow-500 text-slate-200 font-bold py-3 px-8 rounded-xl transition-all duration-300">
                            {{ __('messages.vision_mission') }}
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- 3.5. Live Streaming Section --}}
        @if(isset($liveStreamings) && $liveStreamings->isNotEmpty())
        <section class="py-24 relative bg-[#0d0d1f] border-y border-white/5" id="live-streaming">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-red-900/20 via-[#0d0d1f] to-[#0d0d1f]"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6" data-aos="fade-up">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="relative flex h-4 w-4">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-4 w-4 bg-red-500 shadow-[0_0_15px_rgba(239,68,68,0.8)]"></span>
                            </span>
                            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-100 uppercase tracking-tight">{{ __('messages.live_streaming') }}</h2>
                        </div>
                        <p class="text-slate-400">{{ __('messages.live_streaming_desc') }}</p>
                    </div>
                </div>

                <div class="flex flex-col gap-12">
                    @foreach($liveStreamings as $live)
                        <x-live-stream-player :live="$live" />
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- 4. Berita Terkini (Slider Featured News) --}}
        <section class="py-24 relative bg-[#1f1f42] border-y border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6" data-aos="fade-up">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-2 h-8 bg-yellow-500 rounded-full shadow-[0_0_10px_rgba(234,179,8,0.5)]"></div>
                            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-100 uppercase tracking-tight">{{ __('messages.latest_news') }}</h2>
                        </div>
                        <p class="text-slate-400">{{ __('messages.latest_news_desc') }}</p>
                    </div>
                    <a href="{{ route('front.index') }}" class="shrink-0 text-sm font-bold text-yellow-500 hover:text-yellow-400 uppercase tracking-wider flex items-center gap-2">
                        {{ __('messages.see_all_news') }} <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Kolom Kiri: Slider (Featured News) --}}
                    <div class="lg:col-span-2">
                        @if ($featuredBlogs->isEmpty())
                            <div class="text-center py-20 bg-[#181836] rounded-3xl border border-white/5 shadow-lg h-full flex flex-col justify-center items-center">
                                <i class="far fa-newspaper text-6xl text-slate-600 mb-4"></i>
                                <p class="text-slate-500">{{ __('messages.no_featured_news') }}</p>
                            </div>
                        @else
                            <!-- Auto-Rotating Slider Container -->
                            <div class="relative w-full h-[350px] md:h-[450px] rounded-3xl overflow-hidden shadow-2xl border border-white/10" id="featuredNewsSlider">
                                @foreach ($featuredBlogs as $index => $blog)
                                    <div class="slider-item absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" data-index="{{ $index }}">
                                        <img src="{{ get_image_url($blog->thumbnail) }}" alt="{{ $blog->name }}" class="absolute inset-0 w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-[#181836] via-[#181836]/60 to-transparent"></div>
                                        
                                        <div class="absolute bottom-0 left-0 w-full p-6 md:p-10">
                                            <span class="inline-block px-3 py-1 bg-yellow-500 text-[#181836] text-[10px] font-bold uppercase tracking-wider rounded-full mb-3 shadow-lg shadow-yellow-500/20">{{ __('messages.main_highlight') }}</span>
                                            <h3 class="text-xl md:text-3xl font-extrabold text-slate-100 mb-3 leading-tight drop-shadow-md">
                                                {{ $blog->getLocalizedTitle() }}
                                            </h3>
                                            <a href="{{ route('front.details', $blog->slug) }}" class="inline-flex items-center gap-2 bg-white/10 hover:bg-yellow-500 text-white hover:text-[#181836] border border-white/20 hover:border-yellow-500 font-bold py-2 px-6 rounded-full transition-all duration-300 backdrop-blur-sm text-xs">
                                                {{ __('messages.read_more') }} <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Slider Indicators -->
                                @if($featuredBlogs->count() > 1)
                                <div class="absolute bottom-6 right-8 z-20 flex gap-2">
                                    @foreach ($featuredBlogs as $index => $blog)
                                        <button class="slider-dot w-2 h-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-yellow-500 w-6' : 'bg-white/30' }}" data-index="{{ $index }}"></button>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    {{-- Kolom Kanan: Berita Acak --}}
                    <div class="lg:col-span-1 flex flex-col gap-4 h-full">
                        @foreach($randomBlogs as $blog)
                            <a href="{{ route('front.details', $blog->slug) }}" class="group flex gap-3 bg-[#181836]/40 p-3 rounded-2xl border border-white/5 hover:border-yellow-500/30 hover:bg-[#181836]/80 transition-all duration-300 h-full">
                                <div class="w-20 h-20 md:w-24 md:h-24 shrink-0 rounded-xl overflow-hidden border border-white/10">
                                    <img src="{{ get_image_url($blog->thumbnail) }}" alt="{{ $blog->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="flex flex-col justify-center">
                                    <span class="text-[9px] font-bold text-yellow-500 uppercase tracking-widest mb-1">{{ $blog->category->name ?? 'News' }}</span>
                                    <h4 class="text-slate-200 text-xs md:text-sm font-bold line-clamp-2 group-hover:text-yellow-400 transition-colors duration-300">
                                        {{ $blog->getLocalizedTitle() }}
                                    </h4>
                                    <div class="mt-1 flex items-center gap-2 text-[9px] text-slate-400">
                                        <i class="far fa-calendar-alt text-yellow-500/70"></i> {{ $blog->created_at->format('d M Y') }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        
                        {{-- Button Mobile/Tablet --}}
                        <a href="{{ route('front.index') }}" class="mt-auto py-3 rounded-2xl border border-white/10 bg-[#181836]/20 text-center text-[10px] font-bold text-slate-400 hover:bg-yellow-500 hover:text-[#181836] hover:border-yellow-500 transition-all duration-300 group">
                            {{ __('messages.see_more_news') }} <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Banner Iklan Section --}}
        @if(isset($bannerAds) && $bannerAds->isNotEmpty())
            <section class="py-12 bg-[#181836] border-y border-white/5">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
            </section>
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

        {{-- 5. Kedisiplinan Section --}}
        <section class="py-24 relative overflow-hidden bg-[#181836]" id="cabang-olahraga">
            {{-- Decorative background elements --}}
            <div class="absolute top-0 left-0 w-96 h-96 bg-yellow-500/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-yellow-500/5 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>

             <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:items-stretch">
                    
                    {{-- Konten Kiri (Sticky Text + Card 7) --}}
                    <div class="lg:col-span-6 flex flex-col justify-center lg:sticky lg:top-32 h-fit text-center lg:text-left" data-aos="fade-right" data-aos-duration="1000">
                        <span class="inline-block w-fit mx-auto lg:mx-0 px-5 py-2 bg-yellow-500/10 border border-yellow-500/20 rounded-full text-yellow-500 text-xs font-bold uppercase tracking-widest mb-6">
                            {{ __('messages.our_sports') }}
                        </span>
                        <h2 class="text-3xl md:text-5xl font-extrabold text-slate-100 uppercase tracking-tight mb-5 leading-tight">
                            {{ __('messages.sports_branches') }}
                        </h2>
                        <p class="text-slate-400 text-base md:text-lg leading-relaxed mb-8">
                            {{ __('messages.sports_branches_desc') }}
                        </p>

                        {{-- Card 7 — Artistic (Pindahan ke Kiri) --}}
                        <div onclick="window.location='{{ route('front.cabangOlahraga', 'artistic') }}'" class="cabor-card group relative rounded-2xl overflow-hidden h-[235px] w-full border border-white/5 shadow-2xl cursor-pointer" data-aos="fade-up" data-aos-duration="800">
                            <img src="{{ get_image_url('assets/images/siapindo/cabor-sepaturoda.png') }}" alt="Artistic" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1.2s] ease-out group-hover:scale-110" />
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d1f] via-[#181836]/60 to-transparent"></div>
                            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-pink-500 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="absolute inset-0 flex flex-col justify-end p-3 text-left">
                                <div class="mb-1">
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 bg-pink-500/20 backdrop-blur-md border border-pink-500/30 rounded-full text-pink-400 text-[8px] font-bold uppercase tracking-wider">
                                        Disiplin
                                    </span>
                                </div>
                                <h3 class="text-sm md:text-base font-extrabold text-white mb-0.5 group-hover:text-yellow-400 transition-colors duration-500 leading-tight">
                                    Artistic
                                </h3>
                                <p class="text-slate-300 text-[10px] leading-normal mb-2 opacity-90">
                                    Free Skating  |  Solo Dance  |  Compulsory Figures
                                </p>
                                <a href="{{ route('front.cabangOlahraga', 'artistic') }}" class="inline-flex items-center gap-1.5 text-[10px] font-bold text-yellow-500 hover:text-yellow-400 uppercase tracking-wider group/link">
                                    {{ __('messages.read_more') }}
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Konten Kanan (Cards Grid) --}}
                    <div class="lg:col-span-6 grid grid-cols-2 lg:grid-cols-3 gap-4">

                    {{-- Card 1 — Inline Freestyle --}}
                    <div onclick="window.location='{{ route('front.cabangOlahraga', 'inline-freestyle') }}'" class="cabor-card group relative rounded-2xl overflow-hidden h-[235px] border border-white/5 shadow-2xl cursor-pointer" data-aos="fade-up" data-aos-duration="800">
                        <img src="{{ get_image_url('assets/images/siapindo/cabor-sepaturoda.png') }}" alt="Inline Freestyle" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1.2s] ease-out group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d1f] via-[#181836]/60 to-transparent"></div>
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-blue-500 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-3">
                            <div class="mb-1">
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 bg-blue-500/20 backdrop-blur-md border border-blue-500/30 rounded-full text-blue-400 text-[8px] font-bold uppercase tracking-wider">
                                    Disiplin
                                </span>
                            </div>
                            <h3 class="text-sm md:text-base font-extrabold text-white mb-0.5 group-hover:text-yellow-400 transition-colors duration-500 leading-tight">
                                Inline Freestyle
                            </h3>
                            <p class="text-slate-300 text-[10px] leading-normal mb-2 opacity-90">
                                Classic Slalom  |  Speed Slalom  |  Battle Slalom
                            </p>
                            <a href="{{ route('front.cabangOlahraga', 'inline-freestyle') }}" class="inline-flex items-center gap-1.5 text-[10px] font-bold text-yellow-500 hover:text-yellow-400 uppercase tracking-wider group/link">
                                {{ __('messages.read_more') }}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Card 2 — Inline Hockey --}}
                    <div onclick="window.location='{{ route('front.cabangOlahraga', 'inline-hockey') }}'" class="cabor-card group relative rounded-2xl overflow-hidden h-[235px] border border-white/5 shadow-2xl cursor-pointer" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                        <img src="{{ get_image_url('assets/images/siapindo/cabor-sepaturoda.png') }}" alt="Inline Hockey" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1.2s] ease-out group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d1f] via-[#181836]/60 to-transparent"></div>
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-indigo-500 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-3">
                            <div class="mb-1">
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 bg-indigo-500/20 backdrop-blur-md border border-indigo-500/30 rounded-full text-indigo-400 text-[8px] font-bold uppercase tracking-wider">
                                    Disiplin
                                </span>
                            </div>
                            <h3 class="text-sm md:text-base font-extrabold text-white mb-0.5 group-hover:text-yellow-400 transition-colors duration-500 leading-tight">
                                Inline Hockey
                            </h3>
                            <p class="text-slate-300 text-[10px] leading-normal mb-2 opacity-90">
                                Match Play  |  Skills Challenge
                            </p>
                            <a href="{{ route('front.cabangOlahraga', 'inline-hockey') }}" class="inline-flex items-center gap-1.5 text-[10px] font-bold text-yellow-500 hover:text-yellow-400 uppercase tracking-wider group/link">
                                {{ __('messages.read_more') }}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Card 3 — Roller Freestyle --}}
                    <div onclick="window.location='{{ route('front.cabangOlahraga', 'roller-freestyle') }}'" class="cabor-card group relative rounded-2xl overflow-hidden h-[235px] border border-white/5 shadow-2xl cursor-pointer" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                        <img src="{{ get_image_url('assets/images/siapindo/cabor-sepaturoda.png') }}" alt="Roller Freestyle" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1.2s] ease-out group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d1f] via-[#181836]/60 to-transparent"></div>
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-purple-500 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-3">
                            <div class="mb-1">
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 bg-purple-500/20 backdrop-blur-md border border-purple-500/30 rounded-full text-purple-400 text-[8px] font-bold uppercase tracking-wider">
                                    Disiplin
                                </span>
                            </div>
                            <h3 class="text-sm md:text-base font-extrabold text-white mb-0.5 group-hover:text-yellow-400 transition-colors duration-500 leading-tight">
                                Roller Freestyle
                            </h3>
                            <p class="text-slate-300 text-[10px] leading-normal mb-2 opacity-90">
                                Park  |  Street
                            </p>
                            <a href="{{ route('front.cabangOlahraga', 'roller-freestyle') }}" class="inline-flex items-center gap-1.5 text-[10px] font-bold text-yellow-500 hover:text-yellow-400 uppercase tracking-wider group/link">
                                {{ __('messages.read_more') }}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Card 4 — Scooter --}}
                    <div onclick="window.location='{{ route('front.cabangOlahraga', 'scooter') }}'" class="cabor-card group relative rounded-2xl overflow-hidden h-[235px] border border-white/5 shadow-2xl cursor-pointer" data-aos="fade-up" data-aos-duration="800">
                        <img src="{{ get_image_url('assets/images/siapindo/cabor-scooter.png') }}" alt="Scooter" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1.2s] ease-out group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d1f] via-[#181836]/60 to-transparent"></div>
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-emerald-500 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-3">
                            <div class="mb-1">
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 bg-emerald-500/20 backdrop-blur-md border border-emerald-500/30 rounded-full text-emerald-400 text-[8px] font-bold uppercase tracking-wider">
                                    Disiplin
                                </span>
                            </div>
                            <h3 class="text-sm md:text-base font-extrabold text-white mb-0.5 group-hover:text-yellow-400 transition-colors duration-500 leading-tight">
                                Scooter
                            </h3>
                            <p class="text-slate-300 text-[10px] leading-normal mb-2 opacity-90">
                                Park  |  Street  |  Best Trick
                            </p>
                            <a href="{{ route('front.cabangOlahraga', 'scooter') }}" class="inline-flex items-center gap-1.5 text-[10px] font-bold text-yellow-500 hover:text-yellow-400 uppercase tracking-wider group/link">
                                {{ __('messages.read_more') }}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Card 5 — Skateboard --}}
                    <div onclick="window.location='{{ route('front.cabangOlahraga', 'skateboard') }}'" class="cabor-card group relative rounded-2xl overflow-hidden h-[235px] border border-white/5 shadow-2xl cursor-pointer" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                        <img src="{{ get_image_url('assets/images/siapindo/cabor-skateboard.png') }}" alt="Skateboard" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1.2s] ease-out group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d1f] via-[#181836]/60 to-transparent"></div>
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-yellow-500 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-3">
                            <div class="mb-1">
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 bg-yellow-500/20 backdrop-blur-md border border-yellow-500/30 rounded-full text-yellow-400 text-[8px] font-bold uppercase tracking-wider">
                                    Disiplin
                                </span>
                            </div>
                            <h3 class="text-sm md:text-base font-extrabold text-white mb-0.5 group-hover:text-yellow-400 transition-colors duration-500 leading-tight">
                                Skateboard
                            </h3>
                            <p class="text-slate-300 text-[10px] leading-normal mb-2 opacity-90">
                                Street  |  Park  |  Game of Skate
                            </p>
                            <a href="{{ route('front.cabangOlahraga', 'skateboard') }}" class="inline-flex items-center gap-1.5 text-[10px] font-bold text-yellow-500 hover:text-yellow-400 uppercase tracking-wider group/link">
                                {{ __('messages.read_more') }}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Card 6 — Speed --}}
                    <div onclick="window.location='{{ route('front.cabangOlahraga', 'speed') }}'" class="cabor-card group relative rounded-2xl overflow-hidden h-[235px] border border-white/5 shadow-2xl cursor-pointer" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                        <img src="{{ get_image_url('assets/images/siapindo/cabor-sepaturoda.png') }}" alt="Speed" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1.2s] ease-out group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d1f] via-[#181836]/60 to-transparent"></div>
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-orange-500 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-3">
                            <div class="mb-1">
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 bg-orange-500/20 backdrop-blur-md border border-orange-500/30 rounded-full text-orange-400 text-[8px] font-bold uppercase tracking-wider">
                                    Disiplin
                                </span>
                            </div>
                            <h3 class="text-sm md:text-base font-extrabold text-white mb-0.5 group-hover:text-yellow-400 transition-colors duration-500 leading-tight">
                                Speed
                            </h3>
                            <p class="text-slate-300 text-[10px] leading-normal mb-2 opacity-90">
                                Track Racing  |  Road Racing  |  Marathon
                            </p>
                            <a href="{{ route('front.cabangOlahraga', 'speed') }}" class="inline-flex items-center gap-1.5 text-[10px] font-bold text-yellow-500 hover:text-yellow-400 uppercase tracking-wider group/link">
                                {{ __('messages.read_more') }}
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>

        <x-footer />
    </div>
@endsection

@push('after-styles')
    <style>
        html { scroll-behavior: smooth; }
        
        /* CSS Untuk Marquee Partner */
        .partner-mask {
            -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        }
        
        @keyframes marqueeLeft {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        
        @keyframes marqueeRight {
            0% { transform: translateX(-50%); }
            100% { transform: translateX(0); }
        }
        
        .animate-marquee-left {
            animation: marqueeLeft 30s linear infinite;
        }
        
        .animate-marquee-right {
            animation: marqueeRight 30s linear infinite;
        }
        
        .hover\:animation-paused:hover {
            animation-play-state: paused;
        }

        @keyframes shine {
            100% { transform: translateX(100%); }
        }
        .group:hover .group-hover\:animate-shine {
            animation: shine 0.8s ease-in-out;
        }
    </style>
@endpush

@push('after-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Slider Logic for Berita Terkini
            const items = document.querySelectorAll('.slider-item');
            const dots = document.querySelectorAll('.slider-dot');
            let currentIndex = 0;
            const totalItems = items.length;
            let interval;

            if (totalItems > 1) {
                const showSlide = (index) => {
                    // Hide all
                    items.forEach(item => {
                        item.classList.remove('opacity-100', 'z-10');
                        item.classList.add('opacity-0', 'z-0');
                    });
                    dots.forEach(dot => {
                        dot.classList.remove('bg-yellow-500', 'w-6');
                        dot.classList.add('bg-white/30');
                    });

                    // Show current
                    items[index].classList.remove('opacity-0', 'z-0');
                    items[index].classList.add('opacity-100', 'z-10');
                    dots[index].classList.remove('bg-white/30');
                    dots[index].classList.add('bg-yellow-500', 'w-6');
                };

                const nextSlide = () => {
                    currentIndex = (currentIndex + 1) % totalItems;
                    showSlide(currentIndex);
                };

                // Start auto-rotate
                interval = setInterval(nextSlide, 5000); // 5 detik

                // Dot click handlers
                dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => {
                        clearInterval(interval); // Pause on manual click
                        currentIndex = index;
                        showSlide(currentIndex);
                        interval = setInterval(nextSlide, 5000); // Resume
                    });
                });
            }
        });
        });
    </script>
@endpush

@section('schema')
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "PORSEROSI",
      "url": "{{ url('/') }}",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "{{ route('front.search') }}?keyword={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
@endsection
