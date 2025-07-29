<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CasesService;
use App\Http\Requests\CreateCaseRequest;
class CasesController extends Controller
{
    public function __construct(private CasesService $casesService) {}
    public function get()
    {
       $cases = $this->casesService->getAllCases();
       return response()->json([
        'data' => $cases
       ]);
    }

    public function createCase(Request $request)
    {
        $request->validate(CreateCaseRequest::rules());
        return "hello";
    }
}
