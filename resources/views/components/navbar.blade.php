@php
    $socialIg = \App\Models\SeoSetting::get('social_instagram');
    $socialFb = \App\Models\SeoSetting::get('social_facebook');
    $socialYt = \App\Models\SeoSetting::get('social_youtube');
    $socialTw = \App\Models\SeoSetting::get('social_twitter');
    $socialTt = \App\Models\SeoSetting::get('social_tiktok');
    $orgEmail = \App\Models\SeoSetting::get('social_email') ?: \App\Models\SeoSetting::get('organization_email');
    $orgPhone = \App\Models\SeoSetting::get('social_whatsapp') ?: \App\Models\SeoSetting::get('organization_phone');
@endphp
    {{-- ========================== --}}
    {{-- DESKTOP NAVBAR (md and up) --}}
    {{-- ========================== --}}
    <nav id="main-navbar" class="hidden md:block fixed top-0 left-0 z-50 w-full bg-[#181836]/95 backdrop-blur-lg border-b border-white/5 shadow-[0_4px_30px_rgba(0,0,0,0.4)] main-navbar-container will-change-transform">

        {{-- Row 1: Top bar with quick links --}}
        <div class="bg-[#0d0d25] border-b border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-9">
                <div class="flex items-center gap-1 text-[11px]">
                    <a href="{{ route('front.cabangOlahraga', 'inline-freestyle') }}" class="px-2 py-1 text-slate-400 hover:text-yellow-400 transition-colors uppercase tracking-wider font-semibold">Inline Freestyle</a>
                    <span class="text-white/10">|</span>
                    <a href="{{ route('front.cabangOlahraga', 'inline-hockey') }}" class="px-2 py-1 text-slate-400 hover:text-yellow-400 transition-colors uppercase tracking-wider font-semibold">Inline Hockey</a>
                    <span class="text-white/10">|</span>
                    <a href="{{ route('front.cabangOlahraga', 'roller-freestyle') }}" class="px-2 py-1 text-slate-400 hover:text-yellow-400 transition-colors uppercase tracking-wider font-semibold">Roller Freestyle</a>
                    <span class="text-white/10">|</span>
                    <a href="{{ route('front.cabangOlahraga', 'scooter') }}" class="px-2 py-1 text-slate-400 hover:text-yellow-400 transition-colors uppercase tracking-wider font-semibold">Scooter</a>
                    <span class="text-white/10">|</span>
                    <a href="{{ route('front.cabangOlahraga', 'skateboard') }}" class="px-2 py-1 text-slate-400 hover:text-yellow-400 transition-colors uppercase tracking-wider font-semibold">Skateboard</a>
                    <span class="text-white/10">|</span>
                    <a href="{{ route('front.cabangOlahraga', 'speed') }}" class="px-2 py-1 text-slate-400 hover:text-yellow-400 transition-colors uppercase tracking-wider font-semibold">Speed</a>
                    <span class="text-white/10">|</span>
                    <a href="{{ route('front.cabangOlahraga', 'artistic') }}" class="px-2 py-1 text-slate-400 hover:text-yellow-400 transition-colors uppercase tracking-wider font-semibold">Artistic</a>
                </div>
                {{-- Social icons & Language --}}
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('lang.switch', 'id') }}" class="{{ app()->getLocale() == 'id' ? 'text-yellow-400 font-bold' : 'text-slate-500 hover:text-white' }} text-xs uppercase transition-colors">ID</a>
                        <span class="text-white/20 text-xs">|</span>
                        <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'text-yellow-400 font-bold' : 'text-slate-500 hover:text-white' }} text-xs uppercase transition-colors">EN</a>
                    </div>
                    <div class="flex items-center gap-3 border-l border-white/10 pl-4">
                        @if($socialYt)
                            <a href="{{ $socialYt }}" target="_blank" class="text-slate-500 hover:text-white transition-colors"><i class="fab fa-youtube text-xs"></i></a>
                        @endif
                        @if($socialIg)
                            <a href="{{ $socialIg }}" target="_blank" class="text-slate-500 hover:text-white transition-colors"><i class="fab fa-instagram text-xs"></i></a>
                        @endif
                        @if($socialFb)
                            <a href="{{ $socialFb }}" target="_blank" class="text-slate-500 hover:text-white transition-colors"><i class="fab fa-facebook text-xs"></i></a>
                        @endif
                        @if($socialTw)
                            <a href="{{ $socialTw }}" target="_blank" class="text-slate-500 hover:text-white transition-colors"><i class="fab fa-twitter text-xs"></i></a>
                        @endif
                        @if($socialTt)
                            <a href="{{ $socialTt }}" target="_blank" class="text-slate-500 hover:text-white transition-colors"><i class="fab fa-tiktok text-xs"></i></a>
                        @endif
                        @if($orgEmail)
                            <a href="mailto:{{ $orgEmail }}" class="text-slate-500 hover:text-white transition-colors"><i class="far fa-envelope text-xs"></i></a>
                        @endif
                        @if($orgPhone)
                            <a href="https://wa.me/{{ $orgPhone }}" target="_blank" class="text-slate-500 hover:text-white transition-colors"><i class="fab fa-whatsapp text-xs"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Row 2: Logo + Search + CTA --}}
        <div class="border-b border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between py-3">
                {{-- Logo --}}
                <a href="/" class="flex items-center shrink-0">
                    <img src="{{ asset('assets/images/siapindo/logo-porserosi.png') }}"
                         alt="{{ __('messages.meta_title_default') }}"
                         class="h-14 lg:h-16 w-auto object-contain" />
                </a>

                {{-- Right side: Search + LiveScore-style CTA --}}
                <div class="flex items-center gap-4">
                    {{-- Search Bar --}}
                    <form method="GET" action="{{ route('front.search') }}" class="relative">
                        @csrf
                        <input type="text" name="keyword" id="search-navbar-desktop"
                            class="w-72 lg:w-80 py-2.5 pl-4 pr-12 text-sm text-slate-200 bg-white/5 border border-white/10 rounded-lg focus:ring-2 focus:ring-yellow-500/30 focus:border-yellow-500/30 placeholder-slate-500 outline-none transition-all duration-300"
                            placeholder="{{ __('messages.search_placeholder') }}" value="{{ request('keyword') }}">
                        <button type="submit" class="absolute right-0 top-0 h-full px-4 text-slate-400 hover:text-yellow-400 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </button>
                    </form>

                    @auth
                        <div class="relative group">
                            <button type="button" class="flex items-center gap-2 px-3 py-2 rounded-xl bg-white/5 border border-white/10 hover:border-yellow-500/30 transition-all duration-300">
                                @if(auth()->user()->avatar_url)
                                    <img src="{{ auth()->user()->avatar_url }}" alt="Avatar" class="w-7 h-7 rounded-full border border-white/20">
                                @else
                                    <div class="w-7 h-7 rounded-full bg-yellow-500/20 flex items-center justify-center text-yellow-400 text-xs font-bold">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif
                                <span class="text-xs text-slate-300 font-semibold max-w-[100px] truncate hidden lg:inline">{{ auth()->user()->name }}</span>
                                <svg class="w-2.5 h-2.5 text-slate-400 transition-transform duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <div class="absolute right-0 top-full h-2 w-full"></div>
                            <div class="absolute right-0 top-full pt-0 z-50 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-in-out">
                                <div class="bg-[#1f1f42] rounded-xl shadow-2xl w-56 border border-white/10 overflow-hidden">
                                    <div class="px-4 py-3 border-b border-white/5">
                                        <div class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</div>
                                        <div class="text-[10px] text-slate-400 truncate">{{ auth()->user()->email }}</div>
                                    </div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <input type="hidden" name="redirect_to" value="{{ url()->current() }}">
                                        <button type="submit" class="w-full flex items-center gap-2 px-4 py-3 text-xs text-red-400 hover:bg-red-500/10 hover:text-red-300 transition duration-300">
                                            <i class="fas fa-sign-out-alt"></i>
                                            {{ app()->getLocale() === 'en' ? 'Logout' : 'Keluar' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endauth

                </div>
            </div>
        </div>

        {{-- Row 3: Main navigation menu --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-12">
            <ul class="flex items-center gap-1 text-[11px] lg:text-xs font-semibold uppercase tracking-wider">
                {{-- 1. Beranda --}}
                <li>
                    <a href="{{ route('front.beranda') }}" @class([
                        'block px-4 py-3 transition-colors duration-300 border-b-2',
                        'text-yellow-400 border-yellow-500' => request()->routeIs('front.beranda'),
                        'text-slate-300 border-transparent hover:text-yellow-400 hover:border-yellow-500/50' => !request()->routeIs('front.beranda'),
                    ])>
                        {{ __('messages.home') }}
                    </a>
                </li>

                {{-- 2. Tentang (Dropdown) --}}
                <li class="relative group">
                    <button type="button"
                        class="flex items-center gap-1 px-4 py-3 text-slate-300 hover:text-yellow-400 border-b-2 border-transparent hover:border-yellow-500/50 transition-all duration-300">
                        <span>{{ __('messages.about') }}</span>
                        <svg class="w-2.5 h-2.5 transition-transform duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full h-3 w-full"></div>
                    <div class="absolute left-0 top-full pt-0 z-50 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-in-out">
                        <div class="bg-[#1f1f42] rounded-xl shadow-2xl w-56 border border-white/10 overflow-hidden">
                            <ul class="text-xs lg:text-sm normal-case py-1 text-slate-300">
                                <li><a href="{{ route('front.profil') }}" class="block px-5 py-3 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">{{ __('messages.profile') }}</a></li>
                                <li class="border-t border-white/5"><a href="{{ route('front.strukturOrganisasi') }}" class="block px-5 py-3 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">{{ __('messages.org_structure') }}</a></li>
                                <li class="border-t border-white/5"><a href="{{ route('front.peraturan') }}" class="block px-5 py-3 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">{{ __('messages.regulations') }}</a></li>
                                <li class="border-t border-white/5"><a href="{{ route('front.kontak') }}" class="block px-5 py-3 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">{{ __('messages.contact_us') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </li>

                {{-- 3. Data (Dropdown) --}}
                <li class="relative group">
                    <button type="button"
                        class="flex items-center gap-1 px-4 py-3 text-slate-300 hover:text-yellow-400 border-b-2 border-transparent hover:border-yellow-500/50 transition-all duration-300">
                        <span>{{ __('messages.data') }}</span>
                        <svg class="w-2.5 h-2.5 transition-transform duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full h-3 w-full"></div>
                    <div class="absolute left-0 top-full pt-0 z-50 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-in-out">
                        <div class="bg-[#1f1f42] rounded-xl shadow-2xl w-56 border border-white/10 overflow-hidden">
                            <ul class="text-xs lg:text-sm normal-case py-1 text-slate-300">
                                <li><a href="{{ route('front.data.provinsi') }}" class="block px-5 py-3 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">{{ __('messages.provinces_cities') }}</a></li>
                                <li class="border-t border-white/5"><a href="{{ route('front.data.club') }}" class="block px-5 py-3 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">{{ __('messages.clubs') }}</a></li>
                                <li class="border-t border-white/5"><a href="{{ route('front.data.wasit') }}" class="block px-5 py-3 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">{{ __('messages.referees') }}</a></li>
                                <li class="border-t border-white/5"><a href="{{ route('front.data.pelatih') }}" class="block px-5 py-3 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">{{ __('messages.coaches') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </li>

                {{-- 4. Event (Dropdown) --}}
                <li class="relative group">
                    <button type="button"
                        class="flex items-center gap-1 px-4 py-3 text-slate-300 hover:text-yellow-400 border-b-2 border-transparent hover:border-yellow-500/50 transition-all duration-300">
                        <span>{{ __('messages.event') }}</span>
                        <svg class="w-2.5 h-2.5 transition-transform duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full h-3 w-full"></div>
                    <div class="absolute left-0 top-full pt-0 z-50 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-in-out">
                        <div class="bg-[#1f1f42] rounded-xl shadow-2xl w-56 border border-white/10 overflow-hidden">
                            <ul class="text-xs lg:text-sm normal-case py-1 text-slate-300">
                                <li><a href="{{ route('front.event.kompetisi') }}" class="block px-5 py-3 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">{{ __('messages.competitions') }}</a></li>
                                <li class="border-t border-white/5"><a href="{{ route('front.event.kegiatan') }}" class="block px-5 py-3 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">{{ __('messages.activities') }}</a></li>
                                <li class="border-t border-white/5"><a href="{{ route('front.event.daftar') }}" class="block px-5 py-3 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">{{ __('messages.event_list') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </li>

                {{-- 5. Result (Dropdown) --}}
                <li class="relative group">
                    <button type="button"
                        class="flex items-center gap-1 px-4 py-3 text-slate-300 hover:text-yellow-400 border-b-2 border-transparent hover:border-yellow-500/50 transition-all duration-300">
                        <span>{{ __('messages.result') }}</span>
                        <svg class="w-2.5 h-2.5 transition-transform duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full h-3 w-full"></div>
                    <div class="absolute left-0 top-full pt-0 z-50 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-in-out">
                        <div class="bg-[#1f1f42] rounded-xl shadow-2xl w-60 border border-white/10 overflow-hidden">
                            <ul class="text-xs lg:text-sm normal-case py-1 text-slate-300">
                                <li><a href="{{ route('front.result', 'inline-freestyle') }}" class="block px-5 py-2.5 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">Inline Freestyle</a></li>
                                <li class="border-t border-white/5"><a href="{{ route('front.result', 'inline-hockey') }}" class="block px-5 py-2.5 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">Inline Hockey</a></li>
                                <li class="border-t border-white/5"><a href="{{ route('front.result', 'roller-freestyle') }}" class="block px-5 py-2.5 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">Roller Freestyle</a></li>
                                <li class="border-t border-white/5"><a href="{{ route('front.result', 'scooter') }}" class="block px-5 py-2.5 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">Scooter</a></li>
                                <li class="border-t border-white/5"><a href="{{ route('front.result', 'skateboard') }}" class="block px-5 py-2.5 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">Skateboard</a></li>
                                <li class="border-t border-white/5"><a href="{{ route('front.result', 'speed') }}" class="block px-5 py-2.5 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">Speed</a></li>
                                <li class="border-t border-white/5"><a href="{{ route('front.result', 'artistic') }}" class="block px-5 py-2.5 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">Artistic</a></li>
                            </ul>
                        </div>
                    </div>
                </li>

                {{-- 6. Berita --}}
                <li>
                    <a href="{{ route('front.index') }}" @class([
                        'block px-4 py-3 transition-colors duration-300 border-b-2',
                        'text-yellow-400 border-yellow-500' => request()->routeIs('front.index'),
                        'text-slate-300 border-transparent hover:text-yellow-400 hover:border-yellow-500/50' => !request()->routeIs('front.index'),
                    ])>
                        {{ __('messages.news') }}
                    </a>
                </li>

                {{-- 7. Galeri --}}
                <li>
                    <a href="{{ route('front.gallery') }}" @class([
                        'block px-4 py-3 transition-colors duration-300 border-b-2',
                        'text-yellow-400 border-yellow-500' => request()->routeIs('front.gallery'),
                        'text-slate-300 border-transparent hover:text-yellow-400 hover:border-yellow-500/50' => !request()->routeIs('front.gallery'),
                    ])>
                        {{ __('messages.gallery') }}
                    </a>
                </li>

                {{-- 8. Partner (Dropdown) --}}
                <li class="relative group">
                    <button type="button"
                        class="flex items-center gap-1 px-4 py-3 text-slate-300 hover:text-yellow-400 border-b-2 border-transparent hover:border-yellow-500/50 transition-all duration-300">
                        <span>{{ __('messages.partner') }}</span>
                        <svg class="w-2.5 h-2.5 transition-transform duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full h-3 w-full"></div>
                    <div class="absolute left-0 top-full pt-0 z-50 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-in-out">
                        <div class="bg-[#1f1f42] rounded-xl shadow-2xl w-56 border border-white/10 overflow-hidden">
                            <ul class="text-xs lg:text-sm normal-case py-1 text-slate-300">
                                <li><a href="{{ route('front.partner') }}" class="block px-5 py-3 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">{{ __('messages.our_partners') }}</a></li>
                                <li class="border-t border-white/5"><a href="{{ route('front.partner.join') }}" class="block px-5 py-3 hover:bg-yellow-500/10 hover:text-yellow-400 transition duration-300">{{ __('messages.join_partner') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>

            {{-- Live Streaming Button on Right --}}
            <div class="flex items-center">
                <a href="{{ route('front.live') }}" class="flex items-center gap-2 px-6 py-2 bg-red-600/10 border border-red-500/20 rounded-full text-red-500 hover:bg-red-600 hover:text-white transition-all duration-300 text-xs font-bold uppercase tracking-wider group shadow-[0_0_10px_rgba(239,68,68,0.1)] hover:shadow-[0_0_20px_rgba(239,68,68,0.4)]">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75 group-hover:bg-white"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500 group-hover:bg-white"></span>
                    </span>
                    {{ __('messages.live_streaming') }}
                </a>
            </div>
        </div>
    </nav>

    {{-- ========================== --}}
    {{-- MOBILE NAVBAR (below md)   --}}
    {{-- ========================== --}}
    <nav id="mobile-navbar" class="md:hidden fixed top-0 left-0 z-50 w-full bg-[#181836]/95 backdrop-blur-lg border-b border-white/5 shadow-[0_4px_20px_rgba(0,0,0,0.3)] transition-all duration-300">
        <div class="flex items-center justify-between px-4 h-14">
            {{-- Logo --}}
            <a href="/" class="flex items-center shrink-0">
                <img src="{{ asset('assets/images/siapindo/logo-porserosi.png') }}"
                     alt="{{ __('messages.meta_title_default') }}"
                     class="h-10 w-auto object-contain" />
            </a>

            {{-- Right: search + hamburger --}}
            <div class="flex items-center gap-1">
                {{-- Search toggle --}}
                <button type="button" id="mobile-search-button" aria-label="Toggle search"
                    class="text-slate-400 hover:text-yellow-400 p-2.5 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </button>

                {{-- Hamburger --}}
                <button id="mobile-menu-toggle" type="button" aria-label="Toggle navigation"
                    class="text-slate-400 hover:text-yellow-400 p-2.5 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Search Form --}}
        <div id="mobile-search-form" class="mobile-search-container w-full">
            <form method="GET" action="{{ route('front.search') }}" class="relative w-full px-4 py-2">
                @csrf
                <div class="absolute inset-y-0 start-0 flex items-center ps-7 pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" name="keyword" id="search-navbar-mobile"
                    class="block w-full py-2.5 ps-10 pe-4 text-sm text-slate-200 bg-white/10 backdrop-blur-md border border-white/20 rounded-full focus:ring-2 focus:ring-yellow-500/40 focus:border-yellow-500/40 placeholder-slate-400 outline-none transition-all duration-300"
                    placeholder="{{ __('messages.search_placeholder') }}" value="{{ request('keyword') }}">
            </form>
        </div>

        {{-- Mobile Overlay --}}
        <div id="mobile-menu-overlay" class="mobile-menu-overlay"></div>

        {{-- Mobile Sidebar --}}
        <div class="mobile-sidebar" id="navbar-search">
            <div class="flex items-center justify-between p-4 border-b border-white/10">
                <span class="text-white font-semibold text-lg">{{ __('messages.menu') }}</span>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 mr-2">
                        <a href="{{ route('lang.switch', 'id') }}" class="{{ app()->getLocale() == 'id' ? 'text-yellow-400 font-bold' : 'text-slate-400' }} text-xs uppercase transition-colors">ID</a>
                        <span class="text-white/20 text-xs">|</span>
                        <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'text-yellow-400 font-bold' : 'text-slate-400' }} text-xs uppercase transition-colors">EN</a>
                    </div>
                    <button id="mobile-menu-close" type="button" class="text-gray-400 hover:text-white transition-colors p-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            <ul class="text-sm text-white flex flex-col p-4 font-medium">
                {{-- 1. Beranda --}}
                <li>
                    <a href="{{ route('front.beranda') }}" @class([
                        'w-full block transition duration-300 px-3 py-3 rounded-lg hover:bg-white/10',
                        'text-yellow-600 font-bold' => request()->routeIs('front.beranda'),
                    ])>{{ __('messages.home') }}</a>
                </li>

                {{-- 2. Tentang (Dropdown) --}}
                <li>
                    <details class="group">
                        <summary class="flex items-center justify-between w-full px-3 py-3 rounded-lg hover:bg-white/10 transition cursor-pointer list-none">
                            <span>{{ __('messages.about') }}</span>
                            <svg class="w-3 h-3 transition-transform duration-300 group-open:rotate-180" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </summary>
                        <ul class="pl-4 mt-1 space-y-1">
                            <li><a href="{{ route('front.profil') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">{{ __('messages.profile') }}</a></li>
                            <li><a href="{{ route('front.strukturOrganisasi') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">{{ __('messages.org_structure') }}</a></li>
                            <li><a href="{{ route('front.peraturan') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">{{ __('messages.regulations') }}</a></li>
                            <li><a href="{{ route('front.kontak') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">{{ __('messages.contact_us') }}</a></li>
                        </ul>
                    </details>
                </li>

                {{-- 3. Disiplin (Dropdown) --}}
                <li>
                    <details class="group">
                        <summary class="flex items-center justify-between w-full px-3 py-3 rounded-lg hover:bg-white/10 transition cursor-pointer list-none">
                            <span>Disiplin PORSEROSI</span>
                            <svg class="w-3 h-3 transition-transform duration-300 group-open:rotate-180" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </summary>
                        <ul class="pl-4 mt-1 space-y-1">
                            <li><a href="{{ route('front.cabangOlahraga', 'inline-freestyle') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">Inline Freestyle</a></li>
                            <li><a href="{{ route('front.cabangOlahraga', 'inline-hockey') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">Inline Hockey</a></li>
                            <li><a href="{{ route('front.cabangOlahraga', 'roller-freestyle') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">Roller Freestyle</a></li>
                            <li><a href="{{ route('front.cabangOlahraga', 'scooter') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">Scooter</a></li>
                            <li><a href="{{ route('front.cabangOlahraga', 'skateboard') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">Skateboard</a></li>
                            <li><a href="{{ route('front.cabangOlahraga', 'speed') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">Speed</a></li>
                            <li><a href="{{ route('front.cabangOlahraga', 'artistic') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">Artistic</a></li>
                        </ul>
                    </details>
                </li>

                {{-- 4. Data (Dropdown) --}}
                <li>
                    <details class="group">
                        <summary class="flex items-center justify-between w-full px-3 py-3 rounded-lg hover:bg-white/10 transition cursor-pointer list-none">
                            <span>{{ __('messages.data') }}</span>
                            <svg class="w-3 h-3 transition-transform duration-300 group-open:rotate-180" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </summary>
                        <ul class="pl-4 mt-1 space-y-1">
                            <li><a href="{{ route('front.data.provinsi') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">{{ __('messages.provinces_cities') }}</a></li>
                            <li><a href="{{ route('front.data.club') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">{{ __('messages.clubs') }}</a></li>
                            <li><a href="{{ route('front.data.wasit') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">{{ __('messages.referees') }}</a></li>
                            <li><a href="{{ route('front.data.pelatih') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">{{ __('messages.coaches') }}</a></li>
                        </ul>
                    </details>
                </li>

                {{-- 5. Event (Dropdown) --}}
                <li>
                    <details class="group">
                        <summary class="flex items-center justify-between w-full px-3 py-3 rounded-lg hover:bg-white/10 transition cursor-pointer list-none">
                            <span>{{ __('messages.event') }}</span>
                            <svg class="w-3 h-3 transition-transform duration-300 group-open:rotate-180" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </summary>
                        <ul class="pl-4 mt-1 space-y-1">
                            <li><a href="{{ route('front.event.kompetisi') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">{{ __('messages.competitions') }}</a></li>
                            <li><a href="{{ route('front.event.kegiatan') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">{{ __('messages.activities') }}</a></li>
                            <li><a href="{{ route('front.event.daftar') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">{{ __('messages.event_list') }}</a></li>
                        </ul>
                    </details>
                </li>

                {{-- 6. Result (Dropdown) --}}
                <li>
                    <details class="group">
                        <summary class="flex items-center justify-between w-full px-3 py-3 rounded-lg hover:bg-white/10 transition cursor-pointer list-none">
                            <span>{{ __('messages.result') }}</span>
                            <svg class="w-3 h-3 transition-transform duration-300 group-open:rotate-180" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </summary>
                        <ul class="pl-4 mt-1 space-y-1">
                            <li><a href="{{ route('front.result', 'inline-freestyle') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">Inline Freestyle</a></li>
                            <li><a href="{{ route('front.result', 'inline-hockey') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">Inline Hockey</a></li>
                            <li><a href="{{ route('front.result', 'roller-freestyle') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">Roller Freestyle</a></li>
                            <li><a href="{{ route('front.result', 'scooter') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">Scooter</a></li>
                            <li><a href="{{ route('front.result', 'skateboard') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">Skateboard</a></li>
                            <li><a href="{{ route('front.result', 'speed') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">Speed</a></li>
                            <li><a href="{{ route('front.result', 'artistic') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">Artistic</a></li>
                        </ul>
                    </details>
                </li>

                {{-- 7. Berita --}}
                <li>
                    <a href="{{ route('front.index') }}" @class([
                        'w-full block transition duration-300 px-3 py-3 rounded-lg hover:bg-white/10',
                        'text-yellow-600 font-bold' => request()->routeIs('front.index'),
                    ])>{{ __('messages.news') }}</a>
                </li>

                {{-- 8. Galeri --}}
                <li>
                    <a href="{{ route('front.gallery') }}" @class([
                        'w-full block transition duration-300 px-3 py-3 rounded-lg hover:bg-white/10',
                        'text-yellow-600 font-bold' => request()->routeIs('front.gallery'),
                    ])>{{ __('messages.gallery') }}</a>
                </li>

                {{-- 9. Partner (Dropdown) --}}
                <li>
                    <details class="group">
                        <summary class="flex items-center justify-between w-full px-3 py-3 rounded-lg hover:bg-white/10 transition cursor-pointer list-none">
                            <span>{{ __('messages.partner') }}</span>
                            <svg class="w-3 h-3 transition-transform duration-300 group-open:rotate-180" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </summary>
                        <ul class="pl-4 mt-1 space-y-1">
                            <li><a href="{{ route('front.partner') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">{{ __('messages.our_partners') }}</a></li>
                            <li><a href="{{ route('front.partner.join') }}" class="block px-3 py-2 text-slate-400 hover:text-yellow-400 rounded-lg transition">{{ __('messages.join_partner') }}</a></li>
                        </ul>
                    </details>
                </li>
            </ul>

            {{-- Mobile User Info & Logout --}}
            @auth
                <div class="mt-4 mx-4 p-4 bg-white/5 border border-white/10 rounded-2xl">
                    <div class="flex items-center gap-3 mb-3">
                        @if(auth()->user()->avatar_url)
                            <img src="{{ auth()->user()->avatar_url }}" alt="Avatar" class="w-9 h-9 rounded-full border border-white/20">
                        @else
                            <div class="w-9 h-9 rounded-full bg-yellow-500/20 flex items-center justify-center text-yellow-400 text-sm font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</div>
                            <div class="text-[10px] text-slate-400 truncate">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <input type="hidden" name="redirect_to" value="{{ url()->current() }}">
                        <button type="submit" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-500/20 transition-all duration-300 text-xs font-bold uppercase tracking-wider">
                            <i class="fas fa-sign-out-alt"></i>
                            {{ app()->getLocale() === 'en' ? 'Logout' : 'Keluar' }}
                        </button>
                    </form>
                </div>
            @endauth

            {{-- Mobile Social Icons --}}
            <div class="mt-6 p-6 border-t border-white/10">
                <p class="text-[10px] text-slate-500 uppercase tracking-widest font-semibold mb-4 text-center">{{ __('messages.follow_us') }}</p>
                <div class="flex items-center justify-center gap-4">
                    @if($socialYt)
                        <a href="{{ $socialYt }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all duration-300"><i class="fab fa-youtube text-lg"></i></a>
                    @endif
                    @if($socialIg)
                        <a href="{{ $socialIg }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-pink-600 hover:border-pink-600 hover:text-white transition-all duration-300"><i class="fab fa-instagram text-lg"></i></a>
                    @endif
                    @if($socialFb)
                        <a href="{{ $socialFb }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:border-blue-600 hover:text-white transition-all duration-300"><i class="fab fa-facebook text-lg"></i></a>
                    @endif
                    @if($socialTw)
                        <a href="{{ $socialTw }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-blue-400 hover:border-blue-400 hover:text-white transition-all duration-300"><i class="fab fa-twitter text-lg"></i></a>
                    @endif
                    @if($socialTt)
                        <a href="{{ $socialTt }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-slate-800 hover:border-slate-800 hover:text-white transition-all duration-300"><i class="fab fa-tiktok text-lg"></i></a>
                    @endif
                    @if($orgEmail)
                        <a href="mailto:{{ $orgEmail }}" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-blue-500 hover:border-blue-500 hover:text-white transition-all duration-300"><i class="far fa-envelope text-lg"></i></a>
                    @endif
                    @if($orgPhone)
                        <a href="https://wa.me/{{ $orgPhone }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-emerald-500 hover:border-emerald-500 hover:text-white transition-all duration-300"><i class="fab fa-whatsapp text-lg"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    {{-- Spacer for fixed navbar --}}
    <div class="h-14 md:h-[140px]"></div>

    @push('after-scripts')
        <script src="{{ asset('js/navbar.js') }}"></script>
    @endpush

    @push('after-styles')
        <link rel="stylesheet" href="{{ asset('css/filament/style.css') }}">
        <style>
            .main-navbar-container {
                transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s ease, box-shadow 0.4s ease;
            }
            .nav-hidden {
                transform: translateY(-100%);
                opacity: 0;
                pointer-events: none;
                box-shadow: none !important;
            }
        </style>
    @endpush
