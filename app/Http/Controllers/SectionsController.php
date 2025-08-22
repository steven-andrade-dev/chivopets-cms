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

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $locale = $this->sectionService->updateSection($id, $data);
        return $this->sendResponse($locale, ResponseMessages::successUpdate(), 200);
    }

    public function changeStatus($status,$id)
    {
        $locale = $this->sectionService->updateSectionStatus($status,$id);
        return $this->sendResponse($locale, ResponseMessages::successChangeStatus($status), 200);
    }

}
