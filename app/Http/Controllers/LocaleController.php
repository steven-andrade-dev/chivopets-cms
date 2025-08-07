<?php

namespace App\Http\Controllers;
use App\Services\LocaleService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Helpers\ResponseMessages;

class LocaleController extends BaseController
{
    public function show(LocaleService $localeService)
    {
       $locale = $localeService->getLocale();
       return $this->sendResponse($locale, ResponseMessages::successList(), 200);
    }

    public function add(Request $request, LocaleService $localeService)
    {
        $data = $request->all();
        $locale = $localeService->createLocale($data);
        return $this->sendResponse($locale, ResponseMessages::successCreate(), 201);
    }

    public function update(Request $request, $id, LocaleService $localeService)
    {
        $data = $request->all();
        $locale = $localeService->updateLocale($id, $data);
        return $this->sendResponse($locale, ResponseMessages::successUpdate(), 200);
    }

    public function destroy($id, LocaleService $localeService)
    {
        $localeService->deleteLocale($id);
        return $this->sendResponse([], ResponseMessages::successDelete(), 200);
    }
}