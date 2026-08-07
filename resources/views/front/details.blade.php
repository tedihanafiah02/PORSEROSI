@extends('front.master')

@section('title', $articleNews->getLocalizedTitle() . ' | PB PORSEROSI')
@section('description', Str::limit(strip_tags($articleNews->getLocalizedContent()), 160))
@section('keywords', $articleNews->tags ?? 'berita olahraga, sepatu roda, skateboard')

@section('og_title', $articleNews->getLocalizedTitle())
@section('og_description', Str::limit(strip_tags($articleNews->getLocalizedContent()), 160))
@section('og_image', get_image_url($articleNews->thumbnail))
@section('og_type', 'article')

@section('schema')
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "NewsArticle",
      "headline": "{{ $articleNews->getLocalizedTitle() }}",
      "datePublished": "{{ $articleNews->created_at->toIso8601String() }}",
      "dateModified": "{{ $articleNews->updated_at->toIso8601String() }}",
      "author": {
        "@type": "Person",
        "name": "{{ $articleNews->author->name ?? 'Admin PORSEROSI' }}"
      },
      "publisher": {
        "@type": "SportsOrganization",
        "name": "PORSEROSI",
        "logo": {
          "@type": "ImageObject",
          "url": "{{ get_image_url('assets/images/siapindo/logo.svg') }}"
        }
      },
      "image": ["{{ get_image_url($articleNews->thumbnail) }}"]
    }
    </script>
@endsection

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
        "name": "{{ __('messages.news') }}",
        "item": "{{ route('front.index') }}"
      },{
        "@type": "ListItem",
        "position": 3,
        "name": "{{ $articleNews->category->name }}",
        "item": "{{ route('front.category', $articleNews->category->slug) }}"
      },{
        "@type": "ListItem",
        "position": 4,
        "name": "{{ $articleNews->getLocalizedTitle() }}"
      }]
    }
    </script>
@endsection

@section('content')

