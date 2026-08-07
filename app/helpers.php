<?php

if (!function_exists('get_image_url')) {
    function get_image_url($path) {
        if (!$path) {
            return asset('assets/images/default.jpg');
        }
        
        // If it's already a full URL (external link)
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }
        
        // If it starts with 'assets/' or is a theme asset
        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }
        
        // For uploaded files (storage)
        $cleanPath = ltrim($path, '/');
        
        // Clean common prefixes recursively/iteratively
        $prefixes = [
            'storage/app/public/',
            'app/public/',
            'public/storage/',
            'public/',
            'storage/',
        ];
        
        $changed = true;
        while ($changed) {
            $changed = false;
            foreach ($prefixes as $prefix) {
                if (str_starts_with($cleanPath, $prefix)) {
                    $cleanPath = substr($cleanPath, strlen($prefix));
                    $cleanPath = ltrim($cleanPath, '/');
                    $changed = true;
                }
            }
        }
        
        return asset('storage/' . $cleanPath);
    }
}

if (!function_exists('compress_to_webp')) {
    function compress_to_webp(\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file, string $directory): string
    {
        $tempPath = $file->getRealPath();
        
        // Check if GD and webp are supported
        if (!function_exists('imagewebp') || !function_exists('imagecreatefromstring')) {
            return $file->store($directory, 'public');
        }
        
        $imageInfo = @getimagesize($tempPath);
        if (!$imageInfo) {
            // Not an image or not readable, save normally
            return $file->store($directory, 'public');
        }
        
        $mime = $imageInfo['mime'];
        // Double check it's an image
        if (!str_starts_with($mime, 'image/')) {
            return $file->store($directory, 'public');
        }
        
        // Read file content
        $data = file_get_contents($tempPath);
        $image = @imagecreatefromstring($data);
        if (!$image) {
            return $file->store($directory, 'public');
        }
        
        // Preserve transparency
        imagepalettetotruecolor($image);
        imagealphablending($image, false);
        imagesavealpha($image, true);
        
        // Get clean filename
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $cleanFilename = \Illuminate\Support\Str::slug($originalName) . '-' . uniqid() . '.webp';
        $targetPath = $directory . '/' . $cleanFilename;
        
        ob_start();
        imagewebp($image, null, 80);
        $webpContent = ob_get_clean();
        imagedestroy($image);
        
        \Illuminate\Support\Facades\Storage::disk('public')->put($targetPath, $webpContent);
        
        return $targetPath;
    }
}
