<?php

namespace App\Services;
use App\Interfaces\DescriptionCasesRepositoryInterface;

class DescriptionCasesService
{
    public function __construct(private DescriptionCasesRepositoryInterface $repo) {}

    public function getAllDescriptionCases()
    {
        return $this->repo->get_all_description_cases();
    }

    public function getDescriptionCaseById(int $id)
    {
        return $this->repo->get_description_case_by_id($id);
    }

    public function createDescriptionCase(array $data)
    {
        return $this->repo->create_description_case($data);
    }

    public function updateDescriptionCase(int $id, array $data)
    {
        return $this->repo->update_description_case($id, $data);
    }

    public function deleteDescriptionCase(int $id)
    {
        return $this->repo->delete_description_case($id);
    }
    
    public function reorder(array $orders)
    {
        return $this->repo->reorder($orders);
    }
}