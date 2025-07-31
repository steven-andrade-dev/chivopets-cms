<?php

namespace App\Services;
use App\Interfaces\MainRepositoryInterface;


class MainService
{
    public function __construct(private MainRepositoryInterface $repo) {}

    public function getMain()
    {
        return $this->repo->get_all_main();
    }
     public function createMain(array $data)
    {
        return $this->repo->create_main($data);
    }

    public function updateMain($id, array $data)
    {
        return $this->repo->update_main($id, $data);
    }

    public function deleteMain($id)
    {
        return $this->repo->delete_main($id);
    }
}
