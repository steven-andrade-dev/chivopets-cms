<?php

namespace App\Services;
use App\Interfaces\MenuRepositoryInterface;


class MenuService
{
    public function __construct(private MenuRepositoryInterface $repo) {}

    public function getMenu()
    {
        return $this->repo->get_all_menu();
    }

    public function getMenuWithLocale()
    {
        return $this->repo->get_menu_with_locale();
    }
     public function createMenu(array $data)
    {
        return $this->repo->create_menu($data);
    }

    public function updateMenu($id, array $data)
    {
        return $this->repo->update_menu($id, $data);
    }

    public function deleteMenu($id)
    {
        return $this->repo->delete_menu($id);
    }
}
