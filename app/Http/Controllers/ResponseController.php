<?php

namespace App\Http\Controllers;

use App\Services\ResponseService;
use Illuminate\Http\Request;
class ResponseController extends Controller
{
    protected $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }

    public function createResponse(Request $request)
    {
        $data = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'content' => 'required|string',
        ]);

        $response = $this->responseService->createResponse($data);

        return response()->json($response, 201);
    }
    public function getAllResponses($ticketId)
    {
        $responses = $this->responseService->getAllResponses($ticketId);

        return response()->json($responses);
    }
    public function getResponseById($id)
    {
        $response = $this->responseService->getResponseById($id);

        return response()->json($response);
    }
    public function updateResponse(Request $request, $id)
    {
        $data = $request->validate([
            'content' => 'required|string',
        ]);

        $response = $this->responseService->updateResponse($id, $data);

        return response()->json($response);
    }
    public function deleteResponse($id)
    {
        $response = $this->responseService->deleteResponse($id);

        return response()->json(['message' => 'Response deleted successfully']);
    }
    public function getResponsesByTicketId($ticketId)
    {
        $responses = $this->responseService->getResponsesByTicketId($ticketId);

        return response()->json($responses);
    }
    public function getResponsesByUserId($userId)
    {
        $responses = $this->responseService->getResponsesByUserId($userId);

        return response()->json($responses);
    }
    public function getResponsesByStatus($ticketId, $status)
    {
        $responses = $this->responseService->getResponsesByStatus($ticketId, $status);

        return response()->json($responses);
    }
}
