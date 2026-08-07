<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Event;
use App\Models\Partner;
use App\Models\Category;
use App\Models\ArticleNews;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BannerAdvertisement;
use App\Models\Achievement;
use App\Models\LiveStreaming;
use App\Models\Officer;
use App\Models\RegulationFolder;
use App\Models\Regulation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Cache;

class FrontController extends Controller
{
    public function sitemap()
    {
        $articles = ArticleNews::latest()->get();
        $categories = Category::all();
        $events = Event::published()->latest('start_date')->get();

        return response()->view('front.sitemap', compact('articles', 'categories', 'events'))->header('Content-Type', 'application/xml');
    }

    public function robots()
    {
        return response()->view('front.robots')->header('Content-Type', 'text/plain');
    }

    public function beranda()
    {
        // Data untuk view
        $partners = Partner::all();
        $featuredBlogs = ArticleNews::with(['category', 'author'])
            ->where('is_featured', 'featured')
            ->latest()
            ->take(5)
            ->get();

        $randomBlogs = ArticleNews::with(['category', 'author'])
            ->whereNotIn('id', $featuredBlogs->pluck('id'))
            ->latest()
            ->take(20)
            ->get();
        if ($randomBlogs->count() > 4) {
            $randomBlogs = $randomBlogs->random(4);
        } else {
            $randomBlogs = $randomBlogs->shuffle();
        }

        // SEO Configuration
        SEOMeta::setTitle(__('messages.seo_beranda_title'));
        SEOMeta::setDescription(__('messages.seo_beranda_desc'));
        SEOMeta::addKeyword([
            'PB PORSEROSI', 'PORSEROSI', 'Pengurus Besar Persatuan Olahraga Sepatu Roda Seluruh Indonesia', 'Persatuan Olahraga Sepatu Roda Seluruh Indonesia',
            'sepatu roda Indonesia', 'skateboard Indonesia', 'scooter Indonesia',
            'atlet sepatu roda', 'atlet skateboard', 'atlet scooter',
            'juara sepatu roda', 'juara skateboard', 'juara scooter',
            'roller sports', 'inline skate'
        ]);

        OpenGraph::setTitle('PB PORSEROSI - Persatuan Olahraga Sepatu Roda Seluruh Indonesia');
        OpenGraph::setDescription(SEOMeta::getDescription());
        OpenGraph::setUrl(url('/'));
        OpenGraph::addImage(get_image_url('assets/images/og-beranda.jpg'));
        OpenGraph::setSiteName('PB PORSEROSI');

        TwitterCard::setTitle(SEOMeta::getTitle());
        TwitterCard::setDescription(SEOMeta::getDescription());
        TwitterCard::setImage(get_image_url('assets/images/twitter-beranda.jpg'));

        $liveStreamings = LiveStreaming::where('is_active', true)
            ->where('status', '!=', 'finished')
            ->orderBy('start_datetime', 'asc')
            ->take(3)
            ->get();

        $bannerAds = BannerAdvertisement::getActiveBannersForPage('beranda');

        return view('front.beranda', compact('partners', 'featuredBlogs', 'randomBlogs', 'liveStreamings', 'bannerAds'));
    }

    public function live()
    {
        SEOMeta::setTitle(__('messages.seo_live_title'));
        SEOMeta::setDescription(__('messages.seo_live_desc'));

        $now = Carbon::now();

        // Ambil semua yang belum selesai
        $allActiveLives = LiveStreaming::where('is_active', true)
            ->where('status', '!=', 'finished')
            ->orderBy('start_datetime', 'asc')
            ->get();

        // Pisahkan mana yang sedang berlangsung dan mana yang akan datang
        $liveNow = $allActiveLives->filter(function($live) use ($now) {
            return $live->status === 'live' || ($live->status === 'upcoming' && $live->start_datetime <= $now);
        });

        $upcomingLives = $allActiveLives->filter(function($live) use ($now) {
            return $live->status === 'upcoming' && $live->start_datetime > $now;
        });

        $bannerAds = BannerAdvertisement::getActiveBannersForPage('live');

        return view('front.live', compact('liveNow', 'upcomingLives', 'bannerAds'));
    }

    public function tentangKami()
    {
        SEOMeta::setTitle(__('messages.seo_tentang_title'));
        SEOMeta::setDescription(__('messages.seo_tentang_desc'));
        OpenGraph::addImage(get_image_url('assets/images/about-us.jpg'));

        $latestNews = ArticleNews::with(['category', 'author'])->latest()->take(3)->get();
        $bannerAds = BannerAdvertisement::getActiveBannersForPage('profil');

        return view('front.profil', compact('latestNews', 'bannerAds'));
    }

    public function profil()
    {
        SEOMeta::setTitle(__('messages.seo_profil_title'));
        SEOMeta::setDescription(__('messages.seo_profil_desc'));

        $latestNews = ArticleNews::with(['category', 'author'])->latest()->take(3)->get();
        $bannerAds = BannerAdvertisement::getActiveBannersForPage('profil');

        return view('front.profil', compact('latestNews', 'bannerAds'));
    }

    public function visimisi()
    {
        SEOMeta::setTitle(__('messages.seo_visimisi_title'));
        SEOMeta::setDescription(__('messages.seo_visimisi_desc'));

        $latestNews = ArticleNews::with(['category', 'author'])->latest()->take(3)->get();
        $bannerAds = BannerAdvertisement::getActiveBannersForPage('visimisi');

        return view('front.visimisi', compact('latestNews', 'bannerAds'));
    }

