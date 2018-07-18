<?php

namespace App\Events;

use App\User;

use Illuminate\Queue\SerializesModels;

class ReauthenticateSuccess
{
    use SerializesModels;

    /**
     * User
     *
     * @var User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}