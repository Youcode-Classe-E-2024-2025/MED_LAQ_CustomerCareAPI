<?php

namespace App\Services;

use App\Repositories\ResponseRepository;
use App\Repositories\TicketRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class ResponseService
{
    protected $responseRepository;
    protected $ticketRepository;
    protected $userRepository;

    public function __construct(ResponseRepository $responseRepository, TicketRepository $ticketRepository, UserRepository $userRepository)
    {
        $this->responseRepository = $responseRepository;
        $this->ticketRepository = $ticketRepository;
        $this->userRepository = $userRepository;
    }

    public function store($request, $ticket)
    {
        $user = Auth::user();

        if ($user->id !== $ticket->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $this->responseRepository->store($request, $ticket);
    }
    public function index($ticketId)
    {
        $ticket = $this->ticketRepository->find($ticketId);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        return $this->responseRepository->index($ticketId);
    }

}
