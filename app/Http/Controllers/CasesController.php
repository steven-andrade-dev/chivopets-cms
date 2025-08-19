<?php

namespace App\Http\Controllers;

use App\Services\CasesService;
use App\Http\Requests\CreateCaseRequest;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;



class CasesController extends BaseController
{
    public function __construct(private CasesService $casesService) {}

    public function index(Request $request)
    {
        $cases = $this->casesService->getAllCases($request,10);
        return $this->sendResponse($cases, ResponseMessages::successList(), 200);
    }

    public function show($id)
    {
        $case = $this->casesService->getCaseById($id);
        if (!$case) {
            return $this->sendError(ResponseMessages::errorNotFound(), 404);
        }
        return $this->sendResponse($case, ResponseMessages::successList(), 200);
    }

     public function store(CreateCaseRequest $request)
    {
        $case = $this->casesService->createCase($request->validated());
        return $this->sendResponse($case, ResponseMessages::successCreate(), 201);
    }

    public function update(Request $request, $id)
    {
        $case = $this->casesService->updateCase($id, $request->all());
        return $this->sendResponse($case, ResponseMessages::successUpdate(), 200);
    }

    public function destroy($id)
    {
        $this->casesService->deleteCase($id);
        return $this->sendResponse([], ResponseMessages::successDelete(), 200);
    }
}
