<?php
 
namespace App\Services;
use App\Interfaces\RolRepositoryInterface;


class RolService
{
    public function __construct(private RolRepositoryInterface $repo) {}

    public function getRol()
    {
        return $this->repo->get_all_rol();
    }

      public function createRol(array $data)
    {
        return $this->repo->create_rol($data);
    }

    public function updateRol($id, array $data)
    {
        return $this->repo->update_rol($id, $data);
    }

    public function deleteRol($id)
    {
        return $this->repo->delete_rol($id);
    }

}