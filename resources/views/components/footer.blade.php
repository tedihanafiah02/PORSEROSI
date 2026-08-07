@php
    $socialIg = \App\Models\SeoSetting::get('social_instagram');
    $socialFb = \App\Models\SeoSetting::get('social_facebook');
    $socialYt = \App\Models\SeoSetting::get('social_youtube');
    $socialTw = \App\Models\SeoSetting::get('social_twitter');
    $socialTt = \App\Models\SeoSetting::get('social_tiktok');
    $orgEmail = \App\Models\SeoSetting::get('social_email') ?: \App\Models\SeoSetting::get('organization_email');
    $orgPhone = \App\Models\SeoSetting::get('social_whatsapp') ?: \App\Models\SeoSetting::get('organization_phone');
    
    // Fetch active footer brands
    $footerBrands = \App\Models\FooterBrand::where('is_active', true)->get();
@endphp
<footer class="w-full mt-auto">

    <!-- SPONSOR SECTION -->
    @if($footerBrands->isNotEmpty())
    <div class="bg-white py-8 border-t-4 border-green-600 shadow-inner">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap justify-center items-center gap-10 md:gap-20 opacity-80 hover:opacity-100 transition-opacity">

            @foreach($footerBrands as $brand)
                @if($brand->link)
                    <a href="{{ $brand->link }}" target="_blank" class="flex items-center justify-center transition-transform hover:scale-105">
                @else
                    <div class="flex items-center justify-center">
                @endif

                @php
                    // Apply different color style classes based on index/brand name for visual aesthetics
                    $styledClasses = 'text-gray-800 text-2xl font-black tracking-widest uppercase';
                    if (strtoupper($brand->name) === 'COUNTERPAIN') {
                        $styledClasses = 'text-[#0082c3] text-3xl font-black italic tracking-tighter';
                    } elseif (strtoupper($brand->name) === 'ROLLERBLADE') {
                        $styledClasses = 'text-[#e2001a] text-3xl font-black tracking-widest';
                    } elseif (strtoupper($brand->name) === 'POWERSLIDE') {
                        $styledClasses = 'text-black text-3xl font-black tracking-tighter italic';
                    }
                @endphp
                <span class="{{ $styledClasses }}">{{ $brand->name }}</span>

                @if($brand->link)
                    </a>
                @else
                    </div>
                @endif
            @endforeach

        </div>
    </div>
    @endif

    <!-- MAIN FOOTER -->
    <div class="bg-[#1a1a1a] pt-16 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-12 gap-12 md:gap-8">

            <!-- COLUMN 1 -->
            <div class="md:col-span-5 flex flex-col sm:flex-row gap-8">

                <div class="shrink-0 flex items-start">
                    <img src="{{ asset('assets/images/siapindo/logo-porserosi.png') }}"
                        class="w-28 md:w-36 h-auto drop-shadow-lg"
                        alt="PORSEROSI - Persatuan Olahraga Sepatu Roda Seluruh Indonesia">
                </div>

                <div class="flex flex-col">
                    <h3 class="text-white font-black text-[15px] mb-5 uppercase tracking-wider">
                        {{ __('messages.footer_about_title') }}
                    </h3>

                    <p class="text-gray-300 text-[13px] leading-relaxed mb-6 font-medium">
                        {{ __('messages.footer_about_desc') }}
                    </p>

                    <a href="{{ route('front.tentangKami') }}"
                        class="inline-block px-5 py-2.5 border-2 border-white text-white font-bold text-[11px] uppercase tracking-[0.2em] hover:bg-white hover:text-black transition-colors w-max">
                        {{ __('messages.footer_read_more') }}
                    </a>
                </div>
            </div>

            <!-- COLUMN 2 -->
            <div class="md:col-span-4 flex flex-col">

                <h3 class="text-white font-black text-[15px] mb-5 uppercase tracking-wider">
                    {{ __('messages.footer_contact_title') }}
                </h3>

                <h4 class="text-white font-bold text-[13px] mb-1">
                    {{ __('messages.secretariat') }}
                </h4>

                <p class="text-gray-400 text-[13px] leading-relaxed mb-6 font-medium">
                    PPKGBK Building, Lantai 8<br>
                    Jl. Pintu 1, Senayan<br>
                    {{ __('messages.jakarta_indonesia') }}
                </p>
            </div>

            <!-- COLUMN 3 -->
            <div class="md:col-span-3 flex flex-col"
                x-data="{ 
                    showToast: {{ session('success_feedback') ? 'true' : 'false' }},
                    showErrorToast: {{ session('error') ? 'true' : 'false' }}
                }">

                <h3 class="text-white font-black text-[15px] mb-4 uppercase tracking-wider">
                    Media Sosial
                </h3>

                <ul class="text-gray-400 text-[14px] space-y-4 mb-8 font-medium">
                    @if($socialIg)
                    <li>
                        <a href="{{ $socialIg }}" target="_blank" class="flex items-center gap-4 hover:text-yellow-400 group transition-colors">
                            <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center border border-white/10 group-hover:bg-gradient-to-tr group-hover:from-yellow-600 group-hover:to-pink-500 group-hover:border-transparent transition-all shadow-lg text-white">
                                <i class="fab fa-instagram text-lg"></i>
                            </div>
                            <span class="tracking-wide">Instagram</span>
                        </a>
                    </li>
                    @endif
                    @if($socialTw)
                    <li>
                        <a href="{{ $socialTw }}" target="_blank" class="flex items-center gap-4 hover:text-yellow-400 group transition-colors">
                            <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center border border-white/10 group-hover:bg-[#1DA1F2] group-hover:border-transparent transition-all shadow-lg text-white">
                                <i class="fab fa-twitter text-lg"></i>
                            </div>
                            <span class="tracking-wide">Twitter</span>
                        </a>
                    </li>
                    @endif
                    @if($orgEmail)
                    <li>
                        <a href="mailto:{{ $orgEmail }}" class="flex items-center gap-4 hover:text-yellow-400 group transition-colors">
                            <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center border border-white/10 group-hover:bg-red-500 group-hover:border-transparent transition-all shadow-lg text-white">
                                <i class="fas fa-envelope text-lg"></i>
                            </div>
                            <span class="tracking-wide">Email</span>
                        </a>
                    </li>
                    @endif
                    @if($socialYt)
                    <li>
                        <a href="{{ $socialYt }}" target="_blank" class="flex items-center gap-4 hover:text-yellow-400 group transition-colors">
                            <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center border border-white/10 group-hover:bg-red-600 group-hover:border-transparent transition-all shadow-lg text-white">
                                <i class="fab fa-youtube text-lg"></i>
                            </div>
                            <span class="tracking-wide">YouTube</span>
                        </a>
                    </li>
                    @endif
                    @if($socialTt)
                    <li>
                        <a href="{{ $socialTt }}" target="_blank" class="flex items-center gap-4 hover:text-yellow-400 group transition-colors">
                            <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center border border-white/10 group-hover:bg-slate-800 group-hover:border-transparent transition-all shadow-lg text-white">
                                <i class="fab fa-tiktok text-lg"></i>
                            </div>
                            <span class="tracking-wide">TikTok</span>
                        </a>
                    </li>
                    @endif
                    @if($socialFb)
                    <li>
                        <a href="{{ $socialFb }}" target="_blank" class="flex items-center gap-4 hover:text-yellow-400 group transition-colors">
                            <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center border border-white/10 group-hover:bg-blue-600 group-hover:border-transparent transition-all shadow-lg text-white">
                                <i class="fab fa-facebook text-lg"></i>
                            </div>
                            <span class="tracking-wide">Facebook</span>
                        </a>
                    </li>
                    @endif
                    @if($orgPhone)
                    <li>
                        <a href="https://wa.me/{{ $orgPhone }}" target="_blank" class="flex items-center gap-4 hover:text-yellow-400 group transition-colors">
                            <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center border border-white/10 group-hover:bg-emerald-500 group-hover:border-transparent transition-all shadow-lg text-white">
                                <i class="fab fa-whatsapp text-lg"></i>
                            </div>
                            <span class="tracking-wide">WhatsApp</span>
                        </a>
                    </li>
                    @endif
                </ul>



                <!-- TOAST -->
                <div x-show="showToast"
                    style="display: none;"
                    class="fixed bottom-10 right-10 z-[99999] bg-emerald-500 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 border border-emerald-400 font-medium"
                    x-init="if(showToast) setTimeout(() => showToast = false, 5000)">

                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center shrink-0">
                        <i class="fas fa-check"></i>
                    </div>

                    <span>{{ session('success_feedback') }}</span>

                    <button @click="showToast = false"
                        class="ml-4 text-white/70 hover:text-white">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- ERROR TOAST -->
                <div x-show="showErrorToast"
                    style="display: none;"
                    class="fixed bottom-10 right-10 z-[99999] bg-rose-500 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 border border-rose-400 font-medium"
                    x-init="if(showErrorToast) setTimeout(() => showErrorToast = false, 5000)">

                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center shrink-0">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>

                    <span>{{ session('error') }}</span>

                    <button @click="showErrorToast = false"
                        class="ml-4 text-white/70 hover:text-white">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- BOTTOM BAR -->
    <div class="bg-[#111111] relative overflow-hidden flex items-center min-h-[90px] mb-0 pb-0">

        <!-- LEFT SHAPE -->
        <div class="absolute left-0 top-0 bottom-0 w-[25%] md:w-[20%] bg-yellow-400 hidden sm:block"
            style="clip-path: polygon(0 0, 100% 100%, 0 100%);"></div>

        <div class="absolute left-0 top-0 bottom-0 w-[35%] md:w-[30%] bg-yellow-400 hidden sm:block"
            style="clip-path: polygon(0 100%, 75% 100%, 25% 0, 0 0);"></div>

        <!-- RIGHT SHAPE -->
        <div class="absolute right-0 top-0 bottom-0 w-[35%] md:w-[30%] bg-yellow-400 hidden sm:block"
            style="clip-path: polygon(100% 100%, 25% 100%, 75% 0, 100% 0);"></div>

        <!-- COPYRIGHT -->
        <div
            class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center items-center text-white font-semibold text-[11px] lg:text-xs uppercase tracking-[0.15em] py-6">
            <span>&copy; {{ date('Y') }} PB PORSEROSI. ALL RIGHTS RESERVED.</span>
        </div>
    </div>

</footer>