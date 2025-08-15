<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Helpers\ResponseMessages;
use App\Services\LogService;

class LogController extends BaseController
{
    public function __construct(private LogService $logService) {}

    public function index(){
        return $this->sendResponse($this->logService->getAllLogPaginate(20), ResponseMessages::successList(), 200);
    }

    public function store(){

    }

    public function update(){

    }

    public function show(){

    }

    public function edit(){

    }
}
