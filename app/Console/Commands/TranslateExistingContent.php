<?php

namespace App\Console\Commands;

use App\Models\ArticleNews;
use App\Models\Category;

use App\Models\Panduan;
use App\Models\Achievement;
use App\Models\Author;
use App\Models\Event;
use App\Models\LiveStreaming;
use App\Models\Partner;
use App\Models\Gallery;
use App\Services\AutoTranslateService;
use Illuminate\Console\Command;

class TranslateExistingContent extends Command
{
    protected $signature   = 'translate:all {--force : Re-translate even if English content already exists}';
    protected $description = 'Auto-translate all existing Indonesian content in the database to English.';

    public function handle(AutoTranslateService $translator): int
    {
        $force = $this->option('force');

        $this->info('🌐 Starting auto-translation of existing content...');
        $this->newLine();

        // ---------- CATEGORIES ----------
        $this->components->info('Translating Categories...');
        $categories = Category::all();
        $bar = $this->output->createProgressBar($categories->count());
        $bar->start();

        foreach ($categories as $category) {
            if ($force || empty($category->name_en)) {
                $translated = $translator->translate($category->name);
                if ($translated) {
                    Category::withoutEvents(fn () => $category->updateQuietly(['name_en' => $translated]));
                }
            }
            $bar->advance();
            usleep(300000); // 0.3s delay to avoid rate limiting
        }

        $bar->finish();
        $this->newLine(2);

        // ---------- ARTICLES ----------
        $this->components->info('Translating Articles (this may take a while)...');
        $articles = ArticleNews::all();
        $bar = $this->output->createProgressBar($articles->count());
        $bar->start();

        foreach ($articles as $article) {
            $updates = [];

            if ($force || empty($article->title_en)) {
                $translated = $translator->translate($article->name);
                if ($translated) $updates['title_en'] = $translated;
            }

            if ($force || empty($article->content_en)) {
                $translated = $translator->translateHtml($article->content);
                if ($translated) $updates['content_en'] = $translated;
            }

            if (!empty($updates)) {
                ArticleNews::withoutEvents(fn () => $article->updateQuietly($updates));
            }

            $bar->advance();
            usleep(500000); // 0.5s delay — content is longer
        }

        $bar->finish();
        $this->newLine(2);



        // ---------- PANDUANS ----------
        $this->components->info('Translating Panduan/Documents...');
        $panduans = Panduan::all();
        $bar = $this->output->createProgressBar($panduans->count());
        $bar->start();

        foreach ($panduans as $panduan) {
            $updates = [];

            if ($force || empty($panduan->title_en)) {
                $translated = $translator->translate($panduan->title);
                if ($translated) $updates['title_en'] = $translated;
            }

            if (($force || empty($panduan->description_en)) && !empty($panduan->description)) {
                $translated = $translator->translate($panduan->description);
                if ($translated) $updates['description_en'] = $translated;
            }

            if (!empty($updates)) {
                Panduan::withoutEvents(fn () => $panduan->updateQuietly($updates));
            }

            $bar->advance();
            usleep(300000);
        }

        $bar->finish();
        $this->newLine(2);

        // ---------- ACHIEVEMENTS ----------
        $this->components->info('Translating Achievements...');
        $achievements = Achievement::all();
        $bar = $this->output->createProgressBar($achievements->count());
        $bar->start();
        foreach ($achievements as $achievement) {
            $updates = [];
            if ($force || empty($achievement->tournament_name_en)) {
                $translated = $translator->translate($achievement->tournament_name);
                if ($translated) $updates['tournament_name_en'] = $translated;
            }
            if ($force || empty($achievement->tournament_level_en)) {
                $translated = $translator->translate($achievement->tournament_level);
                if ($translated) $updates['tournament_level_en'] = $translated;
            }
            if ($force || empty($achievement->discipline_en)) {
                $translated = $translator->translate($achievement->discipline);
                if ($translated) $updates['discipline_en'] = $translated;
            }
            if (!empty($updates)) Achievement::withoutEvents(fn () => $achievement->updateQuietly($updates));
            $bar->advance();
            usleep(200000);
        }
        $bar->finish();
        $this->newLine(2);

        // ---------- AUTHORS ----------
        $this->components->info('Translating Authors...');
        $authors = Author::all();
        $bar = $this->output->createProgressBar($authors->count());
        $bar->start();
        foreach ($authors as $author) {
            if ($force || empty($author->occupation_en)) {
                $translated = $translator->translate($author->occupation);
                if ($translated) Author::withoutEvents(fn () => $author->updateQuietly(['occupation_en' => $translated]));
            }
            $bar->advance();
            usleep(200000);
        }
        $bar->finish();
        $this->newLine(2);

        // ---------- EVENTS ----------
        $this->components->info('Translating Events...');
        $events = Event::all();
        $bar = $this->output->createProgressBar($events->count());
        $bar->start();
        foreach ($events as $event) {
            $updates = [];
            $fields = ['name' => 'name_en', 'venue' => 'venue_en', 'city' => 'city_en', 'country' => 'country_en', 'organizer' => 'organizer_en'];
            foreach ($fields as $s => $t) {
                if ($force || empty($event->$t)) {
                    $translated = $translator->translate($event->$s);
                    if ($translated) $updates[$t] = $translated;
                }
            }
            if ($force || empty($event->description_en)) {
                $translated = $translator->translateHtml($event->description);
                if ($translated) $updates['description_en'] = $translated;
            }
            if (!empty($updates)) Event::withoutEvents(fn () => $event->updateQuietly($updates));
            $bar->advance();
            usleep(300000);
        }
        $bar->finish();
        $this->newLine(2);

        // ---------- LIVE STREAMINGS ----------
        $this->components->info('Translating Live Streamings...');
        $lives = LiveStreaming::all();
        $bar = $this->output->createProgressBar($lives->count());
        $bar->start();
        foreach ($lives as $live) {
            $updates = [];
            if ($force || empty($live->title_en)) {
                $translated = $translator->translate($live->title);
                if ($translated) $updates['title_en'] = $translated;
            }
            if ($force || empty($live->description_en)) {
                $translated = $translator->translate($live->description);
                if ($translated) $updates['description_en'] = $translated;
            }
            if (!empty($updates)) LiveStreaming::withoutEvents(fn () => $live->updateQuietly($updates));
            $bar->advance();
            usleep(200000);
        }
        $bar->finish();
        $this->newLine(2);

        // ---------- PARTNERS & GALLERIES ----------
        $this->components->info('Translating Partners & Galleries...');
        $partners = Partner::all();
        $galleries = Gallery::all();
        $bar = $this->output->createProgressBar($partners->count() + $galleries->count());
        $bar->start();
        foreach ($partners as $partner) {
            if ($force || empty($partner->alt_text_en)) {
                $translated = $translator->translate($partner->alt_text);
                if ($translated) Partner::withoutEvents(fn () => $partner->updateQuietly(['alt_text_en' => $translated]));
            }
            $bar->advance();
            usleep(100000);
        }
        foreach ($galleries as $gallery) {
            if ($force || empty($gallery->alt_text_en)) {
                $translated = $translator->translate($gallery->alt_text);
                if ($translated) Gallery::withoutEvents(fn () => $gallery->updateQuietly(['alt_text_en' => $translated]));
            }
            $bar->advance();
            usleep(100000);
        }
        $bar->finish();
        $this->newLine(2);

        $this->info('✅ Auto-translation complete!');
        $this->line('   All existing content has been translated to English.');
        $this->line('   New content will be auto-translated when saved in Admin Panel.');

        return self::SUCCESS;
    }
}
