@extends('front.master')

@section('title', (app()->getLocale() === 'en' ? 'Organizational Structure' : 'Struktur Organisasi') . ' | PB PORSEROSI')

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
                    {{ app()->getLocale() === 'en' ? 'Organizational Structure' : 'Struktur Organisasi' }}
                </h1>
                <p class="text-slate-400 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                    {{ app()->getLocale() === 'en' 
                        ? 'The following is the line-up of the Executive Board of the Indonesian Roller Skating Sports Association (PB PORSEROSI) for the current active period.' 
                        : 'Berikut adalah susunan kepengurusan Pengurus Besar Persatuan Olahraga Sepatu Roda Seluruh Indonesia (PB PORSEROSI) periode aktif saat ini.' 
                    }}
                </p>
            </div>
        </div>

        {{-- Content Grid Section --}}
        <div class="relative pb-24 z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if($officers->isEmpty())
                    <div class="text-center py-20 bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl p-8 max-w-lg mx-auto" data-aos="fade-up">
                        <svg class="w-16 h-16 text-yellow-500/40 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <p class="text-slate-400 text-sm">
                            {{ app()->getLocale() === 'en' 
                                ? 'No organizational structure data available yet.' 
                                : 'Data struktur organisasi belum tersedia saat ini.' 
                            }}
                        </p>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                        @foreach($officers as $officer)
                            <div class="group flex flex-col bg-gradient-to-b from-[#181836]/50 to-[#0e0e24]/90 backdrop-blur-md border border-white/[0.08] rounded-3xl overflow-hidden shadow-[0_15px_35px_rgba(0,0,0,0.3)] hover:-translate-y-2 hover:shadow-[0_20px_45px_rgba(234,179,8,0.12)] hover:border-yellow-500/30 transition-all duration-500" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                                
                                {{-- Profile Image --}}
                                <div class="relative aspect-[4/5] w-full overflow-hidden bg-[#0a0a16]">
                                    @if($officer->photo_path)
                                        <img src="{{ Storage::url($officer->photo_path) }}" alt="{{ $officer->name }}" class="w-full h-full object-cover transition-transform duration-[1.2s] cubic-bezier(0.16, 1, 0.3, 1) group-hover:scale-105">
                                        {{-- Soft gradient overlay --}}
                                        <div class="absolute inset-0 bg-gradient-to-t from-[#0e0e24]/90 via-transparent to-transparent opacity-80 group-hover:opacity-60 transition-opacity duration-500"></div>
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-[#1c1c3c] to-[#0c0c1e] text-slate-600 relative">
                                            <div class="w-20 h-20 rounded-full bg-white/5 border border-white/10 flex items-center justify-center mb-3 group-hover:border-yellow-500/30 group-hover:bg-yellow-500/5 transition-all duration-500">
                                                <i class="fas fa-user-circle text-4xl text-slate-400/30 group-hover:text-yellow-500/40 transition-colors duration-500"></i>
                                            </div>
                                            <span class="text-[9px] font-extrabold text-yellow-500/50 uppercase tracking-widest bg-yellow-500/10 px-3 py-1 rounded-full border border-yellow-500/20">
                                                PB PORSEROSI
                                            </span>
                                        </div>
                                    @endif
                                    
                                    {{-- Accent Top Border Line --}}
                                    <div class="absolute bottom-0 left-0 w-full h-[3px] bg-gradient-to-r from-transparent via-yellow-500/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                </div>

                                {{-- Details --}}
                                <div class="p-6 flex flex-col justify-between flex-grow text-center relative bg-gradient-to-b from-[#181836]/10 to-[#0e0e24]/40">
                                    <div class="flex flex-col items-center justify-center flex-grow">
                                        <h3 class="text-base md:text-lg font-black text-white leading-tight mb-2 tracking-tight group-hover:text-yellow-400 transition-colors duration-300 line-clamp-2">
                                            {{ $officer->name }}
                                        </h3>
                                        
                                        {{-- Elegant custom divider --}}
                                        <div class="h-[2px] w-8 bg-yellow-500/50 my-1 group-hover:w-16 transition-all duration-500 rounded-full"></div>
                                        
                                        <p class="text-[11px] md:text-xs font-bold text-slate-400 uppercase tracking-widest mt-2 group-hover:text-slate-300 transition-colors duration-300">
                                            {{ $officer->getLocalizedPosition() }}
                                        </p>
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
@endsection
