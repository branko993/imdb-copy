<?php

namespace App\Listeners;

use App\Events\MovieCreation;
use App\Mail\MovieCreationEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MovieCreation  $event
     * @return void
     */
    public function handle(MovieCreation $event)
    {
        Mail::to('branko.mirnic@vivifyideas.com')->send(new MovieCreationEmail($event->movie));
    }
}
