@extends('front.master')

@section('title', __('messages.page_title_category', ['category' => $category->name]))
@section('description', __('messages.page_desc_category', ['category' => $category->name]))
@section('keywords', 'berita ' . strtolower($category->name) . ', update pb porserosi, artikel olahraga')

@section('content')

<div class="font-[Poppins] bg-[#181836] text-gray-200 flex flex-col flex-grow min-h-screen">
        <x-navbar />

        {{-- Category Header --}}
        <header class="pt-[120px] md:pt-[150px] pb-10 px-4 border-b border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center text-center gap-6">
                @if($category->icon)
                    <div class="w-16 h-16 bg-white/5 rounded-2xl flex items-center justify-center border border-white/10 shadow-xl">
                        <img src="{{ get_image_url($category->icon) }}" class="w-8 h-8 object-contain" alt="icon">
                    </div>
                @endif
                <h1 class="text-3xl md:text-5xl font-black text-white tracking-tight uppercase">
                    {{ __('messages.news') }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">{{ $category->name }}</span>
                </h1>
                <p class="text-gray-400 max-w-2xl text-sm md:text-base">
                    {{ __('messages.category_desc', ['category' => $category->name]) }}
                </p>
                <a href="{{ route('front.index') }}" class="mt-2 inline-flex items-center gap-2 text-sm font-semibold text-gray-400 hover:text-yellow-400 transition-colors">
                    <i class="fas fa-arrow-left"></i> {{ __('messages.back_to_all_news') }}
                </a>
            </div>
        </header>

        {{-- Content Cards --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($category->news as $news)
                    <a href="{{ route('front.details', $news->slug) }}" class="group flex flex-col bg-white/5 rounded-2xl overflow-hidden border border-white/10 hover:border-yellow-500/50 transition-all duration-300 hover:shadow-[0_0_20px_rgba(234,179,8,0.15)] hover:-translate-y-1">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ get_image_url($news->thumbnail) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="thumbnail" />
                            <div class="absolute inset-0 bg-gradient-to-t from-[#181836] to-transparent opacity-90"></div>
                        </div>
                        
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center gap-2 text-xs text-gray-400 mb-3 font-medium">
                                <i class="far fa-calendar-alt text-yellow-500"></i> {{ $news->created_at->format('d F Y') }}
                            </div>
                            <h3 class="text-xl font-bold text-white leading-snug mb-4 group-hover:text-yellow-400 transition-colors line-clamp-3">
                                {{ $news->getLocalizedTitle() }}
                            </h3>
                            

                        </div>
                    </a>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-20 bg-white/5 rounded-3xl border border-white/10">
                        <i class="far fa-folder-open text-6xl text-gray-600 mb-4"></i>
                        <p class="text-gray-400 text-lg">{{ __('messages.no_news_in_category', ['category' => $category->name]) }}</p>
                    </div>
                @endforelse
            </div>
        </section>

        <x-footer />
    </div>
@endsection
