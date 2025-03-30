<?php


namespace App\Repositories;

use App\Models\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class ResponseRepository
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function createResponse($data)
    {
        $validator = Validator::make($data, [
            'ticket_id' => 'required|exists:tickets,id',
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->response->create($data);
    }
    public function getAllResponses()
    {
        return $this->response->all();
    }
    public function getResponseById($id)
    {
        return $this->response->find($id);
    }
    public function updateResponse($id, $data)
    {
        $response = $this->getResponseById($id);
        if ($response) {
            $response->update($data);
            return $response;
        }
        return null;
    }
    public function deleteResponse($id)
    {
        $response = $this->getResponseById($id);
        if ($response) {
            return $response->delete();
        }
        return false;
    }
    public function getResponsesByTicketId($ticketId)
    {
        return $this->response->where('ticket_id', $ticketId)->get();
    }
    public function getResponsesByUserId($userId)
    {
        return $this->response->where('user_id', $userId)->get();
    }
    public function getResponsesByStatus($ticketId, $status)
    {
        return $this->response->where('ticket_id', $ticketId)->where('status', $status)->get();
    }


}