    public function strukturOrganisasi()
    {
        SEOMeta::setTitle((app()->getLocale() === 'en' ? 'Organizational Structure' : 'Struktur Organisasi') . ' | PB PORSEROSI');
        SEOMeta::setDescription(app()->getLocale() === 'en' 
            ? 'Organizational structure of the Executive Board of the Indonesian Roller Skating Sports Association (PB PORSEROSI).' 
            : 'Struktur Organisasi Pengurus Besar Persatuan Olahraga Sepatu Roda Seluruh Indonesia (PB PORSEROSI).');

        $officers = Officer::orderBy('order', 'asc')->get();

        return view('front.struktur-organisasi', compact('officers'));
    }

    public function peraturan()
    {
        SEOMeta::setTitle((app()->getLocale() === 'en' ? 'Regulations' : 'Peraturan') . ' | PB PORSEROSI');
        SEOMeta::setDescription(app()->getLocale() === 'en'
            ? 'Official regulations, AD/ART, and rules of the Executive Board of the Indonesian Roller Skating Sports Association (PB PORSEROSI).'
            : 'Peraturan resmi, AD/ART, dan ketentuan Pengurus Besar Persatuan Olahraga Sepatu Roda Seluruh Indonesia (PB PORSEROSI).');

        $folders = RegulationFolder::with(['regulations' => function($q) {
            $q->orderBy('order', 'asc');
        }])->orderBy('order', 'asc')->get();

        $rootRegulations = Regulation::whereNull('regulation_folder_id')
            ->orderBy('order', 'asc')
            ->get();

        return view('front.peraturan', compact('folders', 'rootRegulations'));
    }

    public function kontak()
    {
        SEOMeta::setTitle('Kontak Kami | PB PORSEROSI');
        return view('front.kontak');
    }

    public function dataProvinsi()
    {
        SEOMeta::setTitle('Data Provinsi | PB PORSEROSI');
        $provinsis = \App\Models\Provinsi::orderBy('order', 'asc')->get();
        return view('front.data-provinsi', compact('provinsis'));
    }

    public function dataClub()
    {
        SEOMeta::setTitle('Data Club | PB PORSEROSI');
        $clubs = \App\Models\Club::all();
        $provinces = \App\Models\Club::query()->pluck('province')->unique()->values();
        $allDisciplines = \App\Models\Club::query()->pluck('discipline')->flatMap(function ($item) {
            return array_map('trim', explode(',', $item));
        })->unique()->values();
        
        return view('front.data-club', compact('clubs', 'provinces', 'allDisciplines'));
    }

    public function dataWasit()
    {
        SEOMeta::setTitle('Data Wasit | PB PORSEROSI');
        $wasits = \App\Models\WasitPelatih::where('kategori', 'Wasit')->where('status', 'selesai')->get();
        return view('front.data-wasit', compact('wasits'));
    }

    public function dataPelatih()
    {
        SEOMeta::setTitle('Data Pelatih | PB PORSEROSI');
        $pelatihs = \App\Models\WasitPelatih::where('kategori', 'Pelatih')->where('status', 'selesai')->get();
        return view('front.data-pelatih', compact('pelatihs'));
    }

    public function eventKompetisi()
    {
        SEOMeta::setTitle('Event Kompetisi | PB PORSEROSI');
        return view('front.event-kompetisi');
    }

    public function eventKegiatan()
    {
        SEOMeta::setTitle('Event Kegiatan | PB PORSEROSI');
        return view('front.event-kegiatan');
    }

    public function eventDaftar()
    {
        SEOMeta::setTitle('Pendaftaran Event | PB PORSEROSI');
        return view('front.event-daftar');
    }

    public function result($slug = null)
    {
        $folderId = request()->query('folder_id');
        $currentFolder = null;
        $breadcrumbs = [];

        // 1. Determine active folder
        if ($folderId) {
            $currentFolder = \App\Models\ResultFolder::findOrFail($folderId);
        } elseif ($slug) {
            $currentFolder = \App\Models\ResultFolder::whereNull('parent_id')
                ->where('slug', $slug)
                ->first();
            
            if (!$currentFolder) {
                $currentFolder = \App\Models\ResultFolder::where('slug', $slug)->first();
            }
        }

        // 2. Fetch folders & files for current view
        if ($currentFolder) {
            $folders = \App\Models\ResultFolder::where('parent_id', $currentFolder->id)
                ->orderBy('order', 'asc')
                ->get();
            $files = \App\Models\ResultFile::where('result_folder_id', $currentFolder->id)
                ->orderBy('order', 'asc')
                ->get();

            // 3. Build Breadcrumbs path (from current folder to root)
            $temp = $currentFolder;
            while ($temp) {
                array_unshift($breadcrumbs, [
                    'id'   => $temp->id,
                    'name' => $temp->getLocalizedName(),
                    'slug' => $temp->slug,
                ]);
                $temp = $temp->parent;
            }
        } else {
            // Root view: Show the 7 main disciplines (root folders)
            $folders = \App\Models\ResultFolder::whereNull('parent_id')
                ->orderBy('order', 'asc')
                ->get();
            $files = collect();
        }

        // Fetch all root level disciplines for navigation highlights
        $disciplinesList = \App\Models\ResultFolder::whereNull('parent_id')
            ->orderBy('order', 'asc')
            ->get();

        // Fetch all folders and files for client-side instant navigation
        $allFolders = \App\Models\ResultFolder::orderBy('order', 'asc')->get();
        $allFiles = \App\Models\ResultFile::orderBy('order', 'asc')->get();

        $pageTitle = $currentFolder 
            ? $currentFolder->getLocalizedName() . ' - Results' 
            : (app()->getLocale() === 'en' ? 'Match Results' : 'Hasil Pertandingan');

        SEOMeta::setTitle($pageTitle . ' | PB PORSEROSI');

        return view('front.result', compact('currentFolder', 'folders', 'files', 'breadcrumbs', 'disciplinesList', 'slug', 'allFolders', 'allFiles'));
    }

