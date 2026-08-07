<?php
 
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Event;
use App\Models\LiveStreaming;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    Event::autoUpdateStatuses();
    LiveStreaming::autoUpdateStatuses();
})->everyFiveMinutes();
