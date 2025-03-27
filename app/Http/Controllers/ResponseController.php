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

    public function index()
{
    try {
        $responses = $this->responseService->all();

        return response()->json([
            'responses' => $responses,
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred while retrieving responses',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'content' => 'required|string'
        ]);

        $validated['ticket_id'] = $id;

        $response = $this->responseService->create($validated);

        if (!$response) {
            return response()->json([
                'message' => "you can't add response to this ticket"
            ], 403);
        }

        return response()->json([
            'response' => $response,
            'message' => 'response created'
        ], 201);
    }

    
    public function show(string $id)
    {
        $response = $this->responseService->find($id);

        if (!$response) {
            return response()->json([
                'message' => 'not fount',
            ], 404);
        }

        return response()->json([
            'response' => $response
        ], 200);
    }

    
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(['content' => 'required|string']);

        $response = $this->responseService->update($id, $validated);

        if (!$response) {
            return response()->json([
                'message' => 'not found',
            ], 404);
        }

        return response()->json([
            'response' => $response,
            'message' => 'response updated'
        ], 201);
    }

    public function destroy(string $id)
    {
        $result = $this->responseService->delete($id);

        if (!$result) {
            return response()->json([
                'message' => 'not found',
            ], 404);
        }

        return response()->json([
            'message' => 'response deleted',
        ], 200);
    }

    public function getTicketResponses(int $ticketId)
    {
        return $this->responseService->getTicketResponses($ticketId);
    }
}