<?php

namespace App\Listeners;

use App\Events\DbSyncDoneEvent;
use App\Models\User;
use App\Notifications\SyncTaskDoneNotification;

class SendNotificationToAdmin
{
    /**
     * Send notification to admin event.
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
