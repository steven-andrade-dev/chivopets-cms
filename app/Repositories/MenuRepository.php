<?php

namespace App\Repositories;

use App\Interfaces\MenuRepositoryInterface;
use App\Models\Menu;
use App\DTO\MenuDTO;

class MenuRepository implements MenuRepositoryInterface
{
    public function get_all_menu()
    {
        return Menu::with('submenus')->get()->map(fn($menu) => MenuDTO::fromModel($menu));
    }

    public function get_menu_with_locale()
    {
        return Menu::with('locale')->get();
    }

     public function get_menu_by_id($id)
    {
        return Menu::find($id);
    }

        public function create_menu(array $data)
    {
        return Menu::create($data);
    }

    public function update_menu($id, array $data)
    {
        $menu = Menu::findOrFail($id);
        $menu->update($data);
        return $menu;
    }

    public function delete_menu($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return true;
    }
}
