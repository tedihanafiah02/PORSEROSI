<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PartnerController;
use Illuminate\Support\Facades\Session;

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::controller(FrontController::class)->group(function () {
    Route::get('/robots.txt', 'robots');
    Route::get('/sitemap.xml', [FrontController::class, 'sitemap']);
    Route::get('/', 'beranda')->name('front.beranda');
    Route::get('/tentang-kami', 'tentangKami')->name('front.tentangKami');
    
    // Tentang Kami Submenus
    Route::get('/struktur-organisasi', 'strukturOrganisasi')->name('front.strukturOrganisasi');
    Route::get('/peraturan', 'peraturan')->name('front.peraturan');
    Route::get('/kontak', 'kontak')->name('front.kontak');

    // Data Submenus
    Route::get('/data/provinsi', 'dataProvinsi')->name('front.data.provinsi');
    Route::get('/data/club', 'dataClub')->name('front.data.club');
    Route::get('/data/wasit', 'dataWasit')->name('front.data.wasit');
    Route::get('/data/pelatih', 'dataPelatih')->name('front.data.pelatih');

    // Event Submenus
    Route::get('/event/kompetisi', 'eventKompetisi')->name('front.event.kompetisi');
    Route::get('/event/kegiatan', 'eventKegiatan')->name('front.event.kegiatan');
    Route::get('/event/daftar', 'eventDaftar')->name('front.event.daftar');

    // Result Submenus
    Route::get('/result/{slug?}', 'result')->name('front.result');

    // Partner Submenus
    Route::get('/partner/join', 'partnerJoin')->name('front.partner.join');
    Route::post('/partner/join', 'storePartnerJoin')->name('front.partner.join.store');

    Route::get('/daftar/wasit-pelatih', 'daftarWasitPelatih')->name('front.daftar.wasitPelatih');
    Route::post('/daftar/wasit-pelatih', 'storeWasitPelatih')->name('front.daftar.wasitPelatih.store');
    Route::get('/daftar/wasit-pelatih/cek-status', 'checkStatusWasitPelatih')->name('front.daftar.wasitPelatih.status');
    
    Route::get('/daftar/event', fn() => redirect()->route('front.event.daftar'))->name('front.daftar.event');
    Route::get('/daftar/event/register/{event:slug}', 'registerEventParticipant')->name('front.daftar.event.register');
    Route::post('/daftar/event/register/{event:slug}', 'storeEventParticipant')->name('front.daftar.event.register.store')->middleware('throttle:5,1');
    Route::get('/daftar/event/cek-status-api', 'checkStatusEventApi')->name('front.daftar.event.status.api');

    Route::get('/unduh-panduan', 'panduan')->name('front.panduan');
    Route::get('/profil', 'profil')->name('front.profil');
    Route::get('/visimisi', 'visimisi')->name('front.visimisi');
    Route::get('/gallery', [PartnerController::class, 'index'])->name('front.gallery');
    Route::get('/partner', 'partner')->name('front.partner');
    // halaman/page blog - berita
    Route::get('/berita', 'index')->name('front.index');
    Route::get('/live', 'live')->name('front.live');
    Route::get('/details/{article_news:slug}', 'details')->name('front.details');
    Route::get('/category/{category:slug}', 'category')->name('front.category');
    Route::get('/author/{author:slug}', 'author')->name('front.author');
    Route::get('/search', 'search')->name('front.search');
    // halaman cabang olahraga
    Route::get('/cabang-olahraga/{slug}', 'cabangOlahraga')->name('front.cabangOlahraga');
    // halaman prestasi
    Route::get('/prestasi', 'prestasi')->name('front.prestasi');
    
    // feedback/saran masukan
    Route::post('/feedback', 'storeFeedback')->name('front.feedback.store');
    
    // legacy redirect
    Route::get('/layanan', fn() => redirect()->route('front.beranda'))->name('front.layanan');
    Route::get('/blog', fn() => redirect()->route('front.index'));
});

use App\Http\Controllers\GoogleController;

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::post('logout', [GoogleController::class, 'logout'])->name('logout');