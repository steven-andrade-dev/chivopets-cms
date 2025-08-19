<?php

namespace App\Http\Controllers;
use App\Services\ContentService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSectionRequest;
use App\Helpers\ResponseMessages;

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

    public function update(StoreSectionRequest $request, $id)
    {
       try {
        $data = $request->all();
        $content = $this->contentService->updateContent($id, $data);
        return $this->sendResponse("Content updated successfully", ResponseMessages::successList(), 200);

       } catch (\Exception $e) {
        return $this->sendError(ResponseMessages::errorEception(),$e->getMessage(), 400);
       }


    }

    public function Publish($id)
    {
        $content = $this->contentService->updateContentPublish($id);
        return $this->sendResponse($content, ResponseMessages::successUpdate(), 200);
    }

    public function unPublish($id)
    {
        $content = $this->contentService->contentUnPublish($id);
        return $this->sendResponse($content, ResponseMessages::successUpdate(), 200);
    }

}
