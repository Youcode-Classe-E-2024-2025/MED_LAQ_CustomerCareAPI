<?php

namespace App\Services;


use App\Repositories\TicketRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;



class TicketService
{

    protected $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function createTicket($data)
    {
        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:open,closed',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $data['user_id'] = Auth::id();

        return $this->ticketRepository->createTicket($data);
    }
    public function getAllTickets()
    {
        return $this->ticketRepository->getAllTickets();
    }
    public function getAllTicketsByUserId($userId)
    {
        return $this->ticketRepository->getAllTicketsByUserId($userId);
    }
    public function getAllTicketsByStatus($status)
    {
        return $this->ticketRepository->getAllTicketsByStatus($status);
    }
    public function getTicketById($id)
    {
        return $this->ticketRepository->getTicketById($id);
    }
    public function updateTicket($id, $data)
    {
        $validator = Validator::make($data, [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:open,closed',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->ticketRepository->updateTicket($id, $data);
    }
    public function deleteTicket($id)
    {
        return $this->ticketRepository->deleteTicket($id);
    }
    public function getTicketsByUserId($userId)
    {
        return $this->ticketRepository->getTicketsByUserId($userId);
    }
    public function getTicketsByStatus($status)
    {
        return $this->ticketRepository->getTicketsByStatus($status);
    }
}
