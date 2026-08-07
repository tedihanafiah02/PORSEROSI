@extends('front.master')

@section('title', __('messages.porserosi_vision_mission') . ' | PORSEROSI')
@section('description', __('messages.page_desc_programs'))
@section('keywords', 'visi misi PB PORSEROSI, sepatu roda, skateboard, roller sports')

@section('og_title', __('messages.porserosi_vision_mission') . ' | PB PORSEROSI')
@section('og_description', __('messages.page_desc_programs'))
@section('og_image', get_image_url('assets/images/siapindo/carousel-1.jpg'))

@section('twitter_title', __('messages.porserosi_vision_mission') . ' | PB PORSEROSI')
@section('twitter_description', __('messages.page_desc_programs'))
@section('twitter_image', get_image_url('assets/images/siapindo/carousel-1.jpg'))

@section('schema')
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "PB PORSEROSI",
  "url": "{{ url('/') }}",
  "logo": "{{ get_image_url('assets/images/siapindo/logo-porserosi.png') }}",
  "description": "Konsultan pelatihan keprotokolan dan pengembangan sumber daya manusia.",
  "sameAs": [
    "https://www.instagram.com/siapindonesia",
    "https://www.linkedin.com/company/siapindonesia"
  ]
}
</script>
@endsection

@section('content')

