<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MainService;
use App\Http\Controllers\BaseController;
use App\Helpers\ResponseMessages;

class MainController extends BaseController
{
    public function getAllMain(MainService $mainService)
    {
       $mainList = $mainService->getMain();
       return $this->sendResponse($mainList, ResponseMessages::successList(), 200);
    }

     public function show(MainService $mainService)
    {
       $main = $mainService->getMainWithLocale();
       return $this->sendResponse($main, ResponseMessages::successList(), 200);
    }
    
    public function store(Request $request, MainService $mainService)
    {
        $data = $request->all();
        $main = $mainService->createMain($data);
        return $this->sendResponse($main, ResponseMessages::successCreate(), 201);
    }

    public function update(Request $request, $id, MainService $mainService)
    {
        $data = $request->all();
        $main = $mainService->updateMain($id, $data);
        return $this->sendResponse($main, ResponseMessages::successUpdate(), 200);
    }

    public function destroy($id, MainService $mainService)
    {
        $mainService->deleteMain($id);
        return $this->sendResponse([], ResponseMessages::successDelete(), 200);
    }
}
