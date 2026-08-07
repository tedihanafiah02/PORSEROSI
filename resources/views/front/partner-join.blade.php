@extends('front.master')

@section('title', (app()->getLocale() === 'en' ? 'Become a Partner' : 'Menjadi Partner') . ' | PB PORSEROSI')
@section('description', app()->getLocale() === 'en' ? 'Apply to become a PB PORSEROSI partner' : 'Ajukan kemitraan dengan PB PORSEROSI')

@section('content')
<div class="font-[Poppins] overflow-hidden bg-[#0d0d1f] flex flex-col flex-grow min-h-screen">
    <x-navbar />

    {{-- Hero --}}
    <div class="relative pt-32 pb-10 md:pt-44 md:pb-16">
        <div class="absolute inset-0 bg-gradient-to-br from-[#0d0d1f] via-[#13132e] to-[#1a1a3e]"></div>
        <div class="absolute top-10 left-0 w-[500px] h-[500px] bg-yellow-500/5 rounded-full blur-[150px] pointer-events-none"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in" data-aos-duration="800">
            <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 text-xs font-extrabold tracking-widest uppercase mb-5">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                {{ app()->getLocale() === 'en' ? 'Partner Registration' : 'Pendaftaran Partner' }}
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 uppercase tracking-tight">
                {{ app()->getLocale() === 'en' ? 'Join Our Partnership' : 'Bergabung Sebagai Partner' }}
            </h1>
            <p class="text-slate-400 text-sm md:text-base max-w-xl mx-auto leading-relaxed">
                {{ app()->getLocale() === 'en' 
                    ? 'Fill in the form below to submit your partnership application. Please login with your Google account first.' 
                    : 'Isi formulir di bawah untuk mengajukan kemitraan. Silakan login dengan akun Google Anda terlebih dahulu.' }}
            </p>
        </div>
    </div>

    {{-- Content --}}
    <section class="py-10 md:py-16 relative z-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Flash Messages --}}
            @if(session('success_partner'))
                <div class="mb-8 p-6 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 backdrop-blur-md" data-aos="fade-up">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h3 class="text-emerald-400 font-bold text-sm mb-1">{{ app()->getLocale() === 'en' ? 'Application Submitted!' : 'Pengajuan Terkirim!' }}</h3>
                            <p class="text-emerald-300/70 text-sm">{{ session('success_partner') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-8 p-6 rounded-2xl bg-red-500/10 border border-red-500/20 backdrop-blur-md" data-aos="fade-up">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-red-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </div>
                        <div>
                            <h3 class="text-red-400 font-bold text-sm mb-1">{{ app()->getLocale() === 'en' ? 'Error' : 'Gagal' }}</h3>
                            <p class="text-red-300/70 text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                
                {{-- Left Sidebar: Steps + Login --}}
                <div class="lg:col-span-2 space-y-6" data-aos="fade-right">
                    
                    {{-- Login Card --}}
                    <div class="bg-[#181836]/60 backdrop-blur-md border border-white/5 rounded-3xl p-6 md:p-8">
                        <h3 class="text-base font-bold text-white mb-4 flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-yellow-500 flex items-center justify-center text-xs font-black text-[#0d0d1f]">1</span>
                            {{ app()->getLocale() === 'en' ? 'Login First' : 'Login Terlebih Dahulu' }}
                        </h3>
                        
                        @auth
                            <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 mb-4">
                                @if(auth()->user()->avatar_url)
                                    <img src="{{ auth()->user()->avatar_url }}" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-emerald-500/50">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold text-sm">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <p class="text-white text-sm font-bold">{{ auth()->user()->name }}</p>
                                    <p class="text-emerald-400/70 text-[11px]">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 text-emerald-400 text-xs font-bold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                {{ app()->getLocale() === 'en' ? 'Logged in with Google' : 'Berhasil login dengan Google' }}
                            </div>

                            @if(isset($partners) && $partners->isNotEmpty())
                                <div class="mt-6 pt-6 border-t border-white/10">
                                    <h4 class="text-xs font-bold text-slate-400 mb-3 uppercase tracking-wider">
                                        {{ app()->getLocale() === 'en' ? 'Application Status' : 'Status Pengajuan' }}
                                    </h4>
                                    <div class="space-y-3">
                                        @foreach($partners as $partner)
                                            <div class="p-3.5 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-between">
                                                <div class="flex items-center gap-2.5 min-w-0">
                                                    <img src="{{ get_image_url($partner->logo_path) }}" alt="{{ $partner->name }}" class="w-8 h-8 rounded-lg object-cover bg-white/10 shrink-0">
                                                    <div class="min-w-0">
                                                        <p class="text-white text-xs font-bold truncate">{{ $partner->name }}</p>
                                                        <p class="text-[10px] text-slate-400 leading-tight">
                                                            {{ \Carbon\Carbon::parse($partner->created_at)->translatedFormat('d M Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div>
                                                    @if($partner->status === 'active')
                                                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-full border border-emerald-500/20">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                                            Active / {{ app()->getLocale() === 'en' ? 'Approved' : 'Disetujui' }}
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-amber-400 bg-amber-500/10 px-2.5 py-1 rounded-full border border-amber-500/20">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                                            Pending / {{ app()->getLocale() === 'en' ? 'Reviewing' : 'Belum Disetujui' }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @else
                            <p class="text-slate-400 text-xs mb-4 leading-relaxed">
                                {{ app()->getLocale() === 'en' 
                                    ? 'You need to login with your Google account to submit a partnership application.' 
                                    : 'Anda harus login dengan akun Google untuk mengajukan kemitraan.' }}
                            </p>
                            <a href="{{ route('auth.google') }}?redirect_to={{ urlencode(route('front.partner.join')) }}" class="flex items-center justify-center gap-3 w-full py-3.5 rounded-2xl bg-white text-gray-800 font-bold text-sm hover:bg-gray-100 transition-all duration-300 shadow-lg">
                                <svg class="w-5 h-5" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                                {{ app()->getLocale() === 'en' ? 'Login with Google' : 'Login dengan Google' }}
                            </a>
                        @endauth
                    </div>

                    {{-- Steps Card --}}
                    <div class="bg-[#181836]/60 backdrop-blur-md border border-white/5 rounded-3xl p-6 md:p-8">
                        <h3 class="text-base font-bold text-white mb-5 flex items-center gap-3">
                            <i class="fas fa-list-ol text-yellow-500 text-sm"></i>
                            {{ app()->getLocale() === 'en' ? 'How It Works' : 'Cara Pendaftaran' }}
                        </h3>
                        <div class="space-y-4">
                            @php
                                $steps = app()->getLocale() === 'en' 
                                    ? [
                                        ['icon' => 'fab fa-google', 'title' => 'Login with Google', 'desc' => 'Authenticate with your Google account'],
                                        ['icon' => 'fas fa-edit', 'title' => 'Fill the Form', 'desc' => 'Complete the partner registration form'],
                                        ['icon' => 'fas fa-paper-plane', 'title' => 'Submit Application', 'desc' => 'Send your application for review'],
                                        ['icon' => 'fas fa-check-circle', 'title' => 'Wait for Approval', 'desc' => 'Our team will review and respond'],
                                    ]
                                    : [
                                        ['icon' => 'fab fa-google', 'title' => 'Login dengan Google', 'desc' => 'Autentikasi dengan akun Google Anda'],
                                        ['icon' => 'fas fa-edit', 'title' => 'Isi Formulir', 'desc' => 'Lengkapi formulir pendaftaran partner'],
                                        ['icon' => 'fas fa-paper-plane', 'title' => 'Kirim Pengajuan', 'desc' => 'Kirim pengajuan untuk ditinjau'],
                                        ['icon' => 'fas fa-check-circle', 'title' => 'Tunggu Persetujuan', 'desc' => 'Tim kami akan meninjau dan merespons'],
                                    ];
                            @endphp
                            @foreach($steps as $idx => $step)
                                <div class="flex gap-4 items-start">
                                    <div class="w-9 h-9 rounded-xl {{ $idx === 0 ? 'bg-yellow-500 text-[#0d0d1f]' : 'bg-white/5 text-slate-400' }} flex items-center justify-center shrink-0">
                                        <i class="{{ $step['icon'] }} text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-white text-sm font-bold">{{ $step['title'] }}</p>
                                        <p class="text-slate-500 text-[11px]">{{ $step['desc'] }}</p>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                    <div class="ml-4 h-4 border-l border-dashed border-white/10"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    {{-- Back to Partners --}}
                    <a href="{{ route('front.partner') }}" class="flex items-center gap-2 text-slate-400 text-sm hover:text-yellow-400 transition-colors duration-300 px-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        {{ app()->getLocale() === 'en' ? 'Back to Partner List' : 'Kembali ke Daftar Partner' }}
                    </a>
                </div>

                {{-- Right: Form --}}
                <div class="lg:col-span-3" data-aos="fade-left">
                    <div class="bg-[#181836]/60 backdrop-blur-md border border-white/5 rounded-3xl p-6 md:p-8">
                        <h3 class="text-lg font-bold text-white mb-1 flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-yellow-500 flex items-center justify-center text-xs font-black text-[#0d0d1f]">2</span>
                            {{ app()->getLocale() === 'en' ? 'Partner Registration Form' : 'Formulir Pendaftaran Partner' }}
                        </h3>
                        <p class="text-slate-500 text-xs mb-8 pl-10">
                            {{ app()->getLocale() === 'en' ? 'Fill in all required fields marked with *' : 'Isi semua field yang ditandai dengan *' }}
                        </p>

                        @auth
                            <form action="{{ route('front.partner.join.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                                @csrf

                                {{-- Organization Name --}}
                                <div>
                                    <label class="text-white text-xs font-bold mb-2 block">
                                        {{ app()->getLocale() === 'en' ? 'Organization / Company Name' : 'Nama Organisasi / Perusahaan' }} <span class="text-red-400">*</span>
                                    </label>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                        class="w-full px-5 py-3.5 rounded-2xl bg-[#0d0d1f] border border-white/10 text-white text-sm placeholder-slate-600 focus:border-yellow-500/50 focus:ring-2 focus:ring-yellow-500/10 outline-none transition-all"
                                        placeholder="{{ app()->getLocale() === 'en' ? 'e.g. PT Sukses Bersama' : 'cth. PT Sukses Bersama' }}">
                                    @error('name') <p class="text-red-400 text-[11px] mt-1.5 pl-1">{{ $message }}</p> @enderror
                                </div>

                                {{-- Description --}}
                                <div>
                                    <label class="text-white text-xs font-bold mb-2 block">
                                        {{ app()->getLocale() === 'en' ? 'Organization Description' : 'Deskripsi Organisasi' }} <span class="text-red-400">*</span>
                                    </label>
                                    <textarea name="description" rows="4" required
                                        class="w-full px-5 py-3.5 rounded-2xl bg-[#0d0d1f] border border-white/10 text-white text-sm placeholder-slate-600 focus:border-yellow-500/50 focus:ring-2 focus:ring-yellow-500/10 outline-none transition-all resize-none"
                                        placeholder="{{ app()->getLocale() === 'en' ? 'Describe your organization and how you can support PORSEROSI...' : 'Jelaskan organisasi Anda dan bagaimana Anda dapat mendukung PORSEROSI...' }}">{{ old('description') }}</textarea>
                                    @error('description') <p class="text-red-400 text-[11px] mt-1.5 pl-1">{{ $message }}</p> @enderror
                                </div>

                                {{-- Two Column: Contact Name + WhatsApp --}}
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-white text-xs font-bold mb-2 block">
                                            {{ app()->getLocale() === 'en' ? 'Contact Person' : 'Nama Kontak' }} <span class="text-red-400">*</span>
                                        </label>
                                        <input type="text" name="contact_name" value="{{ old('contact_name', auth()->user()->name) }}" required
                                            class="w-full px-5 py-3.5 rounded-2xl bg-[#0d0d1f] border border-white/10 text-white text-sm placeholder-slate-600 focus:border-yellow-500/50 focus:ring-2 focus:ring-yellow-500/10 outline-none transition-all"
                                            placeholder="{{ app()->getLocale() === 'en' ? 'Full Name' : 'Nama Lengkap' }}">
                                        @error('contact_name') <p class="text-red-400 text-[11px] mt-1.5 pl-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="text-white text-xs font-bold mb-2 block">
                                            {{ app()->getLocale() === 'en' ? 'WhatsApp Number' : 'Nomor WhatsApp' }} <span class="text-red-400">*</span>
                                        </label>
                                        <div class="relative">
                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"><i class="fab fa-whatsapp text-emerald-400"></i></span>
                                            <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number') }}" required
                                                class="w-full pl-10 pr-5 py-3.5 rounded-2xl bg-[#0d0d1f] border border-white/10 text-white text-sm placeholder-slate-600 focus:border-yellow-500/50 focus:ring-2 focus:ring-yellow-500/10 outline-none transition-all"
                                                placeholder="08xxxxxxxxxx">
                                        </div>
                                        @error('whatsapp_number') <p class="text-red-400 text-[11px] mt-1.5 pl-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                {{-- Website Link --}}
                                <div>
                                    <label class="text-white text-xs font-bold mb-2 block">
                                        {{ app()->getLocale() === 'en' ? 'Website URL' : 'Link Website' }} <span class="text-slate-600 text-[10px] font-normal">({{ app()->getLocale() === 'en' ? 'Optional' : 'Opsional' }})</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"><i class="fas fa-link"></i></span>
                                        <input type="url" name="link" value="{{ old('link') }}"
                                            class="w-full pl-10 pr-5 py-3.5 rounded-2xl bg-[#0d0d1f] border border-white/10 text-white text-sm placeholder-slate-600 focus:border-yellow-500/50 focus:ring-2 focus:ring-yellow-500/10 outline-none transition-all"
                                            placeholder="https://www.example.com">
                                    </div>
                                    @error('link') <p class="text-red-400 text-[11px] mt-1.5 pl-1">{{ $message }}</p> @enderror
                                </div>

                                {{-- Logo Upload --}}
                                <div>
                                    <label class="text-white text-xs font-bold mb-2 block">
                                        {{ app()->getLocale() === 'en' ? 'Organization Logo' : 'Logo Organisasi' }} <span class="text-red-400">*</span>
                                    </label>
                                    <div class="relative" x-data="{ fileName: '' }">
                                        <label class="flex items-center gap-4 cursor-pointer p-4 rounded-2xl bg-[#0d0d1f] border border-dashed border-white/10 hover:border-yellow-500/30 transition-all duration-300 group">
                                            <div class="w-12 h-12 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center shrink-0 group-hover:bg-yellow-500/20 transition-all">
                                                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                            <div>
                                                <p class="text-white text-sm font-bold" x-text="fileName || '{{ app()->getLocale() === 'en' ? 'Click to upload logo' : 'Klik untuk upload logo' }}'"></p>
                                                <p class="text-slate-500 text-[10px]">JPG, PNG, WebP • Max 2MB</p>
                                            </div>
                                            <input type="file" name="logo" accept="image/jpeg,image/png,image/webp" required class="hidden" x-on:change="fileName = $event.target.files[0]?.name || ''">
                                        </label>
                                    </div>
                                    @error('logo') <p class="text-red-400 text-[11px] mt-1.5 pl-1">{{ $message }}</p> @enderror
                                </div>

                                {{-- Submit Button --}}
                                <div class="pt-3">
                                    <button type="submit" class="w-full py-4 rounded-2xl bg-gradient-to-r from-yellow-500 to-amber-500 text-[#0d0d1f] font-extrabold text-sm hover:shadow-[0_0_30px_rgba(234,179,8,0.3)] hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2.5">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                        {{ app()->getLocale() === 'en' ? 'Submit Application' : 'Kirim Pengajuan' }}
                                    </button>
                                </div>
                            </form>
                        @else
                            {{-- Not Logged In State --}}
                            <div class="text-center py-10">
                                <div class="w-20 h-20 rounded-full bg-yellow-500/10 flex items-center justify-center mx-auto mb-5">
                                    <i class="fas fa-lock text-yellow-500 text-2xl"></i>
                                </div>
                                <h4 class="text-white font-bold text-lg mb-2">
                                    {{ app()->getLocale() === 'en' ? 'Login Required' : 'Login Diperlukan' }}
                                </h4>
                                <p class="text-slate-400 text-sm mb-6 max-w-sm mx-auto">
                                    {{ app()->getLocale() === 'en' 
                                        ? 'Please login with your Google account first using the button on the left to access the registration form.' 
                                        : 'Silakan login terlebih dahulu dengan akun Google Anda menggunakan tombol di sebelah kiri untuk mengakses formulir pendaftaran.' }}
                                </p>
                                {{-- Mobile: Show Google Login here too --}}
                                <a href="{{ route('auth.google') }}?redirect_to={{ urlencode(route('front.partner.join')) }}" class="lg:hidden inline-flex items-center justify-center gap-3 px-8 py-3.5 rounded-2xl bg-white text-gray-800 font-bold text-sm hover:bg-gray-100 transition-all duration-300 shadow-lg">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                                    {{ app()->getLocale() === 'en' ? 'Login with Google' : 'Login dengan Google' }}
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>

            </div>
        </div>
    </section>

    <x-footer />
</div>
@endsection

