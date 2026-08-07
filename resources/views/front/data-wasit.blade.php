@extends('front.master')

@section('title', (app()->getLocale() === 'en' ? 'Referee Directory' : 'Direktori Wasit') . ' | PB PORSEROSI')

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
                    {{ app()->getLocale() === 'en' ? 'Official Referees' : 'Wasit Resmi' }}
                </h1>
                <p class="text-slate-400 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                    {{ app()->getLocale() === 'en' 
                        ? 'Directory of certified national and international referees registered under PB PORSEROSI.' 
                        : 'Direktori wasit bersertifikat daerah, nasional, dan internasional yang terdaftar resmi di bawah PB PORSEROSI.' 
                    }}
                </p>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="relative pb-24 z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                @if($wasits->isEmpty())
                    <div class="text-center py-20 bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl p-8 max-w-lg mx-auto" data-aos="fade-up">
                        <svg class="w-16 h-16 text-yellow-500/40 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-slate-400 text-sm">
                            {{ app()->getLocale() === 'en' ? 'No referee data available.' : 'Data wasit belum tersedia.' }}
                        </p>
                    </div>
                @else
                    {{-- Search Input --}}
                    <div class="mb-6 max-w-md mx-auto" data-aos="fade-up">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </span>
                            <input type="text" id="search-wasit" oninput="searchWasit()" placeholder="{{ app()->getLocale() === 'en' ? 'Search by name, province, city...' : 'Cari berdasarkan nama, provinsi, kota...' }}" class="w-full pl-11 pr-4 py-3 bg-[#181836]/60 border border-white/5 focus:border-yellow-500/50 rounded-2xl text-slate-100 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500/20 backdrop-blur-md shadow-xl transition-all duration-300">
                        </div>
                    </div>

                    {{-- Data Table --}}
                    <div class="bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl overflow-hidden shadow-2xl" data-aos="fade-up" data-aos-delay="100">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-white/5 bg-white/5">
                                        <th class="p-5 text-xs font-bold uppercase tracking-wider text-slate-400 w-16">Foto</th>
                                        <th class="p-5 text-xs font-bold uppercase tracking-wider text-slate-400">Nama Lengkap</th>
                                        <th class="p-5 text-xs font-bold uppercase tracking-wider text-slate-400">Level (Lisensi)</th>
                                        <th class="p-5 text-xs font-bold uppercase tracking-wider text-slate-400">Kota / Kab</th>
                                        <th class="p-5 text-xs font-bold uppercase tracking-wider text-slate-400">Provinsi</th>
                                        <th class="p-5 text-xs font-bold uppercase tracking-wider text-slate-400 text-center">Disiplin</th>
                                    </tr>
                                </thead>
                                <tbody id="wasit-table-body" class="divide-y divide-white/5">
                                    @foreach($wasits as $wasit)
                                        <tr class="wasit-row hover:bg-white/5 transition-colors duration-200" 
                                            data-searchable="{{ strtolower($wasit->nama_lengkap) }} {{ strtolower($wasit->kabupaten_kota) }} {{ strtolower($wasit->provinsi) }} {{ strtolower($wasit->disiplin) }} {{ strtolower($wasit->lisensi) }}">
                                            
                                            {{-- Foto --}}
                                            <td class="p-5">
                                                <div class="w-10 h-10 rounded-full overflow-hidden border border-white/10 shrink-0">
                                                    @if($wasit->foto_path && $wasit->foto_path !== 'test-dummy.png')
                                                        <img src="{{ Storage::url($wasit->foto_path) }}" alt="{{ $wasit->nama_lengkap }}" class="w-full h-full object-cover">
                                                    @else
                                                        {{-- Fallback dynamic SVG avatar --}}
                                                        <div class="w-full h-full bg-yellow-500/10 flex items-center justify-center text-yellow-500 font-extrabold text-sm uppercase">
                                                            {{ substr($wasit->nama_lengkap, 0, 2) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>

                                            {{-- Nama Lengkap --}}
                                            <td class="p-5 font-bold text-white text-sm">
                                                {{ $wasit->nama_lengkap }}
                                            </td>

                                            {{-- Lisensi --}}
                                            <td class="p-5 text-sm">
                                                @php
                                                    $lisensiColors = [
                                                        'Daerah' => 'bg-slate-500/10 border-slate-500/20 text-slate-300',
                                                        'Nasional' => 'bg-blue-500/10 border-blue-500/20 text-blue-400',
                                                        'Internasional' => 'bg-yellow-500/10 border-yellow-500/20 text-yellow-500',
                                                        'Belum Ada' => 'bg-red-500/10 border-red-500/20 text-red-400',
                                                    ];
                                                    $colorClass = $lisensiColors[$wasit->lisensi] ?? 'bg-slate-500/10 border-slate-500/20 text-slate-300';
                                                @endphp
                                                <span class="inline-flex py-1 px-3 rounded-full border text-xs font-extrabold uppercase {{ $colorClass }}">
                                                    {{ $wasit->lisensi }}
                                                </span>
                                            </td>

                                            {{-- Kota / Kab --}}
                                            <td class="p-5 text-slate-300 text-sm">
                                                {{ $wasit->kabupaten_kota }}
                                            </td>

                                            {{-- Provinsi --}}
                                            <td class="p-5 text-slate-300 text-sm">
                                                {{ $wasit->provinsi }}
                                            </td>

                                            {{-- Disiplin --}}
                                            <td class="p-5 text-center">
                                                @if($wasit->disiplin)
                                                    @php
                                                        $discList = array_map('trim', explode(',', $wasit->disiplin));
                                                    @endphp
                                                    <div class="flex flex-wrap justify-center gap-1">
                                                        @foreach($discList as $d)
                                                            <span class="px-2 py-0.5 rounded-md bg-pink-500/10 border border-pink-500/20 text-pink-500 text-[10px] font-extrabold uppercase tracking-wide">
                                                                {{ $d }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-slate-600 text-xs italic">-</span>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- No Search Results Alert --}}
                    <div id="no-search-results" class="hidden text-center py-20 bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl p-8 max-w-lg mx-auto mt-6" data-aos="fade-up">
                        <svg class="w-16 h-16 text-yellow-500/40 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-slate-400 text-sm">
                            {{ app()->getLocale() === 'en' ? 'No referees match your search.' : 'Tidak ada wasit yang cocok dengan pencarian Anda.' }}
                        </p>
                    </div>
                @endif

            </div>
        </div>

        <x-footer />
    </div>

    {{-- JS Search --}}
    <script>
        function searchWasit() {
            const query = document.getElementById('search-wasit').value.toLowerCase().trim();
            const rows = document.querySelectorAll('.wasit-row');
            const noResultsAlert = document.getElementById('no-search-results');
            
            let visibleCount = 0;

            rows.forEach(row => {
                const searchable = row.getAttribute('data-searchable');
                if (searchable.includes(query)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
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
