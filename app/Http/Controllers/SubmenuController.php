<?php

namespace App\Http\Controllers;
use App\Services\SubmenuService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Helpers\ResponseMessages;

class SubmenuController extends BaseController
{
    public function __construct(private SubmenuService $submenuService) {}


    public function show($id)
    {
        $submenu = $this->submenuService->getSubmenu($id);
        return $this->sendResponse($submenu, ResponseMessages::successList(), 200);
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $submenu = $this->submenuService->createSubmenu($data);
        return $this->sendResponse($submenu, ResponseMessages::successCreate(), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $submenu = $this->submenuService->updateSubmenu($id, $data);
        return $this->sendResponse($submenu, ResponseMessages::successUpdate(), 200);
    }

    public function destroy($id)
    {
        $this->submenuService->deleteSubmenu($id);
        return $this->sendResponse([], ResponseMessages::successDelete(), 200);
    }
}
