<?php

namespace App\Providers;

use App\Models\ArticleNews;
use App\Models\Category;

use App\Models\Panduan;
use App\Models\Achievement;
use App\Models\Author;
use App\Models\Event;
use App\Models\LiveStreaming;
use App\Models\Partner;
use App\Models\Gallery;
use App\Models\Officer;
use App\Models\RegulationFolder;
use App\Models\Regulation;
use App\Models\ResultFolder;
use App\Models\ResultFile;

use App\Observers\ArticleNewsObserver;
use App\Observers\CategoryObserver;

use App\Observers\PanduanObserver;
use App\Observers\AchievementObserver;
use App\Observers\AuthorObserver;
use App\Observers\EventObserver;
use App\Observers\LiveStreamingObserver;
use App\Observers\PartnerObserver;
use App\Observers\GalleryObserver;
use App\Observers\OfficerObserver;
use App\Observers\RegulationFolderObserver;
use App\Observers\RegulationObserver;
use App\Observers\ResultFolderObserver;
use App\Observers\ResultFileObserver;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path('helpers.php');
    }

    /**
     * Bootstrap any application services.
     * Register model observers for auto-translation.
     */
    public function boot(): void
    {
        ArticleNews::observe(ArticleNewsObserver::class);
        Category::observe(CategoryObserver::class);

        Panduan::observe(PanduanObserver::class);
        Achievement::observe(AchievementObserver::class);
        Author::observe(AuthorObserver::class);
        Event::observe(EventObserver::class);
        LiveStreaming::observe(LiveStreamingObserver::class);
        Partner::observe(PartnerObserver::class);
        Gallery::observe(GalleryObserver::class);
        Officer::observe(OfficerObserver::class);
        RegulationFolder::observe(RegulationFolderObserver::class);
        Regulation::observe(RegulationObserver::class);
        ResultFolder::observe(ResultFolderObserver::class);
        ResultFile::observe(ResultFileObserver::class);
    }
}