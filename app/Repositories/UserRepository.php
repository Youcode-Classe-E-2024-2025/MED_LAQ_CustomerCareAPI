<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Create a new user
     * 
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * Find user by ID
     * 
     * @param int $id
     * @return User|null
     */
    public function find(int $id): ?User
    {
        return User::find($id);
    }


    /**
     * Update user
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $user = $this->find($id);
        
        if (!$user) {
            return false;
        }
        
        return $user->update($data);
    }

    public function isAgent($id)
    {
        $user = $this->find($id);

        return $user ? $user->isAgent() : false;
    }

    public function isClient($id)
    {
        $user = $this->find($id);

        return $user ? $user->isClient() : false;
    }
    
}