<?php

namespace App\Repositories;
use App\Interfaces\RolRepositoryInterface;
use App\Models\Rol; 

class RolRepository implements RolRepositoryInterface
{
    public function get_all_rol()
    {
        $roles = Rol::withCount('users')->get();
        foreach ($roles as $role) {
            $role->can_delete = $role->users_count === 0;
        }
        return $roles;
    }

    public function get_rol_by_id($id)
    {
        return Rol::find($id);
    }

    public function create_rol(array $data)
    {
        return Rol::create($data);
    }

    public function update_rol($id, array $data)
    {
        $rol = Rol::findOrFail($id);
        $rol->update($data);
        return $rol;
    }

    public function delete_rol($id)
    {
        $rol = Rol::findOrFail($id);
        $rol->delete();
        return true;
    }

}
