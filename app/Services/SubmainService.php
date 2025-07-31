<?php
 
namespace App\Services;
use App\Interfaces\SubmainRepositoryInterface;


class SubmainService
{
    public function __construct(private SubmainRepositoryInterface $repo) {}

    public function getSubmain()
    {
        return $this->repo->get_all_submain();
    }

    public function createSubmain(array $data)
    {
        return $this->repo->create_submain($data);
    }

    public function updateSubmain($id, array $data)
    {
        return $this->repo->update_submain($id, $data);
    }

    public function deleteSubmain($id)
    {
        return $this->repo->delete_submain($id);
    }

}