<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Partner;
use App\Models\GalleryAlbum;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $partners = Partner::all();
        $albums = GalleryAlbum::withCount('galleries')->get();
        
        $activeAlbum = null;
        $galleries = collect();

        if ($request->has('album')) {
            $slug = $request->query('album');
            $activeAlbum = GalleryAlbum::where('slug', $slug)->first();
            
            if ($activeAlbum) {
                // Fetch photos from DB
                $dbGalleries = Gallery::where('gallery_album_id', $activeAlbum->id)->latest()->get();
                $finalGalleries = collect();
                
                foreach ($dbGalleries as $item) {
                    $finalGalleries->push([
                        'url' => get_image_url($item->image_path),
                        'alt_text' => $item->getLocalizedAlt() ?? "Dokumentasi PB PORSEROSI",
                        'created_at' => $item->created_at
                    ]);
                }

                // If this is the "Umum" album, append the 30 static default photos
                if ($slug === 'umum') {
                    for ($i = 1; $i <= 30; $i++) {
                        $finalGalleries->push([
                            'url' => get_image_url("assets/images/porserosi/pb{$i}.webp"),
                            'alt_text' => "Dokumentasi PB PORSEROSI",
                            'created_at' => null
                        ]);
                    }
                }
                
                $galleries = $finalGalleries;
            }
        }

        return view('front.gallery', compact('partners', 'albums', 'activeAlbum', 'galleries'));
    }
}