<div class="font-[Poppins] bg-[#181836] text-gray-200 flex flex-col flex-grow min-h-screen">
        <x-navbar />

        {{-- Hero Image & Headline --}}
        <header class="relative w-full h-[50vh] md:h-[70vh] flex items-end justify-center overflow-hidden">
            <div class="absolute inset-0">
                <img src="{{ get_image_url($articleNews->thumbnail) }}" class="w-full h-full object-cover" alt="{{ $articleNews->name }}">
                <div class="absolute inset-0 bg-gradient-to-t from-[#181836] via-[#181836]/80 to-transparent"></div>
            </div>
            
            <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 md:pb-20">
                <div class="flex flex-col items-center text-center max-w-4xl mx-auto gap-6">
                    {{-- Category Badge --}}
                    <a href="{{ route('front.category', $articleNews->category->slug) }}" class="px-4 py-1.5 bg-yellow-500 text-black text-sm font-bold uppercase tracking-widest rounded-full shadow-lg hover:bg-yellow-400 transition-colors">
                        {{ $articleNews->category->getLocalizedName() }}
                    </a>
                    
                    {{-- Title --}}
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-white leading-tight drop-shadow-2xl">
                        {{ $articleNews->getLocalizedTitle() }}
                    </h1>
                    
                    {{-- Meta Info --}}
                    <div class="flex flex-wrap items-center justify-center gap-6 mt-4">
                        <div class="flex items-center gap-2 text-gray-300 font-medium">
                            <i class="far fa-calendar-alt text-yellow-500"></i>
                            <span>{{ $articleNews->created_at->format('d F Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- Main Article Container --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex flex-col lg:flex-row gap-12">
            
            {{-- Content Area --}}
            <article class="flex-1 lg:w-2/3 bg-white/5 rounded-3xl p-6 md:p-10 border border-white/10 shadow-2xl">
                <div class="prose prose-lg prose-invert max-w-none 
                    prose-headings:font-bold prose-headings:text-white 
                    prose-p:text-gray-300 prose-p:leading-relaxed prose-p:mb-6
                    prose-a:text-yellow-500 prose-a:no-underline hover:prose-a:underline
                    prose-img:rounded-2xl prose-img:shadow-lg prose-img:mx-auto
                    prose-strong:text-white prose-blockquote:border-l-yellow-500 prose-blockquote:bg-white/5 prose-blockquote:py-2 prose-blockquote:px-6 prose-blockquote:rounded-r-xl">
                    {!! $articleNews->getLocalizedContent() !!}
                </div>
                
                {{-- Tags / Share --}}
                @php
                    $shareUrl = route('front.details', $articleNews->slug);
                    $shareTitle = $articleNews->getLocalizedTitle();
                    $shareText = $shareTitle . ' - ' . config('app.url');
                    
                    // WhatsApp Share
                    $whatsappUrl = 'https://wa.me/?text=' . urlencode($shareText . ' ' . $shareUrl);
                    
                    // Twitter Share
                    $twitterUrl = 'https://twitter.com/intent/tweet?text=' . urlencode($shareTitle) . '&url=' . urlencode($shareUrl);
                    
                    // Facebook Share
                    $facebookUrl = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($shareUrl);
                    
                    // Instagram (copy to clipboard fallback)
                    $instagramUrl = 'https://www.instagram.com/';
                @endphp
                <div class="mt-12 pt-8 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">{{ __('messages.share') }}</span>
                        
                        <!-- Facebook Share -->
                        <a href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-gray-300 hover:bg-blue-600 hover:text-white transition-colors" title="Bagikan ke Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        
                        <!-- Twitter Share -->
                        <a href="{{ $twitterUrl }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-gray-300 hover:bg-sky-500 hover:text-white transition-colors" title="Bagikan ke Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        
                        <!-- WhatsApp Share -->
                        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-gray-300 hover:bg-green-500 hover:text-white transition-colors" title="Bagikan ke WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        
                        <!-- Instagram - Copy Link -->
                        <button onclick="copyToClipboard('{{ $shareUrl }}')" type="button" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-gray-300 hover:bg-pink-500 hover:text-white transition-colors" title="Salin link untuk Instagram">
                            <i class="fab fa-instagram"></i>
                        </button>
                    </div>
                </div>

                <script>
                    function copyToClipboard(text) {
                        navigator.clipboard.writeText(text).then(() => {
                            // Tampilkan notifikasi
                            const btn = event.target.closest('button');
                            const originalTitle = btn.title;
                            btn.title = 'Link tersalin!';
                            btn.classList.add('animate-pulse');
                            
                            setTimeout(() => {
                                btn.title = originalTitle;
                                btn.classList.remove('animate-pulse');
                            }, 2000);
                        }).catch(err => {
                            alert('Gagal menyalin link');
                        });
                    }
                </script>
            </article>

            {{-- Sidebar --}}
            <aside class="w-full lg:w-1/3 flex flex-col gap-8 shrink-0">
                
                {{-- Square Advertisement Banner --}}
                @if(isset($bannerAds) && $bannerAds->isNotEmpty())
                    <div class="relative rounded-[2rem] overflow-hidden shadow-xl border border-white/10 group bg-[#1f1f45]/50 p-4 flex flex-col items-center">
                        <span class="text-[9px] font-bold text-slate-400 mb-2.5 uppercase tracking-widest self-start px-2">Sponsor</span>
                        <div class="relative w-full aspect-[100/35] rounded-2xl overflow-hidden" id="detailsAdBannerSlider">
                            @foreach($bannerAds as $index => $banner)
                                <div class="ad-slide absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" data-slide-index="{{ $index }}" data-duration="{{ $banner->slide_duration * 1000 }}">
                                    <a href="{{ $banner->link }}" target="_blank" class="block w-full h-full">
                                        <img src="{{ get_image_url($banner->thumbnail) }}" alt="Iklan" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-[1.02]">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if($bannerAds->count() > 1)
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const adSlides = document.querySelectorAll('#detailsAdBannerSlider .ad-slide');
                                if (adSlides.length > 1) {
                                    let currentAdIndex = 0;
                                    function showNextAd() {
                                        adSlides[currentAdIndex].classList.remove('opacity-100', 'z-10');
                                        adSlides[currentAdIndex].classList.add('opacity-0', 'z-0');
                                        
                                        currentAdIndex = (currentAdIndex + 1) % adSlides.length;
                                        
                                        adSlides[currentAdIndex].classList.remove('opacity-0', 'z-0');
                                        adSlides[currentAdIndex].classList.add('opacity-100', 'z-10');
                                        
                                        const nextDuration = parseInt(adSlides[currentAdIndex].getAttribute('data-duration')) || 5000;
                                        setTimeout(showNextAd, nextDuration);
                                    }
                                    const firstDuration = parseInt(adSlides[0].getAttribute('data-duration')) || 5000;
                                    setTimeout(showNextAd, firstDuration);
                                }
                            });
                        </script>
                    @endif
                @endif

                {{-- More From Author --}}
                <div class="bg-white/5 p-6 rounded-3xl border border-white/10 shadow-xl">
                    <h3 class="font-bold text-lg text-white mb-6 border-b border-white/10 pb-3 flex items-center gap-2">
                        <i class="fas fa-pen-nib text-yellow-500"></i> {{ __('messages.other_articles') }}
                    </h3>
                    <div class="flex flex-col gap-4">
                        @forelse($author_news as $item)
                            @if($item->id !== $articleNews->id)
                                <a href="{{ route('front.details', $item->slug) }}" class="group flex gap-4 items-center bg-transparent hover:bg-white/5 p-2 rounded-xl transition-colors">
                                    <div class="w-20 h-20 shrink-0 rounded-xl overflow-hidden border border-white/10">
                                        <img src="{{ get_image_url($item->thumbnail) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="thumb">
                                    </div>
                                    <div class="flex flex-col">
                                <h4 class="text-sm font-bold text-white group-hover:text-yellow-400 transition-colors line-clamp-2 leading-snug mb-1">{{ $item->getLocalizedTitle() }}</h4>
                                        <span class="text-[10px] font-medium text-gray-500">{{ $item->created_at->format('d M Y') }}</span>
                                    </div>
                                </a>
                            @endif
                        @empty
                            <p class="text-sm text-gray-500">{{ __('messages.no_other_articles') }}</p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </section>

        {{-- Related News --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 border-t border-white/10">
            <div class="flex items-center justify-between mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-white flex items-center gap-3">
                    <div class="w-2 h-8 bg-blue-500 rounded-full"></div>
                    {{ __('messages.you_might_like') }}
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($articles->take(3) as $article)
                    <a href="{{ route('front.details', $article->slug) }}" class="group flex flex-col bg-white/5 rounded-2xl overflow-hidden border border-white/10 hover:border-yellow-500/50 transition-all duration-300 hover:shadow-[0_0_20px_rgba(234,179,8,0.15)] hover:-translate-y-1">
                        <div class="relative h-48 overflow-hidden">
                            <span class="absolute top-4 left-4 z-10 px-3 py-1 bg-yellow-500 text-black text-xs font-bold uppercase rounded-full shadow-lg">
                                {{ $article->category->name }}
                            </span>
                            <img src="{{ get_image_url($article->thumbnail) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="thumbnail" />
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="text-lg font-bold text-white leading-snug mb-3 group-hover:text-yellow-400 transition-colors line-clamp-2">
                                {{ $article->getLocalizedTitle() }}
                            </h3>
                            <div class="mt-auto flex items-center gap-2 text-xs text-gray-500 font-medium">
                                <i class="far fa-calendar-alt"></i> {{ $article->created_at->format('d M Y') }}
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="col-span-3 text-center text-gray-500">{{ __('messages.no_recommended_articles') }}</p>
                @endforelse
            </div>
        </section>

        <x-footer />
    </div>
@endsection