<div class="font-[Poppins] overflow-hidden bg-[#181836] flex flex-col flex-grow min-h-screen">
    <x-navbar />

    <!-- 1. HERO SECTION -->
    <div class="relative pt-32 pb-20 md:pt-48 md:pb-32 flex items-center justify-center bg-fixed bg-center bg-cover"
        style="background-image: url('{{ get_image_url('assets/images/porserosi/pb10.webp') }}'); background-position: center top -300px;">
        <!-- Overlays -->
        <div class="absolute inset-0 bg-[#0d0d1f]/80"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#181836] to-transparent"></div>
        
        <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl text-center" data-aos="zoom-in" data-aos-duration="1000">
            <span class="inline-block py-1 px-3 md:py-1.5 md:px-4 rounded-full bg-yellow-500/20 border border-yellow-500/30 text-yellow-400 text-xs md:text-sm font-medium tracking-widest uppercase mb-4 backdrop-blur-md">
                Visi & Misi
            </span>
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white drop-shadow-lg mb-4 md:mb-5 leading-tight uppercase tracking-tight">
                {{ __('messages.porserosi_vision_mission') }}
            </h1>
            <p class="text-sm md:text-lg text-slate-300 font-normal max-w-2xl mx-auto leading-relaxed">
                {{ __('messages.porserosi_vm_subtitle') }}
            </p>
        </div>
    </div>

    <!-- 2. MAIN CONTENT AREA -->
    <section class="py-10 md:py-16 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">

                <!-- KIRI: KONTEN UTAMA -->
                <div class="w-full lg:w-2/3 flex flex-col gap-10 md:gap-14">
                    
                    <!-- Visi Kami -->
                    <div class="bg-[#1f1f42] rounded-2xl md:rounded-3xl p-6 md:p-10 border border-white/5 shadow-xl relative overflow-hidden group" data-aos="fade-up">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
                        
                        <div class="relative z-10">
                            <div class="flex items-center gap-4 mb-6 md:mb-8 border-b border-white/10 pb-5 md:pb-6">
                                <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-yellow-500 flex items-center justify-center shrink-0 shadow-[0_5px_15px_rgba(234,179,8,0.3)]">
                                    <i class="fas fa-eye text-white text-lg md:text-xl"></i>
                                </div>
                                <h2 class="text-xl md:text-2xl font-bold text-white tracking-tight leading-tight">
                                    {{ __('messages.our_vision') }}
                                </h2>
                            </div>
                            
                            <div class="bg-black/30 rounded-xl md:rounded-2xl p-5 md:p-8 border border-white/5 relative shadow-inner">
                                <i class="fas fa-quote-left text-xl md:text-3xl text-white/10 absolute top-4 left-4"></i>
                                <p class="text-slate-200 italic font-medium relative z-10 pl-6 md:pl-10 text-sm md:text-lg leading-relaxed">
                                    "{{ __('messages.vision_desc') }}"
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Misi Kami -->
                    <div class="bg-[#1f1f42] rounded-2xl md:rounded-3xl p-6 md:p-10 border border-white/5 shadow-xl relative overflow-hidden group" data-aos="fade-up">
                        <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>
                        
                        <div class="relative z-10">
                            <div class="flex items-center gap-4 mb-6 md:mb-8 border-b border-white/10 pb-5 md:pb-6">
                                <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-blue-500 flex items-center justify-center shrink-0 shadow-[0_5px_15px_rgba(59,130,246,0.3)]">
                                    <i class="fas fa-bullseye text-white text-lg md:text-xl"></i>
                                </div>
                                <h2 class="text-xl md:text-2xl font-bold text-white tracking-tight leading-tight">
                                    {{ __('messages.our_mission') }}
                                </h2>
                            </div>
                            
                            <ul class="space-y-4 md:space-y-5 text-slate-300 text-sm md:text-base leading-relaxed font-normal">
                                <li class="flex gap-4 p-4 rounded-xl bg-white/5 border border-white/5 hover:border-blue-500/30 transition-colors">
                                    <i class="fas fa-check-circle text-blue-400 text-lg md:text-xl shrink-0 mt-0.5"></i>
                                    <span>{{ __('messages.mission_1') }}</span>
                                </li>
                                <li class="flex gap-4 p-4 rounded-xl bg-white/5 border border-white/5 hover:border-blue-500/30 transition-colors">
                                    <i class="fas fa-check-circle text-blue-400 text-lg md:text-xl shrink-0 mt-0.5"></i>
                                    <span>{{ __('messages.mission_2') }}</span>
                                </li>
                                <li class="flex gap-4 p-4 rounded-xl bg-white/5 border border-white/5 hover:border-blue-500/30 transition-colors">
                                    <i class="fas fa-check-circle text-blue-400 text-lg md:text-xl shrink-0 mt-0.5"></i>
                                    <span>{{ __('messages.mission_3') }}</span>
                                </li>
                                <li class="flex gap-4 p-4 rounded-xl bg-white/5 border border-white/5 hover:border-blue-500/30 transition-colors">
                                    <i class="fas fa-check-circle text-blue-400 text-lg md:text-xl shrink-0 mt-0.5"></i>
                                    <span>{{ __('messages.mission_4') }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

                <!-- KANAN: SIDEBAR -->
                <div class="w-full lg:w-1/3 flex flex-col gap-6 md:gap-8" data-aos="fade-left">

                    <!-- Widget: Navigasi Cepat -->
                    <div class="bg-[#1f1f42] border border-white/5 shadow-xl rounded-2xl md:rounded-3xl p-5 md:p-8">
                        <h3 class="text-sm md:text-base font-bold text-white mb-4 md:mb-5 uppercase tracking-wider flex items-center gap-3 border-b border-white/10 pb-3 md:pb-4">
                            <i class="fas fa-list-ul text-yellow-500"></i>
                            {{ __('messages.nav_menu') }}
                        </h3>
                        
                        <ul class="flex flex-col gap-2">
                            @php
                                $menus = [
                                    ['route' => 'front.beranda', 'icon' => 'fa-home', 'label' => __('messages.home')],
                                    ['route' => 'front.profil', 'icon' => 'fa-user', 'label' => __('messages.profile')],
                                    ['route' => 'front.visimisi', 'icon' => 'fa-bullseye', 'label' => __('messages.vision_mission'), 'active' => true],
                                    ['route' => 'front.index', 'icon' => 'fa-newspaper', 'label' => __('messages.news')],
                                    ['route' => 'front.prestasi', 'icon' => 'fa-trophy', 'label' => __('messages.achievements')],
                                    ['route' => 'front.gallery', 'icon' => 'fa-images', 'label' => __('messages.gallery')],
                                ];
                            @endphp

                            @foreach($menus as $menu)
                            <li>
                                <a href="{{ route($menu['route']) }}" class="group flex items-center justify-between p-3 rounded-xl transition-all duration-300 {{ isset($menu['active']) && $menu['active'] ? 'bg-yellow-500 text-[#181836] font-medium' : 'bg-transparent text-slate-300 hover:bg-white/5 hover:text-white font-normal' }}">
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 md:w-8 md:h-8 rounded-lg flex items-center justify-center {{ isset($menu['active']) && $menu['active'] ? 'bg-[#181836]/10' : 'bg-white/5 group-hover:bg-white/10 group-hover:text-yellow-400' }} transition-colors">
                                            <i class="fas {{ $menu['icon'] }} text-[11px] md:text-xs"></i>
                                        </div>
                                        <span class="text-[13px] md:text-sm">{{ $menu['label'] }}</span>
                                    </div>
                                    <i class="fas fa-chevron-right text-[10px] {{ isset($menu['active']) && $menu['active'] ? 'text-[#181836] opacity-70' : 'opacity-40 group-hover:opacity-100 group-hover:translate-x-1' }} transition-all"></i>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>



                    {{-- Banner Iklan Slider Section --}}
                    @if(isset($bannerAds) && $bannerAds->isNotEmpty())
                        <div class="relative rounded-[2rem] overflow-hidden shadow-xl border border-white/10 group bg-[#1f1f45]/50 p-4 flex flex-col items-center">
                            <span class="text-[9px] font-bold text-slate-400 mb-2.5 uppercase tracking-widest self-start px-2">Sponsor</span>
                            <div class="relative w-full aspect-[100/35] rounded-2xl overflow-hidden" id="visimisiAdBannerSlider">
                                @foreach($bannerAds as $index => $banner)
                                    <div class="ad-slide absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" data-slide-index="{{ $index }}" data-duration="{{ $banner->slide_duration * 1000 }}">
                                        <a href="{{ $banner->link }}" target="_blank" class="block w-full h-full">
                                            <img src="{{ get_image_url($banner->thumbnail) }}" alt="Iklan" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-[1.02]">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @if($bannerAds->count() > 1)
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const adSlides = document.querySelectorAll('#visimisiAdBannerSlider .ad-slide');
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

                    <!-- Widget: Berita Terbaru -->
                    <div class="bg-[#1f1f42] border border-white/5 shadow-xl rounded-2xl md:rounded-3xl p-5 md:p-8">
                        <h3 class="text-sm md:text-base font-bold text-white mb-4 md:mb-5 uppercase tracking-wider flex items-center gap-3 border-b border-white/10 pb-3 md:pb-4">
                            <i class="fas fa-fire text-orange-500"></i>
                            {{ __('messages.latest_news') }}
                        </h3>
                        <div class="space-y-3 md:space-y-4">
                            @foreach($latestNews as $news)
                            <a href="{{ route('front.details', $news->slug) }}" class="group flex gap-3 md:gap-4 bg-transparent hover:bg-white/5 p-2 rounded-xl transition-all duration-300 border border-transparent hover:border-white/5">
                                <div class="w-14 h-14 md:w-16 md:h-16 flex-shrink-0 rounded-lg overflow-hidden relative bg-white/5">
                                    <img src="{{ get_image_url($news->thumbnail) }}" alt="{{ $news->getLocalizedTitle() }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="flex flex-col justify-center py-1">
                                    <span class="text-[9px] md:text-[10px] font-medium text-yellow-500 uppercase tracking-widest mb-1">{{ $news->category->name }}</span>
                                    <h4 class="text-slate-200 text-[13px] md:text-sm font-normal line-clamp-2 leading-snug group-hover:text-yellow-400 transition-colors duration-300">{{ $news->getLocalizedTitle() }}</h4>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <a href="{{ route('front.index') }}" class="mt-4 md:mt-5 w-full py-2.5 md:py-3 rounded-xl border border-white/10 text-center block text-slate-300 text-[13px] md:text-sm font-medium hover:bg-white/10 hover:text-white transition-all">
                            {{ __('messages.see_all_news') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <x-footer />
</div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/filament/style.css') }}">
@endpush
