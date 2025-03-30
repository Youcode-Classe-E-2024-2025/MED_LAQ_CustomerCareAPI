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

    public function store($request, $ticketId)
{
    $user = Auth::user();
    $ticket = $this->ticketRepository->find($ticketId);

    if (!$ticket) {
        return response()->json(['message' => 'Ticket not found'], 404);
    }

    if ($ticket->client_id !== $user->id && !$user->hasRole('agent')) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    return $this->responseRepository->store($request, $ticket);
}
    public function index($ticketId)
    {
        $ticket = $this->ticketRepository->find($ticketId);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }// Assuming you have a 'role' column in your users table

        return $this->responseRepository->index($ticketId);
    }

}
