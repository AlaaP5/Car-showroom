<?php

namespace App\Listeners;

use App\Events\CreateUserEvent;
use App\Services\AuthService;
use App\Services\VerificationCodeService;

class sendCodeListener
{
    /**
     * Create the event listener.
     */
    protected $auth;
    public function __construct(AuthService $auth = null)
    {
        $this->auth = $auth;
    }

    /**
     * Handle the event.
     */
    public function handle(CreateUserEvent $event): void
    {
        $this->auth->sendCode($event->user);
    }
}
