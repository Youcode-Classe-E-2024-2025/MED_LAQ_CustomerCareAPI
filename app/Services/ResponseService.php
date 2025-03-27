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

    public function getTicketResponses($id)
    {
        try {
            $ticket = $this->ticketRepository->find($id);

            if (!$ticket) {
                return null;
            }

            if (Auth::id() !== $ticket->user_id && !$this->userRepository->isAgent(Auth::id())) {
                return null;
            }

            return $this->responseRepository->getTicketResponses($id);
        } catch (\Exception $e) {
            [
                'ticket_id' => $id,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ];
            throw $e;
        }
    }

    public function getResponse($id)
    {
        $response = $this->responseRepository->find($id);
        $ticket = $this->ticketRepository->find($response->ticket_id);

        if (!$response) {
            return null;
        }

        if (Auth::id() !== $ticket->user_id && !$this->userRepository->isAgent(Auth::id())) {
            return null;
        }

        return $response;
    }

    public function create($data)
    {
        $id = $data['ticket_id'];
        $ticket = $this->ticketRepository->find($id);

        if (!$ticket) {
            return null;
        }

        if ($this->userRepository->isAgent(Auth::id())) {
            if ($ticket->agent_id !== Auth::id()) {
                return null;
            }
        } else {
            if ($ticket->user_id !== Auth::id()) {
                return null;
            }
        }

        $data['user_id'] = Auth::id();

        $response = $this->responseRepository->create($data);

        if ($this->userRepository->isAgent(Auth::id()) && $ticket->status === 'open') {
            $this->ticketRepository->changeStatus($id, 'in_progress');
        }

        return $response;
    }

    public function update($id, $data)
    {
        $response = $this->responseRepository->find($id);

        if (!$response) {
            return null;
        }

        if (Auth::id() !== $response->user_id) {
            return null;
        }

        $data = ['content' => $data['content'] ?? $response->content];

        return $this->responseRepository->update($id, $data);
    }

    public function delete($id)
    {
        $response = $this->responseRepository->find($id);

        if (!$response) {
            return false;
        }

        if (Auth::id() !== $response->user_id && $this->userRepository->isAgent(Auth::id())) {
            return false;
        }

        return $this->responseRepository->delete($id);
    }

    public function all()
    {
        return $this->responseRepository->all();
    }

    public function find($id)
    {
        return $this->responseRepository->find($id);
    }
}