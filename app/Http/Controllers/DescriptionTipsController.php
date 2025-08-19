<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DescriptionTipsService;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\BaseController;



class DescriptionTipsController extends BaseController
{
    public function __construct(private DescriptionTipsService $DescriptionTipsService) {}

    public function index()
    {
        $tips = $this->DescriptionTipsService->getAllDescriptionTips();
        return $this->sendResponse($tips, ResponseMessages::successList(), 200);
    }

    public function show($id)
    {
        $tips = $this->DescriptionTipsService->getDescriptionTipsById($id);
        if (!$tips) {
            return $this->sendError(ResponseMessages::errorNotFound(), 404);
        }
        return $this->sendResponse($tips, ResponseMessages::successList(), 200);
    }

    public function store (Request $request)
    {
        $tips = $this->DescriptionTipsService->createDescriptionTips($request->all());
        return $this->sendResponse($tips, ResponseMessages::successCreate(), 201);
    }

    public function update(Request $request, $id)
    {
        $tips = $this->DescriptionTipsService->updateDescriptionTips($id, $request->all());
        return $this->sendResponse($tips, ResponseMessages::successUpdate(), 200);
    }

    public function destroy($id)
    {
        $this->DescriptionTipsService->deleteDescriptionTips($id);
        return $this->sendResponse([], ResponseMessages::successDelete(), 200);
    }


        public function reorder(Request $request)
    {
        $this->DescriptionTipsService->reorder($request->input('orders', []));
        return $this->sendResponse([], ResponseMessages::successUpdate(), 200);
    }

}
