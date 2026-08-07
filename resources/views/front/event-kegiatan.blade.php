@extends('front.master')

@section('title', (app()->getLocale() === 'en' ? 'Non-Competition Events' : 'Event Kegiatan Non-Kompetisi') . ' | PB PORSEROSI')

@section('content')
    <div class="font-[Poppins] text-slate-200 flex flex-col flex-grow min-h-screen bg-[#0d0d1f]">
        <x-navbar />

        <div class="relative pt-32 pb-20 md:pt-40 md:pb-32 text-center overflow-hidden flex-grow flex items-center justify-center">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-yellow-500/10 blur-[120px] rounded-full pointer-events-none"></div>
            
            <div class="relative z-10 px-6 max-w-2xl mx-auto">
                <span class="inline-flex items-center gap-2 py-2 px-4 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 text-xs font-extrabold tracking-widest mb-6 uppercase">
                    PB PORSEROSI
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-6 uppercase tracking-tight">
                    {{ app()->getLocale() === 'en' ? 'Non-Competition Events' : 'Event Kegiatan Non-Kompetisi' }}
                </h1>
                <p class="text-slate-400 text-sm md:text-base leading-relaxed">
                    {{ app()->getLocale() === 'en' 
                        ? 'This page is being prepared to display non-competition activities such as Referee/Coach Training, National Work Meetings, Workshops, and Socializations.' 
                        : 'Halaman ini sedang dipersiapkan untuk menampilkan khusus event non-kompetisi seperti Pelatihan Wasit/Pelatih, Rapat Kerja Nasional, Workshop, dan Sosialisasi.' 
                    }}
                </p>
                <div class="mt-10 flex justify-center gap-4">
                    <a href="{{ route('front.event.daftar') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-yellow-500 text-[#0d0d1f] rounded-2xl text-sm font-extrabold hover:bg-yellow-400 transition-all duration-300">
                        <i class="fas fa-clipboard-list"></i> {{ app()->getLocale() === 'en' ? 'View Available Events' : 'Lihat Daftar Event' }}
                    </a>
                    <a href="{{ route('front.beranda') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white/5 border border-white/10 rounded-2xl text-sm font-extrabold text-slate-300 hover:bg-white/10 hover:text-white transition-all duration-300">
                        <i class="fas fa-home"></i> {{ app()->getLocale() === 'en' ? 'Home' : 'Beranda' }}
                    </a>
                </div>
            </div>
        </div>

        <x-footer />
    </div>
@endsection
