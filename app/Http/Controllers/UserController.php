<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(Request $request)
    {
        $this->userService->createUser($request->all());
    }

    public function update(Request $request, $id)
    {
        $this->userService->updateUser($id, $request->all());
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);
    }
}
