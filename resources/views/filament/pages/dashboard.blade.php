<x-filament::page>
    <style>
        /* Custom Dashboard Styles - Bypasses Filament's Tailwind Purging */
        .dash-container { max-width: 80rem; margin: 0 auto; display: flex; flex-direction: column; gap: 2rem; padding-bottom: 2.5rem; font-family: inherit; }
        
        /* Hero Section */
        .dash-hero { background: #030712; border-radius: 2.5rem; padding: 3rem; display: flex; justify-content: space-between; align-items: center; position: relative; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.1); }
        .dash-hero-blob1 { position: absolute; top: -10rem; left: -10rem; width: 30rem; height: 30rem; background: #4f46e5; border-radius: 50%; filter: blur(120px); opacity: 0.4; pointer-events: none; }
        .dash-hero-blob2 { position: absolute; top: 5rem; right: -5rem; width: 25rem; height: 25rem; background: #9333ea; border-radius: 50%; filter: blur(100px); opacity: 0.3; pointer-events: none; }
        .dash-hero-content { position: relative; z-index: 10; max-width: 45rem; }
        .dash-badge { display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.05); padding: 0.5rem 1rem; border-radius: 1rem; border: 1px solid rgba(255,255,255,0.1); font-size: 0.75rem; font-weight: 600; color: rgba(255,255,255,0.8); margin-bottom: 1.5rem; box-shadow: inset 0 2px 4px rgba(0,0,0,0.1); }
        .dash-dot { width: 0.5rem; height: 0.5rem; background: #34d399; border-radius: 50%; box-shadow: 0 0 10px #34d399; }
        .dash-title { font-size: 3rem; font-weight: 900; color: #fff; margin-bottom: 1rem; line-height: 1.2; letter-spacing: -0.02em; }
        .dash-desc { color: rgba(255,255,255,0.6); font-size: 1.125rem; line-height: 1.6; font-weight: 500; }
        .dash-btn { position: relative; z-index: 10; display: inline-flex; align-items: center; gap: 0.75rem; padding: 1rem 2rem; background: #fff; color: #030712; font-weight: 800; border-radius: 1rem; text-decoration: none; transition: all 0.3s ease; white-space: nowrap; }
        .dash-btn:hover { transform: translateY(-2px) scale(1.02); box-shadow: 0 10px 25px rgba(255,255,255,0.2); }
        .dash-btn svg { width: 1.25rem; height: 1.25rem; transition: transform 0.3s; }
        .dash-btn:hover svg { transform: translateX(4px); }

        /* Grid Layouts */
        .dash-grid-3 { display: grid; grid-template-columns: repeat(1, 1fr); gap: 1.5rem; }
        @media (min-width: 640px) { .dash-grid-3 { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 1024px) { .dash-grid-3 { grid-template-columns: repeat(3, 1fr); } }
        
        /* Stat Cards */
        .dash-card { background: #111827; border: 1px solid rgba(255,255,255,0.05); border-radius: 2rem; padding: 1.5rem; position: relative; overflow: hidden; transition: all 0.4s ease; text-decoration: none; display: block; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.3); }
        .dash-card:hover { transform: translateY(-5px); }
        .dash-card-blue:hover { border-color: rgba(59,130,246,0.3); }
        .dash-card-amber:hover { border-color: rgba(245,158,11,0.3); }
        .dash-card-emerald:hover { border-color: rgba(16,185,129,0.3); }
        .dash-card-purple:hover { border-color: rgba(168,85,247,0.3); }
        
        .dash-card-glow { position: absolute; top: -2rem; right: -2rem; width: 8rem; height: 8rem; border-radius: 50%; filter: blur(40px); transition: all 0.5s; opacity: 0; }
        .dash-card:hover .dash-card-glow { opacity: 0.5; transform: scale(1.5); }
        .dash-card-blue .dash-card-glow { background: #3b82f6; }
        .dash-card-amber .dash-card-glow { background: #f59e0b; }
        .dash-card-emerald .dash-card-glow { background: #10b981; }
        .dash-card-purple .dash-card-glow { background: #a855f7; }

        .dash-icon-wrapper { width: 3.5rem; height: 3.5rem; border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; transition: transform 0.4s; position: relative; z-index: 2; }
        .dash-card:hover .dash-icon-wrapper { transform: scale(1.1); }
        .dash-icon-blue { background: rgba(59,130,246,0.1); color: #60a5fa; border: 1px solid rgba(59,130,246,0.2); box-shadow: 0 0 15px rgba(59,130,246,0.1); }
        .dash-icon-amber { background: rgba(245,158,11,0.1); color: #fbbf24; border: 1px solid rgba(245,158,11,0.2); box-shadow: 0 0 15px rgba(245,158,11,0.1); }
        .dash-icon-emerald { background: rgba(16,185,129,0.1); color: #34d399; border: 1px solid rgba(16,185,129,0.2); box-shadow: 0 0 15px rgba(16,185,129,0.1); }
        .dash-icon-purple { background: rgba(168,85,247,0.1); color: #c084fc; border: 1px solid rgba(168,85,247,0.2); box-shadow: 0 0 15px rgba(168,85,247,0.1); }
        .dash-icon-wrapper svg { width: 1.75rem; height: 1.75rem; }

        .dash-card-label { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.4); margin-bottom: 0.5rem; position: relative; z-index: 2; }
        .dash-card-value { display: flex; align-items: baseline; gap: 0.5rem; position: relative; z-index: 2; }
        .dash-card-value strong { font-size: 3rem; font-weight: 900; color: #fff; line-height: 1; letter-spacing: -0.05em; }
        .dash-card-value span { font-size: 0.875rem; font-weight: 600; }
        .text-blue { color: #60a5fa; } .text-amber { color: #fbbf24; } .text-emerald { color: #34d399; } .text-purple { color: #c084fc; }

        /* Mini Cards */
        .dash-grid-6 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
        @media (min-width: 768px) { .dash-grid-6 { grid-template-columns: repeat(3, 1fr); } }
        @media (min-width: 1024px) { .dash-grid-6 { grid-template-columns: repeat(6, 1fr); } }
        
        .dash-mini-card { background: #111827; border: 1px solid rgba(255,255,255,0.05); border-radius: 1.5rem; padding: 1.5rem; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; transition: all 0.3s ease; text-decoration: none; }
        .dash-mini-card:hover { background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.1); transform: translateY(-3px); box-shadow: 0 10px 20px -5px rgba(0,0,0,0.4); }
        .dash-mini-value { font-size: 1.75rem; font-weight: 900; color: #fff; margin-bottom: 0.25rem; line-height: 1; }
        .dash-mini-label { font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.4); }

        /* Tables Layer */
        .dash-grid-2 { display: grid; grid-template-columns: repeat(1, 1fr); gap: 2rem; }
        @media (min-width: 768px) { .dash-grid-2 { grid-template-columns: repeat(2, 1fr); } }

        .dash-table-card { background: #111827; border: 1px solid rgba(255,255,255,0.05); border-radius: 2.5rem; overflow: hidden; display: flex; flex-direction: column; position: relative; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); }
        .dash-table-header { padding: 1.5rem 2rem; border-bottom: 1px solid rgba(255,255,255,0.05); background: rgba(0,0,0,0.2); backdrop-filter: blur(10px); display: flex; justify-content: space-between; align-items: center; position: relative; z-index: 10; }
        .dash-table-title { display: flex; align-items: center; gap: 0.75rem; font-size: 0.875rem; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 0.1em; }
        .dash-table-title-dot { width: 0.5rem; height: 0.5rem; border-radius: 50%; }
        .dash-table-link { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; text-decoration: none; padding: 0.5rem 1rem; border-radius: 999px; transition: all 0.3s; }
        .dash-table-link-blue { color: #60a5fa; background: rgba(59,130,246,0.1); }
        .dash-table-link-blue:hover { background: rgba(59,130,246,0.2); }
        .dash-table-link-emerald { color: #34d399; background: rgba(16,185,129,0.1); }
        .dash-table-link-emerald:hover { background: rgba(16,185,129,0.2); }
        .dash-table-link-purple { color: #c084fc; background: rgba(168,85,247,0.1); }
        .dash-table-link-purple:hover { background: rgba(168,85,247,0.2); }
        
        .dash-table-body { padding: 1rem; display: flex; flex-direction: column; gap: 0.5rem; position: relative; z-index: 10; }
        .dash-list-item { display: flex; align-items: center; gap: 1.25rem; padding: 1rem; background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.02); border-radius: 1.5rem; transition: all 0.3s; text-decoration: none; }
        .dash-list-item:hover { background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.1); transform: translateX(5px); }
        
        .dash-list-thumb { width: 4rem; height: 4rem; border-radius: 1rem; background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.05); overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: inset 0 2px 4px rgba(0,0,0,0.5); }
        .dash-list-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .dash-list-item:hover .dash-list-thumb img { transform: scale(1.1); }
        .dash-list-thumb svg { width: 1.5rem; height: 1.5rem; color: rgba(255,255,255,0.2); }
        
        .dash-list-date { width: 4rem; height: 4rem; border-radius: 1rem; display: flex; flex-direction: column; align-items: center; justify-content: center; flex-shrink: 0; background: linear-gradient(to bottom right, rgba(16,185,129,0.2), rgba(16,185,129,0.05)); border: 1px solid rgba(16,185,129,0.2); color: #34d399; }
        .dash-list-date span:first-child { font-size: 0.65rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; opacity: 0.8; margin-bottom: 2px; }
        .dash-list-date span:last-child { font-size: 1.5rem; font-weight: 900; line-height: 1; }

        .dash-list-content { flex: 1; min-width: 0; }
        .dash-list-title { font-size: 1rem; font-weight: 700; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 0.35rem; }
        .dash-list-meta { display: flex; align-items: center; gap: 0.5rem; font-size: 0.75rem; font-weight: 600; color: rgba(255,255,255,0.4); }
        .dash-list-meta svg { width: 1rem; height: 1rem; }
        
        .dash-tag { display: inline-flex; padding: 0.25rem 0.75rem; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.05); border-radius: 0.5rem; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.7); }
        
        .dash-empty { padding: 3rem; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .dash-empty-icon { width: 4rem; height: 4rem; border-radius: 50%; background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; color: rgba(255,255,255,0.2); }
        .dash-empty-icon svg { width: 2rem; height: 2rem; }
        .dash-empty-text { font-size: 0.875rem; font-weight: 600; color: rgba(255,255,255,0.4); }
        
        /* Event Cabor Summary */
        .dash-cabor-container { margin-top: 1rem; }
        .dash-cabor-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }
        .dash-cabor-title { font-size: 1rem; font-weight: 800; color: #fff; text-transform: uppercase; letter-spacing: 0.05em; }
        .dash-cabor-line { flex: 1; height: 1px; background: linear-gradient(to right, rgba(255,255,255,0.1), transparent); }
        .dash-grid-3 { display: grid; grid-template-columns: repeat(1, 1fr); gap: 1.5rem; }
        @media (min-width: 768px) { .dash-grid-3 { grid-template-columns: repeat(3, 1fr); } }
        .dash-cabor-card { background: #111827; border: 1px solid rgba(255,255,255,0.05); border-radius: 1.5rem; padding: 1.5rem; display: flex; align-items: center; justify-content: space-between; transition: all 0.3s; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.3); }
        .dash-cabor-card:hover { transform: translateY(-3px); border-color: rgba(255,255,255,0.1); background: rgba(255,255,255,0.02); }
        .dash-cabor-info { display: flex; flex-direction: column; gap: 0.5rem; }
        .dash-cabor-name { font-size: 1rem; font-weight: 800; color: #fff; }
        .dash-cabor-meta { display: flex; align-items: center; gap: 1rem; font-size: 0.75rem; font-weight: 600; color: rgba(255,255,255,0.5); }
        .dash-cabor-meta-item { display: flex; align-items: center; gap: 0.35rem; }
        .dash-cabor-meta-item.highlight { color: #34d399; }
        .dash-cabor-icon { width: 3rem; height: 3rem; border-radius: 1rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.8); flex-shrink: 0; box-shadow: inset 0 2px 4px rgba(0,0,0,0.2); }

        @media (max-width: 768px) {
            .dash-hero { flex-direction: column; align-items: flex-start; gap: 2rem; padding: 2rem; }
        }
    </style>

    <div class="dash-container">
        {{-- ===================== HERO SECTION ===================== --}}
        <div class="dash-hero">
            <div class="dash-hero-blob1"></div>
            <div class="dash-hero-blob2"></div>
            
            <div class="dash-hero-content">
                <div class="dash-badge">
                    <div class="dash-dot"></div>
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                </div>
                
                <h1 class="dash-title">
                    Halo, {{ auth()->user()->name ?? 'Admin' }}
                </h1>
                
                <p class="dash-desc">
                    Selamat datang di pusat kendali utama. Pantau perkembangan data, kelola konten, dan navigasikan sistem PB PORSEROSI dengan mudah dan cepat.
                </p>
            </div>
            
            <a href="/" target="_blank" class="dash-btn">
                Kunjungi Website
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        {{-- ===================== STAT CARDS — ROW 1: UTAMA ===================== --}}
        <div class="dash-grid-3">
            {{-- Berita Card --}}
            <a href="{{ route('filament.admin.resources.article-news.index') }}" class="dash-card dash-card-blue">
                <div class="dash-card-glow"></div>
                <div class="dash-icon-wrapper dash-icon-blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
                <div class="dash-card-label">Total Berita</div>
                <div class="dash-card-value">
                    <strong>{{ $totalArticles }}</strong>
                    <span class="text-blue">{{ $featuredArticles }} unggulan</span>
                </div>
            </a>

            {{-- Prestasi Card --}}
            <a href="{{ route('filament.admin.resources.achievements.index') }}" class="dash-card dash-card-amber">
                <div class="dash-card-glow"></div>
                <div class="dash-icon-wrapper dash-icon-amber">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                </div>
                <div class="dash-card-label">Data Prestasi</div>
                <div class="dash-card-value">
                    <strong>{{ $totalAchievements }}</strong>
                    <span class="text-amber">🥇 {{ $totalWinner }} emas</span>
                </div>
            </a>

            {{-- Event Card --}}
            <a href="{{ route('filament.admin.resources.events.index') }}" class="dash-card dash-card-emerald">
                <div class="dash-card-glow"></div>
                <div class="dash-icon-wrapper dash-icon-emerald">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div class="dash-card-label">Jadwal Event</div>
                <div class="dash-card-value">
                    <strong>{{ $totalEvents }}</strong>
                    <span class="text-emerald">{{ $upcomingEvents }} mendatang</span>
                </div>
            </a>
        </div>

        {{-- ===================== STAT CARDS — ROW 2: MINI PENDUKUNG ===================== --}}
        <div class="dash-grid-6">
            @foreach([
                ['label' => 'Gallery',      'value' => $totalGalleries,   'route' => 'filament.admin.resources.galleries.index'],
                ['label' => 'Partner',      'value' => $totalPartners,    'route' => 'filament.admin.resources.partners.index'],
                ['label' => 'Penulis',      'value' => $totalAuthors,     'route' => 'filament.admin.resources.authors.index'],
                ['label' => 'Kategori',     'value' => $totalCategories,  'route' => 'filament.admin.resources.categories.index'],
                ['label' => 'Banner',       'value' => $totalBanners,     'route' => 'filament.admin.resources.banner-advertisements.index'],
            ] as $card)
            <a href="{{ route($card['route']) }}" class="dash-mini-card">
                <div class="dash-mini-value">{{ $card['value'] }}</div>
                <div class="dash-mini-label">{{ $card['label'] }}</div>
            </a>
            @endforeach
        </div>

        {{-- ===================== BOTTOM: TABLES (Glassmorphism) ===================== --}}
        <div class="dash-grid-2">

            {{-- Berita Terbaru --}}
            <div class="dash-table-card">
                <div class="dash-table-header">
                    <div class="dash-table-title">
                        <div class="dash-table-title-dot" style="background: #3b82f6; box-shadow: 0 0 8px #3b82f6;"></div>
                        Berita Terbaru
                    </div>
                    <a href="{{ route('filament.admin.resources.article-news.index') }}" class="dash-table-link dash-table-link-blue">Lihat Semua</a>
                </div>
                <div class="dash-table-body">
                    @forelse($recentArticles as $article)
                    <a href="{{ route('filament.admin.resources.article-news.edit', $article) }}" class="dash-list-item">
                        <div class="dash-list-thumb">
                            @if($article->thumbnail)
                                <img src="{{ get_image_url($article->thumbnail) }}" alt="Thumbnail" />
                            @else
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            @endif
                        </div>
                        <div class="dash-list-content">
                            <div class="dash-list-title">{{ $article->name ?? $article->title ?? 'Tanpa Judul' }}</div>
                            <div class="dash-list-meta">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $article->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="dash-empty">
                        <div class="dash-empty-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                        </div>
                        <div class="dash-empty-text">Belum ada berita dipublikasikan.</div>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Event Terbaru --}}
            <div class="dash-table-card">
                <div class="dash-table-header">
                    <div class="dash-table-title">
                        <div class="dash-table-title-dot" style="background: #10b981; box-shadow: 0 0 8px #10b981;"></div>
                        Event Terjadwal
                    </div>
                    <a href="{{ route('filament.admin.resources.events.index') }}" class="dash-table-link dash-table-link-emerald">Lihat Semua</a>
                </div>
                <div class="dash-table-body">
                    @forelse($recentEvents as $event)
                    <a href="{{ route('filament.admin.resources.events.edit', $event) }}" class="dash-list-item">
                        <div class="dash-list-date">
                            <span>{{ \Carbon\Carbon::parse($event->start_date)->isoFormat('MMM') }}</span>
                            <span>{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</span>
                        </div>
                        <div class="dash-list-content">
                            <div class="dash-list-title">{{ $event->name ?? $event->title ?? 'Event' }}</div>
                            <div class="dash-tag">{{ match($event->sport_type) { 'inline-freestyle' => 'Inline Freestyle', 'inline-hockey' => 'Inline Hockey', 'roller-freestyle' => 'Roller Freestyle', 'scooter' => 'Scooter', 'skateboard' => 'Skateboard', 'speed' => 'Speed', 'artistic' => 'Artistic', default => ucfirst($event->sport_type ?? 'Umum') } }}</div>
                        </div>
                    </a>
                    @empty
                    <div class="dash-empty">
                        <div class="dash-empty-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="dash-empty-text">Belum ada event terjadwal.</div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- ===================== REKAPITULASI EVENT PER DISIPLIN ===================== --}}
        <div class="dash-cabor-container">
            <div class="dash-cabor-header">
                <h3 class="dash-cabor-title">Rekapitulasi Event per Disiplin</h3>
                <div class="dash-cabor-line"></div>
            </div>
            <div class="dash-grid-3">
                @foreach($eventStatsByCabor as $stat)
                <div class="dash-cabor-card">
                    <div class="dash-cabor-info">
                        <div class="dash-cabor-name">{{ $stat['name'] }}</div>
                        <div class="dash-cabor-meta">
                            <div class="dash-cabor-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="14" height="14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                {{ $stat['total'] }} Total Event
                            </div>
                            <div class="dash-cabor-meta-item highlight">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="14" height="14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $stat['this_month'] }} Bulan Ini
                            </div>
                        </div>
                    </div>
                    <div class="dash-cabor-icon">
                        @if($stat['name'] === 'Inline Freestyle')
                            <i class="fas fa-skating text-lg text-blue-400"></i>
                        @elseif($stat['name'] === 'Inline Hockey')
                            <i class="fas fa-hockey-puck text-lg text-indigo-400"></i>
                        @elseif($stat['name'] === 'Roller Freestyle')
                            <i class="fas fa-mountain text-lg text-purple-400"></i>
                        @elseif($stat['name'] === 'Scooter')
                            <i class="fas fa-bicycle text-lg text-emerald-400"></i>
                        @elseif($stat['name'] === 'Skateboard')
                            <i class="fas fa-snowboarding text-lg text-yellow-400"></i>
                        @elseif($stat['name'] === 'Speed')
                            <i class="fas fa-tachometer-alt text-lg text-orange-400"></i>
                        @elseif($stat['name'] === 'Artistic')
                            <i class="fas fa-star text-lg text-pink-400"></i>
                        @else
                            <i class="fas fa-calendar-alt text-lg text-slate-400"></i>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</x-filament::page>
