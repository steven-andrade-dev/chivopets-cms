<?php

namespace App\Http\Controllers;
use App\Services\RolService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Helpers\ResponseMessages;

class RolController extends BaseController
{
    public function __construct(private RolService $rolService) {}

        public function show()
    {
       $rol = $this->rolService->getRol();
       return $this->sendResponse($rol, ResponseMessages::successList(), 200);
    }

    public function add(Request $request)
    {
        $data = $request->all();
        $rol = $this->rolService->createRol($data);
        return $this->sendResponse($rol, ResponseMessages::successCreate(), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $rol = $this->rolService->updateRol($id, $data);
        return $this->sendResponse($rol, ResponseMessages::successUpdate(), 200);
    }

    public function destroy($id)
    {
        $this->rolService->deleteRol($id);
        return $this->sendResponse([], ResponseMessages::successDelete(), 200);
    }
}