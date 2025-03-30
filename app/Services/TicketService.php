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

    public function store($data)
{
    $validator = Validator::make($data, [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'status' => 'required|in:open,closed',
    ]);

    if ($validator->fails()) {
        throw new ValidationException($validator);
    }

    $data['client_id'] = Auth::id();

    return $this->ticketRepository->store($data);
}

    public function index()
    {
        return $this->ticketRepository->index();
    }

    public function show($ticket)
    {
        return $this->ticketRepository->show($ticket);
    }


    public function updateStatus($ticket, $status)
    {
        $validator = Validator::make(['status' => $status], [
            'status' => 'required|in:open,closed',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->ticketRepository->updateStatus($ticket, $status);
    }
    public function clientTickets($clientId)
    {
        return $this->ticketRepository->clientTickets($clientId);
    }
    public function deleteTicket($ticket)
    {
        return $this->ticketRepository->deleteTicket($ticket);
    }
}
