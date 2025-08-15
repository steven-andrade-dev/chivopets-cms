<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MenuService;
use App\Http\Controllers\BaseController;
use App\Helpers\ResponseMessages;

class MenuController extends BaseController
{
    public function __construct(private MenuService $menuService) {}


    public function index(Request $request)
    {
       $menuList = $this->menuService->getMenu($request);
       return $this->sendResponse($menuList, ResponseMessages::successList(), 200);
    }

     public function show()
    {
       $menu = $this->menuService->getMenuWithLocale();
       return $this->sendResponse($menu, ResponseMessages::successList(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $menu = $this->menuService->createMenu($data);
        return $this->sendResponse($menu, ResponseMessages::successCreate(), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $menu = $this->menuService->updateMenu($id, $data);
        return $this->sendResponse($menu, ResponseMessages::successUpdate(), 200);
    }

    public function destroy($id)
    {
        $this->menuService->deleteMenu($id);
        return $this->sendResponse([], ResponseMessages::successDelete(), 200);
    }
}
