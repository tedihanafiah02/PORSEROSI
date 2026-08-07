@extends('front.master')

@section('title', __('messages.our_partner') . ' | PB PORSEROSI')
@section('description', __('messages.some_of_our_partners'))

@section('content')
<div class="font-[Poppins] overflow-hidden bg-[#0d0d1f] flex flex-col flex-grow min-h-screen">
    <x-navbar />

    {{-- 1. HERO SECTION - Horizontal Split --}}
    <div class="relative pt-32 pb-16 md:pt-44 md:pb-24 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#0d0d1f] via-[#13132e] to-[#1a1a3e]"></div>
        <div class="absolute top-20 right-0 w-[500px] h-[500px] bg-yellow-500/5 rounded-full blur-[150px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-blue-500/5 rounded-full blur-[120px] pointer-events-none"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                {{-- Left: Text --}}
                <div data-aos="fade-right" data-aos-duration="1000">
                    <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 text-xs font-extrabold tracking-widest mb-5 uppercase">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/></svg>
                        Partnership
                    </span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-5 uppercase tracking-tight leading-[1.1]">
                        {{ app()->getLocale() === 'en' ? 'Our Valued' : 'Mitra Resmi' }} <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-amber-500">{{ app()->getLocale() === 'en' ? 'Partners' : 'Kami' }}</span>
                    </h1>
                    <p class="text-slate-400 text-sm md:text-base leading-relaxed max-w-lg mb-8">
                        {{ app()->getLocale() === 'en' 
                            ? 'Meet the organizations and companies that support PB PORSEROSI in developing roller sports, skateboarding, and scooter across Indonesia.' 
                            : 'Kenali organisasi dan perusahaan yang mendukung PB PORSEROSI dalam memajukan olahraga sepatu roda, skateboard, dan skuter di seluruh Indonesia.' }}
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('front.partner.join') }}" class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-2xl bg-gradient-to-r from-yellow-500 to-amber-500 text-[#0d0d1f] font-extrabold text-sm hover:shadow-[0_0_30px_rgba(234,179,8,0.3)] hover:-translate-y-0.5 transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            {{ app()->getLocale() === 'en' ? 'Become a Partner' : 'Jadi Partner Kami' }}
                        </a>
                        <a href="#partner-list" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-white/5 border border-white/10 text-white font-bold text-sm hover:bg-white/10 transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            {{ app()->getLocale() === 'en' ? 'See Partners' : 'Lihat Partner' }}
                        </a>
                    </div>
                </div>

                {{-- Right: Stats Cards --}}
                <div class="grid grid-cols-2 gap-4" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="bg-[#181836]/60 backdrop-blur-md border border-white/5 rounded-3xl p-6 text-center hover:border-yellow-500/20 transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-2xl bg-yellow-500/10 flex items-center justify-center mx-auto mb-3 group-hover:bg-yellow-500 transition-colors duration-300">
                            <i class="fas fa-handshake text-yellow-500 text-xl group-hover:text-[#0d0d1f] transition-colors"></i>
                        </div>
                        <span class="text-3xl font-extrabold text-white block">{{ $partners->count() }}</span>
                        <span class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">{{ app()->getLocale() === 'en' ? 'Active Partners' : 'Partner Aktif' }}</span>
                    </div>
                    <div class="bg-[#181836]/60 backdrop-blur-md border border-white/5 rounded-3xl p-6 text-center hover:border-blue-500/20 transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-2xl bg-blue-500/10 flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-500 transition-colors duration-300">
                            <i class="fas fa-globe text-blue-400 text-xl group-hover:text-white transition-colors"></i>
                        </div>
                        <span class="text-3xl font-extrabold text-white block">7</span>
                        <span class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">{{ app()->getLocale() === 'en' ? 'Disciplines' : 'Cabang Olahraga' }}</span>
                    </div>
                    <div class="bg-[#181836]/60 backdrop-blur-md border border-white/5 rounded-3xl p-6 text-center hover:border-emerald-500/20 transition-all duration-300 group col-span-2">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center mx-auto mb-3 group-hover:bg-emerald-500 transition-colors duration-300">
                            <i class="fas fa-map-marked-alt text-emerald-400 text-xl group-hover:text-white transition-colors"></i>
                        </div>
                        <span class="text-3xl font-extrabold text-white block">34</span>
                        <span class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">{{ app()->getLocale() === 'en' ? 'Provinces Reached' : 'Provinsi Terjangkau' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. PARTNER LIST - Full Width Cards --}}
    <section id="partner-list" class="py-16 md:py-24 bg-[#0d0d1f] relative">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
        
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl font-extrabold text-white uppercase tracking-tight mb-3">
                    {{ app()->getLocale() === 'en' ? 'Partner Directory' : 'Direktori Partner' }}
                </h2>
                <div class="w-16 h-1 bg-yellow-500 mx-auto rounded-full mb-4"></div>
                <p class="text-slate-400 text-sm max-w-xl mx-auto">
                    {{ app()->getLocale() === 'en' 
                        ? 'Explore our partners and connect with them directly.' 
                        : 'Jelajahi mitra kami dan hubungi mereka secara langsung.' }}
                </p>
            </div>

            @if($partners->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($partners as $partner)
                        <div class="bg-[#181836]/60 backdrop-blur-md border border-white/10 rounded-3xl p-6 hover:border-yellow-500/30 hover:shadow-[0_10px_30px_rgba(234,179,8,0.1)] transition-all duration-300 flex flex-col justify-between h-full group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                            <div>
                                {{-- Logo & Link --}}
                                <div class="flex items-center justify-between gap-4 mb-5">
                                    <div class="w-16 h-16 rounded-xl bg-white flex items-center justify-center shrink-0 overflow-hidden p-2 shadow-md">
                                        <img src="{{ get_image_url($partner->logo_path) }}" 
                                             alt="{{ $partner->getLocalizedAlt() ?? $partner->name }}" 
                                             class="max-w-full max-h-full object-contain transition-transform duration-300 group-hover:scale-105"
                                             loading="lazy">
                                    </div>
                                    @if($partner->link)
                                        <a href="{{ $partner->link }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 hover:bg-blue-500 hover:text-white transition-all duration-300 shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    @endif
                                </div>

                                {{-- Partner Name --}}
                                <h3 class="text-base md:text-lg font-extrabold text-white group-hover:text-yellow-400 transition-colors duration-300 mb-3 truncate">
                                    {{ $partner->name }}
                                </h3>

                                {{-- Description --}}
                                @if($partner->getLocalizedDescription())
                                    <p class="text-slate-400 text-xs md:text-sm leading-relaxed mb-5 line-clamp-3">
                                        {{ $partner->getLocalizedDescription() }}
                                    </p>
                                @else
                                    <p class="text-slate-500 text-xs md:text-sm italic leading-relaxed mb-5">
                                        {{ app()->getLocale() === 'en' ? 'No description available.' : 'Tidak ada deskripsi tersedia.' }}
                                    </p>
                                @endif
                            </div>

                            {{-- Contact / Call-to-action details --}}
                            <div class="mt-auto pt-4 border-t border-white/5 space-y-3">
                                @if($partner->contact_name)
                                    <div class="flex items-center gap-2 text-slate-300 text-xs">
                                        <svg class="w-3.5 h-3.5 text-slate-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        <span class="truncate font-medium">{{ $partner->contact_name }}</span>
                                    </div>
                                @endif
                                
                                <div class="flex flex-wrap gap-2 pt-1">
                                    @if($partner->whatsapp_number)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $partner->whatsapp_number) }}" target="_blank" class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold hover:bg-emerald-500 hover:text-white transition-all duration-300">
                                            <i class="fab fa-whatsapp text-sm"></i>
                                            WhatsApp
                                        </a>
                                    @endif
                                    @if($partner->link)
                                        <a href="{{ $partner->link }}" target="_blank" rel="noopener" class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-white/5 border border-white/5 text-slate-300 text-xs font-semibold hover:bg-white/10 hover:text-white transition-all duration-300 truncate">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                            Website
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl" data-aos="fade-up">
                    <svg class="w-16 h-16 text-yellow-500/20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <p class="text-slate-400 text-sm">{{ app()->getLocale() === 'en' ? 'No active partners yet.' : 'Belum ada partner aktif saat ini.' }}</p>
                </div>
            @endif
        </div>
    </section>

    {{-- 3. CTA Section --}}
    <section class="py-20 bg-gradient-to-br from-[#13132e] to-[#0d0d1f] border-t border-white/5 relative overflow-hidden">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-yellow-500/5 rounded-full blur-[200px] pointer-events-none"></div>
        
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4 uppercase tracking-tight">
                {{ app()->getLocale() === 'en' ? 'Want to Be Our Partner?' : 'Tertarik Menjadi Partner?' }}
            </h2>
            <p class="text-slate-400 text-sm md:text-base mb-8 max-w-xl mx-auto leading-relaxed">
                {{ app()->getLocale() === 'en' 
                    ? 'Join us to support the development of roller sports, skateboarding, and scooter in Indonesia. Register now through our partner application form.' 
                    : 'Bergabunglah bersama kami untuk mendukung perkembangan olahraga sepatu roda, skateboard, dan skuter di Indonesia. Daftarkan diri Anda melalui formulir pengajuan partner.' }}
            </p>
            <a href="{{ route('front.partner.join') }}" class="inline-flex items-center gap-2.5 px-8 py-4 rounded-2xl bg-gradient-to-r from-yellow-500 to-amber-500 text-[#0d0d1f] font-extrabold text-sm hover:shadow-[0_0_40px_rgba(234,179,8,0.4)] hover:-translate-y-1 transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                {{ app()->getLocale() === 'en' ? 'Apply as Partner' : 'Daftar Jadi Partner' }}
            </a>
        </div>
    </section>

    <x-footer />
</div>
@endsection
