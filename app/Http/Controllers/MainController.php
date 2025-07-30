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
}
