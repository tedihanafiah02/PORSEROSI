<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">

<head>
    {{-- ============================== --}}
    {{-- BASIC META TAGS --}}
    {{-- ============================== --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#181836">
    <meta name="format-detection" content="telephone=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <style>
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }
    </style>

    {{-- ============================== --}}
    {{-- SEO CONFIGURATION & META TAGS --}}
    {{-- ============================== --}}
    @php
        $siteTitle = \App\Models\SeoSetting::get('site_title') ?: __('messages.meta_title_default');
        $siteDesc = \App\Models\SeoSetting::get('site_description') ?: __('messages.meta_desc_default');
        $siteKeywords = \App\Models\SeoSetting::get('site_keywords') ?: __('messages.meta_keywords_default');
        $ogImageDefault = \App\Models\SeoSetting::get('og_image') ?: get_image_url('assets/images/og-default.jpg');
        
        $googleVerification = \App\Models\SeoSetting::get('google_verification');
        $bingVerification = \App\Models\SeoSetting::get('bing_verification');
        $gaId = \App\Models\SeoSetting::get('google_analytics_id');
        $gtmId = \App\Models\SeoSetting::get('gtm_id');
    @endphp

    <title>@yield('title', $siteTitle)</title>
    <meta name="description" content="@yield('description', $siteDesc)">
    <meta name="keywords" content="@yield('keywords', $siteKeywords)">
    <meta name="author" content="PORSEROSI">
    <meta name="copyright" content="{{ $siteTitle }}">

    {{-- Canonical & Robots --}}
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="robots" content="@yield('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1')">

    {{-- ============================== --}}
    {{-- OPEN GRAPH (Facebook, LinkedIn, WhatsApp) --}}
    {{-- ============================== --}}
    <meta property="og:locale" content="id_ID">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', $siteTitle)">
    <meta property="og:description" content="@yield('og_description', $siteDesc)">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="PORSEROSI">
    <meta property="og:image" content="@yield('og_image', $ogImageDefault)">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="@yield('og_title', $siteTitle)">
    @yield('extra_og')

    {{-- ============================== --}}
    {{-- TWITTER CARD --}}
    {{-- ============================== --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@porserosi">
    <meta name="twitter:title" content="@yield('twitter_title', $siteTitle)">
    <meta name="twitter:description" content="@yield('twitter_description', $siteDesc)">
    <meta name="twitter:image" content="@yield('twitter_image', $ogImageDefault)">

    {{-- ============================== --}}
    {{-- GOOGLE VERIFICATION & ANALYTICS --}}
    {{-- ============================== --}}
    @if($googleVerification)
        <meta name="google-site-verification" content="{{ $googleVerification }}">
    @endif
    @if($bingVerification)
        <meta name="msvalidate.01" content="{{ $bingVerification }}">
    @endif

    {{-- Google Tag Manager --}}
    @if($gtmId)
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','{{ $gtmId }}');</script>
    @endif

    {{-- Google Analytics 4 --}}
    @if($gaId)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $gaId }}', {
            page_title: document.title,
            page_location: window.location.href
        });
    </script>
    @endif

    {{-- ============================== --}}
    {{-- FAVICON --}}
    {{-- ============================== --}}
    <link rel="icon" href="{{ get_image_url('assets/images/siapindo/logo.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ get_image_url('assets/images/apple-touch-icon.png') }}">

    {{-- ============================== --}}
    {{-- PERFORMANCE: Preconnect & DNS-prefetch --}}
    {{-- ============================== --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    @if($gaId)
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="dns-prefetch" href="https://www.google-analytics.com">
    @endif

    {{-- ============================== --}}
    {{-- CSS & FONTS --}}
    {{-- ============================== --}}
    @stack('before-styles')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @stack('after-styles')

    {{-- ============================== --}}
    {{-- STRUCTURED DATA: Organization (Global) --}}
    {{-- ============================== --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SportsOrganization",
        "name": "PORSEROSI",
        "alternateName": "Persatuan Olahraga Sepatu Roda Seluruh Indonesia",
        "url": "{{ url('/') }}",
        "logo": "{{ get_image_url('assets/images/siapindo/logo.svg') }}",
        "description": "Organisasi induk olahraga sepatu roda, skateboard, dan scooter Indonesia. Pembinaan atlet, kompetisi nasional & internasional.",
        "sport": ["Roller Sports", "Skateboarding", "Inline Speed Skating", "Artistic Skating", "Roller Hockey", "Scooter"],
        "memberOf": {
            "@type": "SportsOrganization",
            "name": "World Skate"
        },
        "areaServed": {
            "@type": "Country",
            "name": "Indonesia"
        }
        @php
            $socialLinks = array_filter([
                \App\Models\SeoSetting::get('social_instagram'),
                \App\Models\SeoSetting::get('social_facebook'),
                \App\Models\SeoSetting::get('social_youtube'),
                \App\Models\SeoSetting::get('social_twitter'),
                \App\Models\SeoSetting::get('social_tiktok'),
                \App\Models\SeoSetting::get('social_whatsapp') ? 'https://wa.me/' . \App\Models\SeoSetting::get('social_whatsapp') : null,
            ]);
        @endphp
        @if(count($socialLinks) > 0)
        ,"sameAs": {!! json_encode(array_values($socialLinks)) !!}
        @endif
    }
    </script>

    {{-- Page-specific Schema --}}
    @yield('schema')
    @yield('breadcrumb_schema')
    @yield('extra_meta')

    {{-- ============================== --}}
    {{-- JS LIBRARIES (defer for performance) --}}
    {{-- ============================== --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" defer></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-[#181836] m-0 p-0">
    {{-- Google Tag Manager (noscript) --}}
    @if($gtmId)
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $gtmId }}"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    <!-- animasi loading -->
    <div id="page-loader">
        <div class="loader-spinner"></div>
    </div>

    <!-- Top loading progress bar -->
    <div id="top-loading-bar" style="position: fixed; top: 0; left: 0; height: 3px; width: 0; background: #facc15; z-index: 99999; opacity: 1; transition: width 0.4s ease, opacity 0.4s ease; pointer-events: none; box-shadow: 0 0 10px #facc15;"></div>

    @yield('content')

    {{-- Professional Floating Contact Menu --}}
    @php 
        $hasSocialWa = \App\Models\SeoSetting::get('social_whatsapp') ?: \App\Models\SeoSetting::get('organization_phone');
        $waNumber = $hasSocialWa ?: '628118087899'; 

        $hasSocialIg = \App\Models\SeoSetting::get('social_instagram');
        $igUrl = $hasSocialIg && filter_var($hasSocialIg, FILTER_VALIDATE_URL) ? $hasSocialIg : 'https://www.instagram.com/' . ($hasSocialIg ?: 'pbporserosi.id');

        $hasSocialEmail = \App\Models\SeoSetting::get('social_email') ?: \App\Models\SeoSetting::get('organization_email');
        $email = $hasSocialEmail ?: 'pbporserosi@gmail.com';
    @endphp
    
    <div x-data="{ open: false }" style="bottom: 24px; right: 24px; left: auto;" class="fixed z-[9999] flex flex-col items-end gap-4">
        {{-- Menu Items --}}
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-10 scale-90"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-10 scale-90"
             class="flex flex-col items-end gap-3 mb-2"
             style="display: none;">
            
            {{-- WhatsApp --}}
            @if($hasSocialWa)
            <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="flex items-center gap-3 group cursor-pointer">
                <span class="bg-white/90 backdrop-blur-sm text-[#181836] px-3 py-1.5 rounded-lg text-[10px] md:text-xs font-bold shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">WhatsApp</span>
                <div class="w-10 h-10 md:w-12 md:h-12 bg-green-500 text-white rounded-full flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
                    <i class="fab fa-whatsapp text-xl md:text-2xl pointer-events-none"></i>
                </div>
            </a>
            @endif

            {{-- Instagram --}}
            @if($hasSocialIg)
            <a href="{{ $igUrl }}" target="_blank" class="flex items-center gap-3 group cursor-pointer">
                <span class="bg-white/90 backdrop-blur-sm text-[#181836] px-3 py-1.5 rounded-lg text-[10px] md:text-xs font-bold shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Instagram</span>
                <div class="w-10 h-10 md:w-12 md:h-12 bg-[#E1306C] text-white rounded-full flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
                    <i class="fab fa-instagram text-xl md:text-2xl pointer-events-none"></i>
                </div>
            </a>
            @endif

            {{-- Email --}}
            @if($hasSocialEmail)
            <a href="mailto:{{ $email }}" class="flex items-center gap-3 group cursor-pointer">
                <span class="bg-white/90 backdrop-blur-sm text-[#181836] px-3 py-1.5 rounded-lg text-[10px] md:text-xs font-bold shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Email</span>
                <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-500 text-white rounded-full flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
                    <i class="far fa-envelope text-xl md:text-2xl pointer-events-none"></i>
                </div>
            </a>
            @endif

            {{-- Saran & Masukan --}}
            <a href="{{ route('front.kontak') }}#saran-masukan" @click="open = false" class="flex items-center gap-3 group cursor-pointer">
                <span class="bg-white/90 backdrop-blur-sm text-[#181836] px-3 py-1.5 rounded-lg text-[10px] md:text-xs font-bold shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Saran & Masukan</span>
                <div class="w-10 h-10 md:w-12 md:h-12 bg-yellow-500 text-black rounded-full flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-envelope-open-text text-xl md:text-2xl pointer-events-none"></i>
                </div>
            </a>
        </div>

        {{-- Main Trigger Button --}}
        <button @click.prevent="open = !open" 
                :class="open ? 'bg-red-500 rotate-90' : 'bg-yellow-500'"
                class="w-12 h-12 md:w-14 md:h-14 rounded-full shadow-[0_10px_25px_rgba(234,179,8,0.4)] flex items-center justify-center text-[#181836] transition-all duration-500 hover:scale-110 relative z-10 group cursor-pointer">
            <template x-if="!open">
                <div class="relative flex items-center justify-center pointer-events-none">
                    <i class="fas fa-comment-dots text-xl md:text-2xl animate-pulse"></i>
                    {{-- Pulse Effect --}}
                    <span class="absolute -inset-2 md:-inset-3 bg-yellow-400/30 rounded-full animate-ping -z-10"></span>
                </div>
            </template>
            <template x-if="open">
                <i class="fas fa-times text-xl md:text-2xl text-white pointer-events-none"></i>
            </template>
        </button>
    </div>

    @stack('before-scripts')
    @stack('after-scripts')

    {{-- Page loading animation --}}
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Sembunyikan loader segera setelah DOM selesai di-render (untuk first enter saja)
        const loader = document.getElementById("page-loader");
        if (loader) {
            loader.classList.add("loader-hide");
            setTimeout(() => loader.style.display = "none", 150);
        }

        // Animasi progress bar selesai loading halaman baru
        const bar = document.getElementById("top-loading-bar");
        if (bar) {
            bar.style.width = "100%";
            setTimeout(() => {
                bar.style.opacity = "0";
            }, 200);
        }

        // Animasi progress bar tipis saat link diklik (non-blocking)
        document.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", function (e) {
                const href = this.getAttribute('href');
                
                if (
                    !href || 
                    href.startsWith('#') || 
                    href.startsWith('javascript:') ||
                    this.target === "_blank" ||
                    this.hasAttribute('download') ||
                    this.classList.contains('gallery-lightbox') ||
                    this.hasAttribute('data-fancybox') ||
                    this.hasAttribute('data-no-loader')
                ) {
                    return;
                }

                const bar = document.getElementById("top-loading-bar");
                if (bar) {
                    bar.style.opacity = "1";
                    bar.style.width = "0";
                    // Sedikit delay agar transisi terlihat smooth
                    setTimeout(() => {
                        bar.style.transition = "width 2s cubic-bezier(0.08, 0.8, 0.1, 1)";
                        bar.style.width = "70%";
                    }, 10);
                }
            });
        });

        // Intercept link ganti bahasa untuk transisi instant tanpa double refresh (lebih kencang)
        document.querySelectorAll('a[href*="/lang/"]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.getAttribute('href');
                
                // Tampilkan loader & progress bar secara instan
                const loader = document.getElementById("page-loader");
                if (loader) {
                    loader.style.display = "flex";
                    loader.classList.remove("loader-hide");
                    loader.style.opacity = "1";
                }
                const bar = document.getElementById("top-loading-bar");
                if (bar) {
                    bar.style.opacity = "1";
                    bar.style.width = "75%";
                }
                
                // Ubah session bahasa di background
                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(() => {
                    // Setelah sukses, langsung reload halaman saat ini (hanya 1x request ke server)
                    if (bar) bar.style.width = "100%";
                    window.location.reload();
                })
                .catch(() => {
                    // Fallback jika terjadi kendala jaringan
                    window.location.href = url;
                });
            });
        });
    });
    </script>

    {{-- Instant.page - Pre-fetching halaman saat hover --}}
    <script src="https://instant.page/5.2.0" type="module" integrity="sha384-jnZyxPjiipyiIMtdObjHC9uUpRJOPq2dpG91T1brEXJJQE37kv3565xz3tOXg87W"></script>

</body>

</html>
