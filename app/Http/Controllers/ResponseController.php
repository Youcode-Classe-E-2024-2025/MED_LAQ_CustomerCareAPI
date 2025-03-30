<?php

namespace App\Http\Controllers;

use App\Services\ResponseService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Responses",
 *     description="API Endpoints for managing responses"
 * )
 */
class ResponseController extends Controller
{
    protected $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }

    /**
     * @OA\Post(
     *     path="/api/tickets/{ticketId}/responses",
     *     tags={"Responses"},
     *     summary="Create a new response for a ticket",
     *     description="Create a new response for a specific ticket",
     *     operationId="createResponse",
     *     @OA\Parameter(
     *         name="ticketId",
     *         in="path",
     *         required=true,
     *         description="ID of the ticket",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"message"},
     *             @OA\Property(property="message", type="string", example="This is a response message")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Response created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Response created successfully and ticket closed")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Validation error")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ticket not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Ticket not found")
     *         )
     *     )
     * )
     */
    public function store(Request $request, $ticketId)
    {
        return $this->responseService->store($request, $ticketId);
    }

    /**
     * @OA\Get(
     *     path="/api/tickets/{ticketId}/responses",
     *     tags={"Responses"},
     *     summary="Get all responses for a ticket",
     *     description="Retrieve all responses for a specific ticket",
     *     operationId="getResponses",
     *     @OA\Parameter(
     *         name="ticketId",
     *         in="path",
     *         required=true,
     *         description="ID of the ticket",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of responses",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(type="object"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No responses found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="No responses found")
     *         )
     *     )
     * )
     */
    public function index($ticketId)
    {
        return $this->responseService->index($ticketId);
    }
}
