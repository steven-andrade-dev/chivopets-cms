<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CarrouselService;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\BaseController;
class CarrouselController extends BaseController
{
    public function __construct(public CarrouselService $carrouselService) {}
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
        $id = $this->carrouselService->save_carrousel($request);
        return $this->sendResponse($id, ResponseMessages::successCreate(), 200);
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
    public function destroy(string $id)
    {
        $this->carrouselService->delete_carrousel($id);
        return $this->sendResponse(null, ResponseMessages::successDelete(), 200);
    }
}
