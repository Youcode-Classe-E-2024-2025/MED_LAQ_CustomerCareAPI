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

    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'response' => 'required|string|max:255',
            'question_id' => 'required|exists:questions,id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->response->create($data);
    }

    public function index()
    {
        return $this->response->all();
    }
}
