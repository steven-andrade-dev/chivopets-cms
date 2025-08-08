<?php

namespace App\Http\Controllers;
use App\Services\LocaleService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Helpers\ResponseMessages;

class LocaleController extends BaseController
{
    public function __construct(private LocaleService $localeService) {}

    public function show()
    {
       $locale = $this->localeService->getLocale();
       return $this->sendResponse($locale, ResponseMessages::successList(), 200);
    }

    public function add(Request $request)
    {
        $data = $request->all();
        $locale = $this->localeService->createLocale($data);
        return $this->sendResponse($locale, ResponseMessages::successCreate(), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $locale = $this->localeService->updateLocale($id, $data);
        return $this->sendResponse($locale, ResponseMessages::successUpdate(), 200);
    }

    public function destroy($id)
    {
        $this->localeService->deleteLocale($id);
        return $this->sendResponse([], ResponseMessages::successDelete(), 200);
    }
}