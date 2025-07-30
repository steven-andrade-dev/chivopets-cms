<?php

namespace App\Http\Controllers;
use App\Services\RolService;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function show(RolService $rolService)
    {
       $rol = $rolService->getRol();
       return response()->json([
        'data' => $rol
       ]);
    }

    public function add(Request $request, RolService $rolService)
    {
        $data = $request->all();
        $rol = $rolService->createRol($data);
        return response()->json(['data' => $rol], 201);
    }

    public function update(Request $request, $id, RolService $rolService)
    {
        $data = $request->all();
        $rol = $rolService->updateRol($id, $data);
        return response()->json(['data' => $rol]);
    }

    public function destroy($id, RolService $rolService)
    {
        $rolService->deleteRol($id);
        return response()->json(['message' => 'Rol Borrado']);
    }

}
