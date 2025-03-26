<?php


namespace App\Repositories;

use App\Models\Response;

class ResponseRepository
{

    /**
     * Get all responses
     * 
     * @return Response[]
     */
    public function all(): array
    {
        return Response::all()->toArray();
    }
    /**
     * Create a new response
     * 
     * @param array $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return Response::create($data);
    }

    /**
     * Find response by ID
     * 
     * @param int $id
     * @return Response|null
     */
    public function find(int $id): ?Response
    {
        return Response::find($id);
    }

    /**
     * Update response
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $response = $this->find($id);
        
        if (!$response) {
            return false;
        }
        
        return $response->update($data);
    }

    /**
     * Delete response
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $response = $this->find($id);
        
        if (!$response) {
            return false;
        }
        
        return $response->delete();
    }
}