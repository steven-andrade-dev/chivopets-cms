<?php

namespace App\Http\Controllers;
use App\Services\SubmainService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Helpers\ResponseMessages;

class SubmainController extends BaseController
{
    public function show(SubmainService $submainService)
    {
       $submain = $submainService->getSubmain();
       return $this->sendResponse($submain, ResponseMessages::successList(), 200);
    }

    public function store(Request $request, SubmainService $submainService)
    {
        $data = $request->all();
        $submain = $submainService->createSubmain($data);
        return $this->sendResponse($submain, ResponseMessages::successCreate(), 201);
    }

    public function update(Request $request, $id, SubmainService $submainService)
    {
        $data = $request->all();
        $submain = $submainService->updateSubmain($id, $data);
        return $this->sendResponse($submain, ResponseMessages::successUpdate(), 200);
    }

    public function destroy($id, SubmainService $submainService)
    {
        $submainService->deleteSubmain($id);
        return $this->sendResponse([], ResponseMessages::successDelete(), 200);
    }
}
