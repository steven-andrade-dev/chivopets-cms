<?php

namespace App\Http\Controllers;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Helpers\ResponseMessages;

class UserController extends BaseController
{
    public function __construct(private UserService $userService) {}

    public function show()
    {
       $user = $this->userService->getUser();
       return $this->sendResponse($user, ResponseMessages::successList(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = $this->userService->createUser($data);
        return $this->sendResponse($user, ResponseMessages::successCreate(), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = $this->userService->updateUser($id, $data);
        return $this->sendResponse($user, ResponseMessages::successUpdate(), 200);
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);
        return $this->sendResponse([], ResponseMessages::successDelete(), 200);
    }
}
