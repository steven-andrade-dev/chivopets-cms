<?php

namespace App\Http\Controllers;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Helpers\ResponseMessages;

class UserController extends BaseController
{
    public function show(UserService $userService)
    {
       $user = $userService->getUser();
       return $this->sendResponse($user, ResponseMessages::successList(), 200);
    }

    public function store(Request $request, UserService $userService)
    {
        $data = $request->all();
        $user = $userService->createUser($data);
        return $this->sendResponse($user, ResponseMessages::successCreate(), 201);
    }

    public function update(Request $request, $id, UserService $userService)
    {
        $data = $request->all();
        $user = $userService->updateUser($id, $data);
        return $this->sendResponse($user, ResponseMessages::successUpdate(), 200);
    }

    public function destroy($id, UserService $userService)
    {
        $userService->deleteUser($id);
        return $this->sendResponse([], ResponseMessages::successDelete(), 200);
    }
}
