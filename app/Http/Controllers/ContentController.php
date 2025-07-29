<?php

namespace App\Http\Controllers;
use App\Services\ContentService;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function show(ContentService $contentService, Request $request)
    {
       $id = $request->id;
       $contents = $contentService->getContent($id);
       return response()->json([
        'data' => $contents
       ]);
    }
    public function showById(ContentService $contentService, Request $request)
    {
        $id = $request->id;
        $content = $contentService->getContentById($id);
        return response()->json([
            'data' => $content
        ]);
    }
    
}
