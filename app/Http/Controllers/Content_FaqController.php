<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Content_FAQService;
use App\Http\Controllers\BaseController;
use App\Helpers\ResponseMessages;

class Content_FaqController extends BaseController
{
    public function __construct(public Content_FAQService $content_faqService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = $this->content_faqService->saveContent_FAQ($request->all());
        return $this->sendResponse($id, ResponseMessages::successList(), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleted = $this->content_faqService->deleteContent_FAQ($id);
        if ($deleted) {
            return $this->sendResponse([], ResponseMessages::successCreate(), 200);
        } else {
            return $this->sendError('Error', ResponseMessages::errorNotFound(), 400);
        }
    }
}
