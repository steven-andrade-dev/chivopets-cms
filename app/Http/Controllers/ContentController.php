<?php

namespace App\Http\Controllers;
use App\Services\ContentService;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function show(ContentService $contentService)
    {
       $contents = $contentService->getContent();
       return response()->json([
        'data' => $contents
       ]);
    }
    
}
