<?php

namespace App\Services;
use App\Interfaces\TipsRepositoryInterface;
use Illuminate\Http\Request;


class TipsService
{
    public function __construct(private TipsRepositoryInterface $repo) {}

    public function getAllTips(Request $request, $page)
    {
        return $this->repo->get_all_tips($request ,$page);
    }

    public function getTipsById(int $id)
    {
        return $this->repo->get_tips_by_id($id);
    }

    public function createTips(array $data)
    {
        return $this->repo->create_tips($data);
    }

    public function updateTips(int $id, array $data)
    {
        return $this->repo->update_tips($id, $data);
    }

    public function deleteTips(int $id)
    {
        return $this->repo->delete_tips($id);
    }
}