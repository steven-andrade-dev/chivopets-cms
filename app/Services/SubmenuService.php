<?php
 
namespace App\Services;
use App\Interfaces\SubmenuRepositoryInterface;


class SubmenuService
{
    public function __construct(private SubmenuRepositoryInterface $repo) {}

    public function getSubmenu()
    {
        return $this->repo->get_all_submenu();
    }

    public function createSubmenu(array $data)
    {
        return $this->repo->create_submenu($data);
    }

    public function updateSubmenu($id, array $data)
    {
        return $this->repo->update_submenu($id, $data);
    }

    public function deleteSubmenu($id)
    {
        return $this->repo->delete_submenu($id);
    }

}