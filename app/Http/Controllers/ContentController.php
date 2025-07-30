<?php

namespace App\Http\Controllers;
use App\Services\ContentService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSectionRequest;

class ContentController extends BaseController
{
    public function __construct(private ContentService $contentService) {}
    public function show(Request $request)
    {
       $id = $request->id;
       $contents = $this->contentService->getContent($id);
       return response()->json([
        'data' => $contents
       ]);
    }
    public function showById(Request $request)
    {
        $id = $request->id;
        $content = $this->contentService->getContentById($id);
        return response()->json([
            'data' => $content
        ]);
    }

    public function updateContent(StoreSectionRequest $request)
    {
       try {
        $validated = $request->validated();
        $content = $this->contentService->updateContent($validated);
        return $this->sendResponse("Content updated successfully", ResponseMessages::successList(), 200);

       } catch (\Exception $e) {
        return $this->sendError(ResponseMessages::errorUpdate(), [], 400);
       }
    }

}