    public function partnerJoin()
    {
        SEOMeta::setTitle('Menjadi Partner | PB PORSEROSI');
        $user = auth()->user();
        $partners = null;
        if ($user) {
            $partners = Partner::where('user_id', $user->id)->latest()->get();
        }
        return view('front.partner-join', compact('user', 'partners'));
    }

    public function storePartnerJoin(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('front.partner.join')->with('error', 'Silakan login dengan Google terlebih dahulu.');
        }

        $request->validate([
            'name'            => 'required|string|max:255',
            'description'     => 'required|string|max:2000',
            'contact_name'    => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:30',
            'link'            => 'nullable|url|max:255',
            'logo'            => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $tempPath = $file->getRealPath();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanFilename = \Illuminate\Support\Str::slug($originalName) . '-' . uniqid() . '.webp';
            $targetPath = 'partners/' . $cleanFilename;

            if (function_exists('imagewebp') && function_exists('imagecreatefromstring')) {
                $data = file_get_contents($tempPath);
                $image = @imagecreatefromstring($data);
                if ($image) {
                    imagepalettetotruecolor($image);
                    imagealphablending($image, false);
                    imagesavealpha($image, true);
                    ob_start();
                    imagewebp($image, null, 80);
                    $webpContent = ob_get_clean();
                    imagedestroy($image);
                    \Illuminate\Support\Facades\Storage::disk('public')->put($targetPath, $webpContent);
                    $logoPath = $targetPath;
                } else {
                    $logoPath = $file->store('partners', 'public');
                }
            } else {
                $logoPath = $file->store('partners', 'public');
            }
        }

        Partner::create([
            'name'            => $request->name,
            'description'     => $request->description,
            'contact_name'    => $request->contact_name,
            'whatsapp_number' => $request->whatsapp_number,
            'link'            => $request->link,
            'logo_path'       => $logoPath,
            'alt_text'        => $request->name,
            'status'          => 'pending',
            'user_id'         => auth()->id(),
            'row'             => 1,
        ]);

        return redirect()->route('front.partner.join')->with('success_partner', 'Terima kasih! Pengajuan kemitraan Anda telah berhasil dikirim dan sedang ditinjau oleh tim kami.');
    }



    public function daftarWasitPelatih()
    {
        SEOMeta::setTitle(__('messages.seo_daftar_wasit_pelatih_title'));
        SEOMeta::setDescription(__('messages.seo_daftar_wasit_pelatih_desc'));

        return view('front.daftar-wasit-pelatih');
    }

