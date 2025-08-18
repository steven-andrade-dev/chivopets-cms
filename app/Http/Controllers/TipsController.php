<?php

namespace App\Http\Controllers;

use App\Services\TipsService;
use App\Http\Requests\CreateTipsRequest;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;



class TipsController extends BaseController
{
    public function __construct(private TipsService $tipsService) {}

    public function index(Request $request)
    {
        $tips = $this->tipsService->getAllTips($request,10);
        return $this->sendResponse($tips, ResponseMessages::successList(), 200);
    }

    public function show($id)
    {
        $tips = $this->tipsService->getTipsById($id);
        if (!$tips) {
            return $this->sendError(ResponseMessages::errorNotFound(), 404);
        }
        return $this->sendResponse($tips, ResponseMessages::successList(), 200);
    }

     public function store(CreateTipsRequest $request)
    {
        $tips = $this->tipsService->createTips($request->validated());
        return $this->sendResponse($tips, ResponseMessages::successCreate(), 201);
    }

    public function update(Request $request, $id)
    {
        $tips = $this->tipsService->updateTips($id, $request->all());
        return $this->sendResponse($tips, ResponseMessages::successUpdate(), 200);
    }

    public function destroy($id)
    {
        $this->tipsService->deleteTips($id);
        return $this->sendResponse([], ResponseMessages::successDelete(), 200);
    }
}
