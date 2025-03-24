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
     * Display a listing of the tickets.
     * 
     * @OA\Get(
     *     path="/api/tickets",
     *     summary="Get all tickets",
     *     tags={"Tickets"},
     *     @OA\Response(
     *         response=200,
     *         description="List of all tickets",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Ticket")
     *         )
     *     )
     * )
     */
    
    public function index()
    {
        return $this->TicketService->all();
    }

    /**
     * Store a newly created ticket in storage.
     * 
     * @OA\Post(
     *     path="/api/tickets",
     *     summary="Create a new ticket",
     *     tags={"Tickets"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Ticket")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Ticket created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Ticket")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        return $this->TicketService->create($request->all());
    }

    /**
     * Display the specified ticket.
     * 
     * @OA\Get(
     *     path="/api/tickets/{id}",
     *     summary="Get a ticket by ID",
     *     tags={"Tickets"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Ticket ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ticket details",
     *         @OA\JsonContent(ref="#/components/schemas/Ticket")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ticket not found"
     *     )
     * )
     */
    public function show(Ticket $ticket)
    {
        return $this->TicketService->find($ticket->id);
    }

    /**
     * Update the specified ticket in storage.
     * 
     * @OA\Put(
     *     path="/api/tickets/{id}",
     *     summary="Update an existing ticket",
     *     tags={"Tickets"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Ticket ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Ticket")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ticket updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Ticket")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ticket not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function update(Request $request, Ticket $ticket)
    {
        return $this->TicketService->update($ticket->id, $request->all());
    }

    /**
     * Remove the specified ticket from storage.
     * 
     * @OA\Delete(
     *     path="/api/tickets/{id}",
     *     summary="Delete a ticket",
     *     tags={"Tickets"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Ticket ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ticket deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ticket not found"
     *     )
     * )
     */
    public function destroy(Ticket $ticket)
    {
        return $this->TicketService->delete($ticket->id);
    }
}