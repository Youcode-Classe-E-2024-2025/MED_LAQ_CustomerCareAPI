<?php


namespace App\Repositories;

use App\Models\Ticket;
use PhpParser\Node\Stmt\Function_;

class TicketRepository
{

    /**
     * Get all tickets
     * 
     * @return Ticket[]
     */
    public function all(): array
    {
        return Ticket::all()->toArray();
    }
    /**
     * Create a new ticket
     * 
     * @param array $data
     * @return Ticket
     */
    public function create(array $data): Ticket
    {
        return Ticket::create($data);
    }

    /**
     * Find ticket by ID
     * 
     * @param int $id
     * @return Ticket|null
     */
    public function find(int $id): ?Ticket
    {
        return Ticket::find($id);
    }

    /**
     * Update ticket
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $ticket = $this->find($id);
        
        if (!$ticket) {
            return false;
        }
        
        return $ticket->update($data);
    }

    /**
     * Delete ticket
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $ticket = $this->find($id);
        
        if (!$ticket) {
            return false;
        }
        
        return $ticket->delete();
    }


    public function allByUser(int $userId): array
    {
        return Ticket::where('user_id', $userId)->get()->toArray();
    }


    public Function changeStatus(int $id, string $status): bool
    {
        $ticket = $this->find($id);
        
        if (!$ticket) {
            return false;
        }
        
        return $ticket->update(['status' => $status]);
    }
    
}