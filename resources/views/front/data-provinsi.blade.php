@extends('front.master')

@section('title', (app()->getLocale() === 'en' ? 'Provincial Board Data' : 'Data Pengurus Provinsi') . ' | PB PORSEROSI')

@section('content')
    <div class="font-[Poppins] text-slate-200 flex flex-col flex-grow min-h-screen bg-[#0d0d1f]">
        <x-navbar />

        {{-- Header Section --}}
        <div class="relative pt-32 pb-12 md:pt-40 md:pb-16 text-center overflow-hidden">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-yellow-500/10 blur-[120px] rounded-full pointer-events-none"></div>
            
            <div class="relative z-10 px-4 max-w-4xl mx-auto">
                <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 text-xs font-extrabold tracking-widest mb-4 uppercase">
                    PB PORSEROSI
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 uppercase tracking-tight">
                    {{ app()->getLocale() === 'en' ? 'Provincial Boards' : 'Pengurus Provinsi' }}
                </h1>
                <p class="text-slate-400 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                    {{ app()->getLocale() === 'en' 
                        ? 'Directory of Provincial Boards (Pengprov) and active management terms across Indonesia.' 
                        : 'Direktori Pengurus Provinsi (Pengprov) PB PORSEROSI beserta masa jabatan dan kota/kabupaten di seluruh Indonesia.' 
                    }}
                </p>
            </div>
        </div>

        {{-- Content Section --}}
        <div class="relative pb-24 z-10">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                
                @if($provinsis->isEmpty())
                    <div class="text-center py-20 bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl p-8 max-w-lg mx-auto" data-aos="fade-up">
                        <svg class="w-16 h-16 text-yellow-500/40 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-slate-400 text-sm">
                            {{ app()->getLocale() === 'en' ? 'No Provincial Board data available.' : 'Data Pengurus Provinsi belum tersedia.' }}
                        </p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($provinsis as $provinsi)
                            <div class="bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-2xl overflow-hidden shadow-lg transition-all duration-300 hover:border-white/10" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                                
                                {{-- Accordion Trigger --}}
                                <button onclick="toggleAccordion({{ $provinsi->id }})" class="w-full flex items-center justify-between p-5 text-left focus:outline-none group">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 group-hover:bg-yellow-500 group-hover:text-[#0d0d1f] transition-all duration-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-extrabold text-white group-hover:text-yellow-400 transition-colors duration-300">
                                                {{ $provinsi->name }}
                                            </h3>
                                            <span class="text-xs text-slate-400 font-semibold">
                                                {{ count($provinsi->cities) }} {{ app()->getLocale() === 'en' ? 'Regencies/Cities' : 'Kabupaten/Kota' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-slate-400 group-hover:text-white transition-colors">
                                        <svg id="chevron-{{ $provinsi->id }}" class="w-6 h-6 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </button>

                                {{-- Accordion Content --}}
                                <div id="content-{{ $provinsi->id }}" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-[#0f0f29]/30">
                                    <div class="p-6 pt-2 border-t border-white/5">
                                        
                                        {{-- Management info grid --}}
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                            <div class="bg-white/5 border border-white/5 rounded-xl p-4">
                                                <span class="text-[10px] text-yellow-500 font-bold uppercase tracking-wider block mb-1">Ketua Pengprov</span>
                                                <span class="text-base font-extrabold text-white">{{ $provinsi->leader }}</span>
                                            </div>
                                            <div class="bg-white/5 border border-white/5 rounded-xl p-4">
                                                <span class="text-[10px] text-yellow-500 font-bold uppercase tracking-wider block mb-1">Masa Jabatan</span>
                                                <span class="text-base font-extrabold text-white">{{ $provinsi->period }}</span>
                                            </div>
                                        </div>

                                        {{-- Cities listdown --}}
                                        <div>
                                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-3 pl-1">
                                                {{ app()->getLocale() === 'en' ? 'Registered Regencies / Cities' : 'Kabupaten & Kota Terdaftar' }}
                                            </span>
                                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                                @foreach($provinsi->cities as $city)
                                                    <div class="flex items-center gap-2 px-3 py-2.5 bg-[#0d0d1f]/40 border border-white/5 rounded-xl text-slate-300 text-xs font-semibold hover:border-yellow-500/25 transition-all">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 shrink-0"></span>
                                                        <span>{{ $city }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>

        <x-footer />
    </div>

    {{-- JS Toggle --}}
    <script>
        function toggleAccordion(id) {
            const content = document.getElementById('content-' + id);
            const chevron = document.getElementById('chevron-' + id);
            
            if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                content.style.maxHeight = '0px';
                chevron.classList.remove('rotate-180');
            } else {
                // Close others
                document.querySelectorAll('[id^="content-"]').forEach(el => {
                    if (el.id !== 'content-' + id) {
                        el.style.maxHeight = '0px';
                    }
                });
                document.querySelectorAll('[id^="chevron-"]').forEach(el => {
                    if (el.id !== 'chevron-' + id) {
                        el.classList.remove('rotate-180');
                    }
                });

                // Open selected
                content.style.maxHeight = content.scrollHeight + 'px';
                chevron.classList.add('rotate-180');
            }
        }
    </script>
@endsection
