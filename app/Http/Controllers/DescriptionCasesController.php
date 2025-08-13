<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DescriptionCasesService;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\BaseController;



class DescriptionCasesController extends BaseController
{
    public function __construct(private DescriptionCasesService $DescriptionCasesService) {}

    public function index()
    {
        $cases = $this->DescriptionCasesService->getAllDescriptionCases();
        return $this->sendResponse($cases, ResponseMessages::successList(), 200);
    }

    public function show($id)
    {
        $case = $this->DescriptionCasesService->getDescriptionCaseById($id);
        if (!$case) {
            return $this->sendError(ResponseMessages::errorNotFound(), 404);
        }
        return $this->sendResponse($case, ResponseMessages::successList(), 200);
    }

    public function store (Request $request)
    {
        $case = $this->DescriptionCasesService->createDescriptionCase($request->all());
        return $this->sendResponse($case, ResponseMessages::successCreate(), 201);
    }

    public function update(Request $request, $id)
    {
        $case = $this->DescriptionCasesService->updateDescriptionCase($id, $request->all());
        return $this->sendResponse($case, ResponseMessages::successUpdate(), 200);
    }

    public function destroy($id)
    {
        $this->DescriptionCasesService->deleteDescriptionCase($id);
        return $this->sendResponse([], ResponseMessages::successDelete(), 200);
    }


        public function reorder(Request $request)
    {
        $this->DescriptionCasesService->reorder($request->input('orders', []));
        return $this->sendResponse([], ResponseMessages::successUpdate(), 200);
    }

}
