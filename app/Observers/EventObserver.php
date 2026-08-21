<?php

namespace App\Observers;

use App\Models\Event;
use App\Services\AutoTranslateService;
use Illuminate\Support\Facades\Log;

class EventObserver
{
    protected AutoTranslateService $translator;

    public function __construct(AutoTranslateService $translator)
    {
        $this->translator = $translator;
    }

    public function saved(Event $event): void
    {
        $needsUpdate = false;
        $updates = [];

        $fieldsToTranslate = [
            'name' => 'name_en',
            'venue' => 'venue_en',
            'city' => 'city_en',
            'country' => 'country_en',
            'organizer' => 'organizer_en',
        ];

        foreach ($fieldsToTranslate as $source => $target) {
            if (!empty($event->$source) && empty($event->$target)) {
                $translated = $this->translator->translate($event->$source);
                if ($translated) {
                    $updates[$target] = $translated;
                    $needsUpdate = true;
                }
            }
        }

        if (!empty($event->description) && empty($event->description_en)) {
            $translated = $this->translator->translateHtml($event->description);
            if ($translated) {
                $updates['description_en'] = $translated;
                $needsUpdate = true;
            }
        }

        if ($needsUpdate) {
            Event::withoutEvents(function () use ($event, $updates) {
                $event->updateQuietly($updates);
            });
            Log::info("Event #{$event->id}: Auto-translated to English.");
        }
    }
}


// masukan datanya ke dalam semua function diatas, jadi tinggal di panggil aja di view nya