@extends('front.master')

@section('title', __('messages.page_title_achievements'))
@section('description', __('messages.page_desc_achievements'))
@section('keywords', 'prestasi PORSEROSI, atlet sepatu roda, skateboard, scooter, SEA Games, Asian Games, kejuaraan dunia')

@section('content')
<div class="font-[Poppins] text-slate-200 flex flex-col flex-grow min-h-screen">
    <x-navbar />

    {{-- Hero Section --}}
    <section class="relative bg-[#0d0d25] overflow-hidden py-20 md:py-28">
        {{-- Background decoratif --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-yellow-500/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-yellow-500/5 rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block px-5 py-2 bg-yellow-500/10 border border-yellow-500/20 rounded-full text-yellow-400 text-xs font-bold uppercase tracking-widest mb-6">
                {{ __('messages.track_record') }}
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-100 uppercase tracking-tight mb-5">
                {{ __('messages.achievements_title') }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">PB PORSEROSI</span>
            </h1>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto">
                {{ __('messages.achievements_subtitle') }}
            </p>

            {{-- Stats Bar --}}
            <div class="flex flex-wrap justify-center gap-6 md:gap-12 mt-10">
                @php
                    $totalWinner   = 0; $totalRunnerUp = 0; $totalBronze = 0; $totalTournament = 0;
                    $allTournaments = [];
                    foreach ($achievements as $year => $items) {
                        foreach ($items as $item) {
                            $t = strtolower($item->achievement_type);
                            if (in_array($t, ['winner','juara 1','gold'])) $totalWinner++;
                            elseif (in_array($t, ['runner-up','juara 2','silver'])) $totalRunnerUp++;
                            elseif (in_array($t, ['bronze','juara 3'])) $totalBronze++;
                            $allTournaments[] = $item->tournament_name;
                        }
                    }
                    $totalTournament = count(array_unique($allTournaments));
                @endphp
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-extrabold text-yellow-400">🥇 {{ $totalWinner }}</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider mt-1">{{ __('messages.winner') }}</div>
                </div>
                <div class="w-px bg-white/10 hidden md:block"></div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-extrabold text-slate-300">🥈 {{ $totalRunnerUp }}</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider mt-1">{{ __('messages.runner_up') }}</div>
                </div>
                <div class="w-px bg-white/10 hidden md:block"></div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-extrabold text-orange-400">🥉 {{ $totalBronze }}</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider mt-1">{{ __('messages.bronze') }}</div>
                </div>
                <div class="w-px bg-white/10 hidden md:block"></div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-extrabold text-blue-400">{{ $totalTournament }}</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider mt-1">{{ __('messages.tournament') }}</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Content: Accordion per Tahun --}}
    <section class="py-16 bg-[#181836]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($achievements->isEmpty())
                <div class="text-center py-20">
                    <i class="fas fa-trophy text-6xl text-slate-600 mb-4"></i>
                    <p class="text-slate-500">{{ __('messages.no_achievements') }}</p>
                </div>
            @else

            {{-- Accordion per Tahun --}}
            <div class="space-y-4" id="achievements-accordion">
                @foreach ($achievements as $year => $items)
                    @php
                        $isFirst = $loop->first;
                        $accordionId = 'accordion-' . $year;
                        // Group items by tournament name
                        $byTournament = $items->groupBy('tournament_name');
                        // Count medals for this year
                        $yWinner = 0; $yRunner = 0; $yBronze = 0;
                        foreach ($items as $item) {
                            $t = strtolower($item->achievement_type);
                            if (in_array($t, ['winner','juara 1','gold'])) $yWinner++;
                            elseif (in_array($t, ['runner-up','juara 2','silver'])) $yRunner++;
                            elseif (in_array($t, ['bronze','juara 3'])) $yBronze++;
                        }
                    @endphp

                    <div class="accordion-item rounded-2xl overflow-hidden border border-white/10 shadow-lg"
                         x-data="{ open: {{ $isFirst ? 'true' : 'false' }} }">

                        {{-- Accordion Header --}}
                        <button
                            @click="open = !open"
                            class="w-full flex items-center justify-between px-6 py-5 bg-[#1f1f42] hover:bg-[#252550] transition-colors duration-300 group"
                            :aria-expanded="open"
                        >
                            <div class="flex items-center gap-4">
                                {{-- Tahun Badge --}}
                                <span class="text-2xl md:text-3xl font-extrabold text-yellow-400 group-hover:text-yellow-300 transition-colors">
                                    {{ $year }}
                                </span>
                                {{-- Medal summary --}}
                                <div class="flex items-center gap-2 flex-wrap">
                                    @if ($yWinner > 0)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-yellow-500/15 border border-yellow-500/30 text-yellow-400 text-xs font-bold">
                                            🥇 {{ $yWinner }}
                                        </span>
                                    @endif
                                    @if ($yRunner > 0)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-slate-500/20 border border-slate-500/30 text-slate-300 text-xs font-bold">
                                            🥈 {{ $yRunner }}
                                        </span>
                                    @endif
                                     @if ($yBronze > 0)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-orange-500/15 border border-orange-500/30 text-orange-400 text-xs font-bold">
                                            🥉 {{ $yBronze }}
                                        </span>
                                    @endif
                                    <span class="text-slate-500 text-xs hidden sm:inline">{{ $items->count() }} {{ __('messages.achievements_count') }}</span>
                                </div>
                            </div>

                            {{-- Icon +/- --}}
                            <div class="flex-shrink-0 w-9 h-9 rounded-full border border-white/10 bg-white/5 flex items-center justify-center text-yellow-400 group-hover:border-yellow-500/40 transition-all duration-300">
                                <svg class="w-5 h-5 transition-transform duration-300" :class="open ? 'rotate-45' : 'rotate-0'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                        </button>

                        {{-- Accordion Body --}}
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-2"
                             class="bg-[#181836] border-t border-white/5"
                        >
                            <div class="p-6 space-y-6">
                                @foreach ($byTournament as $tournamentName => $tournamentItems)
                                    @php
                                        $firstItem = $tournamentItems->first();
                                        $levelColors = [
                                            'Internasional' => 'text-yellow-400 border-yellow-500/30 bg-yellow-500/10',
                                            'Regional'      => 'text-blue-400 border-blue-500/30 bg-blue-500/10',
                                            'Nasional'      => 'text-emerald-400 border-emerald-500/30 bg-emerald-500/10',
                                        ];
                                        $levelColor = $levelColors[$firstItem->tournament_level] ?? 'text-slate-400 border-slate-500/30 bg-slate-500/10';
                                    @endphp

                                    <div class="rounded-xl border border-white/5 overflow-hidden">
                                        {{-- Tournament Header --}}
                                        <div class="flex items-center justify-between px-5 py-3 bg-white/3 border-b border-white/5">
                                            <h3 class="text-sm md:text-base font-bold text-slate-200">
                                                {{ $tournamentItems->first()->getLocalizedTournament() }}
                                            </h3>
                                            <span class="shrink-0 ml-3 inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $levelColor }}">
                                                {{ $firstItem->getLocalizedLevel() }}
                                            </span>
                                        </div>

                                        {{-- Achievement Rows --}}
                                        <div class="divide-y divide-white/5">
                                            @foreach ($tournamentItems as $achievement)
                                                @php
                                                    $achType = strtolower($achievement->achievement_type);
                                                    $isWinner   = in_array($achType, ['winner','juara 1','gold']);
                                                    $isRunner   = in_array($achType, ['runner-up','juara 2','silver']);
                                                    $isBronze   = in_array($achType, ['bronze','juara 3']);
                                                    $medal      = $isWinner ? '🥇' : ($isRunner ? '🥈' : ($isBronze ? '🥉' : '🏆'));
                                                    $typeClass  = $isWinner
                                                        ? 'bg-yellow-500/15 text-yellow-300 border-yellow-500/30'
                                                        : ($isRunner
                                                            ? 'bg-slate-500/20 text-slate-300 border-slate-500/30'
                                                            : ($isBronze
                                                                ? 'bg-orange-500/15 text-orange-300 border-orange-500/30'
                                                                : 'bg-blue-500/15 text-blue-300 border-blue-500/30'));

                                                    $caborColors = [
                                                        'Inline Freestyle' => 'text-blue-400',
                                                        'Inline Hockey'    => 'text-indigo-400',
                                                        'Roller Freestyle' => 'text-purple-400',
                                                        'Scooter'          => 'text-emerald-400',
                                                        'Skateboard'       => 'text-yellow-400',
                                                        'Speed'            => 'text-orange-400',
                                                        'Artistic'         => 'text-pink-400',
                                                    ];
                                                    $caborColor = $caborColors[$achievement->cabang_olahraga] ?? 'text-slate-400';
                                                @endphp
                                                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 px-5 py-3 hover:bg-white/3 transition-colors duration-200">
                                                    {{-- Medal & Achievement Type --}}
                                                    <span class="shrink-0 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold border {{ $typeClass }}">
                                                        {{ $medal }} {{ $achievement->getLocalizedType() }}
                                                    </span>
                                                    {{-- Discipline --}}
                                                    <div class="flex-1 min-w-0">
                                                        <span class="text-sm text-slate-300">{{ $achievement->getLocalizedDiscipline() }}</span>
                                                        <span class="mx-2 text-white/10">·</span>
                                                        <span class="text-xs {{ $caborColor }} font-semibold">{{ $achievement->cabang_olahraga }}</span>
                                                    </div>
                                                    {{-- Athlete Names --}}
                                                    <div class="text-sm text-slate-400 sm:text-right sm:max-w-xs truncate" title="{{ $achievement->athlete_names }}">
                                                        <i class="fas fa-user-circle text-xs text-slate-600 mr-1"></i>
                                                        {{ $achievement->athlete_names }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif

        </div>
    </section>

    <x-footer />
</div>
@endsection

@push('after-styles')
<style>
    .bg-white\/3 { background-color: rgba(255,255,255,0.03); }
    [x-cloak] { display: none !important; }
</style>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@section('breadcrumb_schema')
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "{{ __('messages.home') }}",
        "item": "{{ url('/') }}"
      },{
        "@type": "ListItem",
        "position": 2,
        "name": "{{ __('messages.achievements') }}"
      }]
    }
    </script>
@endsection
