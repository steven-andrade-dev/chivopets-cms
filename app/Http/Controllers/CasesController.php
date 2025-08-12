<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CasesService;
use App\Http\Requests\CreateCaseRequest;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\BaseController;



class CasesController extends BaseController
{
    public function __construct(private CasesService $casesService) {}

    public function index()
    {
        $cases = $this->casesService->getAllCases();
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

    public function store (Request $request)
    {
        $request->validate(CreateCaseRequest::rules());
        $case = $this->casesService->createCase($request->all());
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
