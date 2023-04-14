<?php

namespace App\Listeners;

use App\Mail\TagdCreated as TagdCreatedMail;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Mail;
use Tagd\Core\Events\Items\Tagd\Created;

class Tagd
{
    public function onCreated(Created $event)
    {
        $tagd = $event->tagd;

        if ($tagd->is_root) {
            // a tagd was created, send email

            Mail::to($tagd->consumer->email)
                ->send(new TagdCreatedMail($tagd));
        }
    }

    public function subscribe(Dispatcher $events): array
    {
        return [
            Created::class => 'onCreated',
        ];
    }
}
