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

}
