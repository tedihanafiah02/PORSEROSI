@extends('front.master')

@section('title', ($currentFolder ? $currentFolder->getLocalizedName() : (app()->getLocale() === 'en' ? 'Championship Results' : 'Hasil Pertandingan')) . ' | PB PORSEROSI')

@section('content')
    <div class="font-[Poppins] text-slate-200 flex flex-col flex-grow min-h-screen bg-[#0d0d1f]">
        <x-navbar />

        {{-- Header Section --}}
        <div class="relative pt-32 pb-12 md:pt-40 md:pb-16 text-center overflow-hidden">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-yellow-500/10 blur-[120px] rounded-full pointer-events-none"></div>
            
            <div class="relative z-10 px-4 max-w-4xl mx-auto">
                <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 text-xs font-extrabold tracking-widest mb-4 uppercase">
                    {{ app()->getLocale() === 'en' ? 'CHAMPIONSHIP RESULTS' : 'HASIL PERTANDINGAN' }}
                </span>
                <h1 id="page-heading" class="text-3xl md:text-5xl font-extrabold text-white mb-4 uppercase tracking-tight">
                    {{ $currentFolder ? $currentFolder->getLocalizedName() : (app()->getLocale() === 'en' ? 'Official Results' : 'Hasil Resmi') }}
                </h1>
                <p class="text-slate-400 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                    {{ app()->getLocale() === 'en' 
                        ? 'Download official competition scores, match statistics, and overall medal standings.' 
                        : 'Unduh rekap skor resmi, statistik pertandingan, dan perolehan medali kejuaraan nasional maupun internasional.' 
                    }}
                </p>
            </div>
        </div>

        {{-- Discipline Quick Navigation --}}
        <div class="relative z-10 mb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-start md:justify-center gap-2 overflow-x-auto pb-4 scrollbar-none">
                    <button onclick="handleNavigation(null, true)" id="tab-all" class="discipline-tab px-5 py-2.5 rounded-full border text-xs font-extrabold uppercase shrink-0 transition-all duration-300 {{ !$slug && !$currentFolder ? 'bg-yellow-500 text-[#0d0d1f] border-transparent shadow-lg shadow-yellow-500/10' : 'bg-white/5 border-white/10 text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        {{ app()->getLocale() === 'en' ? 'All Results' : 'Semua Hasil' }}
                    </button>
                    @foreach($disciplinesList as $disc)
                        @php
                            $isActive = false;
                            if ($slug === $disc->slug) {
                                $isActive = true;
                            } elseif (isset($breadcrumbs[0]) && $breadcrumbs[0]['id'] === $disc->id) {
                                $isActive = true;
                            }
                        @endphp
                        <button onclick="handleNavigation({{ $disc->id }}, true)" id="tab-{{ $disc->id }}" class="discipline-tab px-5 py-2.5 rounded-full border text-xs font-extrabold uppercase shrink-0 transition-all duration-300 {{ $isActive ? 'bg-yellow-500 text-[#0d0d1f] border-transparent shadow-lg shadow-yellow-500/10' : 'bg-white/5 border-white/10 text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            {{ $disc->getLocalizedName() }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- File Explorer Container --}}
        <div class="relative pb-24 z-10">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                
                {{-- Breadcrumbs & Search Row --}}
                <div class="bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl p-5 md:p-6 mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4 shadow-xl" data-aos="fade-up">
                    
                    {{-- Breadcrumbs --}}
                    <div id="breadcrumbs-container" class="flex items-center flex-wrap gap-2 text-sm font-semibold">
                        <a href="javascript:void(0)" onclick="handleNavigation(null, true)" class="text-slate-400 hover:text-yellow-400 transition-colors flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                            </svg>
                            <span>Result</span>
                        </a>
                        
                        @foreach($breadcrumbs as $bc)
                            <span class="text-slate-600">/</span>
                            @if($loop->last)
                                <span class="text-yellow-400 font-extrabold max-w-[180px] truncate">{{ $bc['name'] }}</span>
                            @else
                                <a href="javascript:void(0)" onclick="handleNavigation({{ $bc['id'] }}, true)" class="text-slate-300 hover:text-yellow-400 transition-colors max-w-[180px] truncate">
                                    {{ $bc['name'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>

                    {{-- Local Search Input --}}
                    <div class="relative w-full md:w-72 shrink-0">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500 pointer-events-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                        <input type="text" id="search-explorer" oninput="searchExplorer()" placeholder="{{ app()->getLocale() === 'en' ? 'Search current folder...' : 'Cari di folder ini...' }}" class="w-full pl-10 pr-4 py-2 bg-[#0d0d1f]/60 border border-white/10 rounded-2xl text-slate-100 placeholder-slate-500 focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/20 text-xs transition-all duration-300">
                    </div>

                </div>

                {{-- Explorer Main Wrapper (for opacity transitions) --}}
                <div id="explorer-wrapper" class="transition-all duration-200">
                    
                    {{-- Empty Alert --}}
                    <div id="empty-alert" class="hidden text-center py-24 bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl p-8 max-w-lg mx-auto" data-aos="fade-up">
                        <svg class="w-16 h-16 text-yellow-500/30 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <p class="text-slate-400 text-sm">
                            {{ app()->getLocale() === 'en' ? 'This folder is empty.' : 'Folder ini kosong.' }}
                        </p>
                        <a href="javascript:void(0)" id="btn-parent-folder" class="mt-4 inline-flex items-center gap-2 text-xs font-bold text-yellow-500 hover:text-yellow-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            {{ app()->getLocale() === 'en' ? 'Go to Parent Folder' : 'Kembali ke Folder Atas' }}
                        </a>
                    </div>

                    {{-- Folders Section --}}
                    <div id="folders-section-container" class="mb-8">
                        <div id="folders-grid" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($folders as $child)
                                <a href="javascript:void(0)" onclick="handleNavigation({{ $child->id }}, true)" class="folder-item bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-2xl p-5 hover:border-white/10 hover:bg-[#1f1f42]/50 transition-all duration-300 group flex flex-col justify-between shadow-md"
                                   data-name="{{ strtolower($child->getLocalizedName()) }}"
                                   data-aos="fade-up" 
                                   data-aos-delay="{{ $loop->index * 30 }}">
                                    
                                    <div class="w-10 h-10 rounded-xl bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 flex items-center justify-center mb-4 group-hover:bg-yellow-500 group-hover:text-[#0d0d1f] transition-all duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                        </svg>
                                    </div>
                                    
                                    <div>
                                        <h3 class="text-sm font-bold text-white group-hover:text-yellow-400 transition-colors duration-300 truncate">
                                            {{ $child->getLocalizedName() }}
                                        </h3>
                                        <span class="text-[10px] text-slate-500 font-semibold uppercase tracking-wider block mt-1">
                                            {{ $child->children->count() }} folders, {{ $child->files->count() }} files
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Files Section --}}
                    <div id="files-section-container" class="space-y-3">
                        <h2 id="files-header" class="text-xs font-bold text-slate-400 uppercase tracking-widest pl-2 mb-3">
                            {{ app()->getLocale() === 'en' ? 'RESULT DOCUMENTS' : 'DOKUMEN HASIL' }}
                        </h2>
                        
                        <div id="files-list" class="bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl p-5 divide-y divide-white/5 shadow-xl">
                            @foreach($files as $file)
                                @php
                                    $ext = strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION));
                                    $iconClass = 'fas fa-file-pdf text-red-500';
                                    $bgClass = 'bg-red-500/10';
                                    
                                    if (in_array($ext, ['xls', 'xlsx', 'csv'])) {
                                        $iconClass = 'fas fa-file-excel text-emerald-500';
                                        $bgClass = 'bg-emerald-500/10';
                                    } elseif (in_array($ext, ['doc', 'docx'])) {
                                        $iconClass = 'fas fa-file-word text-blue-500';
                                        $bgClass = 'bg-blue-500/10';
                                    }
                                @endphp
                                <div class="file-item flex flex-col sm:flex-row sm:items-center justify-between gap-4 py-4 first:pt-0 last:pb-0" 
                                     data-name="{{ strtolower($file->getLocalizedTitle()) }}"
                                     data-aos="fade-up" 
                                     data-aos-delay="{{ $loop->index * 30 }}">
                                    
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 flex items-center justify-center rounded-xl {{ $bgClass }} shrink-0">
                                            <i class="{{ $iconClass }} text-lg"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-slate-200">
                                                {{ $file->getLocalizedTitle() }}
                                            </h4>
                                            <span class="text-[9px] text-slate-500 uppercase font-bold tracking-wider">{{ $ext ? $ext . ' Document' : 'Document' }}</span>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ Storage::url($file->file_path) }}" download class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-yellow-500/10 hover:bg-yellow-500 text-yellow-500 hover:text-[#0d0d1f] border border-yellow-500/20 hover:border-transparent rounded-xl text-xs font-extrabold transition-all duration-300 shrink-0">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                        {{ app()->getLocale() === 'en' ? 'Download' : 'Unduh' }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- No Search Results Alert (for local filter) --}}
                    <div id="no-search-results" class="hidden text-center py-20 bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-3xl p-8 max-w-lg mx-auto mt-6" data-aos="fade-up">
                        <svg class="w-16 h-16 text-yellow-500/40 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-slate-400 text-sm">
                            {{ app()->getLocale() === 'en' ? 'No items match your search.' : 'Tidak ada folder atau file yang cocok dengan pencarian Anda.' }}
                        </p>
                    </div>

                </div>

            </div>
        </div>

        <x-footer />
    </div>

    {{-- JS Client-Side Router --}}
    <script>
        // Parse preloaded collections from Blade
        const allFolders = @json($allFolders);
        const allFiles = @json($allFiles);
        const locale = '{{ app()->getLocale() }}';
        
        // Define root disciplines
        const disciplines = @json($disciplinesList);

        // Keep current state
        let currentFolderId = {!! $currentFolder ? $currentFolder->id : 'null' !!};
        
        // Storage base URL
        const storageBaseUrl = '{{ Storage::url("") }}';

        // Translate helper
        function getLocalizedName(item) {
            if (locale === 'en' && item.name_en) return item.name_en;
            if (locale === 'en' && item.title_en) return item.title_en;
            return item.name || item.title;
        }

        // Navigate to folder
        function handleNavigation(folderId, pushState = true) {
            currentFolderId = folderId;

            // Trigger Fade Out
            const wrapper = document.getElementById('explorer-wrapper');
            wrapper.style.opacity = '0.3';

            setTimeout(() => {
                renderFolderContents(folderId);
                
                // Trigger Fade In
                wrapper.style.opacity = '1';

                // Handle URL modification
                if (pushState) {
                    let url = '{{ route("front.result") }}';
                    const activeFolder = allFolders.find(f => f.id === folderId);
                    
                    if (folderId) {
                        // Check if it's one of the 7 root disciplines (parent_id is null)
                        if (activeFolder && activeFolder.parent_id === null && activeFolder.slug) {
                            url += '/' + activeFolder.slug;
                        } else {
                            url += '?folder_id=' + folderId;
                        }
                    }
                    
                    history.pushState({ folderId: folderId }, '', url);
                }
            }, 100);
        }

        // Handle Browser Back / Forward buttons
        window.onpopstate = function(event) {
            const stateFolderId = event.state ? event.state.folderId : null;
            handleNavigation(stateFolderId, false);
        };

        // Render current folder contents into DOM
        function renderFolderContents(folderId) {
            // Clear search field
            document.getElementById('search-explorer').value = '';

            const activeFolder = allFolders.find(f => f.id === folderId) || null;
            const childFolders = allFolders.filter(f => f.parent_id === folderId);
            const childFiles = allFiles.filter(f => f.result_folder_id === folderId);

            // Update main heading
            const heading = document.getElementById('page-heading');
            if (activeFolder) {
                heading.innerText = getLocalizedName(activeFolder);
                document.title = getLocalizedName(activeFolder) + " - Results | PB PORSEROSI";
            } else {
                heading.innerText = locale === 'en' ? 'Official Results' : 'Hasil Resmi';
                document.title = (locale === 'en' ? 'Match Results' : 'Hasil Pertandingan') + " | PB PORSEROSI";
            }

            // Update tab highlights
            // First determine which root discipline this folder belongs to
            let disciplineRootId = null;
            if (activeFolder) {
                let temp = activeFolder;
                while (temp) {
                    if (temp.parent_id === null) {
                        disciplineRootId = temp.id;
                        break;
                    }
                    temp = allFolders.find(f => f.id === temp.parent_id);
                }
            }

            document.querySelectorAll('.discipline-tab').forEach(tab => {
                tab.className = 'discipline-tab px-5 py-2.5 rounded-full border text-xs font-extrabold uppercase shrink-0 transition-all duration-300 bg-white/5 border-white/10 text-slate-300 hover:bg-white/10 hover:text-white';
            });

            if (disciplineRootId) {
                const activeTab = document.getElementById('tab-' + disciplineRootId);
                if (activeTab) {
                    activeTab.className = 'discipline-tab px-5 py-2.5 rounded-full border text-xs font-extrabold uppercase shrink-0 transition-all duration-300 bg-yellow-500 text-[#0d0d1f] border-transparent shadow-lg shadow-yellow-500/10';
                }
            } else {
                const allTab = document.getElementById('tab-all');
                if (allTab) {
                    allTab.className = 'discipline-tab px-5 py-2.5 rounded-full border text-xs font-extrabold uppercase shrink-0 transition-all duration-300 bg-yellow-500 text-[#0d0d1f] border-transparent shadow-lg shadow-yellow-500/10';
                }
            }

            // Update Breadcrumbs
            const breadcrumbsContainer = document.getElementById('breadcrumbs-container');
            let bcHtml = `
                <a href="javascript:void(0)" onclick="handleNavigation(null, true)" class="text-slate-400 hover:text-yellow-400 transition-colors flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                    <span>Result</span>
                </a>
            `;

            if (activeFolder) {
                const pathList = [];
                let temp = activeFolder;
                while (temp) {
                    pathList.unshift(temp);
                    temp = allFolders.find(f => f.id === temp.parent_id);
                }

                pathList.forEach((bc, idx) => {
                    bcHtml += `<span class="text-slate-600">/</span>`;
                    if (idx === pathList.length - 1) {
                        bcHtml += `<span class="text-yellow-400 font-extrabold max-w-[180px] truncate">${getLocalizedName(bc)}</span>`;
                    } else {
                        bcHtml += `<a href="javascript:void(0)" onclick="handleNavigation(${bc.id}, true)" class="text-slate-300 hover:text-yellow-400 transition-colors max-w-[180px] truncate">${getLocalizedName(bc)}</a>`;
                    }
                });
            }
            breadcrumbsContainer.innerHTML = bcHtml;

            // Render Empty Alert, Folders, and Files
            const emptyAlert = document.getElementById('empty-alert');
            const foldersSection = document.getElementById('folders-section-container');
            const foldersGrid = document.getElementById('folders-grid');
            const filesSection = document.getElementById('files-section-container');
            const filesList = document.getElementById('files-list');
            const noResultsAlert = document.getElementById('no-search-results');

            noResultsAlert.classList.add('hidden');

            if (childFolders.length === 0 && childFiles.length === 0) {
                emptyAlert.classList.remove('hidden');
                foldersSection.style.display = 'none';
                filesSection.style.display = 'none';
                
                // Configure back to parent button in empty alert
                const btnParent = document.getElementById('btn-parent-folder');
                if (activeFolder && activeFolder.parent_id !== undefined) {
                    btnParent.style.display = '';
                    btnParent.onclick = function() {
                        handleNavigation(activeFolder.parent_id, true);
                    };
                } else {
                    btnParent.style.display = 'none';
                }
            } else {
                emptyAlert.classList.add('hidden');

                // Render child folders
                if (childFolders.length > 0) {
                    foldersSection.style.display = '';
                    let foldersHtml = '';
                    childFolders.forEach(child => {
                        const directFiles = allFiles.filter(file => file.result_folder_id === child.id).length;
                        const directFolders = allFolders.filter(folder => folder.parent_id === child.id).length;
                        
                        foldersHtml += `
                            <a href="javascript:void(0)" onclick="handleNavigation(${child.id}, true)" class="folder-item bg-[#181836]/40 backdrop-blur-md border border-white/5 rounded-2xl p-5 hover:border-white/10 hover:bg-[#1f1f42]/50 transition-all duration-300 group flex flex-col justify-between shadow-md"
                               data-name="${getLocalizedName(child).toLowerCase()}">
                                
                                <div class="w-10 h-10 rounded-xl bg-yellow-500/10 border border-yellow-500/20 text-yellow-500 flex items-center justify-center mb-4 group-hover:bg-yellow-500 group-hover:text-[#0d0d1f] transition-all duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                    </svg>
                                </div>
                                
                                <div>
                                    <h3 class="text-sm font-bold text-white group-hover:text-yellow-400 transition-colors duration-300 truncate">
                                        ${getLocalizedName(child)}
                                    </h3>
                                    <span class="text-[10px] text-slate-500 font-semibold uppercase tracking-wider block mt-1">
                                        ${directFolders} folders, ${directFiles} files
                                    </span>
                                </div>
                            </a>
                        `;
                    });
                    foldersGrid.innerHTML = foldersHtml;
                } else {
                    foldersSection.style.display = 'none';
                }

                // Render files
                if (childFiles.length > 0) {
                    filesSection.style.display = '';
                    let filesHtml = '';
                    childFiles.forEach(file => {
                        // File type detection
                        const filePathLower = file.file_path.toLowerCase();
                        let iconClass = 'fas fa-file-pdf text-red-500';
                        let bgClass = 'bg-red-500/10';
                        let docLabel = 'Document';

                        if (filePathLower.endsWith('.xls') || filePathLower.endsWith('.xlsx') || filePathLower.endsWith('.csv')) {
                            iconClass = 'fas fa-file-excel text-emerald-500';
                            bgClass = 'bg-emerald-500/10';
                            docLabel = 'Excel';
                        } else if (filePathLower.endsWith('.doc') || filePathLower.endsWith('.docx')) {
                            iconClass = 'fas fa-file-word text-blue-500';
                            bgClass = 'bg-blue-500/10';
                            docLabel = 'Word';
                        }

                        filesHtml += `
                            <div class="file-item flex flex-col sm:flex-row sm:items-center justify-between gap-4 py-4 first:pt-0 last:pb-0" 
                                 data-name="${getLocalizedName(file).toLowerCase()}">
                                
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 flex items-center justify-center rounded-xl ${bgClass} shrink-0">
                                        <i class="${iconClass} text-lg"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-200">
                                            ${getLocalizedName(file)}
                                        </h4>
                                        <span class="text-[9px] text-slate-500 uppercase font-bold tracking-wider">${docLabel} Document</span>
                                    </div>
                                </div>
                                
                                <a href="${storageBaseUrl}/${file.file_path}" download class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-yellow-500/10 hover:bg-yellow-500 text-yellow-500 hover:text-[#0d0d1f] border border-yellow-500/20 hover:border-transparent rounded-xl text-xs font-extrabold transition-all duration-300 shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    ${locale === 'en' ? 'Download' : 'Unduh'}
                                </a>
                            </div>
                        `;
                    });
                    filesList.innerHTML = filesHtml;
                } else {
                    filesSection.style.display = 'none';
                }
            }
        }

        // Search within the current active directory locally
        function searchExplorer() {
            const query = document.getElementById('search-explorer').value.toLowerCase().trim();
            const folders = document.querySelectorAll('.folder-item');
            const files = document.querySelectorAll('.file-item');
            const foldersGrid = document.getElementById('folders-grid');
            const foldersSection = document.getElementById('folders-section-container');
            const filesList = document.getElementById('files-list');
            const filesSection = document.getElementById('files-section-container');
            const noResultsAlert = document.getElementById('no-search-results');
            
            let visibleFolders = 0;
            let visibleFiles = 0;

            // Filter folders
            folders.forEach(folder => {
                const name = folder.getAttribute('data-name');
                if (name.includes(query)) {
                    folder.style.display = '';
                    visibleFolders++;
                } else {
                    folder.style.display = 'none';
                }
            });

            // Filter files
            files.forEach(file => {
                const name = file.getAttribute('data-name');
                if (name.includes(query)) {
                    file.style.display = '';
                    visibleFiles++;
                } else {
                    file.style.display = 'none';
                }
            });

            // Toggle visibility of grids
            if (foldersSection) {
                foldersSection.style.display = visibleFolders === 0 ? 'none' : '';
            }
            if (filesSection) {
                filesSection.style.display = visibleFiles === 0 ? 'none' : '';
            }

            // Show fallback alert if nothing is visible
            if (visibleFolders === 0 && visibleFiles === 0) {
                noResultsAlert.classList.remove('hidden');
            } else {
                noResultsAlert.classList.add('hidden');
            }
        }
    </script>
@endsection
