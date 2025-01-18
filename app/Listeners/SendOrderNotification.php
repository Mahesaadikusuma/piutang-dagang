<?php

namespace App\Listeners;

use App\Events\OrderStatusUpdated;
use App\Jobs\SendCheckoutEmail;
use App\Mail\OrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOrderNotification
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
    public function handle(OrderStatusUpdated $event): void 
    {
        SendCheckoutEmail::dispatch($event->transaction);
        // Mail::to($event->transaction->user->email)->send(
        //     new OrderNotification($event->transaction)
        // )->queue(new SendCheckoutEmail($event->transaction));
    }
}
