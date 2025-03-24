<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $TicketService;

    public function __construct(TicketService $TicketService)
    {
        $this->TicketService = $TicketService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->TicketService->all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->TicketService->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return $this->TicketService->find($ticket->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        return $this->TicketService->update($ticket->id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        return $this->TicketService->delete($ticket->id);
    }
}
