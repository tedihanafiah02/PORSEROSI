@props(['live'])

<div x-data="liveStreamPlayer('{{ $live->start_datetime->toIso8601String() }}', '{{ $live->status }}')" 
     class="relative w-full rounded-3xl overflow-hidden shadow-2xl border border-white/10 bg-[#0d0d1f] group flex flex-col h-full">
    
    {{-- State: Upcoming (Countdown) --}}
    <div x-show="isUpcoming" class="relative w-full aspect-[16/10] md:aspect-video flex flex-col items-center justify-center" x-transition.opacity.duration.500ms>
        @if($live->thumbnail)
            <img src="{{ get_image_url($live->thumbnail) }}" alt="{{ $live->title }}" class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:scale-105 transition-transform duration-700">
        @else
            <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-[#181836] to-[#0d0d1f]"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d1f] via-[#0d0d1f]/60 to-transparent"></div>
        
        <div class="absolute inset-0 flex flex-col items-center justify-center p-4 sm:p-6 text-center z-10">
            <span class="px-3 sm:px-4 py-1 sm:py-1.5 bg-yellow-500/20 text-yellow-500 text-[10px] sm:text-xs font-bold uppercase tracking-widest rounded-full mb-3 border border-yellow-500/30 backdrop-blur-sm shadow-[0_0_15px_rgba(234,179,8,0.2)]">
                {{ __('messages.status_upcoming') }}
            </span>
            <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold text-white mb-4 sm:mb-8 drop-shadow-md max-w-3xl leading-tight">
                {{ $live->getLocalizedTitle() }}
            </h3>
            
            <div class="flex items-center gap-2 sm:gap-4 text-white">
                <div class="flex flex-col items-center bg-[#181836]/80 px-3 sm:px-5 py-2 sm:py-4 rounded-xl border border-white/10 backdrop-blur-md min-w-[60px] sm:min-w-[80px]">
                    <span class="text-2xl sm:text-4xl font-black text-yellow-400" x-text="countdown.days">00</span>
                    <span class="text-[9px] sm:text-[11px] text-slate-400 uppercase tracking-widest mt-1">{{ __('messages.days') }}</span>
                </div>
                <div class="text-lg sm:text-2xl font-bold text-slate-500">:</div>
                <div class="flex flex-col items-center bg-[#181836]/80 px-3 sm:px-5 py-2 sm:py-4 rounded-xl border border-white/10 backdrop-blur-md min-w-[60px] sm:min-w-[80px]">
                    <span class="text-2xl sm:text-4xl font-black text-white" x-text="countdown.hours">00</span>
                    <span class="text-[9px] sm:text-[11px] text-slate-400 uppercase tracking-widest mt-1">{{ __('messages.hours') }}</span>
                </div>
                <div class="text-lg sm:text-2xl font-bold text-slate-500">:</div>
                <div class="flex flex-col items-center bg-[#181836]/80 px-3 sm:px-5 py-2 sm:py-4 rounded-xl border border-white/10 backdrop-blur-md min-w-[60px] sm:min-w-[80px]">
                    <span class="text-2xl sm:text-4xl font-black text-white" x-text="countdown.minutes">00</span>
                    <span class="text-[9px] sm:text-[11px] text-slate-400 uppercase tracking-widest mt-1">{{ __('messages.minutes') }}</span>
                </div>
                <div class="text-lg sm:text-2xl font-bold text-slate-500">:</div>
                <div class="flex flex-col items-center bg-[#181836]/80 px-3 sm:px-5 py-2 sm:py-4 rounded-xl border border-white/10 backdrop-blur-md min-w-[60px] sm:min-w-[80px]">
                    <span class="text-2xl sm:text-4xl font-black text-white" x-text="countdown.seconds">00</span>
                    <span class="text-[9px] sm:text-[11px] text-slate-400 uppercase tracking-widest mt-1">{{ __('messages.seconds') }}</span>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full p-4 sm:p-6 bg-gradient-to-t from-[#0d0d1f] to-transparent z-10 border-t border-white/5 flex items-center justify-between">
            <p class="text-slate-300 font-medium tracking-wide text-[11px] sm:text-sm">
                {{ __('messages.airing') }} <strong class="text-yellow-400 ml-1">{{ $live->start_datetime->translatedFormat('d F Y, H:i') }} WIB</strong>
            </p>
            <div class="flex items-center gap-2">
                @if($live->platform === 'youtube')
                    <i class="fab fa-youtube text-red-500 text-lg sm:text-xl"></i>
                @elseif($live->platform === 'instagram')
                    <i class="fab fa-instagram text-pink-500 text-lg sm:text-xl"></i>
                @elseif($live->platform === 'tiktok')
                    <i class="fab fa-tiktok text-slate-200 text-lg sm:text-xl"></i>
                @else
                    <i class="fas fa-play-circle text-yellow-500 text-lg sm:text-xl"></i>
                @endif
            </div>
        </div>
    </div>

    {{-- State: Live (Player) --}}
    <div x-show="isLive" style="display: none;" class="relative w-full flex flex-col h-full" x-transition.opacity.duration.1000ms>
        
        {{-- Video Player Container (16:9 Aspect Ratio) --}}
        <div class="relative w-full aspect-video bg-black shrink-0 border-b border-white/10">
            <div class="absolute top-4 left-4 z-20">
                <span class="flex items-center gap-2 px-3 py-1.5 bg-red-600/90 backdrop-blur-sm text-white text-[10px] sm:text-xs font-bold uppercase tracking-widest rounded-md shadow-[0_0_15px_rgba(239,68,68,0.6)] animate-pulse border border-red-500/50">
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span> {{ __('messages.live_now') }}
                </span>
            </div>

            @php
                $url = trim($live->embed_url);
                $isIframe = str_contains($url, '<iframe');
                
                $finalEmbed = '';
                
                if ($live->platform === 'youtube') {
                    if ($isIframe) {
                        $finalEmbed = $url;
                    } else {
                        // Coba parse ID dari link YouTube biasa (watch?v=, youtu.be/, live/)
                        if (preg_match('/(youtube\.com|youtu\.be)\/(watch\?v=|live\/|embed\/)?([a-zA-Z0-9_-]{11})/', $url, $matches)) {
                            $ytId = $matches[3];
                            $finalEmbed = '<iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/'.$ytId.'?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                        } else {
                            // Fallback jika format link aneh
                            $finalEmbed = '<iframe class="absolute inset-0 w-full h-full" src="'.$url.'" frameborder="0" allowfullscreen></iframe>';
                        }
                    }
                } else {
                    // TV Streaming / Custom
                    if ($isIframe) {
                        $finalEmbed = $url;
                    } else {
                        // Jika bukan iframe (hanya link mentah), otomatis buatkan iframe
                        $finalEmbed = '<iframe class="absolute inset-0 w-full h-full" src="'.$url.'" frameborder="0" allowfullscreen></iframe>';
                    }
                }
            @endphp
            
            {!! $finalEmbed !!}
        </div>
        
        <div class="p-5 sm:p-6 bg-[#181836] flex-1 flex flex-col">
            <h3 class="text-xl sm:text-2xl font-bold text-white mb-3">{{ $live->getLocalizedTitle() }}</h3>
            @if($live->getLocalizedDescription())
                <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-4 flex-1">{{ $live->getLocalizedDescription() }}</p>
            @endif
            <div class="mt-auto pt-4 border-t border-white/5 flex items-center justify-between text-xs sm:text-sm text-slate-500">
                <span class="flex items-center gap-2"><i class="far fa-calendar-alt text-yellow-500"></i> {{ $live->start_datetime->translatedFormat('d M Y') }}</span>
                <span class="uppercase tracking-widest font-semibold flex items-center gap-2">
                    Platform: <strong class="text-slate-300">{{ ucfirst($live->platform) }}</strong>
                </span>
            </div>
        </div>
    </div>
</div>

@pushonce('after-scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('liveStreamPlayer', (startTimeIso, initialStatus) => ({
            startTime: new Date(startTimeIso).getTime(),
            status: initialStatus,
            currentTime: new Date().getTime(),
            countdown: { days: '00', hours: '00', minutes: '00', seconds: '00' },
            interval: null,

            get isUpcoming() {
                return this.status === 'upcoming' && this.currentTime < this.startTime;
            },
            get isLive() {
                return this.status === 'live' || (this.status === 'upcoming' && this.currentTime >= this.startTime);
            },

            init() {
                if (this.isUpcoming) {
                    this.updateCountdown();
                    this.interval = setInterval(() => {
                        this.currentTime = new Date().getTime();
                        if (this.currentTime >= this.startTime) {
                            clearInterval(this.interval);
                            // Auto transition to live!
                        } else {
                            this.updateCountdown();
                        }
                    }, 1000);
                }
            },

            updateCountdown() {
                const distance = this.startTime - this.currentTime;
                
                if (distance < 0) return;

                const d = Math.floor(distance / (1000 * 60 * 60 * 24));
                const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((distance % (1000 * 60)) / 1000);

                this.countdown.days = d.toString().padStart(2, '0');
                this.countdown.hours = h.toString().padStart(2, '0');
                this.countdown.minutes = m.toString().padStart(2, '0');
                this.countdown.seconds = s.toString().padStart(2, '0');
            }
        }));
    });
</script>
@endpushonce
