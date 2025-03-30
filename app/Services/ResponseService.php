<?php

namespace App\Services;

use App\Repositories\ResponseRepository;
use App\Repositories\TicketRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class ResponseService
{
    protected $userRepository;
    protected $ticketRepository;
    protected $responseRepository;

    public function __construct(ResponseRepository $responseRepository, TicketRepository $ticketRepository, UserRepository $userRepository)
    {
        $this->responseRepository = $responseRepository;
        $this->ticketRepository = $ticketRepository;
        $this->userRepository = $userRepository;
    }

}
