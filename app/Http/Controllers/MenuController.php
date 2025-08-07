<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MenuService;
use App\Http\Controllers\BaseController;
use App\Helpers\ResponseMessages;

class MenuController extends BaseController
{
    public function getAllMenu(MenuService $menuService)
    {
       $menuList = $menuService->getMenu();
       return $this->sendResponse($menuList, ResponseMessages::successList(), 200);
    }

     public function show(MenuService $menuService)
    {
       $menu = $menuService->getMenuWithLocale();
       return $this->sendResponse($menu, ResponseMessages::successList(), 200);
    }

    public function store(Request $request, MenuService $menuService)
    {
        $data = $request->all();
        $menu = $menuService->createMenu($data);
        return $this->sendResponse($menu, ResponseMessages::successCreate(), 201);
    }

    public function update(Request $request, $id, MenuService $menuService)
    {
        $data = $request->all();
        $menu = $menuService->updateMenu($id, $data);
        return $this->sendResponse($menu, ResponseMessages::successUpdate(), 200);
    }

    public function destroy($id, MenuService $menuService)
    {
        $menuService->deleteMenu($id);
        return $this->sendResponse([], ResponseMessages::successDelete(), 200);
    }
}
