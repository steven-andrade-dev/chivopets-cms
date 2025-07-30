<?php

namespace App\Http\Controllers;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(UserService $userService)
    {
       $user = $userService->getUser();
       return response()->json([
        'data' => $user
       ]);
    }

    public function add(Request $request, UserService $userService)
    {
        $data = $request->all();
        $user = $userService->createUser($data);
        return response()->json(['data' => $user], 201);
    }

    public function update(Request $request, $id, UserService $userService)
    {
        $data = $request->all();
        $user = $userService->updateUser($id, $data);
        return response()->json(['data' => $user]);
    }

    public function destroy($id, UserService $userService)
    {
        $userService->deleteUser($id);
        return response()->json(['message' => 'Usuario Borrado']);
    }

}
