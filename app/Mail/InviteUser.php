<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\InviteUser;

class InviteUser extends Mailable
{
    use Queueable, SerializesModels;

    protected $userInvite;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userInvite)
    {
        $this->userInvite = $userInvite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.invite_user')->with([
            'accept_token' => $this->userInvite->accept_token,
        ]);
    }
}
