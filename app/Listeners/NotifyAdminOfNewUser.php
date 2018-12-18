<?php

namespace App\Listeners;

use App\User;
use App\Notifications\NewUser;
use Illuminate\Auth\Events\Registered;

class NotifyAdminOfNewUser
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        User::admin()->each(function ($admin) use ($event) {
            $admin->notify(new NewUser($event->user));
        });
    }
}
