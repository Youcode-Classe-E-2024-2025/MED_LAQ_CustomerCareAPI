<?php


namespace App\Repositories;

use App\Models\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class ResponseRepository
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }


}
