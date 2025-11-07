<?php

namespace App\Listeners;

use App\Mail\SeriesCreated;
use App\Events\SeriesCreated as SeriesCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EmailUsersAboutSeriesCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SeriesCreatedEvent $event): void
    {
        $email = new SeriesCreated(
            $event->seriesName,
            $event->seriesId,
            $event->seriesSeasonsQty,
            $event->seriesEpisodesPerSeason,
        );

        Mail::to($event->seriesUser->email)->send($email);
    }
}
