<?php

namespace App\Services;


use App\Repositories\TicketRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;



class TicketService
{

    protected $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }   


    /**
     * Get all tickets
     * 
     * @return array
     */
    public function all()
    {
        return $this->ticketRepository->all();
    }

    /**
     * Create a new ticket
     * 
     * @param array $data
     * @return array
     * @throws ValidationException
     */
    public function create(array $data)
    {
        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $ticket = $this->ticketRepository->create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => Auth::id(),
            'closed_at' => null,
            'reopened_at' => null,
            'resolved_at' => null,
        ]);

        return $ticket;
    }

    /**
     * Update ticket
     * 
     * @param int $id
     * @param array $data
     * @return array
     * @throws ValidationException
     */
    public function update(int $id, array $data)
    {
        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $ticket = $this->ticketRepository->update($id, [
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        return $ticket;
    }
    
    /**
     * Delete ticket
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        return $this->ticketRepository->delete($id);
    }

    /**
     * Find ticket
     * 
     * @param int $id
     * @return array
     */
    public function find(int $id)
    {
        return $this->ticketRepository->find($id);
    }
}