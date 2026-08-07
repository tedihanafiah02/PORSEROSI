@extends('front.master')

@section('title', __('messages.page_title_gallery'))
@section('description', __('messages.page_desc_gallery'))

@section('content')
<div class="font-[Poppins] bg-[#0d0d1f] text-white flex flex-col flex-grow min-h-screen">
        <x-navbar />

        {{-- Hero Header --}}
        <div class="relative pt-32 pb-16 md:pt-40 md:pb-24 text-center overflow-hidden">
            {{-- Background decorative elements --}}
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-yellow-500/10 blur-[120px] rounded-full pointer-events-none"></div>
            
            <div class="relative z-10 px-4">
                <span class="inline-flex items-center py-1.5 px-4 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 text-xs font-extrabold tracking-widest mb-4 uppercase">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    {{ __('messages.official_documentation') }}
                </span>
                
                @if($activeAlbum)
                    <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 uppercase tracking-tight">
                        {{ $activeAlbum->name }}
                    </h1>
                    <p class="text-slate-400 text-sm md:text-base max-w-xl mx-auto font-medium">
                        {{ $activeAlbum->getLocalizedDescription() }}
                    </p>
                @else
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 tracking-tight">
                        {{ __('messages.gallery_title_heading') }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">PB PORSEROSI</span>
                    </h1>
                    <p class="text-slate-400 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
                        {{ __('messages.gallery_desc') }}
                    </p>
                @endif
            </div>
        </div>

        {{-- Main Content Section --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24 w-full">
            
            @if($activeAlbum)
                {{-- 1. VIEW PHOTOS IN ALBUM --}}
                <div class="mb-10 flex items-center justify-between">
                    <a href="{{ route('front.gallery') }}" 
                       class="inline-flex items-center px-4 py-2 bg-white/5 border border-white/10 rounded-2xl text-sm font-extrabold text-slate-300 hover:bg-white/10 hover:text-white transition-all duration-300 whitespace-nowrap">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        {{ app()->getLocale() === 'en' ? 'Back to Albums' : 'Kembali ke Album' }}
                    </a>
                    
                    <span class="text-sm font-semibold text-slate-400">
                        {{ count($galleries) }} {{ app()->getLocale() === 'en' ? 'Photos' : 'Foto' }}
                    </span>
                </div>

                @if(count($galleries) > 0)
                    <div class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-6 space-y-6">
                        @foreach ($galleries as $gallery)
                            @php
                                $imgSrc = $gallery['url'];
                            @endphp
                            
                            <div class="break-inside-avoid" data-aos="fade-up">
                                <a href="{{ $imgSrc }}" 
                                   data-fancybox="gallery" 
                                   data-caption="{{ $gallery['alt_text'] }}" 
                                   class="group relative block overflow-hidden rounded-3xl bg-[#1c1c3a] border border-white/5 shadow-xl cursor-pointer transform transition-transform duration-300 hover:-translate-y-1">
                                    
                                    <img src="{{ $imgSrc }}" 
                                         alt="{{ $gallery['alt_text'] }}" 
                                         class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105"
                                         loading="lazy">
                                    
                                    {{-- Hover Overlay --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d1f]/95 via-[#0d0d1f]/40 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6">
                                        {{-- Icon Zoom --}}
                                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-yellow-500 text-[#0d0d1f] flex items-center justify-center transform scale-0 group-hover:scale-100 transition-transform duration-500 delay-75 shadow-2xl">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                            </svg>
                                        </div>
                                        
                                        {{-- Caption --}}
                                        <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100">
                                            <p class="text-white font-bold text-base drop-shadow-md">
                                                {{ $gallery['alt_text'] }}
                                            </p>
                                            <div class="flex items-center gap-2 mt-2 text-yellow-400 text-xs font-extrabold uppercase tracking-wider">
                                                <span>{{ __('messages.view_photo') }}</span>
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-[#1c1c3a] rounded-3xl p-16 text-center border border-white/5" data-aos="fade-up">
                        <div class="w-16 h-16 rounded-full bg-white/5 border border-white/10 flex items-center justify-center mx-auto mb-4">
                            <i class="far fa-images text-slate-500 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">
                            {{ app()->getLocale() === 'en' ? 'Album is Empty' : 'Album Kosong' }}
                        </h3>
                        <p class="text-slate-400 max-w-sm mx-auto text-sm">
                            {{ app()->getLocale() === 'en' ? 'No photos uploaded to this folder yet.' : 'Belum ada foto yang diunggah ke dalam folder ini.' }}
                        </p>
                    </div>
                @endif

            @else
                {{-- 2. VIEW FOLDER ALBUMS LIST --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($albums as $album)
                        @php
                            $photoCount = $album->slug === 'arsip-dokumentasi-umum' ? ($album->galleries_count + 30) : $album->galleries_count;
                        @endphp
                        
                        <div class="group relative bg-[#1c1c3a] border border-white/5 rounded-3xl overflow-hidden shadow-2xl hover:border-yellow-500/30 hover:shadow-[0_20px_50px_rgba(234,179,8,0.08)] transition-all duration-500"
                             data-aos="fade-up">
                            
                            {{-- Folder Cover Image --}}
                            <div class="relative h-56 overflow-hidden">
                                @if($album->cover_image)
                                    <img src="{{ get_image_url($album->cover_image) }}" 
                                         alt="{{ $album->name }}"
                                         class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-105" />
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-[#181836] to-[#13132e] flex items-center justify-center">
                                        <i class="fas fa-folder text-slate-600 text-5xl"></i>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-[#1c1c3a] via-[#1c1c3a]/40 to-transparent"></div>

                                {{-- Photo Count Badge --}}
                                <div class="absolute top-4 right-4 px-3.5 py-1.5 bg-black/45 backdrop-blur-md border border-white/10 rounded-xl text-xs font-bold tracking-wider">
                                    <i class="far fa-image text-yellow-500 mr-1.5"></i>
                                    {{ $photoCount }} {{ app()->getLocale() === 'en' ? 'Photos' : 'Foto' }}
                                </div>
                            </div>

                            {{-- Folder Content info --}}
                            <div class="p-6 md:p-8 flex flex-col min-h-[220px]">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center shrink-0">
                                        <i class="fas fa-folder text-yellow-500"></i>
                                    </div>
                                    <h3 class="text-xl font-extrabold text-white group-hover:text-yellow-400 transition-colors duration-300">
                                        {{ $album->name }}
                                    </h3>
                                </div>

                                <p class="text-slate-400 text-sm leading-relaxed mb-6 flex-grow">
                                    {{ $album->getLocalizedDescription() ?? ($album->description ?? 'Dokumentasi resmi untuk kategori ini.') }}
                                </p>

                                <div class="border-t border-white/5 pt-5 mt-auto">
                                    <a href="{{ route('front.gallery') }}?album={{ $album->slug }}"
                                       class="w-full inline-flex items-center justify-center gap-2 px-5 py-3.5 bg-white/5 border border-white/5 rounded-2xl text-sm font-extrabold text-yellow-500 hover:bg-yellow-500 hover:text-[#0d0d1f] hover:border-yellow-500 transition-all duration-300">
                                        {{ app()->getLocale() === 'en' ? 'Open Album' : 'Buka Album Foto' }}
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>

        <x-footer />
    </div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/filament/style.css') }}">
    <style>
        /* Custom styles for masonry layout */
        .columns-1 { column-count: 1; }
        @media (min-width: 640px) { .sm\:columns-2 { column-count: 2; } }
        @media (min-width: 1024px) { .lg\:columns-3 { column-count: 3; } }
        @media (min-width: 1280px) { .xl\:columns-4 { column-count: 4; } }
        .break-inside-avoid { break-inside: avoid; page-break-inside: avoid; }
    </style>
@endpush

@push('after-scripts')
    <script>
        $(document).ready(function () {
            // Fancybox Configuration
            $('[data-fancybox="gallery"]').fancybox({
                buttons: [
                    "zoom",
                    "slideShow",
                    "fullScreen",
                    "download",
                    "thumbs",
                    "close"
                ],
                loop: true,
                animationEffect: "zoom-in-out",
                transitionEffect: "fade",
                hash: false,
                backFocus: false,
                trapFocus: false,
                autoFocus: false,
                wheel: false,
                clickOutside: "close",
                mobile: {
                    clickContent: "close",
                    clickSlide: "close"
                }
            });
        });
    </script>
@endpush
