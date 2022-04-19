<?php

namespace App\Listeners;

use App\Events\DbSyncDoneEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SyncCompletedLogListener
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
     * @param  \App\Events\DbSyncDoneEvent  $event
     * @return void
     */
    public function handle(DbSyncDoneEvent $event)
    {
        Log::channel('spacelog')->info('All data from SpaceX Api :', [
            'capsules' => $event->capsulesFromSpaceX
        ]);
    }
}
