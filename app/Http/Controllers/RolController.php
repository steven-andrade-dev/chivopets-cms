<?php

namespace App\Http\Controllers;
use App\Services\RolService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Helpers\ResponseMessages;

class RolController extends BaseController
{
    public function show(RolService $rolService)
    {
       $rol = $rolService->getRol();
       return $this->sendResponse($rol, ResponseMessages::successList(), 200);
    }

    public function add(Request $request, RolService $rolService)
    {
        $data = $request->all();
        $rol = $rolService->createRol($data);
        return $this->sendResponse($rol, ResponseMessages::successCreate(), 201);
    }

    public function update(Request $request, $id, RolService $rolService)
    {
        $data = $request->all();
        $rol = $rolService->updateRol($id, $data);
        return $this->sendResponse($rol, ResponseMessages::successUpdate(), 200);
    }

    public function destroy($id, RolService $rolService)
    {
        $rolService->deleteRol($id);
        return $this->sendResponse([], ResponseMessages::successDelete(), 200);
    }
}