<?php

namespace App\Services;
use App\Interfaces\DescriptionTipsRepositoryInterface;

class DescriptionTipsService
{
    public function __construct(private DescriptionTipsRepositoryInterface $repo) {}

    public function getAllDescriptionTips()
    {
        return $this->repo->get_all_description_tips();
    }

    public function getDescriptionTipsById(int $id)
    {
        return $this->repo->get_description_tips_by_id($id);
    }

    public function createDescriptionTips(array $data)
    {
        return $this->repo->create_description_tips($data);
    }

    public function updateDescriptionTips(int $id, array $data)
    {
        return $this->repo->update_description_tips($id, $data);
    }

    public function deleteDescriptionTips(int $id)
    {
        return $this->repo->delete_description_tips($id);
    }
    
    public function reorder(array $orders)
    {
        return $this->repo->reorder($orders);
    }
}