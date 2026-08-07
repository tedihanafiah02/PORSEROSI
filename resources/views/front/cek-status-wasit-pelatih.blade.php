@extends('front.master')

@section('title', 'Cek Status Pendaftaran Wasit & Pelatih | PB PORSEROSI')

@section('content')
<div class="font-[Poppins] bg-[#181836] text-white flex flex-col flex-grow min-h-screen">
    <x-navbar />

    {{-- Hero Header --}}
    <div class="relative pt-32 pb-16 md:pt-40 md:pb-24 text-center overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-blue-500/10 blur-[120px] rounded-full pointer-events-none"></div>
        
        <div class="relative z-10 px-4">
            <span class="inline-flex items-center gap-2 py-1 px-3 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-sm font-semibold tracking-wider mb-4 uppercase">
                <i class="fas fa-search"></i>
                Tracking Status
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                Cek Status <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">Pendaftaran</span>
            </h1>
            <p class="text-slate-400 text-base md:text-lg max-w-2xl mx-auto">
                Masukkan Nomor Induk Kependudukan (NIK) Anda untuk melihat status pendaftaran Wasit atau Pelatih.
            </p>
        </div>
    </div>

    {{-- Content Section --}}
    <div class="max-w-3xl mx-auto px-5 lg:px-8 pb-20 relative z-10">
        
        {{-- Search Card --}}
        <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-10 shadow-2xl backdrop-blur-sm mb-10">
            <form action="{{ route('front.daftar.wasitPelatih.status') }}" method="GET" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">NIK KTP <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500">
                            <i class="fas fa-id-card"></i>
                        </span>
                        <input type="number" name="nik" value="{{ $nik }}" required placeholder="Contoh: 3201234567890001"
                               class="w-full bg-[#181836] border border-white/10 rounded-xl pl-12 pr-4 py-4 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors text-lg tracking-widest">
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-400 hover:to-blue-500 text-white font-bold rounded-xl shadow-[0_0_20px_rgba(59,130,246,0.3)] transition-all hover:-translate-y-1 flex items-center justify-center gap-2">
                    <i class="fas fa-search"></i>
                    Cek Sekarang
                </button>
            </form>
        </div>

        @if(session('error'))
            <div class="p-6 bg-red-500/10 border border-red-500/30 rounded-2xl flex items-start gap-4 animate-shake">
                <div class="p-2 bg-red-500 rounded-full text-white">
                    <i class="fas fa-times"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-red-400 mb-1">Data Tidak Ditemukan</h3>
                    <p class="text-slate-300">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        @if($registration)
            <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden shadow-2xl animate-fade-in mb-10">
                <div class="p-6 md:p-8 border-b border-white/10 bg-white/[0.04] flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl overflow-hidden border-2 border-white/10">
                            <img src="{{ get_image_url($registration->foto_path) }}" alt="Foto" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">{{ $registration->nama_lengkap }}</h2>
                            <p class="text-slate-400 text-sm">{{ $registration->kategori }} - {{ $registration->lisensi }}</p>
                        </div>
                    </div>
                    
                    <div>
                        @if($registration->status === 'pending')
                            <span class="inline-flex items-center gap-2 py-2 px-6 rounded-full bg-yellow-500/10 border border-yellow-500/30 text-yellow-400 font-bold uppercase text-xs tracking-wider">
                                <i class="fas fa-clock"></i>
                                Data Diterima, Sedang Diproses
                            </span>
                        @elseif($registration->status === 'selesai')
                            <span class="inline-flex items-center gap-2 py-2 px-6 rounded-full bg-green-500/10 border border-green-500/30 text-green-400 font-bold uppercase text-xs tracking-wider">
                                <i class="fas fa-check-circle"></i>
                                Pendaftaran Berhasil
                            </span>
                        @elseif($registration->status === 'ditolak')
                            <span class="inline-flex items-center gap-2 py-2 px-6 rounded-full bg-red-500/10 border border-red-500/30 text-red-400 font-bold uppercase text-xs tracking-wider">
                                <i class="fas fa-times-circle"></i>
                                Data Ditolak
                            </span>
                        @endif
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <p class="text-slate-500 text-xs uppercase tracking-widest">Klub Asal</p>
                            <p class="text-slate-200 font-medium">{{ $registration->klub_asal }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-slate-500 text-xs uppercase tracking-widest">Domisili</p>
                            <p class="text-slate-200 font-medium">{{ $registration->kabupaten_kota }}, {{ $registration->provinsi }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-slate-500 text-xs uppercase tracking-widest">Tanggal Update Terakhir</p>
                            <p class="text-slate-200 font-medium">{{ $registration->updated_at->translatedFormat('d F Y H:i') }} WIB</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-slate-500 text-xs uppercase tracking-widest">NIK</p>
                            <p class="text-slate-200 font-medium">{{ substr($registration->nik, 0, 6) . '********' . substr($registration->nik, -2) }}</p>
                        </div>
                    </div>

                    @if($registration->status === 'pending')
                        <div class="mt-8 p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-xl">
                            <p class="text-yellow-400 text-sm flex items-start gap-3">
                                <i class="fas fa-info-circle mt-1"></i>
                                Data pendaftaran Anda telah kami terima dan saat ini sedang dalam tahap peninjauan (proses). Mohon menunggu informasi selanjutnya.
                            </p>
                        </div>
                    @elseif($registration->status === 'selesai')
                        <div class="mt-8 p-4 bg-green-500/10 border border-green-500/20 rounded-xl">
                            <p class="text-green-400 text-sm flex items-start gap-3">
                                <i class="fas fa-check-circle mt-1"></i>
                                Selamat! Pendaftaran Anda telah Berhasil dan dinyatakan valid. Terima kasih atas partisipasinya.
                            </p>
                        </div>
                    @elseif($registration->status === 'ditolak')
                        <div class="mt-8 p-4 bg-red-500/10 border border-red-500/20 rounded-xl">
                            <p class="text-red-400 text-sm flex items-start gap-3">
                                <i class="fas fa-exclamation-circle mt-1"></i>
                                Mohon maaf, data pendaftaran Anda ditolak karena berkas atau informasi yang diberikan kurang valid. Silakan melakukan pendaftaran ulang.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- History Section --}}
            <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden shadow-2xl animate-fade-in delay-200">
                <div class="p-6 md:p-8 border-b border-white/10 bg-white/[0.04]">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <i class="fas fa-history text-blue-400"></i>
                        Riwayat Pendaftaran
                    </h3>
                </div>
                <div class="p-6 md:p-8">
                    <div class="space-y-6">
                        @foreach($history as $item)
                            <div class="flex gap-4 relative {{ !$loop->last ? 'before:absolute before:left-[11px] before:top-8 before:w-[2px] before:h-[calc(100%+8px)] before:bg-white/10' : '' }}">
                                <div class="relative z-10 flex-shrink-0 w-6 h-6 rounded-full border-4 border-[#181836] shadow-[0_0_0_1px_rgba(255,255,255,0.1)]
                                    @if($item->status === 'pending') bg-yellow-500
                                    @elseif($item->status === 'selesai') bg-green-500
                                    @else bg-red-500 @endif">
                                </div>
                                <div class="flex-grow pb-4">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-1 gap-1">
                                        <h4 class="font-bold text-slate-200">
                                            @if($item->status === 'pending') Data Diterima, Sedang Diproses
                                            @elseif($item->status === 'selesai') Pendaftaran Berhasil
                                            @else Data Ditolak @endif
                                        </h4>
                                        <span class="text-xs text-slate-500 font-mono">{{ $item->created_at->translatedFormat('d M Y H:i') }}</span>
                                    </div>
                                    <p class="text-sm text-slate-400">
                                        Pendaftaran sebagai {{ $item->kategori }} ({{ $item->lisensi }}) di klub {{ $item->klub_asal }}.
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    <x-footer />
</div>

<style>
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    .animate-shake {
        animation: shake 0.4s ease-in-out;
    }
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

<!-- masukan semua data ke semua function -->
