<?php

namespace App\Listeners;

use App\Events\DbSyncDoneEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\SyncTaskDoneNotification;

class SendNotificationToAdmin
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
        User::whereRole('admin')->each(function ($user) use ($event) {
            $user->notify(new SyncTaskDoneNotification($event->capsulesFromSpaceX));
        });
    }
}
