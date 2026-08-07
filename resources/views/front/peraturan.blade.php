@extends('front.master')

@section('title', (app()->getLocale() === 'en' ? 'Official Regulations' : 'Peraturan Resmi') . ' | PB PORSEROSI')

@section('content')
    <div class="font-[Poppins] text-slate-200 flex flex-col flex-grow min-h-screen bg-[#0d0d1f]">
        <x-navbar />

        {{-- Header Section --}}
        <div class="relative pt-32 pb-12 md:pt-40 md:pb-16 text-center overflow-hidden">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-yellow-500/10 blur-[120px] rounded-full pointer-events-none"></div>
            
            <div class="relative z-10 px-4 max-w-4xl mx-auto">
                <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 text-xs font-extrabold tracking-widest mb-4 uppercase">
                    PB PORSEROSI
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 uppercase tracking-tight">
                    {{ app()->getLocale() === 'en' ? 'Official Regulations' : 'Peraturan Resmi' }}
                </h1>
                <p class="text-slate-400 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                    {{ app()->getLocale() === 'en' 
                        ? 'Download official rules, bylaws, AD/ART, and tournament guidelines of the Executive Board of the Indonesian Roller Skating Sports Association (PB PORSEROSI).' 
                        : 'Unduh berkas peraturan resmi, AD/ART, keputusan, dan panduan teknis perlombaan dari Pengurus Besar Persatuan Olahraga Sepatu Roda Seluruh Indonesia (PB PORSEROSI).' 
                    }}
                </p>
            </div>
        </div>

        {{-- Content Section --}}
        <div class="relative pb-24 z-10">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                
                @if($folders->isEmpty() && $rootRegulations->isEmpty())
                    <div class="text-center py-20 bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl p-8 max-w-lg mx-auto" data-aos="fade-up">
                        <svg class="w-16 h-16 text-yellow-500/40 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-slate-400 text-sm">
                            {{ app()->getLocale() === 'en' 
                                ? 'No regulations available at this moment.' 
                                : 'Dokumen peraturan belum tersedia saat ini.' 
                            }}
                        </p>
                    </div>
                @else
                    {{-- Search Bar --}}
                    <div class="mb-8" data-aos="fade-up">
                        <div class="relative max-w-md mx-auto">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </span>
                            <input type="text" id="search-input" oninput="performSearch()" placeholder="{{ app()->getLocale() === 'en' ? 'Search official regulations...' : 'Cari peraturan resmi...' }}" class="w-full pl-11 pr-4 py-3 bg-[#181836]/60 border border-white/5 focus:border-yellow-500/50 rounded-2xl text-slate-100 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-yellow-500/20 backdrop-blur-md shadow-xl transition-all duration-300">
                        </div>
                    </div>

                    {{-- Search Results Fallback Alert --}}
                    <div id="no-search-results" class="hidden text-center py-16 bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl p-8 max-w-lg mx-auto" data-aos="fade-up">
                        <svg class="w-16 h-16 text-yellow-500/40 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-slate-400 text-sm">
                            {{ app()->getLocale() === 'en' 
                                ? 'No documents match your search.' 
                                : 'Tidak ada dokumen yang cocok dengan pencarian Anda.' 
                            }}
                        </p>
                    </div>

                    {{-- Regulations List Container --}}
                    <div id="regulations-container">
                        
                        {{-- 1. Folder Section --}}
                        @if($folders->isNotEmpty())
                            <div class="space-y-4 mb-10">
                                @foreach($folders as $folder)
                                    <div class="folder-card bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-2xl overflow-hidden shadow-lg transition-all duration-300 hover:border-white/10" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                                        
                                        {{-- Folder Header / Trigger --}}
                                        <button onclick="toggleFolder({{ $folder->id }})" class="folder-btn w-full flex items-center justify-between p-5 text-left focus:outline-none group" data-name="{{ strtolower($folder->getLocalizedName()) }}">
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 group-hover:bg-yellow-500 group-hover:text-[#0d0d1f] transition-all duration-300">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h3 class="text-base font-extrabold text-white group-hover:text-yellow-400 transition-colors duration-300">
                                                        {{ $folder->getLocalizedName() }}
                                                    </h3>
                                                    <span class="text-xs text-slate-400 font-semibold">
                                                        {{ $folder->regulations->count() }} {{ app()->getLocale() === 'en' ? ($folder->regulations->count() > 1 ? 'Files' : 'File') : 'Dokumen' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="text-slate-400 group-hover:text-white transition-colors">
                                                <svg id="chevron-{{ $folder->id }}" class="w-6 h-6 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </div>
                                        </button>

                                        {{-- Folder Contents --}}
                                        <div id="content-{{ $folder->id }}" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-[#0f0f29]/30">
                                            <div class="p-5 pt-0 border-t border-white/5 divide-y divide-white/5">
                                                @if($folder->regulations->isEmpty())
                                                    <p class="text-slate-500 text-xs py-4 italic">
                                                        {{ app()->getLocale() === 'en' ? 'No files inside this folder.' : 'Tidak ada berkas di dalam folder ini.' }}
                                                    </p>
                                                @else
                                                    @foreach($folder->regulations as $regulation)
                                                        <div class="file-row flex flex-col sm:flex-row sm:items-center justify-between gap-4 py-4 first:pt-4 last:pb-0" data-title="{{ strtolower($regulation->getLocalizedTitle()) }}">
                                                            <div class="flex items-start gap-3">
                                                                <div class="w-8 h-8 mt-0.5 flex items-center justify-center rounded-lg bg-pink-500/10 text-pink-500 shrink-0">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                                    </svg>
                                                                </div>
                                                                <div>
                                                                    <h4 class="text-sm font-bold text-slate-200">
                                                                        {{ $regulation->getLocalizedTitle() }}
                                                                    </h4>
                                                                    <span class="text-[10px] text-slate-500 uppercase font-bold tracking-wider">PDF Document</span>
                                                                </div>
                                                            </div>
                                                            <a href="{{ Storage::url($regulation->file_path) }}" download class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-yellow-500/10 hover:bg-yellow-500 text-yellow-500 hover:text-[#0d0d1f] border border-yellow-500/20 hover:border-transparent rounded-xl text-xs font-extrabold transition-all duration-300 shrink-0">
                                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                                </svg>
                                                                {{ app()->getLocale() === 'en' ? 'Download' : 'Unduh' }}
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- 2. Root Level Regulations Section --}}
                        @if($rootRegulations->isNotEmpty())
                            <div class="root-section-wrapper mt-8">
                                <h2 class="text-lg font-extrabold text-white mb-4 uppercase tracking-wider pl-2 border-l-4 border-yellow-500">
                                    {{ app()->getLocale() === 'en' ? 'General Documents' : 'Dokumen Umum' }}
                                </h2>
                                <div class="bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-2xl p-5 divide-y divide-white/5 shadow-lg">
                                    @foreach($rootRegulations as $regulation)
                                        <div class="root-file-row flex flex-col sm:flex-row sm:items-center justify-between gap-4 py-4 first:pt-0 last:pb-0" data-title="{{ strtolower($regulation->getLocalizedTitle()) }}">
                                            <div class="flex items-start gap-3">
                                                <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-pink-500/10 text-pink-500 shrink-0">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h4 class="text-sm md:text-base font-bold text-slate-200">
                                                        {{ $regulation->getLocalizedTitle() }}
                                                    </h4>
                                                    <span class="text-[10px] text-slate-500 uppercase font-bold tracking-wider">PDF Document</span>
                                                </div>
                                            </div>
                                            <a href="{{ Storage::url($regulation->file_path) }}" download class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-yellow-500/10 hover:bg-yellow-500 text-yellow-500 hover:text-[#0d0d1f] border border-yellow-500/20 hover:border-transparent rounded-xl text-xs font-extrabold transition-all duration-300 shrink-0">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                </svg>
                                                {{ app()->getLocale() === 'en' ? 'Download' : 'Unduh' }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                @endif

            </div>
        </div>

        <x-footer />
    </div>

    {{-- JS Toggle & Search --}}
    <script>
        function toggleFolder(id) {
            const content = document.getElementById('content-' + id);
            const chevron = document.getElementById('chevron-' + id);
            
            if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                content.style.maxHeight = '0px';
                chevron.classList.remove('rotate-180');
            } else {
                // Close all other folders first for clean accordion behavior
                document.querySelectorAll('[id^="content-"]').forEach(el => {
                    if (el.id !== 'content-' + id) {
                        el.style.maxHeight = '0px';
                    }
                });
                document.querySelectorAll('[id^="chevron-"]').forEach(el => {
                    if (el.id !== 'chevron-' + id) {
                        el.classList.remove('rotate-180');
                    }
                });

                // Open selected folder
                content.style.maxHeight = content.scrollHeight + 'px';
                chevron.classList.add('rotate-180');
            }
        }

        function performSearch() {
            const query = document.getElementById('search-input').value.toLowerCase().trim();
            const folders = document.querySelectorAll('.folder-card');
            const rootFiles = document.querySelectorAll('.root-file-row');
            const rootSection = document.querySelector('.root-section-wrapper');
            const noResultsAlert = document.getElementById('no-search-results');
            
            let visibleFoldersCount = 0;
            let visibleRootFilesCount = 0;

            // 1. Filter Folders & Files inside them
            folders.forEach(folder => {
                const folderBtn = folder.querySelector('.folder-btn');
                const folderName = folderBtn.getAttribute('data-name');
                const files = folder.querySelectorAll('.file-row');
                const content = folder.querySelector('[id^="content-"]');
                const chevron = folder.querySelector('[id^="chevron-"]');
                
                let matchesInsideFolder = 0;

                files.forEach(file => {
                    const fileTitle = file.getAttribute('data-title');
                    if (fileTitle.includes(query)) {
                        file.style.display = '';
                        matchesInsideFolder++;
                    } else {
                        file.style.display = 'none';
                    }
                });

                // Folder matches if folder name matches query OR if it has matching files inside
                const folderMatches = folderName.includes(query) || matchesInsideFolder > 0;

                if (folderMatches) {
                    folder.style.display = '';
                    visibleFoldersCount++;
                    
                    // If searching and there are matches, auto-expand the folder
                    if (query.length > 0) {
                        // If folder name matched but no files matched, show all files in it
                        if (matchesInsideFolder === 0) {
                            files.forEach(file => {
                                file.style.display = '';
                            });
                        }
                        content.style.maxHeight = content.scrollHeight + 'px';
                        chevron.classList.add('rotate-180');
                    } else {
                        // Reset folder collapse state when search is cleared
                        content.style.maxHeight = '0px';
                        chevron.classList.remove('rotate-180');
                    }
                } else {
                    folder.style.display = 'none';
                }
            });

            // 2. Filter Root Level Files
            let matchesInRoot = 0;
            rootFiles.forEach(file => {
                const fileTitle = file.getAttribute('data-title');
                if (fileTitle.includes(query)) {
                    file.style.display = '';
                    matchesInRoot++;
                    visibleRootFilesCount++;
                } else {
                    file.style.display = 'none';
                }
            });

            // Hide/Show general documents section header based on matches
            if (rootSection) {
                if (matchesInRoot > 0) {
                    rootSection.style.display = '';
                } else {
                    rootSection.style.display = 'none';
                }
            }

            // 3. Show "No results" alert if total visible items is 0
            if (visibleFoldersCount === 0 && visibleRootFilesCount === 0) {
                noResultsAlert.classList.remove('hidden');
            } else {
                noResultsAlert.classList.add('hidden');
            }
        }
    </script>
@endsection
