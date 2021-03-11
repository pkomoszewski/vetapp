<?php

namespace App\Listeners;

use App\Events\Event2FA;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\info2faEmail;
class SendEmail2FaListner

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
     * @param  Event2FA  $event
     * @return void
     */
    public function handle(Event2FA $event)
    {
  
    Mail::to($event->user)->send(new info2faEmail($event->user,$event->status));
    }
}
