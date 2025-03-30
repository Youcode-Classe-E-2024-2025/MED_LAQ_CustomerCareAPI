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

    public function createTicket($data)
    {
        return $this->ticket->create($data);
    }

    public function getAllTickets()
    {
        return $this->ticket->all();
    }
    public function getAllTicketsByUserId($userId)
    {
        return $this->ticket->where('user_id', $userId)->get();
    }
    public function getAllTicketsByStatus($status)
    {
        return $this->ticket->where('status', $status)->get();
    }
    public function getTicketById($id)
    {
        return $this->ticket->find($id);
    }

    public function updateTicket($id, $data)
    {
        $ticket = $this->getTicketById($id);
        if ($ticket) {
            $ticket->update($data);
            return $ticket;
        }
        return null;
    }

    public function deleteTicket($id)
    {
        $ticket = $this->getTicketById($id);
        if ($ticket) {
            return $ticket->delete();
        }
        return false;
    }
    public function getTicketsByUserId($userId)
    {
        return $this->ticket->where('user_id', $userId)->get();
    }
    public function getTicketsByStatus($status)
    {
        return $this->ticket->where('status', $status)->get();
    }


}
