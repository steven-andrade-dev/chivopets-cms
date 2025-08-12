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

    public function getCaseById(int $id)
    {
        return $this->repo->get_case_by_id($id);
    }

    public function createCase(array $data)
    {
        return $this->repo->create_case($data);
    }

    public function updateCase(int $id, array $data)
    {
        return $this->repo->update_case($id, $data);
    }

    public function deleteCase(int $id)
    {
        return $this->repo->delete_case($id);
    }
}