<?php

namespace App\Http\Controllers;
use App\Services\SubmenuService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Helpers\ResponseMessages;

class SubmenuController extends BaseController
{
 public function show($id, SubmenuService $submenuService)
{
    $submenu = $submenuService->getSubmenu($id);

    if (!$submenu) {
        return $this->sendError('Submenús no encontrados', [], 404);
    }

    return $this->sendResponse($submenu, ResponseMessages::successList(), 200);
}


    public function store(Request $request, SubmenuService $submenuService)
    {
        $data = $request->all();
        $submenu = $submenuService->createSubmenu($data);
        return $this->sendResponse($submenu, ResponseMessages::successCreate(), 201);
    }

    public function update(Request $request, $id, SubmenuService $submenuService)
    {
        $data = $request->all();
        $submenu = $submenuService->updateSubmenu($id, $data);
        return $this->sendResponse($submenu, ResponseMessages::successUpdate(), 200);
    }

    public function destroy($id, SubmenuService $submenuService)
    {
        $submenuService->deleteSubmenu($id);
        return $this->sendResponse([], ResponseMessages::successDelete(), 200);
    }
}
