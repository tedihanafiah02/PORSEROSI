@extends('front.master')

@section('title', __('messages.form_title') . ' ' . __('messages.form_title_highlight') . ' | PB PORSEROSI')
@section('description', __('messages.form_subtitle'))

@section('content')
<div class="font-[Poppins] bg-[#181836] text-white flex flex-col flex-grow min-h-screen">
        <x-navbar />

        {{-- Hero Header --}}
        <div class="relative pt-32 pb-16 md:pt-40 md:pb-24 text-center overflow-hidden">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-yellow-500/20 blur-[120px] rounded-full pointer-events-none"></div>
            
            <div class="relative z-10 px-4">
                <span class="inline-flex items-center gap-2 py-1 px-3 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 text-sm font-semibold tracking-wider mb-4 uppercase">
                    <i class="fas fa-clipboard-list"></i>
                    {{ __('messages.form_official') }}
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                    {{ __('messages.form_title') }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">{{ __('messages.form_title_highlight') }}</span>
                </h1>
                <p class="text-slate-400 text-base md:text-lg max-w-2xl mx-auto mb-8">
                    {{ __('messages.form_subtitle') }}
                </p>

                <div class="animated-border-box animate-soft-bounce rounded-full p-[1.5px] inline-flex mb-8">
                    <a href="{{ route('front.daftar.wasitPelatih.status') }}" class="animated-border-box-inner inline-flex items-center gap-2 px-6 py-3 bg-[#181836] rounded-full text-slate-300 hover:text-white transition-all text-sm font-semibold">
                        <i class="fas fa-search"></i>
                        Sudah Daftar? Cek Status Pendaftaran Anda
                    </a>
                </div>
            </div>
        </div>

        {{-- Form Section --}}
        <div class="max-w-4xl mx-auto px-5 lg:px-8 pb-20 relative z-10">
            @if(session('success'))
                <div class="mb-8 p-6 bg-green-500/10 border border-green-500/30 rounded-2xl flex items-start gap-4">
                    <div class="p-2 bg-green-500 rounded-full text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-green-400 mb-1">{{ __('messages.form_success') }}</h3>
                        <p class="text-slate-300">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-8 p-6 bg-red-500/10 border border-red-500/30 rounded-2xl flex items-start gap-4">
                    <div class="p-2 bg-red-500 rounded-full text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-red-400 mb-1">Gagal!</h3>
                        <p class="text-slate-300">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @if(session('info'))
                <div class="mb-8 p-6 bg-blue-500/10 border border-blue-500/30 rounded-2xl flex items-start gap-4">
                    <div class="p-2 bg-blue-500 rounded-full text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-blue-400 mb-1">Informasi</h3>
                        <p class="text-slate-300">{{ session('info') }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('front.daftar.wasitPelatih.store') }}" method="POST" enctype="multipart/form-data" class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-10 shadow-2xl backdrop-blur-sm">
                @csrf

                <!-- Honeypot Anti-Spam Bot Protection -->
                <div style="display: none;" aria-hidden="true">
                    <input type="text" name="website" tabindex="-1" autocomplete="off" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Nama Lengkap --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-300 mb-2">{{ __('messages.form_name') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                               class="w-full bg-[#181836] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-colors">
                        @error('nama_lengkap') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- NIK --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">{{ __('messages.form_nik') }} <span class="text-red-500">*</span></label>
                        <input type="number" name="nik" value="{{ old('nik') }}" required
                               class="w-full bg-[#181836] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-colors">
                        @error('nik') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- No WA --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">{{ __('messages.form_whatsapp') }} <span class="text-red-500">*</span></label>
                        <input type="number" name="no_wa" value="{{ old('no_wa') }}" required
                               class="w-full bg-[#181836] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-colors">
                        @error('no_wa') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Tempat Lahir --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">{{ __('messages.form_birthplace') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                               class="w-full bg-[#181836] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-colors">
                        @error('tempat_lahir') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">{{ __('messages.form_birthdate') }} <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                               class="w-full bg-[#181836] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-colors [color-scheme:dark]">
                        @error('tanggal_lahir') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">{{ __('messages.form_gender') }} <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" required
                                class="w-full bg-[#181836] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-colors">
                            <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>{{ __('messages.form_gender_select') }}</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>{{ __('messages.form_gender_male') }}</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>{{ __('messages.form_gender_female') }}</option>
                        </select>
                        @error('jenis_kelamin') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">{{ __('messages.email') }}</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full bg-[#181836] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-colors">
                        @error('email') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2 my-4 border-t border-white/10"></div>

                    {{-- Provinsi --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">{{ __('messages.form_province') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="provinsi" value="{{ old('provinsi') }}" required
                               class="w-full bg-[#181836] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-colors">
                        @error('provinsi') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Kab/Kota --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">{{ __('messages.form_city') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="kabupaten_kota" value="{{ old('kabupaten_kota') }}" required
                               class="w-full bg-[#181836] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-colors">
                        @error('kabupaten_kota') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Klub --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-300 mb-2">{{ __('messages.form_club') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="klub_asal" value="{{ old('klub_asal') }}" required
                               class="w-full bg-[#181836] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-colors">
                        @error('klub_asal') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2 my-4 border-t border-white/10"></div>

                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">{{ __('messages.form_category') }} <span class="text-red-500">*</span></label>
                        <select name="kategori" required
                                class="w-full bg-[#181836] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-colors">
                            <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>{{ __('messages.form_category_select') }}</option>
                            <option value="Wasit" {{ old('kategori') == 'Wasit' ? 'selected' : '' }}>{{ __('messages.form_category_referee') }}</option>
                            <option value="Pelatih" {{ old('kategori') == 'Pelatih' ? 'selected' : '' }}>{{ __('messages.form_category_coach') }}</option>
                        </select>
                        @error('kategori') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Lisensi --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">{{ __('messages.form_license') }} <span class="text-red-500">*</span></label>
                        <select name="lisensi" required
                                class="w-full bg-[#181836] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-colors">
                            <option value="" disabled {{ old('lisensi') ? '' : 'selected' }}>{{ __('messages.form_license_select') }}</option>
                            <option value="Belum Ada" {{ old('lisensi') == 'Belum Ada' ? 'selected' : '' }}>{{ __('messages.form_license_none') }}</option>
                            <option value="Daerah" {{ old('lisensi') == 'Daerah' ? 'selected' : '' }}>{{ __('messages.form_license_regional') }}</option>
                            <option value="Nasional" {{ old('lisensi') == 'Nasional' ? 'selected' : '' }}>{{ __('messages.form_license_national') }}</option>
                            <option value="Internasional" {{ old('lisensi') == 'Internasional' ? 'selected' : '' }}>{{ __('messages.form_license_international') }}</option>
                        </select>
                        @error('lisensi') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2 my-4 border-t border-white/10"></div>

                    {{-- Pas Foto --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">{{ __('messages.form_photo') }} <span class="text-red-500">*</span></label>
                        <input type="file" name="foto_path" accept="image/jpeg,image/png,image/jpg" required
                               class="w-full bg-[#181836] border border-white/10 rounded-xl px-4 py-3 text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-500/10 file:text-yellow-400 hover:file:bg-yellow-500/20 cursor-pointer">
                        @error('foto_path') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                        <p class="text-xs text-slate-500 mt-2">{{ __('messages.form_photo_note') }}</p>
                    </div>

                    {{-- Sertifikat --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">{{ __('messages.form_certificate') }}</label>
                        <input type="file" name="sertifikat_path" accept=".pdf,image/jpeg,image/png,image/jpg"
                               class="w-full bg-[#181836] border border-white/10 rounded-xl px-4 py-3 text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-white/10 file:text-white hover:file:bg-white/20 cursor-pointer">
                        @error('sertifikat_path') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                        <p class="text-xs text-slate-500 mt-2">{{ __('messages.form_certificate_note') }}</p>
                    </div>

                    {{-- Submit Button --}}
                    <div class="md:col-span-2 mt-6">
                        <button type="submit" class="w-full md:w-auto px-8 py-4 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-400 hover:to-yellow-500 text-black font-bold rounded-xl shadow-[0_0_20px_rgba(234,179,8,0.3)] transition-all hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(234,179,8,0.5)] flex items-center justify-center gap-2">
                            <i class="fas fa-paper-plane"></i>
                            {{ __('messages.form_submit') }}
                        </button>
                    </div>
                </div>
            </form>
        {{-- Akhir Form Section --}}
        </div>

        <x-footer />
    </div>
@endsection

@push('after-styles')
<style>
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    @keyframes softBounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-6px); }
    }
    .animate-soft-bounce {
        animation: softBounce 3s ease-in-out infinite;
        display: inline-flex;
    }
    .animated-border-box {
        position: relative;
        padding: 2px;
        overflow: hidden;
        display: inline-flex;
    }
    .animated-border-box::before {
        content: '';
        position: absolute;
        top: -100%;
        left: -100%;
        width: 300%;
        height: 300%;
        background: conic-gradient(
            from 0deg, 
            transparent 0%, 
            transparent 25%, 
            #fbbf24 30%, 
            #d97706 35%, 
            transparent 40%, 
            transparent 100%
        );
        animation: rotate 4s linear infinite;
    }
    .animated-border-box-inner {
        position: relative;
        z-index: 1;
        width: 100%;
        height: 100%;
    }
</style>
@endpush
