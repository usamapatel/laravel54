<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\InviteUser;

class SendInvitationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userInvite;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userInvite, $user)
    {
        $this->userInvite = $userInvite;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new InviteUser($this->userInvite);
        Mail::to($this->user->email)->send($email);
    }
}
