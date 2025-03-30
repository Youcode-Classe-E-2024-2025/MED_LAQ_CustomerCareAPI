<?php


namespace App\Repositories;

use App\Models\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class ResponseRepository
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function store(Request $request, Ticket $ticket)
{
    $validator = Validator::make($request->all(), [
        'message' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        throw new ValidationException($validator);
    }

    $response = new Response();
    $response->message = $request->message;
    $response->ticket_id = $ticket->id;
    $response->agent_id = Auth::id();

    if ($response->save()) {
        // Update the ticket status to "closed"
        $ticket->status = 'closed';
        $ticket->save();

        return response()->json(['message' => 'Response created successfully and ticket closed'], 201);
    }

    return response()->json(['message' => 'Failed to create response'], 500);
}
    public function index($ticketId)
    {
        $responses = $this->response->where('ticket_id', $ticketId)->get();

        if ($responses->isEmpty()) {
            return response()->json(['message' => 'No responses found'], 404);
        }

        return response()->json(['data' => $responses], 200);
    }

}
