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

    public function createResponse($data)
    {
        $data['user_id'] = Auth::id();
        return $this->responseRepository->createResponse($data);
    }

    public function getAllResponses($ticketId)
    {
        return $this->responseRepository->getAllResponses($ticketId);
    }

    public function getResponseById($id)
    {
        return $this->responseRepository->getResponseById($id);
    }
    public function updateResponse($id, $data)
    {
        return $this->responseRepository->updateResponse($id, $data);
    }
    public function deleteResponse($id)
    {
        return $this->responseRepository->deleteResponse($id);
    }

    public function getResponsesByTicketId($ticketId)
    {
        return $this->responseRepository->getResponsesByTicketId($ticketId);
    }
    public function getResponsesByUserId($userId)
    {
        return $this->responseRepository->getResponsesByUserId($userId);
    }

    public function getResponsesByStatus($ticketId, $status)
    {
        return $this->responseRepository->getResponsesByStatus($ticketId, $status);
    }
}
