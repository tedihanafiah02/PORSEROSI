@extends('front.master')

@section('title', (app()->getLocale() === 'en' ? 'Club Directory' : 'Direktori Klub') . ' | PB PORSEROSI')

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
                    {{ app()->getLocale() === 'en' ? 'Official Clubs' : 'Klub Resmi' }}
                </h1>
                <p class="text-slate-400 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                    {{ app()->getLocale() === 'en' 
                        ? 'Directory of official roller skating, skateboard, and scooter clubs registered under PB PORSEROSI.' 
                        : 'Direktori klub sepatu roda, papan luncur (skateboard), dan skuter resmi yang terdaftar di bawah naungan PB PORSEROSI.' 
                    }}
                </p>
            </div>
        </div>

        {{-- Filter & Content Section --}}
        <div class="relative pb-24 z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                @if($clubs->isEmpty())
                    <div class="text-center py-20 bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl p-8 max-w-lg mx-auto" data-aos="fade-up">
                        <svg class="w-16 h-16 text-yellow-500/40 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-slate-400 text-sm">
                            {{ app()->getLocale() === 'en' ? 'No club data available.' : 'Data klub belum tersedia.' }}
                        </p>
                    </div>
                @else
                    {{-- Filters Row --}}
                    <div class="bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl p-5 md:p-6 mb-10 max-w-3xl mx-auto shadow-2xl" data-aos="fade-up">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label for="filter-province" class="block text-xs font-bold text-slate-400 mb-2 uppercase tracking-wider">
                                    {{ app()->getLocale() === 'en' ? 'Filter by Province' : 'Filter Provinsi' }}
                                </label>
                                <select id="filter-province" onchange="filterClubs()" class="w-full bg-[#0d0d1f] border border-white/10 rounded-xl px-3 py-2.5 text-slate-300 text-sm focus:outline-none focus:border-yellow-500 transition-colors">
                                    <option value="">{{ app()->getLocale() === 'en' ? 'All Provinces' : 'Semua Provinsi' }}</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ strtolower($province) }}">{{ $province }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label for="filter-discipline" class="block text-xs font-bold text-slate-400 mb-2 uppercase tracking-wider">
                                    {{ app()->getLocale() === 'en' ? 'Filter by Discipline' : 'Filter Disiplin' }}
                                </label>
                                <select id="filter-discipline" onchange="filterClubs()" class="w-full bg-[#0d0d1f] border border-white/10 rounded-xl px-3 py-2.5 text-slate-300 text-sm focus:outline-none focus:border-yellow-500 transition-colors">
                                    <option value="">{{ app()->getLocale() === 'en' ? 'All Disciplines' : 'Semua Disiplin' }}</option>
                                    @foreach($allDisciplines as $discipline)
                                        <option value="{{ strtolower($discipline) }}">{{ $discipline }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="search-club" class="block text-xs font-bold text-slate-400 mb-2 uppercase tracking-wider">
                                    {{ app()->getLocale() === 'en' ? 'Search Club Name' : 'Cari Nama Klub' }}
                                </label>
                                <div class="relative">
                                    <input type="text" id="search-club" oninput="filterClubs()" placeholder="{{ app()->getLocale() === 'en' ? 'Type name...' : 'Ketik nama...' }}" class="w-full bg-[#0d0d1f] border border-white/10 rounded-xl pl-3 pr-8 py-2.5 text-slate-300 text-sm focus:outline-none focus:border-yellow-500 transition-colors">
                                    <span class="absolute inset-y-0 right-3 flex items-center text-slate-500 pointer-events-none">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Clubs Grid --}}
                    <div id="clubs-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($clubs as $club)
                            <div class="club-card bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl p-6 shadow-xl hover:shadow-2xl hover:border-white/10 transition-all duration-300 flex flex-col justify-between" 
                                 data-aos="fade-up" 
                                 data-aos-delay="{{ $loop->index * 50 }}"
                                 data-name="{{ strtolower($club->name) }}"
                                 data-province="{{ strtolower($club->province) }}"
                                 data-discipline="{{ strtolower($club->discipline) }}">
                                
                                <div class="mb-4">
                                    <div class="w-12 h-12 rounded-2xl bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 flex items-center justify-center mb-4">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-extrabold text-white mb-2 leading-snug">
                                        {{ $club->name }}
                                    </h3>
                                    
                                    <div class="flex flex-col gap-1 text-slate-400 text-xs font-semibold mb-4">
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-slate-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            </svg>
                                            <span>{{ $club->city }}, {{ $club->province }}</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Disciplines Badges --}}
                                <div class="pt-4 border-t border-white/5 flex flex-wrap gap-1.5">
                                    @php
                                        $disciplinesList = array_map('trim', explode(',', $club->discipline));
                                    @endphp
                                    @foreach($disciplinesList as $disc)
                                        <span class="px-2.5 py-1 rounded-full bg-pink-500/10 border border-pink-500/20 text-pink-500 text-[10px] font-extrabold tracking-wider uppercase">
                                            {{ $disc }}
                                        </span>
                                    @endforeach
                                </div>

                            </div>
                        @endforeach
                    </div>

                    {{-- No Search Results Alert --}}
                    <div id="no-search-results" class="hidden text-center py-20 bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl p-8 max-w-lg mx-auto" data-aos="fade-up">
                        <svg class="w-16 h-16 text-yellow-500/40 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-slate-400 text-sm">
                            {{ app()->getLocale() === 'en' ? 'No clubs match your filters.' : 'Tidak ada klub yang cocok dengan filter pencarian.' }}
                        </p>
                    </div>
                @endif

            </div>
        </div>

        <x-footer />
    </div>

    {{-- JS Filtering --}}
    <script>
        function filterClubs() {
            const provinceQuery = document.getElementById('filter-province').value.toLowerCase();
            const disciplineQuery = document.getElementById('filter-discipline').value.toLowerCase();
            const searchQuery = document.getElementById('search-club').value.toLowerCase().trim();
            const cards = document.querySelectorAll('.club-card');
            const noResultsAlert = document.getElementById('no-search-results');
            
            let visibleCount = 0;

            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                const province = card.getAttribute('data-province');
                const discipline = card.getAttribute('data-discipline');

                const matchesProvince = provinceQuery === '' || province === provinceQuery;
                const matchesDiscipline = disciplineQuery === '' || discipline.includes(disciplineQuery);
                const matchesSearch = searchQuery === '' || name.includes(searchQuery);

                if (matchesProvince && matchesDiscipline && matchesSearch) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (visibleCount === 0) {
                noResultsAlert.classList.remove('hidden');
            } else {
                noResultsAlert.classList.add('hidden');
            }
        }
    </script>
@endsection
