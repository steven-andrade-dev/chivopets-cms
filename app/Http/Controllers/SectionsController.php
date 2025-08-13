<?php

namespace App\Http\Controllers;
use App\Services\SectionService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Helpers\ResponseMessages;

class SectionsController extends BaseController
{
    public function __construct(private SectionService $sectionService) {}


    public function index(Request $request)
    {
       $sections = $this->sectionService->getSection($request, 10);
       return $this->sendResponse($sections, ResponseMessages::successList(), 200);
    }

}
