<?php


namespace App\Repositories;

use App\Models\Ticket;
use PhpParser\Node\Stmt\Function_;

class TicketRepository
{
    protected $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function store($data)
    {
        return $this->ticket->create($data);
    }

    public function index()
    {
        return $this->ticket->all();
    }
    public function show($ticket)
    {
        return $this->ticket->find($ticket);
    }

    public function updateStatus($ticket, $status)
    {
        $ticket = $this->ticket->find($ticket);
        $ticket->status = $status;
        return $ticket->save();
    }

    public function clientTickets($clientId)
    {
        return $this->ticket->where('client_id', $clientId)->get();
    }

    public function deleteTicket($ticket)
    {
        $ticket = $this->ticket->find($ticket);
        return $ticket->delete();
    }

}
