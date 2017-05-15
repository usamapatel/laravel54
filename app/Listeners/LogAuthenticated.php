<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use App\Exceptions\UserNotVerifiedException;

class LogAuthenticated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param Authenticated $event
     *
     * @return void
     */
    public function handle(Authenticated $event)
    {
        if (! $event->user->is_verified) {
            throw new UserNotVerifiedException('User Not verified');
        }
    }
}
