@extends('front.master')

@section('title', $cabor['name'] . ' | Disiplin Resmi PB PORSEROSI')
@section('description', $cabor['description'])

@section('content')
    <div class="font-[Poppins] text-slate-200 flex flex-col flex-grow min-h-screen bg-[#0d0d1f]">
        <x-navbar />

        {{-- 1. Hero Section --}}
        <section class="relative min-h-[60vh] md:min-h-[75vh] flex items-center overflow-hidden">
            {{-- Background Image --}}
            <img src="{{ get_image_url('assets/images/siapindo/' . $cabor['hero_image']) }}"
                 alt="{{ $cabor['name'] }}"
                 class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2s] scale-105" />
            {{-- Premium Gradient Overlays --}}
            <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d1f] via-[#0d0d1f]/80 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0d0d1f]/90 via-[#0d0d1f]/40 to-transparent"></div>
            <div class="absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-[#0d0d1f]/80 to-transparent"></div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32">
                <div class="max-w-3xl">
                    {{-- Badge --}}
                    <div class="mb-6" data-aos="fade-down" data-aos-duration="800">
                        <span class="inline-flex items-center gap-2.5 px-4.5 py-2 bg-{{ $cabor['badge_color'] }}-500/20 backdrop-blur-md border border-{{ $cabor['badge_color'] }}-500/30 rounded-full text-{{ $cabor['badge_color'] }}-400 text-xs font-extrabold uppercase tracking-widest">
                            <span class="w-2 h-2 rounded-full bg-{{ $cabor['badge_color'] }}-400 animate-pulse"></span>
                            {{ app()->getLocale() === 'en' ? 'PORSEROSI Discipline' : 'Disiplin PORSEROSI' }}
                        </span>
                    </div>

                    {{-- Title --}}
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 leading-tight drop-shadow-2xl tracking-tight" data-aos="fade-right" data-aos-duration="1000">
                        {{ $cabor['name'] }}
                    </h1>

                    {{-- Tagline --}}
                    <p class="text-xl md:text-2xl text-yellow-400 font-semibold mb-8 tracking-wide" data-aos="fade-right" data-aos-delay="200" data-aos-duration="1000">
                        {{ $cabor['tagline'] }}
                    </p>

                    {{-- Stats Summary --}}
                    <div class="flex flex-wrap items-center gap-6 md:gap-8" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                        <div class="flex flex-col bg-white/5 backdrop-blur-sm border border-white/10 px-6 py-3 rounded-2xl">
                            <span class="text-3xl font-extrabold text-white">{{ count($cabor['disciplines']) }}</span>
                            <span class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mt-0.5">
                                {{ app()->getLocale() === 'en' ? 'Categories' : 'Kategori Lomba' }}
                            </span>
                        </div>
                        <div class="hidden sm:block w-px h-12 bg-white/10"></div>
                        <div class="flex flex-wrap gap-2 text-sm text-slate-300 font-medium tracking-wide">
                            @foreach($cabor['disciplines'] as $category)
                                <span class="px-3 py-1 bg-white/5 border border-white/5 rounded-lg">{{ $category['name'] }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Scroll indicator --}}
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 animate-bounce">
                <svg class="w-6 h-6 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </div>
        </section>

        {{-- 2. Overview Section --}}
        <section class="py-24 bg-[#0d0d1f] relative">
            {{-- Decorative --}}
            <div class="absolute top-0 right-0 w-96 h-96 bg-{{ $cabor['badge_color'] }}-500/5 rounded-full blur-3xl opacity-30 pointer-events-none"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                    {{-- Text Content --}}
                    <div class="lg:col-span-7" data-aos="fade-right" data-aos-duration="1000">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-2.5 h-9 bg-yellow-500 rounded-full shadow-[0_0_15px_rgba(234,179,8,0.6)]"></div>
                            <h2 class="text-3xl md:text-4xl font-extrabold text-white uppercase tracking-tight">
                                {{ app()->getLocale() === 'en' ? 'Overview' : 'Gambaran Umum' }}
                            </h2>
                        </div>
                        <p class="text-slate-200 text-lg leading-relaxed mb-6 font-medium">
                            {{ $cabor['description'] }}
                        </p>
                        <p class="text-slate-400 text-base leading-relaxed">
                            {{ $cabor['overview'] }}
                        </p>
                    </div>

                    {{-- Quick Info Card --}}
                    <div class="lg:col-span-5" data-aos="fade-left" data-aos-duration="1000">
                        <div class="bg-gradient-to-b from-[#181836] to-[#13132e] rounded-3xl p-8 border border-white/5 shadow-2xl relative overflow-hidden group">
                            <div class="absolute -right-16 -top-16 w-32 h-32 bg-{{ $cabor['badge_color'] }}-500/10 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-700"></div>
                            
                            <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2.5">
                                <i class="fas fa-info-circle text-yellow-500"></i>
                                {{ app()->getLocale() === 'en' ? 'Quick Facts' : 'Fakta Singkat' }}
                            </h3>

                            <div class="space-y-5">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center shrink-0">
                                        <i class="fas fa-globe-asia text-{{ $cabor['badge_color'] }}-400"></i>
                                    </div>
                                    <div>
                                        <span class="text-xs text-slate-500 uppercase tracking-wider block font-bold">{{ app()->getLocale() === 'en' ? 'Discipline Name' : 'Nama Disiplin' }}</span>
                                        <span class="text-sm text-slate-200 font-semibold">{{ $cabor['name'] }}</span>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center shrink-0">
                                        <i class="fas fa-sitemap text-yellow-500"></i>
                                    </div>
                                    <div>
                                        <span class="text-xs text-slate-500 uppercase tracking-wider block font-bold">{{ app()->getLocale() === 'en' ? 'Affiliation' : 'Afiliasi Induk' }}</span>
                                        <span class="text-sm text-slate-200 font-semibold">PB PORSEROSI / World Skate</span>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center shrink-0">
                                        <i class="fas fa-medal text-emerald-400"></i>
                                    </div>
                                    <div>
                                        <span class="text-xs text-slate-500 uppercase tracking-wider block font-bold">{{ app()->getLocale() === 'en' ? 'Category Count' : 'Jumlah Kategori Lomba' }}</span>
                                        <span class="text-sm text-slate-200 font-semibold">{{ count($cabor['disciplines']) }} Kategori Kompetisi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- 3. Categories / Events Section --}}
        <section class="py-24 bg-[#13132e] border-y border-white/5 relative">
            {{-- Decorative --}}
            <div class="absolute left-0 w-96 h-96 bg-yellow-500/5 rounded-full blur-3xl -translate-x-1/2 opacity-30 pointer-events-none"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                {{-- Section Header --}}
                <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up" data-aos-duration="1000">
                    <span class="inline-block px-5 py-2 bg-yellow-500/10 border border-yellow-500/20 rounded-full text-yellow-500 text-xs font-bold uppercase tracking-widest mb-6">
                        {{ app()->getLocale() === 'en' ? 'COMPETITION CATEGORIES' : 'NOMOR LOMBA & KATEGORI' }}
                    </span>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-white uppercase tracking-tight mb-5 leading-tight">
                        {{ app()->getLocale() === 'en' ? 'Official Categories' : 'Kategori Kompetisi' }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">{{ $cabor['name'] }}</span>
                    </h2>
                    <p class="text-slate-400 text-lg leading-relaxed">
                        {{ app()->getLocale() === 'en' 
                            ? 'List of official competition events and categories for ' . $cabor['name'] . ' developed by PB PORSEROSI.'
                            : 'Daftar nomor lomba dan kategori kompetisi resmi untuk disiplin ' . $cabor['name'] . ' yang dikembangkan oleh PB PORSEROSI.' }}
                    </p>
                </div>

                {{-- Category Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
                    @foreach ($cabor['disciplines'] as $index => $category)
                        <div class="group relative bg-[#1c1c3a] rounded-3xl overflow-hidden border border-white/5 shadow-2xl hover:border-yellow-500/30 hover:shadow-[0_20px_50px_rgba(234,179,8,0.08)] transition-all duration-500"
                             data-aos="fade-up" data-aos-delay="{{ $index * 150 }}" data-aos-duration="1000">

                            {{-- Image Cover --}}
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ get_image_url('assets/images/siapindo/' . $category['image']) }}"
                                     alt="{{ $category['name'] }}"
                                     class="w-full h-full object-cover transition-transform duration-[1.2s] ease-out group-hover:scale-110" />
                                <div class="absolute inset-0 bg-gradient-to-t from-[#1c1c3a] via-[#1c1c3a]/40 to-transparent"></div>

                                {{-- Floating Icon Container --}}
                                <div class="absolute top-5 right-5 w-12 h-12 rounded-2xl bg-black/35 backdrop-blur-md border border-white/10 flex items-center justify-center group-hover:bg-yellow-500 group-hover:border-yellow-400 transition-all duration-300">
                                    <i class="{{ $category['icon'] }} text-yellow-400 group-hover:text-[#1c1c3a] text-lg transition-colors duration-300"></i>
                                </div>

                                {{-- Category Title --}}
                                <div class="absolute bottom-5 left-6 right-6">
                                    <h3 class="text-2xl font-extrabold text-white drop-shadow-lg group-hover:text-yellow-400 transition-colors duration-300">
                                        {{ $category['name'] }}
                                    </h3>
                                </div>
                            </div>

                            {{-- Content Description --}}
                            <div class="p-6 md:p-8">
                                <p class="text-slate-300 leading-relaxed mb-6 text-sm md:text-base opacity-90">
                                    {{ $category['description'] }}
                                </p>

                                {{-- Details --}}
                                <div class="flex items-center gap-3.5 mb-6 bg-white/5 border border-white/5 px-4.5 py-3 rounded-2xl">
                                    <div class="w-9 h-9 rounded-xl bg-yellow-500/20 flex items-center justify-center shrink-0">
                                        <i class="fas fa-medal text-yellow-500 text-sm"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] text-slate-500 uppercase tracking-widest block font-bold">{{ app()->getLocale() === 'en' ? 'Competition Level' : 'Level Kompetisi' }}</span>
                                        <span class="text-sm text-slate-200 font-semibold">{{ $category['competition_level'] }}</span>
                                    </div>
                                </div>

                                {{-- Link to events --}}
                                <div class="border-t border-white/5 pt-5">
                                    <a href="{{ route('front.event.daftar') }}"
                                       class="inline-flex items-center gap-2 text-sm font-extrabold text-yellow-500 hover:text-yellow-400 uppercase tracking-wider group/link transition-colors">
                                        {{ app()->getLocale() === 'en' ? 'View Competitions' : 'Kompetisi Resmi' }}
                                        <svg class="w-4 h-4 transition-transform duration-300 group-hover/link:translate-x-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- 4. Other Disciplines Navigation --}}
        <section class="py-24 bg-[#0d0d1f] relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="1000">
                    <h2 class="text-2xl md:text-3xl font-extrabold text-white uppercase tracking-tight">
                        {{ app()->getLocale() === 'en' ? 'Other PORSEROSI Disciplines' : 'Disiplin Resmi PORSEROSI Lainnya' }}
                    </h2>
                    <div class="w-20 h-1 bg-yellow-500 mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="flex flex-wrap justify-center gap-6 lg:gap-8">
                    @foreach ($allCabang as $other)
                        @if ($other['slug'] !== $cabor['slug'])
                            <a href="{{ route('front.cabangOlahraga', $other['slug']) }}"
                               class="group relative rounded-2xl overflow-hidden h-44 w-full sm:w-[320px] md:w-[350px] border border-white/5 shadow-xl block hover:border-yellow-500/20 hover:shadow-2xl transition-all duration-300" data-aos="fade-up">
                                <img src="{{ get_image_url('assets/images/siapindo/' . $other['hero_image']) }}"
                                     alt="{{ $other['name'] }}"
                                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d1f] via-[#0d0d1f]/60 to-transparent"></div>
                                <div class="absolute inset-0 flex items-end p-6">
                                    <div>
                                        <h3 class="text-lg font-extrabold text-white group-hover:text-yellow-400 transition-colors duration-300">
                                            {{ $other['name'] }}
                                        </h3>
                                        <span class="text-[10px] text-slate-400 uppercase tracking-widest flex items-center gap-1.5 mt-1 font-bold">
                                            {{ app()->getLocale() === 'en' ? 'Explore Details' : 'Lihat Detail Kategori' }}
                                            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        {{-- 5. CTA Section --}}
        <section class="py-24 bg-[#13132e] border-t border-white/5 relative overflow-hidden">
            <div class="absolute -bottom-16 -left-16 w-64 h-64 bg-yellow-500/5 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
            
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6 leading-tight" data-aos="fade-up" data-aos-duration="1000">
                    {{ app()->getLocale() === 'en' ? 'Get Involved' : 'Siap Menunjukkan Prestasimu?' }}
                </h2>
                <p class="text-slate-400 text-lg mb-12 max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                    {{ app()->getLocale() === 'en' 
                        ? 'Register yourself to participate in official ' . $cabor['name'] . ' events organized by PB PORSEROSI.' 
                        : 'Daftarkan diri Anda untuk mengikuti berbagai event dan kompetisi resmi ' . $cabor['name'] . ' yang diselenggarakan oleh PB PORSEROSI.' }}
                </p>
                <div class="flex flex-wrap justify-center gap-5" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                    <a href="{{ route('front.event.daftar') }}"
                       class="inline-flex items-center gap-2.5 px-8 py-4.5 rounded-2xl bg-gradient-to-r from-yellow-500 to-yellow-600 text-[#0d0d1f] font-extrabold hover:from-yellow-400 hover:to-yellow-500 hover:shadow-[0_0_30px_rgba(234,179,8,0.45)] hover:-translate-y-1 transition-all duration-300">
                        <i class="fas fa-clipboard-list text-base"></i>
                        {{ app()->getLocale() === 'en' ? 'Explore Events' : 'Lihat Semua Event' }}
                    </a>
                </div>
            </div>
        </section>

        <x-footer />
    </div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/filament/style.css') }}">
@endpush

@section('schema')
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "SportsOrganization",
      "name": "{{ $cabor['name'] }}",
      "description": "{{ $cabor['description'] }}",
      "parentOrganization": {
        "@type": "SportsOrganization",
        "name": "PORSEROSI"
      },
      "sport": "{{ $cabor['name'] }}",
      "areaServed": "Indonesia"
    }
    </script>
@endsection