    public function storeWasitPelatih(\Illuminate\Http\Request $request)
    {
        // Honeypot check for bots
        if ($request->filled('website')) {
            return redirect()->back()->with('success', 'Data Anda berhasil didaftarkan. Terima kasih atas partisipasinya!');
        }

        // Rate Limiter: Max 3 attempts per hour per IP address to block spamming scripts
        $ip = $request->ip();
        if (RateLimiter::tooManyAttempts('wasit-pelatih-reg:'.$ip, 3)) {
            $seconds = RateLimiter::availableIn('wasit-pelatih-reg:'.$ip);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terlalu banyak upaya pendaftaran dari perangkat Anda. Silakan coba lagi dalam ' . ceil($seconds / 60) . ' menit.');
        }
        RateLimiter::hit('wasit-pelatih-reg:'.$ip, 3600); // Track limit for 1 hour

        // Cek apakah NIK sudah pernah mendaftar
        $existing = \App\Models\WasitPelatih::where('nik', $request->nik)->latest()->first();

        if ($existing) {
            // 2. Jika statusnya data di terima sedang di proses maka tidak bisa daftar
            if ($existing->status === 'pending') {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Status pendaftaran Anda saat ini: "Data Diterima, Sedang Diproses". Anda belum bisa mendaftar kembali, harap hubungi admin.');
            }

            // 3. Jika statusnya pendaftaran berhasil (selesai) atau ditolak, bisa daftar kembali
            if ($existing->status === 'selesai') {
                session()->flash('info', 'Pendaftaran Anda sebelumnya telah Berhasil. Silakan isi kembali formulir ini jika Anda ingin melakukan pendaftaran baru atau pembaruan data.');
            }

            if ($existing->status === 'ditolak') {
                session()->flash('info', 'Pendaftaran Anda sebelumnya ditolak. Silakan mendaftar kembali dengan memastikan seluruh data dan dokumen yang diunggah valid. Jika kendala berlanjut, hubungi admin.');
            }
        }

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => ['required', 'string', 'regex:/^\d{16}$/'],
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_wa' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'provinsi' => 'required|string|max:255',
            'kabupaten_kota' => 'required|string|max:255',
            'klub_asal' => 'required|string|max:255',
            'kategori' => 'required|in:Wasit,Pelatih',
            'lisensi' => 'required|in:Daerah,Nasional,Internasional,Belum Ada',
            'foto_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'sertifikat_path' => 'nullable|mimes:pdf,jpeg,png,jpg|max:5120',
        ], [
            'nik.regex' => 'Format NIK tidak valid. Harus berupa 16 digit angka.'
        ]);

        if ($request->hasFile('foto_path')) {
            $validated['foto_path'] = $request->file('foto_path')->store('wasit_pelatih/foto', 'public');
        }

        if ($request->hasFile('sertifikat_path')) {
            $validated['sertifikat_path'] = $request->file('sertifikat_path')->store('wasit_pelatih/sertifikat', 'public');
        }

        \App\Models\WasitPelatih::create($validated);

        return redirect()->back()->with('success', 'Data Anda berhasil didaftarkan. Terima kasih atas partisipasinya!');
    }



    public function registerEventParticipant($slug)
    {
        $event = \App\Models\Event::where('slug', $slug)->firstOrFail();
        $today = \Carbon\Carbon::today();

        if (!$event->is_registration_open || $event->status !== 'upcoming' || $event->start_date->lt($today)) {
            return redirect()->route('front.event.daftar')
                ->with('error', 'Maaf, pendaftaran untuk event "' . $event->name . '" saat ini sudah ditutup.');
        }

        if ($event->registration_url) {
            return redirect()->away($event->registration_url);
        }

        return redirect()->route('front.event.daftar')
            ->with('error', 'Maaf, link pendaftaran untuk event "' . $event->name . '" belum dikonfigurasi.');
    }

    public function storeEventParticipant(Request $request, $slug)
    {
        return redirect()->route('front.event.daftar');
    }

    public function checkStatusEventApi(Request $request)
    {
        return response()->json(['error' => 'Fitur ini telah dinonaktifkan.'], 404);
    }

    public function checkStatusWasitPelatih(Request $request)
    {
        SEOMeta::setTitle('Cek Status Pendaftaran | PB PORSEROSI');
        
        $registrations = collect();
        $latestRegistration = null;
        $nik = $request->get('nik');

        if ($nik) {
            // Rate Limiter: Maksimal 10 pencarian per menit per IP untuk mencegah bot/brute force
            $ip = $request->ip();
            if (RateLimiter::tooManyAttempts('wasit-pelatih-status:'.$ip, 10)) {
                $seconds = RateLimiter::availableIn('wasit-pelatih-status:'.$ip);
                return redirect()->back()->with('error', 'Terlalu banyak permintaan cek status. Silakan coba lagi dalam ' . $seconds . ' detik.');
            }
            RateLimiter::hit('wasit-pelatih-status:'.$ip, 60);

            $registrations = \App\Models\WasitPelatih::where('nik', $nik)->latest()->get();
            
            if ($registrations->isEmpty()) {
                return redirect()->back()->with('error', 'Data dengan NIK tersebut tidak ditemukan.');
            }
            
            $latestRegistration = $registrations->first();
        }

        return view('front.cek-status-wasit-pelatih', [
            'registration' => $latestRegistration,
            'history' => $registrations,
            'nik' => $nik
        ]);
    }

    public function panduan()
    {
        SEOMeta::setTitle(__('messages.seo_panduan_title'));
        SEOMeta::setDescription(__('messages.seo_panduan_desc'));

        $panduans = \App\Models\Panduan::latest()->get();
        $bannerAds = BannerAdvertisement::getActiveBannersForPage('panduan');

        return view('front.panduan', compact('panduans', 'bannerAds'));
    }

    public function partner()
    {
        SEOMeta::setTitle(__('messages.seo_partner_title'));
        SEOMeta::setDescription(__('messages.seo_partner_desc'));

        $partners = Partner::where('status', 'active')->get();
        $latestNews = ArticleNews::with(['category', 'author'])->latest()->take(3)->get();
        $bannerAds = BannerAdvertisement::getActiveBannersForPage('partner');

        return view('front.partner', compact('partners', 'latestNews', 'bannerAds'));
    }


    public function prestasi()
    {
        SEOMeta::setTitle(__('messages.seo_prestasi_title'));
        SEOMeta::setDescription(__('messages.seo_prestasi_desc'));
        SEOMeta::addKeyword([
            'prestasi PORSEROSI', 'atlet sepatu roda', 'atlet skateboard', 'atlet scooter',
            'juara sepatu roda', 'juara skateboard', 'juara scooter',
            'kejuaraan nasional sepatu roda', 'kejuaraan skateboard Indonesia', 'SEA Games', 'Asian Games'
        ]);

        $achievements = Achievement::published()
            ->orderBy('year', 'desc')
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->get()
            ->groupBy('year');

        return view('front.prestasi', compact('achievements'));
    }

    public static function getDisciplinesData(string $locale = 'id'): array
    {
        $isEn = $locale === 'en';
        return [
            'inline-freestyle' => [
                'name'        => 'Inline Freestyle',
                'slug'        => 'inline-freestyle',
                'tagline'     => $isEn ? 'Expression, Agility & High Control' : 'Ekspresi, Kelincahan & Kontrol Tinggi',
                'hero_image'  => 'cabor-sepaturoda.png',
                'badge_color' => 'blue',
                'badge_text'  => $isEn ? 'Discipline' : 'Disiplin Olahraga',
                'description' => $isEn 
                    ? 'Inline Freestyle is a discipline that combines technical slalom tricks through a line of cones with agility, balance, and artistic expression. It includes classic slalom, speed slalom, battle slalom, and slides.'
                    : 'Inline Freestyle memadukan trik teknis slalom meliuk-liuk di antara barisan cone dengan kelincahan, keseimbangan, serta ekspresi artistik di atas sepatu roda inline. Meliputi nomor classic slalom, speed slalom, battle slalom, dan slides.',
                'overview'    => $isEn 
                    ? 'Athletes are judged on their choreographic creativity, trick execution precision, and speed in passing the cones. It is one of the most popular and fast-growing disciplines in Indonesia.'
                    : 'Atlet dinilai berdasarkan kreativitas koreografi, presisi eksekusi trik kaki, dan kecepatan melewati cone. Disiplin ini merupakan salah satu yang terpopuler dan berkembang pesat di Indonesia.',
                'disciplines' => [
                    [
                        'name' => 'Classic Slalom',
                        'description' => $isEn ? 'Choreographed performance to music through cone lines.' : 'Penampilan koreografi dengan iringan musik melewati barisan cone.',
                        'competition_level' => 'National & International',
                        'icon' => 'fas fa-music',
                        'image' => 'disiplin-artistic.png',
                    ],
                    [
                        'name' => 'Speed Slalom',
                        'description' => $isEn ? 'One-legged speed run through a line of cones.' : 'Adu cepat dengan satu kaki melewati barisan cone secara zigzag.',
                        'competition_level' => 'National & International',
                        'icon' => 'fas fa-timer',
                        'image' => 'disiplin-speed.png',
                    ],
                    [
                        'name' => 'Battle Slalom',
                        'description' => $isEn ? 'Head-to-head trick battles in a group format.' : 'Pertarungan trik teknis secara langsung dalam format grup.',
                        'competition_level' => 'National & International',
                        'icon' => 'fas fa-fire',
                        'image' => 'disiplin-artistic.png',
                    ],
                    [
                        'name' => 'Slides',
                        'description' => $isEn ? 'Performing long and complex stopping slides.' : 'Melakukan teknik pengereman artistik dengan jarak sejauh mungkin.',
                        'competition_level' => 'National & International',
                        'icon' => 'fas fa-wind',
                        'image' => 'disiplin-downhill.png',
                    ],
                ]
            ],
            'inline-hockey' => [
                'name'        => 'Inline Hockey',
                'slug'        => 'inline-hockey',
                'tagline'     => $isEn ? 'Speed, Strategy & Teamwork' : 'Kecepatan, Strategi & Kerja Sama Tim',
                'hero_image'  => 'cabor-sepaturoda.png',
                'badge_color' => 'indigo',
                'badge_text'  => $isEn ? 'Discipline' : 'Disiplin Olahraga',
                'description' => $isEn 
                    ? 'Inline Hockey is a fast-paced team sport played on inline skates, using hockey sticks and a puck. It demands high stamina, agile puck control, and solid team strategy.'
                    : 'Inline Hockey adalah olahraga beregu dinamis dan cepat yang dimainkan menggunakan sepatu roda inline, stik hoki, dan puck/bola. Membutuhkan stamina tinggi, ketangkasan mengontrol puck, serta strategi tim yang solid.',
                'overview'    => $isEn 
                    ? 'It is a highly competitive team discipline under PB PORSEROSI. Regional and national leagues are regularly held to scout talents for the national team.'
                    : 'Hoki inline merupakan disiplin beregu bergengsi di bawah PB PORSEROSI. Liga regional dan kejuaraan nasional diselenggarakan berkala untuk menjaring atlet tim nasional.',
                'disciplines' => [
                    [
                        'name' => 'Match Play',
                        'description' => $isEn ? 'Official team matches with 4 skaters and 1 goaltender.' : 'Pertandingan resmi beregu dengan format 4 pemain lapangan dan 1 penjaga gawang.',
                        'competition_level' => 'National & Regional',
                        'icon' => 'fas fa-users',
                        'image' => 'disiplin-speed.png',
                    ],
                    [
                        'name' => 'Skills Challenge',
                        'description' => $isEn ? 'Individual skills competition showcasing shooting power and agility.' : 'Kompetisi keterampilan individu meliputi kecepatan, akurasi tembakan, dan kelincahan.',
                        'competition_level' => 'National',
                        'icon' => 'fas fa-bullseye',
                        'image' => 'disiplin-artistic.png',
                    ],
                ]
            ],
            'roller-freestyle' => [
                'name'        => 'Roller Freestyle',
                'slug'        => 'roller-freestyle',
                'tagline'     => $isEn ? 'Extreme Tricks, Creativity & Courage' : 'Trik Ekstrem, Kreativitas & Keberanian',
                'hero_image'  => 'cabor-sepaturoda.png',
                'badge_color' => 'purple',
                'badge_text'  => $isEn ? 'Discipline' : 'Disiplin Olahraga',
                'description' => $isEn 
                    ? 'Roller Freestyle (also known as Aggressive Inline) focuses on executing extreme tricks such as grinding rails, high aerial jumps, and flips on skatepark transitions.'
                    : 'Roller Freestyle (juga dikenal sebagai Aggressive Inline) berfokus pada eksekusi trik ekstrem seperti meluncur di rail (grind), lompatan udara tinggi (aerials), serta flip di skatepark atau rintangan jalanan.',
                'overview'    => $isEn 
                    ? 'This discipline demands extraordinary physical control and mental strength. PB PORSEROSI supports skatepark developments and championships to empower this extreme sports community.'
                    : 'Disiplin ini menuntut kontrol fisik luar biasa dan mental yang kuat. PB PORSEROSI mendukung pembangunan skatepark serta kejuaraan nasional untuk mewadahi komunitas olahraga ekstrem ini.',
                'disciplines' => [
                    [
                        'name' => 'Park',
                        'description' => $isEn ? 'Performing aerial tricks and lines using bowl and halfpipe transitions.' : 'Melakukan trik udara dan transisi memanfaatkan bowl dan halfpipe.',
                        'competition_level' => 'National & International',
                        'icon' => 'fas fa-mountain',
                        'image' => 'disiplin-park.png',
                    ],
                    [
                        'name' => 'Street',
                        'description' => $isEn ? 'Executing grinds and jumps on handrails, ledges, and stairs.' : 'Mengeksekusi grind dan lompatan di atas handrail, tangga, dan pembatas jalan.',
                        'competition_level' => 'National & International',
                        'icon' => 'fas fa-road',
                        'image' => 'disiplin-street.png',
                    ],
                ]
            ],
            'scooter' => [
                'name'        => 'Scooter',
                'slug'        => 'scooter',
                'tagline'     => $isEn ? 'Acrobatics, Innovation & Flight' : 'Akrobatik, Inovasi & Terbang Tinggi',
                'hero_image'  => 'cabor-scooter.png',
                'badge_color' => 'emerald',
                'badge_text'  => $isEn ? 'Discipline' : 'Disiplin Olahraga',
                'description' => $isEn 
                    ? 'Freestyle Scooter blends BMX acrobatics and skateboarding elements. Riders execute whip tricks, barspins, and flips using ramps or street obstacles.'
                    : 'Scooter Freestyle menggabungkan elemen akrobatik sepeda BMX dan skateboard menggunakan otopet/scooter. Atlet melakukan variasi whip, barspin, dan flip memanfaatkan ramp atau rintangan jalanan.',
                'overview'    => $isEn 
                    ? 'Scooter is growing very rapidly among Indonesian youth. PB PORSEROSI officially sanctions national-level development and standard competitions.'
                    : 'Disiplin Scooter berkembang sangat pesat di kalangan pemuda Indonesia. PB PORSEROSI secara resmi menaungi pembinaan prestasi serta kompetisi berstandar nasional.',
                'disciplines' => [
                    [
                        'name' => 'Park',
                        'description' => $isEn ? 'Aerial tricks using transitions, spinboxes, and quarter pipes.' : 'Trik udara menggunakan transisi, spinbox, dan quarter pipe di area skatepark.',
                        'competition_level' => 'National & Regional',
                        'icon' => 'fas fa-mountain',
                        'image' => 'disiplin-scooter-park.png',
                    ],
                    [
                        'name' => 'Street',
                        'description' => $isEn ? 'Technical grinds and ledge combos on street obstacles.' : 'Grind teknis dan kombinasi trik pada handrail serta pembatas jalan.',
                        'competition_level' => 'National & Regional',
                        'icon' => 'fas fa-road',
                        'image' => 'disiplin-scooter-street.png',
                    ],
                    [
                        'name' => 'Best Trick',
                        'description' => $isEn ? 'One-shot execution of the most difficult and innovative trick.' : 'Kompetisi satu kesempatan untuk memperlihatkan trik tersulit dan paling inovatif.',
                        'competition_level' => 'National',
                        'icon' => 'fas fa-star',
                        'image' => 'disiplin-scooter-park.png',
                    ],
                ]
            ],
            'skateboard' => [
                'name'        => 'Skateboard',
                'slug'        => 'skateboard',
                'tagline'     => $isEn ? 'Creativity, Culture & Olympics' : 'Kreativitas, Budaya & Olimpiade',
                'hero_image'  => 'cabor-skateboard.png',
                'badge_color' => 'yellow',
                'badge_text'  => $isEn ? 'Discipline' : 'Disiplin Olahraga',
                'description' => $isEn 
                    ? 'Skateboarding is an iconic action sport and an official Olympic discipline. It evaluates style, trick difficulty, control, and creative utilization of street or park courses.'
                    : 'Skateboarding adalah olahraga aksi ikonik yang kini menjadi disiplin resmi Olimpiade. Menilai gaya (style), tingkat kesulitan trik, kontrol papan, serta kreativitas memanfaatkan rintangan.',
                'overview'    => $isEn 
                    ? 'Indonesian skateboarders have achieved remarkable milestones at the SEA Games and Asian Games. PB PORSEROSI continues nurturing talents towards Olympic qualification.'
                    : 'Skateboarder Indonesia telah menorehkan prestasi gemilang di SEA Games dan Asian Games. PB PORSEROSI terus mengembangkan talenta menuju kualifikasi Olimpiade.',
                'disciplines' => [
                    [
                        'name' => 'Street',
                        'description' => $isEn ? 'Using real street obstacles such as stairs, handrails, and ledges.' : 'Memanfaatkan rintangan jalanan nyata seperti tangga, rel, dan ledge.',
                        'competition_level' => 'Olympics, Asian Games, SEA Games',
                        'icon' => 'fas fa-road',
                        'image' => 'disiplin-street.png',
                    ],
                    [
                        'name' => 'Park',
                        'description' => $isEn ? 'Flowing speed and high air tricks inside a deep concrete dome or bowl.' : 'Kecepatan dan trik udara tinggi di dalam kubah beton bowl yang dalam.',
                        'competition_level' => 'Olympics, Asian Games, SEA Games',
                        'icon' => 'fas fa-mountain',
                        'image' => 'disiplin-park.png',
                    ],
                    [
                        'name' => 'Game of Skate',
                        'description' => $isEn ? 'Flatground match play copying tricks between riders.' : 'Pertandingan adu trik di atas permukaan rata dengan cara meniru gerakan lawan.',
                        'competition_level' => 'National',
                        'icon' => 'fas fa-gamepad',
                        'image' => 'disiplin-street.png',
                    ],
                ]
            ],
            'speed' => [
                'name'        => 'Speed',
                'slug'        => 'speed',
                'tagline'     => $isEn ? 'Absolute Speed, Endurance & Strategy' : 'Kecepatan Mutlak, Daya Tahan & Strategi',
                'hero_image'  => 'cabor-sepaturoda.png',
                'badge_color' => 'orange',
                'badge_text'  => $isEn ? 'Discipline' : 'Disiplin Olahraga',
                'description' => $isEn 
                    ? 'Inline Speed Skating is a racing discipline where athletes sprint or run long distances on oval tracks or roads. It demands immense leg power, aerobic stamina, and tactical positioning.'
                    : 'Inline Speed Skating adalah disiplin balapan adu cepat di mana atlet melakukan sprint atau lari jarak jauh di lintasan oval maupun jalan raya. Menuntut kekuatan kaki luar biasa, stamina aerobik, dan taktik posisi.',
                'overview'    => $isEn 
                    ? 'Speed is a major gold medal source for Indonesia in Asian championships. PB PORSEROSI runs centralized national training programs at international-standard speed tracks.'
                    : 'Speed skating adalah tambang medali emas andalan Indonesia di Asia. PB PORSEROSI mengelola pemusatan latihan nasional terpusat di sirkuit berstandar internasional.',
                'disciplines' => [
                    [
                        'name' => 'Track Racing',
                        'description' => $isEn ? 'Races on banked oval tracks, focusing on drafting and sprints.' : 'Balapan di lintasan miring oval, berfokus pada teknik draft dan sprint.',
                        'competition_level' => 'Asian Games, World Championships',
                        'icon' => 'fas fa-tachometer-alt',
                        'image' => 'disiplin-speed.png',
                    ],
                    [
                        'name' => 'Road Racing',
                        'description' => $isEn ? 'Long distance races held on open asphalt roads or circuits.' : 'Balapan jarak jauh yang diselenggarakan di sirkuit jalan raya beraspal.',
                        'competition_level' => 'World Championships',
                        'icon' => 'fas fa-road',
                        'image' => 'disiplin-speed.png',
                    ],
                    [
                        'name' => 'Marathon',
                        'description' => $isEn ? 'Endurance race covering standard 42km distances.' : 'Balapan ketahanan menempuh jarak maraton standar 42 kilometer.',
                        'competition_level' => 'World Championships',
                        'icon' => 'fas fa-running',
                        'image' => 'disiplin-downhill.png',
                    ],
                ]
            ],
            'artistic' => [
                'name'        => 'Artistic',
                'slug'        => 'artistic',
                'tagline'     => $isEn ? 'Beauty, Elegance & Precision' : 'Keindahan, Keanggunan & Presisi',
                'hero_image'  => 'cabor-sepaturoda.png',
                'badge_color' => 'pink',
                'badge_text'  => $isEn ? 'Discipline' : 'Disiplin Olahraga',
                'description' => $isEn 
                    ? 'Artistic Skating combines dance, gymnastics, and skating skill on quad or inline skates. Skaters are judged on jumps, spins, choreography, and interpretation of music.'
                    : 'Artistic Skating menggabungkan unsur tari, senam, dan keterampilan meluncur menggunakan sepatu roda quad atau inline. Atlet dinilai dari lompatan, putaran, koreografi, serta penjiwaan musik.',
                'overview'    => $isEn 
                    ? 'The Artistic discipline represents the peak of aesthetics and technical precision. PB PORSEROSI supports artistic skaters competing in world championships.'
                    : 'Disiplin Artistic mewakili puncak estetika dan presisi teknis. PB PORSEROSI mendukung pembinaan atlet artistik untuk berkompetisi di tingkat dunia.',
                'disciplines' => [
                    [
                        'name' => 'Free Skating',
                        'description' => $isEn ? 'Athletes perform individual programs featuring jumps, spins, and footwork.' : 'Penampilan program individu yang menampilkan kombinasi lompatan, putaran, dan langkah kaki.',
                        'competition_level' => 'World Championships',
                        'icon' => 'fas fa-star',
                        'image' => 'disiplin-artistic.png',
                    ],
                    [
                        'name' => 'Solo Dance',
                        'description' => $isEn ? 'Focuses on musicality, rhythm, and skate edge control.' : 'Berfokus pada musikalitas, ketukan ritme, dan kontrol tepi roda saat menari.',
                        'competition_level' => 'World Championships',
                        'icon' => 'fas fa-user',
                        'image' => 'disiplin-artistic.png',
                    ],
                    [
                        'name' => 'Compulsory Figures',
                        'description' => $isEn ? 'Tracing clean geometric patterns on the floor with extreme precision.' : 'Mengikuti pola geometris lingkaran di lantai dengan presisi ekstrem.',
                        'competition_level' => 'World Championships',
                        'icon' => 'fas fa-circle',
                        'image' => 'disiplin-artistic.png',
                    ],
                ]
            ],
        ];
    }

    public function cabangOlahraga($slug)
    {
        $locale = app()->getLocale();
        $isEn = $locale === 'en';
        $cabangData = self::getDisciplinesData($locale);

        if (!isset($cabangData[$slug])) {
            abort(404);
        }

        $cabor = $cabangData[$slug];

        SEOMeta::setTitle("{$cabor['name']} | " . ($isEn ? 'Sports Discipline PB PORSEROSI' : 'Disiplin Olahraga PB PORSEROSI'));
        SEOMeta::setDescription($cabor['description']);
        SEOMeta::addKeyword([
            $cabor['name'], 'PB PORSEROSI', 'disiplin olahraga', 'roller sports', 
            'atlet ' . $cabor['name'], 'juara ' . $cabor['name'], $cabor['name'] . ' Indonesia'
        ]);

        // All cabang for navigation
        $allCabang = collect($cabangData)->map(fn($c) => [
            'name'       => $c['name'],
            'slug'       => $c['slug'],
            'hero_image' => $c['hero_image'],
        ]);

        return view('front.cabang-olahraga', compact('cabor', 'allCabang'));
    }

    public function index()
    {
        SEOMeta::setTitle(__('messages.seo_news_title'));
        SEOMeta::setDescription(__('messages.seo_news_desc'));
        SEOMeta::addKeyword([
            'berita sepatu roda', 'berita skateboard', 'berita scooter',
            'berita PORSEROSI', 'atlet sepatu roda', 'atlet skateboard', 'atlet scooter',
            'juara skateboard', 'juara sepatu roda'
        ]);

        $categories = Category::all();
        $articles = ArticleNews::with(['category', 'author'])
            ->where('is_featured', 'not_featured')
            ->latest()
            ->take(3)
            ->get();

        $featured_articles = ArticleNews::with(['category', 'author'])
            ->where('is_featured', 'featured')
            ->latest()
            ->take(5)
            ->get();

        $authors = Author::all();

        // Data untuk section dinamis berdasarkan kategori (di-caching 10 menit agar hemat query & RAM)
        $category_sections = Cache::remember('blog_category_sections', 600, function() {
            $category_sections = [];
            $categories = Category::all();

            foreach ($categories as $category) {
                // Ambil 1 artikel utama/unggulan (atau artikel terbaru jika tidak ada yang ditandai featured)
                $featured = ArticleNews::with(['category', 'author'])
                    ->where('category_id', $category->id)
                    ->where('is_featured', 'featured')
                    ->latest()
                    ->first()
                    ?? ArticleNews::with(['category', 'author'])
                    ->where('category_id', $category->id)
                    ->latest()
                    ->first();

                // Ambil maksimal 6 artikel biasa (bukan unggulan)
                $articles = ArticleNews::with(['category', 'author'])
                    ->where('category_id', $category->id)
                    ->where('is_featured', 'not_featured')
                    ->latest()
                    ->take(6)
                    ->get();

                $category_sections[$category->slug] = [
                    'featured' => $featured,
                    'articles' => $articles,
                ];
            }
            return $category_sections;
        });

        $upcoming_events = \App\Models\Event::whereIn('status', ['upcoming', 'ongoing'])
            ->orderBy('start_date', 'asc')
            ->take(4)
            ->get();

        $bannerAds = BannerAdvertisement::getActiveBannersForPage('index');

        return view('front.index', compact('categories', 'articles', 'authors', 'featured_articles', 'category_sections', 'upcoming_events', 'bannerAds'));
    }

    public function category(Category $category)
    {
        SEOMeta::setTitle("Artikel {$category->name} | PB PORSEROSI");
        SEOMeta::setDescription("Kumpulan artikel terbaru tentang {$category->name} dari PB PORSEROSI");

        $categories = Category::all();

        return view('front.category', compact('category', 'categories'));
    }

    public function author(Author $author)
    {
        SEOMeta::setTitle("Artikel oleh {$author->name} | PB PORSEROSI");
        SEOMeta::setDescription("Kumpulan artikel yang ditulis oleh {$author->name}");

        $categories = Category::all();
        $bannerAds = BannerAdvertisement::getActiveBannersForPage('author');
        $bannerads = $bannerAds->first();

        return view('front.author', compact('categories', 'author', 'bannerads'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'keyword' => ['required', 'string', 'max:255'],
        ]);

        $keyword = $request->keyword;

        SEOMeta::setTitle(__('messages.seo_search_title', ['keyword' => $keyword]));
        SEOMeta::setDescription(__('messages.seo_search_desc', ['keyword' => $keyword]));

        $categories = Category::all();
        $articles = ArticleNews::with(['category', 'author'])
            ->where('name', 'like', '%' . $keyword . '%')
            ->paginate(6);

        $bannerAds = BannerAdvertisement::getActiveBannersForPage('search');

        return view('front.search', compact('articles', 'keyword', 'categories', 'bannerAds'));
    }

    public function details(ArticleNews $articleNews)
    {
        // SEO Configuration
        SEOMeta::setTitle($articleNews->getLocalizedTitle() . ' | PB PORSEROSI');
        SEOMeta::setDescription(Str::limit(strip_tags($articleNews->getLocalizedContent()), 160));
        SEOMeta::addMeta('article:published_time', $articleNews->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $articleNews->category->name, 'property');
        SEOMeta::addKeyword([strtolower($articleNews->category->name), 'sepatu roda', 'skateboard']);

        OpenGraph::setTitle($articleNews->getLocalizedTitle());
        OpenGraph::setDescription(SEOMeta::getDescription());
        OpenGraph::setUrl(url()->current());
        OpenGraph::addImage(get_image_url($articleNews->thumbnail));
        OpenGraph::setType('article');
        OpenGraph::addProperty('locale', 'id_ID');

        TwitterCard::setTitle($articleNews->getLocalizedTitle());
        TwitterCard::setDescription(SEOMeta::getDescription());
        TwitterCard::setImage(get_image_url($articleNews->thumbnail));

        // Data Preparation
        $categories = Category::all();
        $articles = ArticleNews::with(['category', 'author'])
            ->where('is_featured', 'not_featured')
            ->where('id', '!=', $articleNews->id)
            ->latest()
            ->take(3)
            ->get();

        $author_news = ArticleNews::where('author_id', $articleNews->author_id)->where('id', '!=', $articleNews->id)->inRandomOrder()->get();

        $bannerAds = BannerAdvertisement::getActiveBannersForPage('details');

        return view('front.details', compact('author_news', 'articleNews', 'categories', 'articles', 'bannerAds'));
    }

    public function storeFeedback(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Anda harus login dengan Google terlebih dahulu untuk mengirimkan saran & masukan.');
        }

        // Honeypot check for bots
        if ($request->filled('website')) {
            return redirect()->back()->with('success_feedback', 'Terima kasih atas saran dan masukan Anda!');
        }

        // Rate Limiter: Diperketat menjadi maksimal 3 kali per jam per IP
        $ip = $request->ip();
        if (RateLimiter::tooManyAttempts('feedback-submit:'.$ip, 3)) {
            $seconds = RateLimiter::availableIn('feedback-submit:'.$ip);
            return redirect()->back()
                ->with('error', 'Terlalu banyak masukan yang dikirimkan. Silakan coba lagi dalam ' . ceil($seconds / 60) . ' menit.');
        }
        RateLimiter::hit('feedback-submit:'.$ip, 3600); // Track limit for 1 hour

        $validDisciplines = array_merge(['Umum'], array_column(self::getDisciplinesData(), 'name'));

        $validated = $request->validate([
            'discipline' => 'required|string|in:' . implode(',', $validDisciplines),
            'message' => 'required|string|min:10|max:1000',
        ]);

        $email = auth()->user()->email;

        // Validasi 1 email hanya boleh mengirim 1 saran
        $existing = \App\Models\Feedback::where('email', $email)->exists();
        if ($existing) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email Anda sudah pernah mengirimkan saran dan masukan sebelumnya.');
        }

        \App\Models\Feedback::create([
            'email' => $email,
            'discipline' => $validated['discipline'],
            'message' => strip_tags($validated['message']), // Sanitisasi HTML/Script tags untuk mencegah XSS
        ]);

        return redirect()->back()->with('success_feedback', 'Terima kasih atas saran dan masukan Anda!');
    }
}