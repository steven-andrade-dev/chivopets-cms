<?php

namespace App\Repositories;

use App\Interfaces\MenuRepositoryInterface;
use App\Models\Menu;
use App\DTO\MenuDTO;
use Illuminate\Http\Request;

class MenuRepository implements MenuRepositoryInterface
{
    public function get_all_menu(Request $request)
    {
        return Menu::with('submenus')->where('id_locale', $request->idLanguage)->get()->map(fn($menu) => MenuDTO::fromModel($menu));
    }

     public function get_menu_with_locale()
    {
        $menus = Menu::withCount('submenus')->get();
        foreach ($menus as $menu) {
            $menu->can_delete = $menu->submenus_count === 0;
        }

        return $menus;
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
