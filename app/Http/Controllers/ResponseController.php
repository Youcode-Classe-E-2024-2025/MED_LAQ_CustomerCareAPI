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

    public function store($request, $ticketId)
    {
        return $this->responseService->store($request, $ticketId);
    }
    public function index($ticketId)
    {
        return $this->responseService->index($ticketId);
    }
}
