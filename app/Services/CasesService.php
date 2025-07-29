<?php

namespace App\Services;
use App\Interfaces\CasesRepositoryInterface;

class CasesService
{
    public function __construct(private CasesRepositoryInterface $repo) {}
    
    public function getAllCases()
    {
        return $this->repo->get_all_cases();
    }
}