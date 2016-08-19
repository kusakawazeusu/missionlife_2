<?php

namespace App\Listeners;

use App\Events\Purchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Confirmation
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
     * @param  Purchased  $event
     * @return void
     */
    public function handle(Purchased $event)
    {
        //
    }
}
