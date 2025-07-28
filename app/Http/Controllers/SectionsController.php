<?php

namespace App\Http\Controllers;
use App\Services\SectionService;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    public function show(SectionService $sectionService)
    {
       $sections = $sectionService->getSection();
       return response()->json([
        'data' => $sections
       ]);
    }
    
}
