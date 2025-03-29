<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Register a new user
     *
     * @param array $data
     * @return array
     * @throws ValidationException
     */
    public function register(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $user = $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ];
    }

    /**
     * Login a user
     *
     * @param array $credentials
     * @return array
     * @throws \Exception
     */
    public function login(array $credentials)
    {
        $validator = Validator::make($credentials, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        if (!Auth::attempt($credentials)) {
            throw new \Exception('Invalid login credentials', 401);
        }

        $user = $this->userRepository->findByEmail($credentials['email']);
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ];
    }

    /**
 * Logout a user
 *
 * @param int|User $user
 * @return bool
 */
public function logout($user)
{
    if ($user instanceof User) {
        return $user->tokens()->delete();
    }

    $user = $this->userRepository->find($user);
    if (!$user) {
        return false;
    }
    return $user->tokens()->delete();
}
    /**
     * Get authenticated user
     *
     * @param int $userId
     * @return User|null
     */
    public function getAuthenticatedUser(int $userId)
    {
        return $this->userRepository->find($userId);
    }

    /**
     * Refresh the authentication token
     *
     * @param User $user
     * @return string
     */

    public function refreshToken($user)
    {
        $user->tokens()->delete();
        return $user->createToken('auth_token')->plainTextToken;
    }
}
