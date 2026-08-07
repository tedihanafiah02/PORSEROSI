@extends('front.master')
@section('content')

<div class="font-[Poppins] flex flex-col flex-grow min-h-screen">

        <x-navbar />

        {{-- Author Section --}}
        <section id="author"
            class="max-w-7xl mx-auto flex items-center flex-col gap-[20px] md:gap-[30px] mt-[120px] md:mt-[150px] px-4 sm:px-6 lg:px-8">
            {{-- Title Section --}}
            <div id="title" class="flex flex-col md:flex-row items-center gap-[10px] md:gap-[30px]">
                <h1
                    class="text-2xl md:text-4xl leading-[1.2] md:leading-[45px] font-bold text-center md:text-left  bg-gradient-to-b from-yellow-400 to-yellow-600 text-transparent bg-clip-text">
                    {{ __('messages.author_news') }}
                </h1>

                <div class="flex items-center gap-3">
                    <div class="w-[50px] h-[50px] md:w-[60px] md:h-[60px] flex shrink-0 rounded-full overflow-hidden">
                        <img src="{{ get_image_url($author->avatar) }}" alt="profile-img"
                            class="w-full h-full object-cover" />
                    </div>
                    <div class="flex flex-col">
                        <p class="text-gray-100 text-base md:text-lg leading-[1.2] md:leading-[27px] font-semibold">
                            {{ $author->name }}
                        </p>
                        <span class="text-sm md:text-base text-gray-100">{{ $author->occupation }}</span>
                    </div>
                </div>
            </div>

            {{-- Content Cards --}}
            <div id="content-cards" class="grid grid-cols-1 md:grid-cols-3 gap-[20px] md:gap-[30px] w-full items-stretch">
                @forelse($author->news as $news)
                    <a href="{{ route('front.details', $news->slug) }}" class="card group h-full">
                        <div
                            class="flex flex-col h-full transition-all duration-300 ring-1 ring-[#EEF0F7] hover:ring-2 hover:ring-slate-800 rounded-[15px] md:rounded-[20px] overflow-hidden bg-gray-400">

                            {{-- Thumbnail --}}
                            <div class="thumbnail-container h-[150px] md:h-[200px] relative overflow-hidden">
                                <div
                                    class="badge absolute left-5 top-5 bottom-auto right-auto flex p-[6px_12px] md:p-[8px_18px] rounded-[50px]">
                                    <p class="text-xs leading-[18px] font-bold uppercase">{{ $news->category->name }}</p>
                                </div>
                                <img src="{{ get_image_url($news->thumbnail) }}" alt="thumbnail photo"
                                    class="object-cover w-full h-full transition-all duration-300 group-hover:scale-105" />
                            </div>

                            <div class="flex flex-col grow gap-[6px] p-[16px] md:p-[26px_20px]">
                                <h3 class="font-bold text-lg leading-[27px] text-white">
                                    {{ $news->getLocalizedTitle() }}
                                </h3>
                                <p class="text-sm leading-[21px] text-gray-100 italic">{{ $news->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="col-span-1 md:col-span-3 text-center text-gray-500">{{ __('messages.no_author_news') }}</p>
                @endforelse
            </div>

        </section>

        {{-- Advertisement Section --}}
        @if ($bannerads)
            <section id="Advertisement" class="max-w-7xl mx-auto flex justify-center mt-[40px] md:mt-[70px] px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-3 shrink-0 w-full md:w-fit">
                    <a href="{{ $bannerads->link }}">
                        <div
                            class="w-full md:w-[900px] h-[100px] md:h-[120px] flex shrink-0 border border-[#EEF0F7] rounded-2xl overflow-hidden">
                            <img src="{{ get_image_url($bannerads->thumbnail) }}" class="object-cover w-full h-full"
                                alt="ads" />
                        </div>
                    </a>
                    <p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1 justify-center md:justify-start">
                        {{ __('messages.our_advertisement') }} <a href="#" class="w-[18px] h-[18px]"><img
                                src="{{ get_image_url('assets/images/icons/message-question.svg') }}" alt="icon" /></a>
                    </p>
                </div>
            </section>
        @endif

        <x-footer />

    </div>

@endsection

@push('after-scripts')
    <script src="https://cdn.tailwindcss.com"></script>
@endpush
