<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\FAQService;
use App\Helpers\ResponseMessages;

class FAQController extends BaseController
{
    public function __construct(private FAQService $faqService) {}
    public function index()
    {
        $faq = $this->faqService->get_all_faq();
        return $this->sendResponse($faq, ResponseMessages::successList(), 200);
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
        $faq = $this->faqService->create_faq($request);
        return $this->sendResponse($faq, ResponseMessages::successList(), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faq = $this->faqService->get_faq_by_id($id);
        return $this->sendResponse($faq, ResponseMessages::successList(), 200);
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
        $faq = $this->faqService->update_faq($request, $id);
        return $this->sendResponse($faq, ResponseMessages::successList(), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
