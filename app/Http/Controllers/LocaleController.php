<?php

namespace App\Http\Controllers;
use App\Services\LocaleService;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function show(LocaleService $localeService)
    {
       $locale = $localeService->getLocale();
       return response()->json([
        'data' => $locale
       ]);
    }

    public function add(Request $request, LocaleService $localeService)
    {
        $data = $request->all();
        $locale = $localeService->createLocale($data);
        return response()->json(['data' => $locale], 201);
    }

    public function update(Request $request, $id, LocaleService $localeService)
    {
        $data = $request->all();
        $locale = $localeService->updateLocale($id, $data);
        return response()->json(['data' => $locale]);
    }

    public function destroy($id, LocaleService $localeService)
    {
        $localeService->deleteLocale($id);
        return response()->json(['message' => 'Idioma Borrado']);
    }

}
