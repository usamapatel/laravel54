<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LogSuccessfulLogin
{
    use AuthenticatesUsers;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param Login $event
     *
     * @return void
     */
    public function handle(Login $event)
    {
    }
}
