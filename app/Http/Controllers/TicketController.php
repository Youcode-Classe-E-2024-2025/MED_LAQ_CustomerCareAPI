<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Tickets",
 *     description="API Endpoints for Ticket Management"
 * )
 */
class TicketController extends Controller
{
    protected $TicketService;

    public function __construct(TicketService $TicketService)
    {
        $this->TicketService = $TicketService;
    }

    /**
     * @OA\Post(
     *     path="/api/tickets",
     *     tags={"Tickets"},
     *     summary="Create a new ticket",
     *     description="Create a new ticket",
     *     operationId="createTicket",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "description", "status"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="status", type="string", enum={"open", "closed"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Ticket created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Ticket")
     *     ),
     * )
     */

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:open,closed',
        ]);

        $ticket = $this->TicketService->store($data);

        return response()->json($ticket, 201);
    }
    /**
     * @OA\Get(
     *     path="/api/tickets",
     *     tags={"Tickets"},
     *     summary="Get all tickets",
     *     description="Get all tickets",
     *     operationId="getAllTickets",
     *     @OA\Response(
     *         response=200,
     *         description="List of tickets",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Ticket"))
     *     ),
     * )
     */
    public function index()
    {
        $tickets = $this->TicketService->index();

        return response()->json($tickets);
    }
    /**
     * @OA\Get(
     *     path="/api/tickets/{ticket}",
     *     tags={"Tickets"},
     *     summary="Get a ticket by ID",
     *     description="Get a ticket by ID",
     *     operationId="getTicketById",
     *     @OA\Parameter(
     *         name="ticket",
     *         in="path",
     *         required=true,
     *         description="ID of the ticket",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ticket details",
     *         @OA\JsonContent(ref="#/components/schemas/Ticket")
     *     ),
     * )
     */
    public function show($ticket)
    {
        $ticket = $this->TicketService->show($ticket);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        return response()->json($ticket);
    }
    /**
     * @OA\Put(
     *     path="/api/tickets/{ticket}/status",
     *     tags={"Tickets"},
     *     summary="Update ticket status",
     *     description="Update ticket status",
     *     operationId="updateTicketStatus",
     *     @OA\Parameter(
     *         name="ticket",
     *         in="path",
     *         required=true,
     *         description="ID of the ticket",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"status"},
     *             @OA\Property(property="status", type="string", enum={"open", "closed"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ticket status updated successfully"
     *     ),
     * )
     */
    public function updateStatus(Request $request, $ticket)
    {
        $data = $request->validate([
            'status' => 'required|in:open,closed',
        ]);

        $this->TicketService->updateStatus($ticket, $data['status']);

        return response()->json(['message' => 'Ticket status updated successfully']);
    }

    /**
     * @OA\Get(
     *     path="/api/tickets/client/{clientId}",
     *     tags={"Tickets"},
     *     summary="Get tickets for a specific client",
     *     description="Get tickets for a specific client",
     *     operationId="getClientTickets",
     *     @OA\Parameter(
     *         name="clientId",
     *         in="path",
     *         required=true,
     *         description="ID of the client",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of tickets for the client",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Ticket"))
     *     ),
     * )
     */
    public function clientTickets($clientId)
    {
        $tickets = $this->TicketService->clientTickets($clientId);

        return response()->json($tickets);
    }


    /**
     * @OA\Delete(
     *     path="/api/tickets/{ticket}",
     *     tags={"Tickets"},
     *     summary="Delete a ticket",
     *     description="Delete a ticket",
     *     operationId="deleteTicket",
     *     @OA\Parameter(
     *         name="ticket",
     *         in="path",
     *         required=true,
     *         description="ID of the ticket",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ticket deleted successfully"
     *     ),
     * )
     */
    public function deleteTicket($ticket)
    {
        $this->TicketService->deleteTicket($ticket);

        return response()->json(['message' => 'Ticket deleted successfully']);
    }

}
