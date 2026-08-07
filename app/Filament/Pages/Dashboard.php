<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Author;
use App\Models\ArticleNews;
use App\Models\Category;
use App\Models\BannerAdvertisement;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\Event;

use App\Models\Achievement;
use Carbon\Carbon;

class Dashboard extends Page
{
    protected static ?string $navigationIcon  = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title           = 'Dashboard';
    protected static ?int    $navigationSort  = -1;

    protected static string $view = 'filament.pages.dashboard';

    public function getViewData(): array
    {
        // Berita & Konten
        $totalArticles  = ArticleNews::count();
        $featuredArticles = ArticleNews::where('is_featured', 'featured')->count();
        $recentArticles = ArticleNews::latest()->take(5)->get();

        // Prestasi
        $totalAchievements = Achievement::count();
        $totalWinner       = Achievement::where('achievement_type', 'Winner')->orWhere('achievement_type', 'Juara 1')->count();
        $totalBronze       = Achievement::where('achievement_type', 'Bronze')->orWhere('achievement_type', 'Juara 3')->count();
        $achievementYears  = Achievement::distinct('year')->count('year');

        // Event
        $totalEvents       = Event::count();
        $upcomingEvents    = Event::where('start_date', '>=', Carbon::now())->count();
        $recentEvents      = Event::latest()->take(4)->get();

        // Rekapitulasi Event per Disiplin
        $cabors = [
            'Inline Freestyle' => ['inline-freestyle'],
            'Inline Hockey'    => ['inline-hockey'],
            'Roller Freestyle' => ['roller-freestyle'],
            'Scooter'          => ['scooter'],
            'Skateboard'       => ['skateboard'],
            'Speed'            => ['speed'],
            'Artistic'         => ['artistic'],
        ];

        $eventStatsByCabor = [];
        $currentMonth = Carbon::now()->month;
        $currentYear  = Carbon::now()->year;

        foreach ($cabors as $caborName => $sportTypes) {
            $total = Event::whereIn('sport_type', $sportTypes)->count();
            $thisMonth = Event::whereIn('sport_type', $sportTypes)
                ->whereMonth('start_date', $currentMonth)
                ->whereYear('start_date', $currentYear)
                ->count();
            
            $eventStatsByCabor[] = [
                'name'       => $caborName,
                'total'      => $total,
                'this_month' => $thisMonth,
            ];
        }

        // Gallery & Partner
        $totalGalleries = Gallery::count();
        $totalPartners  = Partner::count();

        // Konten lain
        $totalAuthors      = Author::count();
        $totalCategories   = Category::count();
        $totalBanners      = BannerAdvertisement::count();

        return compact(
            'totalArticles', 'featuredArticles', 'recentArticles',
            'totalAchievements', 'totalWinner', 'totalBronze', 'achievementYears',
            'totalEvents', 'upcomingEvents', 'recentEvents', 'eventStatsByCabor',
            'totalGalleries', 'totalPartners',
            'totalAuthors', 'totalCategories', 'totalBanners'
        );
    }
}