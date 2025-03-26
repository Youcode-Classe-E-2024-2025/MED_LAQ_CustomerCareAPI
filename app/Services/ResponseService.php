<?php


namespace App\Services;

use App\Models\Response;
use App\Repositories\ResponseRepository;

class ResponseService
{
    protected $responseRepository;

    public function __construct(ResponseRepository $responseRepository)
    {
        $this->responseRepository = $responseRepository;
    }

    /**
     * Get all responses
     * 
     * @return array
     */
    public function all()
    {
        return $this->responseRepository->all();
    }

    /**
     * Create a new response
     * 
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        return $this->responseRepository->create($data);
    }


    /**
     * Find response by ID
     * 
     * @param int $id
     * @return array
     */
    public function find(int $id)
    {
        return $this->responseRepository->find($id);
    }


    /**
     * Update response
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */


    public function update(int $id, array $data)
    {
        return $this->responseRepository->update($id, $data);
    }



    /**
     * Delete response
     * 
     * @param int $id
     * @return bool
     */


    public function delete(int $id)
    {
        return $this->responseRepository->delete($id);
    }
}