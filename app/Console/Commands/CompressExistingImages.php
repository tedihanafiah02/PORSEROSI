<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompressExistingImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:compress-existing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compress all existing images in the database and public storage to WebP format';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting existing image compression to WebP...');

        // Map tables and their respective image columns
        $config = [
            'galleries' => ['image_path'],
            'article_news' => ['thumbnail'],
            'authors' => ['avatar'],
            'banner_advertisements' => ['thumbnail'],
            'categories' => ['icon'],
            'events' => ['logo'],
            'live_streamings' => ['thumbnail'],
            'panduans' => ['image'],
            'partners' => ['logo_path'],
            'wasit_pelatihs' => ['foto_path', 'sertifikat_path'],
        ];

        foreach ($config as $table => $columns) {
            if (!DB::getSchemaBuilder()->hasTable($table)) {
                $this->warn("Table '{$table}' does not exist. Skipping.");
                continue;
            }

            foreach ($columns as $column) {
                // Get records that have files
                $records = DB::table($table)
                    ->whereNotNull($column)
                    ->where($column, '<>', '')
                    ->get();

                if ($records->isEmpty()) {
                    continue;
                }

                $this->info("Scanning table: {$table}.{$column} (Found {$records->count()} records)...");

                $successCount = 0;
                foreach ($records as $record) {
                    $originalPath = $record->$column;
                    
                    // Skip external urls
                    if (str_starts_with($originalPath, 'http://') || str_starts_with($originalPath, 'https://')) {
                        continue;
                    }

                    // Clean the path
                    $cleanPath = ltrim($originalPath, '/');
                    if (str_starts_with($cleanPath, 'storage/')) {
                        $cleanPath = substr($cleanPath, 8);
                    }

                    // Check if file exists
                    if (!Storage::disk('public')->exists($cleanPath)) {
                        continue;
                    }

                    // Skip if already webp
                    if (strtolower(pathinfo($cleanPath, PATHINFO_EXTENSION)) === 'webp') {
                        continue;
                    }

                    $fullPath = Storage::disk('public')->path($cleanPath);

                    // Check if it's a valid image
                    $imageInfo = @getimagesize($fullPath);
                    if (!$imageInfo) {
                        continue;
                    }

                    $mime = $imageInfo['mime'];
                    if (!str_starts_with($mime, 'image/')) {
                        continue;
                    }

                    // Read image
                    $data = @file_get_contents($fullPath);
                    $image = @imagecreatefromstring($data);
                    if (!$image) {
                        $this->error("Failed to load image resource for: {$cleanPath}");
                        continue;
                    }

                    // Preserve transparency
                    imagepalettetotruecolor($image);
                    imagealphablending($image, false);
                    imagesavealpha($image, true);

                    // Generate new path with .webp extension
                    $dir = pathinfo($cleanPath, PATHINFO_DIRNAME);
                    $filename = pathinfo($cleanPath, PATHINFO_FILENAME);
                    $newFilename = $filename . '-' . uniqid() . '.webp';
                    
                    // Target clean path
                    $newCleanPath = ($dir === '.' || $dir === '') ? $newFilename : $dir . '/' . $newFilename;

                    ob_start();
                    imagewebp($image, null, 80);
                    $webpContent = ob_get_clean();
                    imagedestroy($image);

                    // Save new webp file
                    Storage::disk('public')->put($newCleanPath, $webpContent);

                    // Update database
                    // Since it could be pointing to "storage/..." or directly relative, we preserve the path format
                    $dbPath = $newCleanPath;
                    if (str_starts_with($originalPath, 'storage/')) {
                        $dbPath = 'storage/' . $newCleanPath;
                    } elseif (str_starts_with($originalPath, '/storage/')) {
                        $dbPath = '/storage/' . $newCleanPath;
                    } elseif (str_starts_with($originalPath, '/')) {
                        $dbPath = '/' . $newCleanPath;
                    }

                    // Update DB record
                    DB::table($table)->where('id', $record->id)->update([$column => $dbPath]);

                    // Delete original file
                    Storage::disk('public')->delete($cleanPath);

                    $this->line("Compressed: {$cleanPath} -> {$newCleanPath}");
                    $successCount++;
                }

                if ($successCount > 0) {
                    $this->info("Completed {$table}.{$column}: compressed {$successCount} images.");
                }
            }
        }

        $this->info('Finished existing image compression!');
    }
}
